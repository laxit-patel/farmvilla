//Save htaccess
jQuery(document).ready(function(){
	jQuery('#seopress-save-htaccess').on('click', function() {
		jQuery.ajax({
			method : 'POST',
			url : seopressAjaxSaveHtaccess.seopress_save_htaccess,
			data : {
				action: 'seopress_save_htaccess', 
				htaccess_content: jQuery('textarea#seopress_htaccess_file').val(),
				_ajax_nonce: seopressAjaxSaveHtaccess.seopress_nonce,
			},
			success : function( data ) {
				window.location.reload(true);
			},
		});
	});
	//htaccess rules
    jQuery('#seopress-tag-htaccess-1').click(function() {
        jQuery("#seopress_htaccess_file").val(jQuery("#seopress_htaccess_file").val() +'\n'+ jQuery('#seopress-tag-htaccess-1').attr('data-tag'));
    });
    jQuery('#seopress-tag-htaccess-2').click(function() {
        jQuery("#seopress_htaccess_file").val(jQuery("#seopress_htaccess_file").val() +'\n'+ jQuery('#seopress-tag-htaccess-2').attr('data-tag'));
    });
    jQuery('#seopress-tag-htaccess-3').click(function() {
        jQuery("#seopress_htaccess_file").val(jQuery("#seopress_htaccess_file").val() +'\n'+ jQuery('#seopress-tag-htaccess-3').attr('data-tag'));
    });
});
jQuery(document).ready(function(){
	jQuery('#seopress-save-htaccess').on('click', function() {
		jQuery(this).attr("disabled", "disabled");
		jQuery( '.spinner' ).css( "visibility", "visible" );
		jQuery( '.spinner' ).css( "float", "none" );
	});
});