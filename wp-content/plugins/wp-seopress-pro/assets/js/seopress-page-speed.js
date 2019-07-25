//Request Google Page Speed
jQuery(document).ready(function(){
	jQuery('.seopress-request-page-speed').on('click', function() {
		var data_permalink = jQuery(this).attr('data_permalink');
		jQuery.ajax({
			method : 'GET',
			url : seopressAjaxRequestPageSpeed.seopress_request_page_speed,
			data : {
				action: 'seopress_request_page_speed',
				data_permalink : data_permalink,
				_ajax_nonce: seopressAjaxRequestPageSpeed.seopress_nonce,
			},
			success : function( data ) {
				var url_location = data.data.url;
				if (jQuery(location).attr('href') == url_location) {
					window.location.reload(true);
				} else {
					jQuery(location).attr('href',url_location);
				}
			},
		});
	});
});
jQuery(document).ready(function(){
	jQuery('.seopress-request-page-speed').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner' ).css( "visibility", "visible" );
		jQuery( '.spinner' ).css( "float", "none" );
	});
});

//Clear Google Page Speed Transient
jQuery(document).ready(function(){
	jQuery('#seopress-clear-page-speed-cache').on('click', function() {
		jQuery.ajax({
			method : 'GET',
			url : seopressAjaxClearPageSpeedCache.seopress_clear_page_speed_cache,
			data : {
				action: 'seopress_clear_page_speed_cache',
				_ajax_nonce: seopressAjaxClearPageSpeedCache.seopress_nonce,
			},
			success : function( data ) {
				window.location.reload(true);
			},
		});
	});
});
jQuery(document).ready(function(){
	jQuery('#seopress-clear-page-speed-cache').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner' ).css( "visibility", "visible" );
		jQuery( '.spinner' ).css( "float", "none" );
	});
});