//Reset License
jQuery(document).ready(function(){
	jQuery('#seopress_pro_license_reset').on('click', function() {
		jQuery.ajax({
			method : 'GET',
			url : seopressAjaxResetLicense.seopress_request_reset_license,
			data : {
				action: 'seopress_request_reset_license',
				_ajax_nonce: seopressAjaxResetLicense.seopress_nonce,
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
	jQuery('#seopress_pro_license_reset').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner2' ).css( "visibility", "visible" );
		jQuery( '.spinner2' ).css( "float", "none" );
	});
});