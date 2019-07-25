jQuery(document).ready(function($) {

	var get_hash = window.location.hash;
	var clean_hash = get_hash.split('$');	

	if(typeof sessionStorage!='undefined') {
		var seopress_bot_tab_session_storage = sessionStorage.getItem("seopress_scan_tab");

		if (clean_hash[1] =='1') { //Scan Tab
            jQuery('#tab_seopress_scan-tab').addClass("nav-tab-active");
            jQuery('#tab_seopress_scan').addClass("active");
        } else if (clean_hash[1] =='2') { //Scan settings Tab
	    	jQuery('#tab_seopress_scan_settings-tab').addClass("nav-tab-active");
	    	jQuery('#tab_seopress_scan_settings').addClass("active");
        } else if (seopress_bot_tab_session_storage) {
            jQuery('#seopress-tabs').find('.nav-tab.nav-tab-active').removeClass("nav-tab-active");
            jQuery('#seopress-tabs').find('.seopress-tab.active').removeClass("active");
            
            jQuery('#'+seopress_bot_tab_session_storage.split('#tab=')+'-tab').addClass("nav-tab-active");
            jQuery('#'+seopress_bot_tab_session_storage.split('#tab=')).addClass("active");
        } else {
            //Default TAB
            jQuery('#tab_seopress_scan-tab').addClass("nav-tab-active");
            jQuery('#tab_seopress_scan').addClass("active");
        }
	};
    jQuery("#seopress-tabs").find("a.nav-tab").click(function(e){
    	e.preventDefault();
    	var hash = jQuery(this).attr('href').split('#tab=')[1];

    	jQuery('#seopress-tabs').find('.nav-tab.nav-tab-active').removeClass("nav-tab-active");
    	jQuery('#'+hash+'-tab').addClass("nav-tab-active");
    	
    	if (clean_hash[1]==1) {
            sessionStorage.setItem("seopress_scan_tab", 'tab_seopress_scan');
        } else if (clean_hash[1]==2) {
    		sessionStorage.setItem("seopress_scan_tab", 'tab_seopress_scan_settings');
    	} else {
    		sessionStorage.setItem("seopress_scan_tab", hash);
    	}    	 
    	
    	jQuery('#seopress-tabs').find('.seopress-tab.active').removeClass("active");
    	jQuery('#'+hash).addClass("active");
    });
});