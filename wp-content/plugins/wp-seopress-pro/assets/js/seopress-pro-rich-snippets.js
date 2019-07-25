//Schemas tabs
jQuery(document).ready(function(){
    if (jQuery('#seopress-schemas-tabs').length) {
        jQuery("#seopress-schemas-tabs .hidden").removeClass('hidden');
        jQuery("#seopress-schemas-tabs").tabs();
    }

    //Schemas post type
    jQuery('#seopress-your-schema select.dyn').change(function(e) {
        e.preventDefault();

        var select = jQuery(this).val();

        if (select == 'manual_global') {
            jQuery(this).next('input.manual_global').show();
            jQuery(this).closest('p').find('input.manual_global').show();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'manual_img_global') {
            jQuery(this).next('input.manual_img_global').show();
            jQuery(this).closest('p').find('input.manual_img_library_global').hide();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'manual_img_library_global') {
            jQuery(this).next('input.manual_img_global').hide();
            jQuery(this).closest('p').find('input.manual_img_library_global').show();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'manual_date_global') {
            jQuery(this).next('input.manual_date_global').show();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'manual_time_global') {
            jQuery(this).next('input.manual_time_global').show();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'manual_rating_global') {
            jQuery(this).next('input.manual_rating_global').show();
            jQuery(this).closest('p').find('select.cf').hide();
        } else if (select == 'custom_fields') {
            jQuery(this).closest('p').find('input').hide();
            jQuery(this).closest('p').find('input.manual_img_global').hide();
            jQuery(this).closest('p').find('input.manual_img_library_global').hide();
            jQuery(this).closest('p').find('input.manual_date_global').hide();
            jQuery(this).closest('p').find('input.manual_time_global').hide();
            jQuery(this).closest('p').find('input.manual_rating_global').hide();
            jQuery(this).closest('p').find('select.cf').show();
        } else {
            jQuery(this).closest('p').find('select.cf').hide();
            jQuery(this).closest('p').find('input').hide();
        }
    }).trigger('change');

    //Rich Snippets Select
	if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'none') {
        jQuery('.wrap-rich-snippets-type .advice').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'articles') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-articles').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'localbusiness') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-local-business').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'faq') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-faq').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'courses') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-courses').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'recipes') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-recipes').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'videos') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-videos').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'events') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-events').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'products') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-products').show();
    } else if (jQuery("#seopress_pro_rich_snippets_type option:selected").val() == 'review') {
        jQuery('.wrap-rich-snippets-type .advice').hide();
        jQuery('.wrap-rich-snippets-review').show();
    }
    
	jQuery('#seopress_pro_rich_snippets_type').change(function() {
		var seopress_rs_type = jQuery('#seopress_pro_rich_snippets_type').val();
	    if (seopress_rs_type == 'none') {
	    	jQuery('.wrap-rich-snippets-type .advice').show();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'articles') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').show();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }	    
	    if (seopress_rs_type == 'localbusiness') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').show();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'faq') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').show();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'courses') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').show();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'recipes') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').show();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'videos') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').show();
	    	jQuery('.wrap-rich-snippets-events').hide();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'events') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').show();
	    	jQuery('.wrap-rich-snippets-products').hide();
            jQuery('.wrap-rich-snippets-review').hide();
	    }
	    if (seopress_rs_type == 'products') {
            jQuery('.wrap-rich-snippets-type .advice').hide();
            jQuery('.wrap-rich-snippets-articles').hide();
            jQuery('.wrap-rich-snippets-local-business').hide();
            jQuery('.wrap-rich-snippets-faq').hide();
            jQuery('.wrap-rich-snippets-courses').hide();
            jQuery('.wrap-rich-snippets-recipes').hide();
            jQuery('.wrap-rich-snippets-videos').hide();
            jQuery('.wrap-rich-snippets-events').hide();
            jQuery('.wrap-rich-snippets-products').show();
            jQuery('.wrap-rich-snippets-review').hide();
        }
        if (seopress_rs_type == 'review') {
	    	jQuery('.wrap-rich-snippets-type .advice').hide();
	    	jQuery('.wrap-rich-snippets-articles').hide();
	    	jQuery('.wrap-rich-snippets-local-business').hide();
	    	jQuery('.wrap-rich-snippets-faq').hide();
	    	jQuery('.wrap-rich-snippets-courses').hide();
	    	jQuery('.wrap-rich-snippets-recipes').hide();
	    	jQuery('.wrap-rich-snippets-videos').hide();
	    	jQuery('.wrap-rich-snippets-events').hide();
            jQuery('.wrap-rich-snippets-products').hide();
	    	jQuery('.wrap-rich-snippets-review').show();
	    }
	});
});
//Rich Snippets Counters - Articles - Headline
jQuery(document).ready(function(){
	jQuery("#seopress_rich_snippets_articles_counters").after("<div id=\"seopress_rich_snippets_articles_counters_val\">/ 110</div>");
    
    if (jQuery("#seopress_rich_snippets_articles_counters").length != 0) {
        jQuery("#seopress_rich_snippets_articles_counters").text(jQuery("#seopress_pro_rich_snippets_article_title").val().length);
    	if(jQuery('#seopress_pro_rich_snippets_article_title').val().length > 110){   
            jQuery('#seopress_rich_snippets_articles_counters').css('color', 'red');
        }
        jQuery("#seopress_pro_rich_snippets_article_title").keyup(function(event) {
        	jQuery('#seopress_rich_snippets_articles_counters').css('color', 'inherit');
         	if(jQuery(this).val().length > 110){
                jQuery('#seopress_rich_snippets_articles_counters').css('color', 'red');
            }
         	jQuery("#seopress_rich_snippets_articles_counters").text(jQuery("#seopress_pro_rich_snippets_article_title").val().length);
         	if(jQuery(this).val().length > 0){
         		jQuery(".snippet-title-custom").text(event.target.value);
                jQuery(".snippet-title").css('display', 'none');
                jQuery(".snippet-title-custom").css('display', 'block');
                jQuery(".snippet-title-default").css('display', 'none');
         	} else if(jQuery(this).val().length == 0) {
         		jQuery(".snippet-title-default").css('display', 'block');
                jQuery(".snippet-title-custom").css('display', 'none');
                jQuery(".snippet-title").css('display', 'none');
         	};
        });
    }
});
//Rich Snippets Counters - Courses - Description
jQuery(document).ready(function(){
	jQuery("#seopress_rich_snippets_courses_counters").after("<div id=\"seopress_rich_snippets_courses_counters_val\">/ 60</div>");
    
    if (jQuery("#seopress_rich_snippets_courses_counters").length != 0) {
        jQuery("#seopress_rich_snippets_courses_counters").text(jQuery("#seopress_pro_rich_snippets_courses_desc").val().length);
    	if(jQuery('#seopress_pro_rich_snippets_courses_desc').val().length > 60){   
            jQuery('#seopress_rich_snippets_courses_counters').css('color', 'red');
        }
        jQuery("#seopress_pro_rich_snippets_courses_desc").keyup(function(event) {
        	jQuery('#seopress_rich_snippets_courses_counters').css('color', 'inherit');
         	if(jQuery(this).val().length > 60){
                jQuery('#seopress_rich_snippets_courses_counters').css('color', 'red');
            }
         	jQuery("#seopress_rich_snippets_courses_counters").text(jQuery("#seopress_pro_rich_snippets_courses_desc").val().length);
         	if(jQuery(this).val().length > 0){
         		jQuery(".snippet-title-custom").text(event.target.value);
                jQuery(".snippet-title").css('display', 'none');
                jQuery(".snippet-title-custom").css('display', 'block');
                jQuery(".snippet-title-default").css('display', 'none');
         	} else if(jQuery(this).val().length == 0) {
         		jQuery(".snippet-title-default").css('display', 'block');
                jQuery(".snippet-title-custom").css('display', 'none');
                jQuery(".snippet-title").css('display', 'none');
         	};
        });
    }
});
//Date picker
jQuery(document).ready(function(){
	jQuery('.seopress-date-picker').datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShow: function(input, inst) {
            jQuery('#ui-datepicker-div').removeClass('ui-date-picker').addClass('seopress-ui-datepicker');
        }
	});
});
//FAQ
jQuery(document).ready(function(){
    var template = jQuery('#wrap-faq .faq:last').clone();

    //accordion
    var stop = false;
    jQuery("#wrap-faq .faq h3").click(function(event) {
        if (stop) {
            event.stopImmediatePropagation();
            event.preventDefault();
            stop = false;
        }
    });
    function seopress_call_faq_accordion() {
        jQuery( "#wrap-faq .faq" ).accordion({
            collapsible: true,
            active: false,
            heightStyle:"panel",
        });
    }
    seopress_call_faq_accordion();

    //define counter
    var sectionsCount = jQuery('#wrap-faq').attr('data-count');

    //add new section
    jQuery('#add-faq').click(function() {

        //increment
        sectionsCount++;

        //loop through each input
        var section = template.clone().find(':input').each(function(){
            //Stock input id
            var input_id = this.id;
            
            //Stock input name
            var input_name = this.name;

            //set id to store the updated section number
            var newId = this.id.replace(/^(\w+)\[.*?\]/, '$1['+sectionsCount+']');

            //Update input name
            jQuery(this).attr('name', input_name.replace(/^(\w+)\[.*?\]/, '$1['+sectionsCount+']'));
            
            //update for label
            jQuery(this).prev().attr('for', input_id.replace(/^(\w+)\[.*?\]/, '$1['+sectionsCount+']'));
            jQuery(this).prev().attr('id', input_name.replace(/^(\w+)\[.*?\]/, '$1['+sectionsCount+']'));
            

            //update id
            this.id = newId;

        }).end()

        //inject new section
        .appendTo('#wrap-faq');
        seopress_call_faq_accordion();
        jQuery( "#wrap-faq .faq" ).accordion('destroy');
        seopress_call_faq_accordion();
        
        return false;
    });

    //remove section
    jQuery('#wrap-faq').on('click', '.remove-faq', function() {
        //fade out section
        jQuery(this).fadeOut(300, function(){
            jQuery(this).parent().parent().parent().parent().remove();
            return false;
        });
        return false;
    });
});