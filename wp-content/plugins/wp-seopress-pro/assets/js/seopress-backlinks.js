//Request Majestic API
jQuery(document).ready(function(){
	jQuery('#seopress-find-backlinks').on('click', function() {
		jQuery.ajax({
			method : 'GET',
			url : seopressAjaxBacklinks.seopress_backlinks,
			data : {
				action: 'seopress_backlinks',
				_ajax_nonce: seopressAjaxBacklinks.seopress_nonce,
			},
			success : function( data ) {
				window.location.reload(true);
			},
		});
	});
});
jQuery(document).ready(function(){
	jQuery('#seopress-find-backlinks').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner' ).css( "visibility", "visible" );
		jQuery( '.spinner' ).css( "float", "none" );
	});
});