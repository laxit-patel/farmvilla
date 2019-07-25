//Lock Google Analytics
jQuery(document).ready(function(){
	jQuery('#seopress-google-analytics-lock').on('click', function() {
		jQuery.ajax({
			method : 'POST',
			url : seopressAjaxLockGoogleAnalytics.seopress_google_analytics_lock,
			data : {
				action: 'seopress_google_analytics_lock',
				_ajax_nonce: seopressAjaxLockGoogleAnalytics.seopress_nonce,
			},
			success : function() {
				window.location.reload(true);
			},
		});
	});
});
jQuery(document).ready(function(){
	jQuery('#seopress-google-analytics-lock').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner' ).css( "visibility", "visible" );
		jQuery( '.spinner' ).css( "float", "none" );
	});
});