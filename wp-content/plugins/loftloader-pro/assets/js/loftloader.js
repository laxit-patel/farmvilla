/**
* Copyright (c) Loft.Ocean
* http://www.loftocean.com
*/

"user strict";

jQuery(window).bind( "pageshow", function( event ) {
	if ( event.originalEvent.persisted ) {
		var $body = jQuery('body');
		$body.length && $body.hasClass('leaves') ? $body.removeClass('leaves') : ''; 
		$body.length && !$body.hasClass('loaded') ? $body.addClass('loaded') : ''; 
	}
} );

/*
 * @description Update the number when choose progress type bar+number
 * @param int current percentage number 0 - 100
 */
function llp_update_progress_count(current, $load){
	if($load && $load.length){
		var $count = $load.next('.load-count'),
			container_width = $load.width() * current / 100,
			offset_x = (container_width > $count.width()) ? (container_width - $count.width()) : 0,
			offset_y = $load.parent().hasClass('bottom') ? '-100%' : '100%';
		$count.css('transform', 'translate(' + offset_x + 'px, ' + offset_y + ')');
	}
}
(function($){
	var llp_file_ext = ['jpg', 'jpeg', 'png', 'gif', 'mov', 'avi', 'mpg', '3gp', '3g2', 'midi', 'mid', 'pdf', 'doc', 'ppt', 'odt', 'pptx', 'docx', 'pps', 'ppsx', 'xls', 'xlsx', 'key', 'mp3', 'ogg', 'wma', 'm4a', 'wav', 'mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv', 'svg', 'svgz'];
	function llp_check_a($a){
		if($a && $a.length){
			var target = $a.attr('target'),
				href = $a.attr('href');
			return ((typeof target == 'undefined') || (target.toLowerCase() != '_blank')) && llp_exclude_a($a) && (href && llp_check_url(href));
		}
		return false;
	}
	function llp_exclude_a($a){
		var $loader = $('#loftloader-wrapper'),
			classes = $a.attr('class'),
			ajax_enabled = classes && (classes.indexOf('ajax') !== -1),
			cart = $a.parent('.site-header-cart').length,
			excluded = $loader.attr('data-insite-transition-excluded');
		excluded = (excluded && $(excluded).length) ? $(excluded) : false;
		return !$a.parent('.product-remove').length 
			&& ((excluded && $a.not(excluded).length) || !excluded)
			&& (typeof $a.attr('onclick') == 'undefined') 
			&& !ajax_enabled && !cart; 
	}
	// Check if url is to current site
	function llp_check_url(url){
		if(url){ 
			var file_ext = false, site_root = document.createElement('a'),
				current = document.createElement('a'), target = document.createElement('a');

			target.href = url; 
			current.href = window.location.href;
			site_root.href = $('#loftloader-wrapper').attr('data-site-url');
			file_ext = target.pathname.split('.').pop();

			return (target.href.replace(/https?:\/\//i, '').indexOf(site_root.href.replace(/https?:\/\//i, '')) === 0)
				&& (url.substr(0, 1) != '#')
				&& !((current.pathname == target.pathname) && (target.hash || (url.indexOf('#') !== -1))) 
				&& (llp_file_ext.indexOf(file_ext) === -1);
		}
		return false;
	}
	// Check if the smooth insite page transition enabled
	function llp_check_insite_transition(){
		var $loader = $('#loftloader-wrapper');
		return $loader.attr('data-insite-transition') && ($loader.attr('data-insite-transition') == 'on') && $loader.attr('data-site-url');
	}

	// Helper extention to test current element has any of the classes listed.
	$.fn.llpHasAnyClass = function(classes){
		var self = $($(this)[0]), ret = false;
		$.each(classes, function(i, cls){
			if(self.hasClass(cls)){
				ret = true;
				return false;
			}
		});
		return ret;
	}
	// Helper function, updating style element in <head> with given id
	function llp_loader_update_style(id, style){
		var $style = $('head').find('#' + id);
		$style = $style.length ? $style : $('<style>').attr('id', id).html('').appendTo($('head'));
		$style.html(style);
	}
	// Change bg image span width and height for loader type image loading
	function llp_loader_type_load_bg_span( $span, $image ) {
		if( $span.length && $image.length ) {
			var values = llp_get_width_height( $image );
			$span.css( { 'width': values.width, 'height': values.height, 'display': '' } );
		}
	}
	// Helper function to get the image width and height
	function llp_get_width_height( $elem ) {
		if( $elem.length ){
			var rect = $elem[0].getBoundingClientRect();
			return { 
				'width': ( rect.width ? rect.width : ( rect.right - rect.left ) ),
				'height': ( rect.height ? rect.height : ( rect.bottom - rect.top ) )
			};
		}
		return false;
	}
	// Show random message by js
	function llp_show_random_message() {
		var $message = $( '#loftloader-wrapper .loader-message' );
		if ( $message.length && ( typeof loftloaderRandomMessage != 'undefined' ) && $.isArray( loftloaderRandomMessage ) ) {
			var messageLength = loftloaderRandomMessage.length, 
				random = Math.random() * ( messageLength - 1 );
			$message.html( loftloaderRandomMessage[ Math.round( random ) ] );
		}
	}
	var $loader = $('#loftloader-wrapper'),  // Loader container
		llp_is_preview = (typeof loftloader_pro !== 'undefined') && (loftloader_pro.preview == 'on'),
		llp_is_loader = llp_is_preview && (typeof parent.wp.customize.settings.settings.loftloader_pro_main_switch !== 'undefined'),
		llp_is_customize = llp_is_preview && (typeof parent.wp.customize.settings.settings.loftloader_pro_main_switch === 'undefined'),
		llp_load_time = $loader.attr('data-load-time') ? parseFloat($loader.attr('data-load-time')) : false,
		llp_flag_wait = llp_load_time ? true : false,
		llp_flag_running = true; 
	llp_is_customize ? $('#loftloader-preview-style-css').remove() : '';
	llp_show_random_message();

	// Always run for both customize preview and normal front end.
	$( document ).ready( function() {
		var $img_load_span = $('#loftloader-wrapper .imgloading-container span');
		if( $img_load_span.length ){
			var $image =  $('#loftloader-wrapper #loader img');
			llp_loader_type_load_bg_span( $img_load_span, $image );
			$image.on( 'load', function( e ) { llp_loader_type_load_bg_span( $img_load_span, $image ); } );
			$( window ).on( 'resize', function( e ) { llp_loader_type_load_bg_span( $img_load_span, $image ); } );
		}
	} );

	// Test if in preview mode. If so, add the hover handler to <body> for loader with percentage progress.
	if(llp_is_loader){
		if($('#loftloader-wrapper .percentage').length || $('#loftloader-wrapper .bar .load-count').length){
			var $loader = $('#loftloader-wrapper .percentage').length ? $('#loftloader-wrapper .percentage') : $('#loftloader-wrapper .bar .load-count'),
				$bar = $('#loftloader-wrapper .bar');
			$bar.children('.load-count').length ? llp_update_progress_count(100, $bar.children('.load')) : '';
			$loader.prop('percentage', 0);
			$('body').hover(function(){
				$loader.prop('percentage', 0).animate(
					{percentage: 100}, 
					{duration: 2850, easing: 'linear', step: function(now){ 
						$(this).text(Math.ceil(now) + '%');
						$(this).hasClass('load-count') ? llp_update_progress_count(now, $(this).prev('.load')) : '';
					}}
				)
			}, function(){
				$loader.stop(true, true).text('100%').prop('percentage', 0);
				$loader.hasClass('load-count') ? llp_update_progress_count(100, $loader.prev('.load')) : '';
			});
		}
	}
	if(!llp_is_preview || llp_is_customize){ // Otherwise, roll the normal loader script
		var $progress = $('#loftloader-wrapper .percentage'),  // Progress element
			progress_once = $loader.hasClass('loftloader-once') && $loader.llpHasAnyClass(['loftloader-imgloading', 'loftloader-rainbow', 'loftloader-circlefilling', 'loftloader-waterfilling', 'loftloader-petals']),
			progress_type = $progress.hasClass('percentage') ? 'percentage' : 'bar';
		$progress = $progress.length ? $progress : $loader.find('.bar .load');
		Progress = {
			status: false, finishPause: 800, $el: $loader, runDuration: 350, current: 0, imgLength: 0, autoDuration: 100, slot: 100,
			progress: $progress, type: progress_type, once: progress_once,
			init: function(length){
				this.imgLength = ((typeof length !== 'undefined') && (length > 0)) ? length : 1;
				this.slot = Math.ceil( 100 / this.imgLength); 
			},
			start: function(){
				$('body').removeClass('loaded');
				this.$el.prop('percentage', 0);
				(this.type == 'percentage') ? this.$el.text('0%') : this.$el.css('transform', 'scaleX(0)');
				this.current = 0;
			},
			stop: function(){
				var cb = this.finish;
				this.render(100, this.finishPause);
				setTimeout(function(){ cb(); }, (this.finishPause + 100));
			},
			update: function(current, done){
				this.current = done;
				this.render(current, this.runDuration);
			},
			render: function(current, runDuration){
				var calDuration = this.slot * 90, next = this.current + 1, progress = this;
				runDuration = ((typeof runDuration !== 'undefined') && (calDuration > runDuration)) ? runDuration : calDuration;
				if(current == 100){
					this.$el.stop(true, true).animate({ percentage: current }, { duration: runDuration, easing: 'swing', step: function(now){
						progress.renderProgress(progress, now);
					}});
				}
				if(next < this.imgLength){
					this.$el.animate({ percentage: Math.floor(next / this.imgLength * 100) }, { duration: (this.slot * this.autoDuration), easing: 'swing', step: function(now){
						progress.renderProgress(progress, now);
					}});
				}
				else if((this.imgLength <= 2)){
					this.$el.animate({ percentage: 80 }, { duration: (this.slot * this.autoDuration), easing: 'swing', step: function(now){
						progress.renderProgress(progress, now);
					}});
				}
			},
			renderProgress: function(progress, now){
				var once = progress.once, type = progress.type, $progress = progress.progress;
				if(type == 'percentage'){
					$progress.text(Math.ceil(now) + '%');
				}
				else{
					$progress.css('transform', 'scaleX(' + (now / 100) + ')');
					if($progress.next('.load-count').length){
						$progress.next('.load-count').text(Math.ceil(now) + '%');
						llp_update_progress_count(now, $progress);
					}
				}
				if(once){
					if($loader.hasClass('loftloader-imgloading')){
						var $img_load_container = $loader.find('.imgloading-container');
						$loader.hasClass('imgloading-horizontal') ? $img_load_container.css('width', (now + '%')) : $img_load_container.css('height', (now + '%'));
					}
					else if($loader.hasClass('loftloader-rainbow')){
						var deg = now * 1.8 - 180;
						llp_loader_update_style('loftloader_pro_once_rainbow', '#loftloader-wrapper.loftloader-rainbow #loader span { -webkit-transform: rotate(' + deg + 'deg); transform: rotate(' + deg + 'deg); }');
					}
					else if($loader.hasClass('loftloader-circlefilling')){
						var scaleY = now / 100;
						llp_loader_update_style('loftloader_pro_once_circlefilling', '#loftloader-wrapper.loftloader-circlefilling #loader span { -webkit-transform: scaleY(' + scaleY + '); transform: scaleY(' + scaleY + '); }');
					}
					else if($loader.hasClass('loftloader-waterfilling')){
						var scaleY = now / 100, transY = now - 100;
						llp_loader_update_style('loftloader_pro_once_waterfilling', '#loftloader-wrapper.loftloader-waterfilling #loader:before { -webkit-transform: scaleY(' + deg + 'deg); transform: scaleY(' + scaleY + '); } #loftloader-wrapper.loftloader-waterfilling #loader span {-webkit-transform: translateY(' + transY + '%); transform: translateY(' + transY + '%); }');
					}
					else if($loader.hasClass('loftloader-petals')){
						var petals = {
							petal0: '{box-shadow: 0 -15px 0 -15px transparent, 10.5px -10.5px 0 -15px transparent, 15px 0 0 -15px transparent, 10.5px 10.5px 0 -15px transparent, 0 15px 0 -15px transparent, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal1: '{box-shadow: 0 -25px 0 -15px currentColor, 10.5px -10.5px 0 -15px transparent, 15px 0 0 -15px transparent, 10.5px 10.5px 0 -15px transparent, 0 15px 0 -15px transparent, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal2: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 15px 0 0 -15px transparent, 10.5px 10.5px 0 -15px transparent, 0 15px 0 -15px transparent, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal3: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 10.5px 10.5px 0 -15px transparent, 0 15px 0 -15px transparent, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal4: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 17.5px 17.5px 0 -15px currentColor, 0 15px 0 -15px transparent, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal5: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 17.5px 17.5px 0 -15px currentColor, 0 25px 0 -15px currentColor, -10.5px 10.5px 0 -15px transparent, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal6: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 17.5px 17.5px 0 -15px currentColor, 0 25px 0 -15px currentColor, -17.5px 17.5px 0 -15px currentColor, -15px 0 0 -15px transparent, -10.5px -10.5px 0 -15px transparent;}',
							petal7: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 17.5px 17.5px 0 -15px currentColor, 0 25px 0 -15px currentColor, -17.5px 17.5px 0 -15px currentColor, -25px 0 0 -15px currentColor, -10.5px -10.5px 0 -15px transparent;}',
							petal8: '{box-shadow: 0 -25px 0 -15px currentColor, 17.5px -17.5px 0 -15px currentColor, 25px 0 0 -15px currentColor, 17.5px 17.5px 0 -15px currentColor, 0 25px 0 -15px currentColor, -17.5px 17.5px 0 -15px currentColor, -25px 0 0 -15px currentColor, -17.5px -17.5px 0 -15px currentColor;}'
						}, style = '', nums = [88, 75, 63, 50, 38, 25, 13], steps = {88: 'petal7', 75: 'petal6', 63: 'petal5', 50: 'petal4', 38: 'petal3', 25: 'petal2', 13: 'petal1'};
						$.each(nums, function(index, value){
							if(now >= value){
								style = petals[steps[value]];
								return false;
							}
						});
						style = (now === 0) ? petals['petal0'] : ((now > 98) ? petals['petal8'] : style);
						llp_loader_update_style('loftloader_pro_once_petals', '#loftloader-wrapper.loftloader-petals #loader span' + style);
					}
				}
			},
			finish: function(){
				$('body').addClass('loaded');
				// Remove class for disable page scroll while loaded
				setTimeout( function(){ 
					$('body').removeClass( 'loftloader-disable-scrolling' ); 
					$('#loftloader-pro-always-show-scrollbar').length ? $('#loftloader-pro-always-show-scrollbar').remove() : '';
				}, 1000 );
				// Remove smooth page transition related styles
				$inline_style = $('#loftloader-page-smooth-transition-bg');
				$inline_style.length ? $inline_style.remove() : '';
				// Remove settings for diagonally split effect
				var $loader_wrap = $('#loftloader-wrapper');
//				!$loader_wrap.data('insite-transition') ? setTimeout(function(){ $loader_wrap.remove(); }, 1500) : '';
				if($loader_wrap.hasClass('split-diagonally')) $loader_wrap.find('.loader-bg').css('background', 'none');

				setTimeout( function(){
					$( document ).trigger( 'loftloaderprodone' );
				}, 1100 );
			}
		}
		// If enable progress or loader with once option, run the loaded percentage calculation.
		if($progress.length || progress_once){
			var ret = $('body').waitForImages({	
				waitForAll: true,
				each: function(done, all){ Progress.update(Math.ceil( done / all * 100 ), done); },
				finished: function(){ llp_flag_wait ? '' : Progress.stop(); llp_flag_running = false; }
			}); 
			(ret['allImgsLength'] > 0) ? Progress.init(ret['allImgsLength']) : '';
            if(llp_load_time){
				if(ret['allImgsLength'] > 0){
					(ret['allImgsLength'] === 1) ? Progress.update(50, 1) : '';
					setTimeout(function(){ llp_flag_running ? '' : Progress.stop(); llp_flag_wait = false; }, llp_load_time);
				}
				else{
					Progress.finishPause = llp_load_time;
					Progress.stop();
					setTimeout(function(){ llp_flag_wait = false; }, llp_load_time);
				}
			}
		}
		else{ // Otherwise, run the simple process, add the loaded class name to <body> after full content loaded.
			$(window).load(function(){
				llp_flag_wait ? '' : Progress.finish();
				llp_flag_running = false;
			});
			llp_load_time ? setTimeout(function(){ llp_flag_running ? '' : Progress.finish(); llp_flag_wait = false; }, llp_load_time) : '';
		}
		$(document).ready(function(){
			var $loader_wrapper = $('#loftloader-wrapper'), show_close_time = '';
			if($loader_wrapper.data('show-close-time')){
				show_close_time = parseInt($loader_wrapper.data('show-close-time'));
				if(show_close_time){
					setTimeout(function(){ $loader_wrapper.find('.loader-close-button').css('display', ''); }, show_close_time);
					$('.loader-close-button').on('click', function(){
						Progress.finish();
					});
				}
			}
			if(llp_check_insite_transition()){
				$('body a').each(function(){
					var $self = $(this),
						href = $self.attr('href');
					if(llp_check_a($self)){
						$self.off('click').on('click', function(e){
							e.preventDefault();
							$('body').addClass('leaves');
							setTimeout(function(){ window.location.href = href; }, 550);
						});
					}
				});
			}
		});
	}
})(jQuery);