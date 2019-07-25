/**
* Copyright (c) Loft.Ocean
* http://www.loftocean.com
*/

( function( api, $ ) {
	"use strict"; 
	$( 'head' ).append( $( '<style>', { 'id': 'loftloader-pro-hide-site-title', 'text': '.site-title { opacity:  0; }' } ) );
	// Main Switch section 
	api.LoftLoaderSwitchSection = api.Section.extend({
		initialize: function () {
			return api.Section.prototype.initialize.apply( this, arguments );
		},
		ready: function() { 
			var checked = this.container.find( 'input[name=loftloader-pro-main-switch]' ).attr( 'checked' ) ? true : false; 
			$( '#customize-theme-controls' ).attr( 'class', 'loftloader-controls-wrapper' );
			checked ? '' : $( '#customize-theme-controls' ).addClass( 'loftloader-settings-disabled' ); 
		},
		attachEvents: function () {
			var container = this.container;
			container.on( 'change', 'input[name=loftloader-pro-main-switch]', function( e ) {
				var checked  = $( this ).attr( 'checked' ) ? true : false,
					$element = container.find( '#customize-control-loftloader_pro_main_switch_control input[type=checkbox]' ),
					controls_wrap = $( '#customize-theme-controls' );

				checked ? $element.attr( 'checked', 'checked' ) : $element.removeAttr( 'checked' );
				$element.trigger( 'change' );
				checked ? controls_wrap.removeClass( 'loftloader-settings-disabled' ) : controls_wrap.addClass( 'loftloader-settings-disabled' );
			} );
		}
	} );
	$.extend( api.sectionConstructor, { loftloader_switch: api.LoftLoaderSwitchSection } );

	// Slider control
	api.controlConstructor.slider = api.Control.extend( {
		ready: function() {
			var elem = this.container.find( '.loader-ui-slider' ),
				input = this.container.find( 'input[data-customize-setting-link]' );
			elem.slider( {
				'range': 'min',
				'min': elem.data( 'min' ),
				'max': elem.data( 'max' ),
				'value': elem.data( 'value' ),
				'step': elem.data( 'step' ),
				'slide': function( event, ui ) {
					input.val( ui.value ).trigger( 'change' );
				}
			} );
		}
	} );

	api.bind( 'loftloader.message.position', function() {
		var progress_type = $( 'input[data-customize-setting-link=loftloader_progress]:checked' ).val(),
			percentage_position = $( 'input[data-customize-setting-link=loftloader_percentageposition]:checked' ).val(),
			bar_position = $( 'input[data-customize-setting-link=loftloader_barposition]:checked' ).val(),
			$message_position = $( 'input[data-customize-setting-link=loftloader_pro_message_position]' ),
			$middle = $message_position.filter( '[value=middle]' );
		if ( ( ( 'bar' === progress_type ) && ( 'middle' === bar_position ) )
			|| ( ( 'number' === progress_type ) && ( 'below' === percentage_position ) ) ) {
			$middle.parent().css( 'display', '' );
		} else {
			if ( $message_position.filter( '[value=middle]:checked' ).length ) {
				$message_position.filter( '[value=bottom]' ).attr( 'checked', '' ).trigger( 'change' );
				$middle.removeAttr( 'checked' );
			}
			$middle.parent().css( 'display', 'none' );
		}
	} );

	/**
	* Get customize setting value by id
	* @param string setting id 
	* @return string setting value
	*/
	function getSettingValue( id ) {
		if ( id in api.settings.settings ) {
			var settings = api.get(), setting = settings[id];
			return ( setting === true ) ? 'on' : setting;
		}
	}
	/**
	* Get the customize control's first setting name
	* @param object customize control
	* @return mix customize setting id string if exists, otherwise boolean false 
	*/
	function getControlSettingId( control ) {
		var control_settings = control.settings, keys = Object.keys( control_settings ),
			first_key = ( 'default' in control_settings )  ? 'default' : ( keys.length ? keys[0] : false );
		return first_key ? control_settings[ first_key ] : false;
	}
	/**
	* Generate the dependency object for wp.customize.setting.controls
	*/
	function generateDependency() {
		var settings = api.settings.settings, dependency = {}, controls = api.settings.controls;
		$.each( controls, function( id, control ) {
			var setting = getControlSettingId( control );
			if ( setting && settings[setting] && settings[setting].dependency ) {
				$.each( settings[setting].dependency, function( pid, dep ) {
					var element = { 'control': ( api.control( id ) || control ), 'dependency': settings[setting].dependency };
					if ( pid in dependency ) {
						dependency[pid].push( element );
					} else {
						dependency[pid] = [element];
						api( pid ).bind( function( to ){
							api.trigger( 'loftloader.setting.change', pid );
						} );
					}
				} );
			}
		} );
		api.LoftLoaderDependency = dependency;
	} 
	/**
	* To deal with the event of setting changed
	*	This will decide to display the controls related or not
	*/
	api.bind( 'loftloader.setting.change', function( id ) {
		if ( id in api.LoftLoaderDependency ) { // If current setting id is in the dependency list
			$.each( api.LoftLoaderDependency[ id ], function( index, item ) { 
				var $control = item.control.container, pass = true;
				$.each( item.dependency, function( pid, attr ) { // Check if all dependency are passed
					var operator = attr.operator || 'in', value = getSettingValue( pid );

					if ( ( ( 'in' == operator ) && ( -1 === attr.value.indexOf( value ) ) )
						|| ( ( 'not in' == operator ) && ( -1 !== attr.value.indexOf( value ) ) ) ) {
						pass = false;
						return false;
					}
				} );
				// Show control if passed
				pass ? $control.show() : $control.hide();
			});
		}
	});

	// Register event handler for hide controls/description
	api.bind('ready', function( e ) {
		var current_url = document.createElement( 'a' ), current_search;
		current_url.href = api.previewer.previewUrl();
		current_search = api.utils.parseQueryString( current_url.search.substr( 1 ) );
		generateDependency();
		api.previewer.unbind( 'url' ).bind( 'url', function( url ) {
			var previewer = this, onUrlChange, urlChanged = false, urlParser;
			urlParser = document.createElement( 'a' );
			urlParser.href = url;
			urlParser.search = $.param( { 'plugin': 'loftloader' } );
			url = urlParser.href;
			previewer.scroll = 0;
			onUrlChange = function() {
				urlChanged = true;
			}; 
			previewer.previewUrl.bind( onUrlChange );
			previewer.previewUrl.set( url );
			previewer.previewUrl.unbind( onUrlChange );
			if ( ! urlChanged ) {
				previewer.refresh();
			}
		} ); 
		if( ! current_search['plugin'] ) { 
			current_search['plugin'] = 'loftloader';
			current_url.search = $.param( current_search ); 
			api.previewer.previewUrl.set( current_url.href );
		}

		// Change the site title in string "You are customizing ..."
		loftloader_i18n ? $( '.site-title' ).text(loftloader_i18n.name) : '';
		$( '#loftloader-pro-hide-site-title' ).remove();

		api.trigger( 'loftloader.message.position' );

		var llp_radios = [ 'loftloader_bgfilltype', 'loftloader_progress', 'loftloader_animation' ];
		function llp_toggle_controls( container, id ) {
			if ( llp_radios.indexOf( id ) !== -1 ) {
				var val = container.find( 'input[data-customize-setting-link]:checked' ).val(),
					wrap = container.parents('ul').first();
				( val === 'none' ) ? wrap.addClass( 'loftloader-control-disabled' ) : wrap.removeClass( 'loftloader-control-disabled' )
			}
		}
		$.each( llp_radios, function( i, v ) {
			var $radio = $( 'input[data-customize-setting-link=' + v + ']:checked' );
			if ( $radio.length ) {
				llp_toggle_controls( $radio.parents('li.customize-control' ).first(), v );
			}
		} );

		$( 'body' ).on( 'change', 'input[name=loftloader_pro_barwidth_unit]', function( e ) {
			var checked  = $( this ).attr( 'checked' ) ? true : false,
				$element = $( '#customize-control-loftloader_pro_progress_width_unit input[type=checkbox]' );

			checked ? $element.attr( 'checked', 'checked' ) : $element.removeAttr( 'checked' );
			$element.trigger( 'change' );
		} )
		.on( 'change', 'input.loftlader-pro-checkbox', function( e ) {
			var checked  = $( this ).attr( 'checked' ) ? true : false,
				$element = $( this ).siblings( 'input' );
			if ( $element.length ) {
				checked ? $element.attr( 'checked', 'checked' ) : $element.removeAttr( 'checked' );
				$element.trigger( 'change' );
			}
		} )
		.on( 'change', 'input[type=number]', function( e ) {
			var $input = $( this ), changed = false,
				min = $input.attr( 'min' ) ? parseInt( $input.attr( 'min' ) ) : 1,
				val = $input.val() ? parseInt( $input.val() ) : 0,
				max = $input.attr( 'max' ) ? parseInt( $input.attr( 'max' ) ) : false;
			if ( min && ( val < min ) ) {
				val = min;
				changed = true;
			}
			if( max && ( val > max ) ) {
				val = max;
				changed = true;
			}
			if ( changed ) {
				$input.val( val ) .trigger( 'change' );
			} 
		} )
		.on( 'click', '.customize-more-toggle', function( e ) {
			e.preventDefault();
			var self = $( this ),
				description = $( this ).siblings( '.customize-control-description' );

			if ( description.length ) {
				self.hasClass( 'expanded' ) ? description.slideUp( 'slow' ) : description.slideDown( 'slow', function(){ $(this).css( 'display', 'block' ); } );
				self.toggleClass( 'expanded' );
			}
		} )
		.on( 'change', 'input[type=radio]', function( e ) {
			var id = $( this ).attr( 'data-customize-setting-link' );
			if ( llp_radios.indexOf( id ) !== -1 ) {
				llp_toggle_controls( $( this ).parents( 'li.customize-control' ).first(), id );
			}
			switch ( id ) {
				case 'loftloader_progress':
				case 'loftloader_barposition':
				case 'loftloader_percentageposition':
					api.trigger( 'loftloader.message.position' );
					break;
			}
		} )
		.on('click', '.loftloader-pro-any-page-generate', function(e){
			e.preventDefault();
			var shortcode = api.loftloader_pro_generate_parameters();
			$( this )
				.siblings( '.loftloader-pro-any-page-shortcode' )
					.attr('rows', 40 )
					.val( '[loftloader ' + shortcode + ']' )
					.select( );
		} );
	} );
} ) ( wp.customize, jQuery );
