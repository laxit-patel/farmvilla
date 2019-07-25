<?php

defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Restrict Structured Data Types metaboxes to user roles
///////////////////////////////////////////////////////////////////////////////////////////////////
function seopress_advanced_security_metaboxe_sdt_role_hook_option() {
    $seopress_advanced_security_metaboxe_sdt_role_hook_option = get_option("seopress_advanced_option_name");
    if ( ! empty ( $seopress_advanced_security_metaboxe_sdt_role_hook_option ) ) {
        foreach ($seopress_advanced_security_metaboxe_sdt_role_hook_option as $key => $seopress_advanced_security_metaboxe_sdt_role_hook_value)
            $options[$key] = $seopress_advanced_security_metaboxe_sdt_role_hook_value;
         if (isset($seopress_advanced_security_metaboxe_sdt_role_hook_option['seopress_advanced_security_metaboxe_sdt_role'])) { 
            return $seopress_advanced_security_metaboxe_sdt_role_hook_option['seopress_advanced_security_metaboxe_sdt_role'];
         }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////
//Display Rich Snippets metabox in Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////
function seopress_pro_admin_std_metaboxe_display() {
    add_action('add_meta_boxes','seopress_pro_init_metabox', 20);
    function seopress_pro_init_metabox(){
        if (function_exists('seopress_advanced_appearance_metaboxe_position_option')) {
            $seopress_advanced_appearance_metaboxe_position_option = seopress_advanced_appearance_metaboxe_position_option();
        } else {
            $seopress_advanced_appearance_metaboxe_position_option = 'default';
        }

        if (function_exists('seopress_get_post_types')) {
            
            $seopress_get_post_types = seopress_get_post_types();

            $seopress_get_post_types = apply_filters('seopress_pro_metaboxe_sdt', $seopress_get_post_types);
            
            if (!empty($seopress_get_post_types)) {
                foreach ($seopress_get_post_types as $key => $value) {
                    add_meta_box('seopress_pro_cpt', __('Structured Data Types','wp-seopress-pro'), 'seopress_pro_cpt', $key, 'normal', $seopress_advanced_appearance_metaboxe_position_option);
                }
            }
        }
    }

    function seopress_rich_snippets_publisher_logo_option() {
        $seopress_rich_snippets_publisher_logo_option = get_option("seopress_pro_option_name");
        if ( ! empty ( $seopress_rich_snippets_publisher_logo_option ) ) {
            foreach ($seopress_rich_snippets_publisher_logo_option as $key => $seopress_rich_snippets_publisher_logo_value)
                $options[$key] = $seopress_rich_snippets_publisher_logo_value;
             if (isset($seopress_rich_snippets_publisher_logo_option['seopress_rich_snippets_publisher_logo'])) { 
                return $seopress_rich_snippets_publisher_logo_option['seopress_rich_snippets_publisher_logo'];
             }
        }
    }    

    function seopress_advanced_appearance_advice_schema_option() {
        $seopress_advanced_appearance_advice_schema_option = get_option("seopress_advanced_option_name");
        if ( ! empty ( $seopress_advanced_appearance_advice_schema_option ) ) {
            foreach ($seopress_advanced_appearance_advice_schema_option as $key => $seopress_advanced_appearance_advice_schema_value)
                $options[$key] = $seopress_advanced_appearance_advice_schema_value;
             if (isset($seopress_advanced_appearance_advice_schema_option['seopress_advanced_appearance_advice_schema'])) { 
                return $seopress_advanced_appearance_advice_schema_option['seopress_advanced_appearance_advice_schema'];
             }
        }
    }
        
    function seopress_pro_cpt($post){
        wp_enqueue_script( 'jquery-ui-accordion' );
        
        wp_enqueue_script( 'seopress-pro-media-uploader-js', plugins_url('assets/js/seopress-pro-media-uploader.js', dirname(dirname( __FILE__ ))), array('jquery'), SEOPRESS_PRO_VERSION, false );
        wp_enqueue_script( 'seopress-pro-rich-snippets-js', plugins_url('assets/js/seopress-pro-rich-snippets.js', dirname(dirname( __FILE__ ))), array('jquery'), SEOPRESS_PRO_VERSION, false );
        wp_enqueue_media();

        wp_enqueue_script('jquery-ui-datepicker');

        global $typenow;
        
        $seopress_pro_rich_snippets_type                                = get_post_meta($post->ID,'_seopress_pro_rich_snippets_type',true);

        //Article
        $seopress_pro_rich_snippets_article_type                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_type',true);
        $seopress_pro_rich_snippets_article_title                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_title',true);
        $seopress_pro_rich_snippets_article_img                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_img',true);
        $seopress_pro_rich_snippets_article_img_width                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_img_width',true);
        $seopress_pro_rich_snippets_article_img_height                  = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_img_height',true);

        //Local Business
        $seopress_pro_rich_snippets_lb_name                             = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_name',true);
        $seopress_pro_rich_snippets_lb_type                             = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_type',true);
        $seopress_pro_rich_snippets_lb_img                              = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_img',true);
        $seopress_pro_rich_snippets_lb_img_width                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_img_width',true);
        $seopress_pro_rich_snippets_lb_img_height                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_img_height',true);
        $seopress_pro_rich_snippets_lb_street_addr                      = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_street_addr',true);
        $seopress_pro_rich_snippets_lb_city                             = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_city',true);
        $seopress_pro_rich_snippets_lb_state                            = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_state',true);
        $seopress_pro_rich_snippets_lb_pc                               = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_pc',true);
        $seopress_pro_rich_snippets_lb_country                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_country',true);
        $seopress_pro_rich_snippets_lb_lat                              = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_lat',true);
        $seopress_pro_rich_snippets_lb_lon                              = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_lon',true);
        $seopress_pro_rich_snippets_lb_website                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_website',true);
        $seopress_pro_rich_snippets_lb_tel                              = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_tel',true);
        $seopress_pro_rich_snippets_lb_price                            = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_price',true);
        $seopress_pro_rich_snippets_lb_opening_hours                    = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_opening_hours',false);

        //FAQ
        $seopress_pro_rich_snippets_faq                                 = get_post_meta($post->ID,'_seopress_pro_rich_snippets_faq');
        
        //Course
        $seopress_pro_rich_snippets_courses_title                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_courses_title',true);
        $seopress_pro_rich_snippets_courses_desc                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_courses_desc',true);
        $seopress_pro_rich_snippets_courses_school                      = get_post_meta($post->ID,'_seopress_pro_rich_snippets_courses_school',true);
        $seopress_pro_rich_snippets_courses_website                     = get_post_meta($post->ID,'_seopress_pro_rich_snippets_courses_website',true);
        
        //Recipe
        $seopress_pro_rich_snippets_recipes_name                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_name',true);
        $seopress_pro_rich_snippets_recipes_desc                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_desc',true);
        $seopress_pro_rich_snippets_recipes_cat                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_cat',true);
        $seopress_pro_rich_snippets_recipes_img                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_img',true);
        $seopress_pro_rich_snippets_recipes_prep_time                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_prep_time',true);
        $seopress_pro_rich_snippets_recipes_cook_time                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_cook_time',true);
        $seopress_pro_rich_snippets_recipes_calories                    = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_calories',true);
        $seopress_pro_rich_snippets_recipes_yield                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_recipes_yield',true);

        //Video
        $seopress_pro_rich_snippets_videos_name                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_name',true);
        $seopress_pro_rich_snippets_videos_description                  = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_description',true);
        $seopress_pro_rich_snippets_videos_img                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_img',true);
        $seopress_pro_rich_snippets_videos_img_width                    = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_img_width',true);
        $seopress_pro_rich_snippets_videos_img_height                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_img_height',true);
        $seopress_pro_rich_snippets_videos_duration                     = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_duration',true);
        $seopress_pro_rich_snippets_videos_url                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_videos_url',true);

        //Events
        $seopress_pro_rich_snippets_events_type                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_type',true);
        $seopress_pro_rich_snippets_events_name                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_name',true);
        $seopress_pro_rich_snippets_events_desc                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_desc',true);
        $seopress_pro_rich_snippets_events_img                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_img',true);
        $seopress_pro_rich_snippets_events_start_date                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_start_date',true);
        $seopress_pro_rich_snippets_events_start_time                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_start_time',true);
        $seopress_pro_rich_snippets_events_end_date                     = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_end_date',true);
        $seopress_pro_rich_snippets_events_end_time                     = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_end_time',true);
        $seopress_pro_rich_snippets_events_location_name                = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_location_name',true);
        $seopress_pro_rich_snippets_events_location_url                 = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_location_url',true);
        $seopress_pro_rich_snippets_events_location_address             = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_location_address',true);
        $seopress_pro_rich_snippets_events_offers_name                  = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_name',true);
        $seopress_pro_rich_snippets_events_offers_cat                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_cat',true);
        $seopress_pro_rich_snippets_events_offers_price                 = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_price',true);
        $seopress_pro_rich_snippets_events_offers_price_currency        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_price_currency',true);
        $seopress_pro_rich_snippets_events_offers_availability          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_availability',true);
        $seopress_rich_snippets_events_offers_valid_from_date                = get_post_meta($post->ID,'_seopress_rich_snippets_events_offers_valid_from_date',true);
        $seopress_rich_snippets_events_offers_valid_from_time                = get_post_meta($post->ID,'_seopress_rich_snippets_events_offers_valid_from_time',true);
        $seopress_pro_rich_snippets_events_offers_url                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_offers_url',true);
        $seopress_pro_rich_snippets_events_performer                    = get_post_meta($post->ID,'_seopress_pro_rich_snippets_events_performer',true);

        //Products
        $seopress_pro_rich_snippets_product_name                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_name',true);
        $seopress_pro_rich_snippets_product_description                 = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_description',true);
        $seopress_pro_rich_snippets_product_img                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_img',true);
        $seopress_pro_rich_snippets_product_price                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_price',true);
        $seopress_pro_rich_snippets_product_price_valid_date            = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_price_valid_date',true);
        $seopress_pro_rich_snippets_product_sku                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_sku',true);
        $seopress_pro_rich_snippets_product_brand                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_brand',true);
        $seopress_pro_rich_snippets_product_global_ids                  = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_global_ids',true);
        $seopress_pro_rich_snippets_product_global_ids_value            = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_global_ids_value',true);
        $seopress_pro_rich_snippets_product_price_currency              = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_price_currency',true);
        $seopress_pro_rich_snippets_product_condition                   = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_condition',true);
        $seopress_pro_rich_snippets_product_availability                = get_post_meta($post->ID,'_seopress_pro_rich_snippets_product_availability',true);
        
        //Review
        $seopress_pro_rich_snippets_review_item                         = get_post_meta($post->ID,'_seopress_pro_rich_snippets_review_item',true);
        $seopress_pro_rich_snippets_review_img                          = get_post_meta($post->ID,'_seopress_pro_rich_snippets_review_img',true);
        $seopress_pro_rich_snippets_review_rating                       = get_post_meta($post->ID,'_seopress_pro_rich_snippets_review_rating',true);


    echo 
    '<div id="seopress-schemas-tabs">
        <ul class="wrap-schemas-list">
            <li><a href="#seopress-schemas-tabs-1">'. __( 'Manual', 'wp-seopress' ) .'</a></li>
            <li><a href="#seopress-schemas-tabs-2">'. __( 'Automatic', 'wp-seopress' ) .'</a></li>
        </ul>


        <div id="seopress-schemas-tabs-1">
            <div class="box-left">
                <div class="wrap-rich-snippets-type">
                    <label for="seopress_pro_rich_snippets_type_meta">'. __( 'Select your data type', 'wp-seopress-pro' ) .'</label>
                    <select id="seopress_pro_rich_snippets_type" name="seopress_pro_rich_snippets_type">
                        <option ' . selected( 'none', $seopress_pro_rich_snippets_type, false ) . ' value="none">'. __( 'None', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'articles', $seopress_pro_rich_snippets_type, false ) . ' value="articles">'. __( 'Article', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'localbusiness', $seopress_pro_rich_snippets_type, false ) . ' value="localbusiness">'. __( 'Local Business', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'faq', $seopress_pro_rich_snippets_type, false ) . ' value="faq">'. __( 'FAQ', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'courses', $seopress_pro_rich_snippets_type, false ) . ' value="courses">'. __( 'Course', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'recipes', $seopress_pro_rich_snippets_type, false ) . ' value="recipes">'. __( 'Recipe', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'videos', $seopress_pro_rich_snippets_type, false ) . ' value="videos">'. __( 'Video', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'events', $seopress_pro_rich_snippets_type, false ) . ' value="events">'. __( 'Event', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'products', $seopress_pro_rich_snippets_type, false ) . ' value="products">'. __( 'Product', 'wp-seopress-pro' ) .'</option>
                        <option ' . selected( 'review', $seopress_pro_rich_snippets_type, false ) . ' value="review">'. __( 'Review', 'wp-seopress-pro' ) .'</option>
                    </select>';

                if (seopress_advanced_appearance_advice_schema_option() !='1') {
                    echo '<ul class="advice">
                        <li class="warning"><span class="dashicons dashicons-warning"></span>'.__('WARNING','wp-seopress-pro').'</li>
                        <li>'.__('Be sure to select the right structure data type for your content.','wp-seopress-pro').'</li>
                        <li>'.__('When you choose one, fill all fields with the right format.','wp-seopress-pro').'</li>
                        <li>'.__('Make sure you don\'t have already include structure data type with a theme or plugin (eg: the default WooCommerce Theme, Storefront, already implement this for single page products.','wp-seopress-pro').'</li>
                        <li>'.__('You can test your page with Google Data Structure Test tool.','wp-seopress-pro').' <a href="https://search.google.com/structured-data/testing-tool" target="_blank">'.__('Make a test','wp-seopress-pro').'</a></li>
                    </ul>';
                }
                echo '</div>
                <div class="wrap-rich-snippets-articles">
                    <p class="notice">
                        '.__('Proper structured data in your news, blog, and sports article page can enhance your appearance in Google Search results.','wp-seopress-pro').'
                    </p>';
                if (seopress_rich_snippets_publisher_logo_option() !='') {
                    echo '<p><span class="dashicons dashicons-yes"></span>'.__('You have set a publisher logo. Good!','wp-seopress-pro').'</p>';
                } else {
                    echo '<p><span class="dashicons dashicons-no-alt"></span>'.__('You don\'t have set a publisher logo. It\'s required for Article content types.','wp-seopress-pro').'</p>';
                }

                echo'
                    <p>
                        <label for="seopress_pro_rich_snippets_article_type_meta">'. __( 'Select your article type', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_article_type">
                            <option ' . selected( 'NewsArticle', $seopress_pro_rich_snippets_article_type, false ) . ' value="NewsArticle">'. __( 'News Article', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Report', $seopress_pro_rich_snippets_article_type, false ) . ' value="Report">'. __( 'Report', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ScholarlyArticle', $seopress_pro_rich_snippets_article_type, false ) . ' value="ScholarlyArticle">'. __( 'Scholarly Article', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SocialMediaPosting', $seopress_pro_rich_snippets_article_type, false ) . ' value="SocialMediaPosting">'. __( 'Social Media Posting', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'TechArticle', $seopress_pro_rich_snippets_article_type, false ) . ' value="TechArticle">'. __( 'TechArticle', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p style="margin-bottom:0">
                        <label for="seopress_pro_rich_snippets_article_title_meta">
                            '. __( 'Headline <em>(max limit: 110)</em>', 'wp-seopress-pro' ) .'</label>
                        <input type="text" id="seopress_pro_rich_snippets_article_title" name="seopress_pro_rich_snippets_article_title" placeholder="'.esc_html__('The headline of the article','wp-seopress-pro').'" aria-label="'.__('Headline <em>(max limit: 110)</em>','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_article_title.'" />
                        <div class="wrap-seopress-counters">
                            <div id="seopress_rich_snippets_articles_counters"></div>
                            '.__('(maximum limit)','wp-seopress-pro').'
                        </div>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_article_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                        '.__('The representative image of the article. Only a marked-up image that directly belongs to the article should be specified. ','wp-seopress-pro').'
                        <span class="advise">'. __('Minimum size: 696px wide, JPG, PNG or GIF, crawlable and indexable (default: post thumbnail if available)', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_article_img_meta" type="text" name="seopress_pro_rich_snippets_article_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_article_img.'" />
                        <input id="seopress_pro_rich_snippets_article_img_width" type="hidden" name="seopress_pro_rich_snippets_article_img_width" value="'.$seopress_pro_rich_snippets_article_img_width.'" />
                        <input id="seopress_pro_rich_snippets_article_img_height" type="hidden" name="seopress_pro_rich_snippets_article_img_height" value="'.$seopress_pro_rich_snippets_article_img_height.'" />
                        <input id="seopress_pro_rich_snippets_article_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                </div>
                <div class="wrap-rich-snippets-local-business">
                    <p class="notice">
                        '.__('When users search for businesses on Google Search or Maps, Search results may display a prominent Knowledge Graph card with details about a business that matched the query. ','wp-seopress-pro').'
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_name_meta">
                            '. __( 'Name of your business', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_name" placeholder="'.esc_html__('eg: SEOPress','wp-seopress-pro').'" aria-label="'.__('Name of your business','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_type_meta">'. __( 'Select a business type', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_lb_type">';

                        $seopress_lb_types = array(
                            'LocalBusiness'             => 'Local Business (default)',
                            'AnimalShelter'             => 'Animal Shelter',
                            'AutomotiveBusiness'        => 'Automotive Business',
                            'AutoBodyShop' => '|-Auto Body Shop',
                            'AutoDealer' => '|-Auto Dealer',
                            'AutoPartsStore' => '|-Auto Parts Store',
                            'AutoRental' => '|-Auto Rental',
                            'AutoRepair' => '|-Auto Repair',
                            'Auto Wash' => '|-AutoWash',
                            'GasStation' => '|-Gas Station',
                            'MotorcycleDealer' => '|-Motorcycle Dealer',
                            'MotorcycleRepair' => '|-Motorcycle Repair',
                            'ChildCare' => 'Child Care',
                            'Dentist' => 'Dentist',
                            'DryCleaningOrLaundry' => 'Dry Cleaning Or Laundry',
                            'EmergencyService' => 'Emergency Service',
                            'FireStation' => '|-Fire Station',
                            'Hospital' => '|-Hospital',
                            'PoliceStation' => '|-Police Station',
                            'EmploymentAgency' => 'Employment Agency',
                            'EntertainmentBusiness' => 'Entertainment Business',
                            'AdultEntertainment' => '|-Adult Entertainment',
                            'AmusementPark' => '|-Amusement Park',
                            'ArtGallery' => '|-Art Gallery',
                            'Casino' => '|-Casino',
                            'ComedyClub' => '|-Comedy Club',
                            'MovieTheater' => '|-Movie Theater',
                            'NightClub' => '|-Night Club',
                            'FinancialService' => 'Financial Service',
                            'AccountingService' => '|-Accounting Service',
                            'AutomatedTeller' => '|-Automated Teller',
                            'BankOrCreditUnion' => '|-Bank Or Credit Union',
                            'InsuranceAgency' => '|-Insurance Agency',
                            'FoodEstablishment' => 'Food Establishment',
                            'Bakery' => '|-Bakery',
                            'BarOrPub' => '|-Bar Or Pub',
                            'Brewery' => '|-Brewery',
                            'CafeOrCoffeeShop' => '|-Cafe Or Coffee Shop',
                            'FastFoodRestaurant' => '|-Fast Food Restaurant',
                            'IceCreamShop' => '|-Ice Cream Shop',
                            'Restaurant' => '|-Restaurant',
                            'Winery' => '|-Winery',
                            'GovernmentOffice' => 'Government Office',
                            'PostOffice' => '|-PostOffice',
                            'HealthAndBeautyBusiness' => 'Health And Beauty Business',
                            'BeautySalon' => '|-Beauty Salon',
                            'DaySpa' => '|-Day Spa',
                            'HairSalon' => '|-Hair Salon',
                            'HealthClub' => '|-Health Club',
                            'NailSalon' => '|-Nail Salon',
                            'TattooParlor' => '|-Tattoo Parlor',
                            'HomeAndConstructionBusiness' => 'Home And Construction Business',
                            'Electrician' => '|-Electrician',
                            'HVACBusiness' => '|-HVAC Business',
                            'HousePainter' => '|-House Painter',
                            'Locksmith' => '|-Locksmith',
                            'MovingCompany' => '|-Moving Company',
                            'Plumber' => '|-Plumber',
                            'RoofingContractor' => '|-Roofing Contractor',
                            'InternetCafe' => 'Internet Cafe',
                            'LegalService' => 'Legal Service',
                            'Attorney' => '|-Attorney',
                            'Notary' => '|-Notary',
                            'Library' => 'Library',
                            'LodgingBusiness' => 'Lodging Business',
                            'BedAndBreakfast' => '|-Bed And Breakfast',
                            'Campground' => '|-Campground',
                            'Hostel' => '|-Hostel',
                            'Hotel' => '|-Hotel',
                            'Motel' => '|-Motel',
                            'Resort' => '|-Resort',
                            'ProfessionalService' => 'Professional Service',
                            'RadioStation' => 'Radio Station',
                            'RealEstateAgent' => 'Real Estate Agent',
                            'RecyclingCenter' => 'Recycling Center',
                            'SelfStorage' => 'Real Self Storage',
                            'ShoppingCenter' => 'Shopping Center',
                            'SportsActivityLocation' => 'Sports Activity Location',
                            'BowlingAlley' => '|-Bowling Alley',
                            'ExerciseGym' => '|-Exercise Gym',
                            'GolfCourse' => '|-Golf Course',
                            'HealthClub' => '|-Health Club',
                            'PublicSwimmingPool' => '|-Public Swimming Pool',
                            'SkiResort' => '|-Ski Resort',
                            'SportsClub' => '|-Sports Club',
                            'StadiumOrArena' => '|-Stadium Or Arena',
                            'TennisComplex' => '|-Tennis Complex',
                            'Store' => 'Store',
                            'AutoPartsStore' => '|-Auto Parts Store',
                            'BikeStore' => '|-Bike Store',
                            'BookStore' => '|-Book Store',
                            'ClothingStore' => '|-Clothing Store',
                            'ComputerStore' => '|-Computer Store',
                            'ConvenienceStore' => '|-Convenience Store',
                            'DepartmentStore' => '|-Department Store',
                            'ElectronicsStore' => '|-Electronics Store',
                            'Florist' => '|-Florist',
                            'FurnitureStore' => '|-Furniture Store',
                            'GardenStore' => '|-Garden Store',
                            'GroceryStore' => '|-Grocery Store',
                            'HardwareStore' => '|-Hardware Store',
                            'HobbyShop' => '|-Hobby Shop',
                            'HomeGoodsStore' => '|-Home Goods Store',
                            'JewelryStore' => '|-Jewelry Store',
                            'LiquorStore' => '|-Liquor Store',
                            'MensClothingStore' => '|-Mens Clothing Store',
                            'MobilePhoneStore' => '|-Mobile Phone Store',
                            'MovieRentalStore' => '|-Movie Rental Store',
                            'MusicStore' => '|-Music Store',
                            'OfficeEquipmentStore' => '|-Office Equipment Store',
                            'OutletStore' => '|-Outlet Store',
                            'PawnShop' => '|-Pawn Shop',
                            'PetStore' => '|-Pet Store',
                            'ShoeStore' => '|-Shoe Store',
                            'SportingGoodsStore' => '|-Sporting Goods Store',
                            'TireShop' => '|-Tire Shop',
                            'ToyStore' => '|-Toy Store',
                            'WholesaleStore' => '|-Wholesale Store',
                            'TelevisionStation' => '|-Wholesale Store',
                            'TouristInformationCenter' => 'Tourist Information Center',
                            'TravelAgency' => 'Travel Agency',
                        );

                        foreach ($seopress_lb_types as $type_value => $type_i18n) {
                            echo '<option ' . selected( $type_value, $seopress_pro_rich_snippets_lb_type, false ) . ' value="'.$type_value.'">'. __( $type_i18n, 'wp-seopress-pro' ) .'</option>';
                        }
                echo '</select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                        <p>'.__('An image of the business.','wp-seopress-pro').'</p>
                        <span class="advise">'. __('Every page must contain at least one image (whether or not you include markup). Google will pick the best image to display in Search results based on the aspect ratio and resolution.<br>
Image URLs must be crawlable and indexable.<br>
Images must represent the marked up content.<br>
Images must be in .jpg, .png, or. gif format.<br>
For best results, provide multiple high-resolution images (minimum of 50K pixels when multiplying width and height) with the following aspect ratios: 16x9, 4x3, and 1x1.', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_lb_img_meta" type="text" name="seopress_pro_rich_snippets_lb_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_img.'" />
                        <input id="seopress_pro_rich_snippets_lb_img_width" type="hidden" name="seopress_pro_rich_snippets_lb_img_width" value="'.$seopress_pro_rich_snippets_lb_img_width.'" />
                        <input id="seopress_pro_rich_snippets_lb_img_height" type="hidden" name="seopress_pro_rich_snippets_lb_img_height" value="'.$seopress_pro_rich_snippets_lb_img_height.'" />
                        <input id="seopress_pro_rich_snippets_lb_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_street_addr_meta">
                            '. __( 'Street Address', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_street_addr" placeholder="'.esc_html__('eg: Place Bellevue','wp-seopress-pro').'" aria-label="'.__('Street Address','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_street_addr.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_city_meta">
                            '. __( 'City', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_city" placeholder="'.esc_html__('eg: Biarritz','wp-seopress-pro').'" aria-label="'.__('City','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_city.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_state_meta">
                            '. __( 'State', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_state" placeholder="'.esc_html__('eg: Pyrenees Atlantiques','wp-seopress-pro').'" aria-label="'.__('State','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_state.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_pc_meta">
                            '. __( 'Postal code', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_pc" placeholder="'.esc_html__('eg: 64200','wp-seopress-pro').'" aria-label="'.__('Postal code','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_pc.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_country_meta">
                            '. __( 'Country', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_country" placeholder="'.esc_html__('eg: France','wp-seopress-pro').'" aria-label="'.__('Country','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_country.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_lat_meta">
                            '. __( 'Latitude', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_lat" placeholder="'.esc_html__('eg: 43.4831389','wp-seopress-pro').'" aria-label="'.__('Latitude','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_lat.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_lon_meta">
                            '. __( 'Longitude', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_lon" placeholder="'.esc_html__('eg: -1.5630987','wp-seopress-pro').'" aria-label="'.__('Longitude','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_lon.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_website_meta">
                            '. __( 'URL', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_website" placeholder="'.get_home_url().'" aria-label="'.__('URL','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_website.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_tel_meta">
                            '. __( 'Telephone', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_tel" placeholder="'.esc_html__('eg: +33559240138','wp-seopress-pro').'" aria-label="'.__('Telephone','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_tel.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_price_meta">
                            '. __( 'Price range', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_lb_price" placeholder="'.esc_html__('eg: $$, €€€, or ££££...','wp-seopress-pro').'" aria-label="'.__('Price','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_lb_price.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_lb_opening_hours_meta">
                            '. __( 'Opening hours', 'wp-seopress-pro' ) .'</label>
                    </p>';

                    $options = $seopress_pro_rich_snippets_lb_opening_hours;
                    
                    $days = array(__('Monday','wp-seopress-pro'), __('Tuesday','wp-seopress-pro'), __('Wednesday','wp-seopress-pro'), __('Thursday','wp-seopress-pro'), __('Friday','wp-seopress-pro'), __('Saturday','wp-seopress-pro'), __('Sunday','wp-seopress-pro') );

                    $hours = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');

                    $mins = array('00', '15', '30', '45');

                    echo '<ul class="wrap-opening-hours">';

                    foreach ($days as $key => $day) {

                        $check_day = isset($options[0]['seopress_local_business_opening_hours'][$key]['open']);
                        
                        $check_day_am = isset($options[0]['seopress_local_business_opening_hours'][$key]['am']['open']);

                        $check_day_pm = isset($options[0]['seopress_local_business_opening_hours'][$key]['pm']['open']);

                        $selected_start_hours = isset($options[0]['seopress_local_business_opening_hours'][$key]['am']['start']['hours']) ? $options[0]['seopress_local_business_opening_hours'][$key]['am']['start']['hours'] : NULL;

                        $selected_start_mins = isset($options[0]['seopress_local_business_opening_hours'][$key]['am']['start']['mins']) ? $options[0]['seopress_local_business_opening_hours'][$key]['am']['start']['mins'] : NULL;
                        
                        echo '<li>';

                            echo '<span class="day"><strong>'.$day.'</strong></span>';

                            echo '<ul>';
                                 //Closed?
                                echo '<li>';

                                    echo '<input id="seopress_local_business_opening_hours['.$key.'][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][open]" type="checkbox"';
                                        if ('1' == $check_day) echo 'checked="yes"'; 
                                        echo ' value="1"/>';
                                    
                                    echo '<label for="seopress_local_business_opening_hours['.$key.'][open]">'. __( 'Closed all the day?', 'wp-seopress-pro' ) .'</label> ';
                                    
                                    if (isset($options['seopress_local_business_opening_hours'][$key]['open'])) {
                                        esc_attr($options['seopress_local_business_opening_hours'][$key]['open']);
                                    }
                                echo '</li>';

                                //AM
                                echo '<li>';
                                    echo '<input id="seopress_local_business_opening_hours['.$key.'][am][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][am][open]" type="checkbox"';
                                        if ('1' == $check_day_am) echo 'checked="yes"'; 
                                        echo ' value="1"/>';                            
                                    
                                    echo '<label for="seopress_local_business_opening_hours['.$key.'][am][open]">'. __( 'Open in the morning?', 'wp-seopress-pro' ) .'</label> ';

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['am']['open'])) {
                                        esc_attr($options['seopress_local_business_opening_hours'][$key]['am']['open']);
                                    }

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][am][start][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][am][start][hours]">';

                                        foreach ($hours as $hour) {
                                            echo '<option '; 
                                            if ($hour == $selected_start_hours) echo 'selected="selected"'; 
                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                        }

                                    echo '</select>';

                                    echo ' : ';

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][am][start][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][am][start][mins]">';

                                        foreach ($mins as $min) {
                                            echo '<option '; 
                                            if ($min == $selected_start_mins) echo 'selected="selected"'; 
                                            echo ' value="'.$min.'">'. $min .'</option>';
                                        }

                                    echo '</select>';

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['am']['start']['hours'])) {
                                        esc_attr( $options['seopress_local_business_opening_hours'][$key]['am']['start']['hours']);
                                    }

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['am']['start']['mins'])) {
                                        esc_attr( $options['seopress_local_business_opening_hours'][$key]['am']['start']['mins']);
                                    }

                                    echo ' - ';

                                    $selected_end_hours = isset($options[0]['seopress_local_business_opening_hours'][$key]['am']['end']['hours']) ? $options[0]['seopress_local_business_opening_hours'][$key]['am']['end']['hours'] : NULL;

                                    $selected_end_mins = isset($options[0]['seopress_local_business_opening_hours'][$key]['am']['end']['mins']) ? $options[0]['seopress_local_business_opening_hours'][$key]['am']['end']['mins'] : NULL;

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][am][end][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][am][end][hours]">';

                                        foreach ($hours as $hour) {
                                            echo '<option '; 
                                            if ($hour == $selected_end_hours) echo 'selected="selected"'; 
                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                        }

                                    echo '</select>';

                                    echo ' : ';

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][am][end][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][am][end][mins]">';

                                        foreach ($mins as $min) {
                                            echo '<option '; 
                                            if ($min == $selected_end_mins) echo 'selected="selected"'; 
                                            echo ' value="'.$min.'">'. $min .'</option>';
                                        }

                                    echo '</select>';
                                echo '</li>';
                                
                                //PM
                                echo '<li>';
                                    $selected_start_hours2 = isset($options[0]['seopress_local_business_opening_hours'][$key]['pm']['start']['hours']) ? $options[0]['seopress_local_business_opening_hours'][$key]['pm']['start']['hours'] : NULL;

                                    $selected_start_mins2 = isset($options[0]['seopress_local_business_opening_hours'][$key]['pm']['start']['mins']) ? $options[0]['seopress_local_business_opening_hours'][$key]['pm']['start']['mins'] : NULL;

                                    echo '<input id="seopress_local_business_opening_hours['.$key.'][pm][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][pm][open]" type="checkbox"';
                                        if ('1' == $check_day_pm) echo 'checked="yes"'; 
                                        echo ' value="1"/>';

                                    echo '<label for="seopress_local_business_opening_hours['.$key.'][pm][open]">'. __( 'Open in the afternoon?', 'wp-seopress-pro' ) .'</label> ';

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['pm']['open'])) {
                                        esc_attr($options['seopress_local_business_opening_hours'][$key]['pm']['open']);
                                    }

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][pm][start][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][pm][start][hours]">';

                                        foreach ($hours as $hour) {
                                            echo '<option '; 
                                            if ($hour == $selected_start_hours2) echo 'selected="selected"'; 
                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                        }

                                    echo '</select>';

                                    echo ' : ';

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][pm][start][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][pm][start][mins]">';

                                        foreach ($mins as $min) {
                                            echo '<option '; 
                                            if ($min == $selected_start_mins2) echo 'selected="selected"'; 
                                            echo ' value="'.$min.'">'. $min .'</option>';
                                        }

                                    echo '</select>';

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['pm']['start']['hours'])) {
                                        esc_attr( $options['seopress_local_business_opening_hours'][$key]['pm']['start']['hours']);
                                    }

                                    if (isset($options['seopress_local_business_opening_hours'][$key]['pm']['start']['mins'])) {
                                        esc_attr( $options['seopress_local_business_opening_hours'][$key]['pm']['start']['mins']);
                                    }

                                    echo ' - ';

                                    $selected_end_hours2 = isset($options[0]['seopress_local_business_opening_hours'][$key]['pm']['end']['hours']) ? $options[0]['seopress_local_business_opening_hours'][$key]['pm']['end']['hours'] : NULL;

                                    $selected_end_mins2 = isset($options[0]['seopress_local_business_opening_hours'][$key]['pm']['end']['mins']) ? $options[0]['seopress_local_business_opening_hours'][$key]['pm']['end']['mins'] : NULL;

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][pm][end][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][pm][end][hours]">';

                                        foreach ($hours as $hour) {
                                            echo '<option '; 
                                            if ($hour == $selected_end_hours2) echo 'selected="selected"'; 
                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                        }

                                    echo '</select>';

                                    echo ' : ';

                                    echo '<select id="seopress_local_business_opening_hours['.$key.'][pm][end][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_local_business_opening_hours]['.$key.'][pm][end][mins]">';

                                        foreach ($mins as $min) {
                                            echo '<option '; 
                                            if ($min == $selected_end_mins2) echo 'selected="selected"'; 
                                            echo ' value="'.$min.'">'. $min .'</option>';
                                        }

                                    echo '</select>';

                                echo '</li>';
                            echo '</ul>';

                        if (isset($options['seopress_local_business_opening_hours'][$key]['pm']['end']['hours'])) {
                            esc_attr( $options['seopress_local_business_opening_hours'][$key]['pm']['end']['hours']);
                        }

                        if (isset($options['seopress_local_business_opening_hours'][$key]['pm']['end']['mins'])) {
                            esc_attr( $options['seopress_local_business_opening_hours'][$key]['pm']['end']['mins']);
                        }

                        $seopress_pro_rich_snippets_lb_opening_hours = $options;
                    }

                    echo '</ul>
                </div>
                <div class="wrap-rich-snippets-faq">
                    <p class="notice">
                        '.__('Mark up your Frequently Asked Questions page with JSON-LD to try to get the position 0 in search results. ','wp-seopress-pro').'
                    </p>';

                    //Init $seopress_faq array if empty
                    if (empty($seopress_pro_rich_snippets_faq)) {
                        $seopress_pro_rich_snippets_faq = array('0' => array(''));
                    }

                    $count = $seopress_pro_rich_snippets_faq[0];
                    end($count);
                    $total = key($count);

                    echo '<div id="wrap-faq" data-count="'.$total.'">';
                            foreach ($seopress_pro_rich_snippets_faq[0] as $key => $value) {
                                $check_question = isset($seopress_pro_rich_snippets_faq[0][$key]["question"]) ? $seopress_pro_rich_snippets_faq[0][$key]["question"] : NULL;
                                $check_answer = isset($seopress_pro_rich_snippets_faq[0][$key]["answer"]) ? $seopress_pro_rich_snippets_faq[0][$key]["answer"] : NULL;
                                
                            echo '<div class="faq">
                                    <h3 class="accordion-section-title" tabindex="0">'.__('Question ','wp-seopress-pro').$check_question.'</h3>
                                    <div class="accordion-section-content">
                                        <div class="inside">
                                            <p>
                                                <label for="seopress_pro_rich_snippets_faq['.$key.'][question_meta]">'. __( 'Question (required)', 'wp-seopress-pro' ) .'</label>
                                                <input id="seopress_pro_rich_snippets_faq['.$key.'][question_meta]" type="text" name="seopress_pro_rich_snippets_faq['.$key.'][question]" placeholder="'.esc_html__('Enter your question','wp-seopress-pro').'" aria-label="'.__('Question','wp-seopress-pro').'" value="'.$check_question.'" />
                                            </p>
                                            <p>
                                                <label for="seopress_pro_rich_snippets_faq['.$key.'][answer_meta]">'. __( 'Answer (required)', 'wp-seopress-pro' ) .'</label>
                                                <textarea id="seopress_pro_rich_snippets_faq['.$key.'][answer_meta]" name="seopress_pro_rich_snippets_faq['.$key.'][answer]" placeholder="'.esc_html__('Enter your answer','wp-seopress-pro').'" aria-label="'.__('Answer','wp-seopress-pro').'" value="'.$check_answer.'" rows="8">'.$check_answer.'</textarea>
                                            </p> 
                                            
                                            <p><a href="#" class="remove-faq button">'.__('Remove question','wp-seopress-pro').'</a></p>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                   echo '</div>
                   <p><a href="#" id="add-faq" class="add-faq button button-primary">'.__('Add question','wp-seopress-pro').'</a></p>
                </div>
                <div class="wrap-rich-snippets-courses">
                    <p class="notice">
                        '.__('Mark up your course lists with structured data so prospective students find you through Google Search. ','wp-seopress-pro').'
                    </p>
                    <ul>
                        <li>'.__('Only use course markup for educational content that fits the following definition of a course: A series or unit of curriculum that contains lectures, lessons, or modules in a particular subject and/or topic.','wp-seopress-pro').'</li>
                        <li>'.__('A course must have an explicit educational outcome of knowledge and/or skill in a particular subject and/or topic, and be led by one or more instructors with a roster of students.','wp-seopress-pro').'</li>
                        <li>'.__('A general public event such as "Astronomy Day" is not a course, and a single 2-minute "How to make a Sandwich Video" is not a course.','wp-seopress-pro').'</li>
                    </ul>
                    <p>
                        <label for="seopress_pro_rich_snippets_courses_title_meta">
                            '. __( 'Title', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_courses_title" placeholder="'.esc_html__('The title of your lesson, course...','wp-seopress-pro').'" aria-label="'.__('Title','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_courses_title.'" />
                    </p>
                    <p style="margin-bottom:0">
                        <label for="seopress_pro_rich_snippets_courses_desc_meta">'. __( 'Course description', 'wp-seopress-pro' ) .'</label>
                        <textarea id="seopress_pro_rich_snippets_courses_desc" style="width:100%" name="seopress_pro_rich_snippets_courses_desc" placeholder="'.esc_html__('Enter your course/lesson description','wp-seopress-pro').'" aria-label="'.__('Course description','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_courses_desc.'">'.$seopress_pro_rich_snippets_courses_desc.'</textarea>
                        <div class="wrap-seopress-counters">
                            <div id="seopress_rich_snippets_courses_counters"></div>
                            '.__('(maximum limit)','wp-seopress-pro').'
                        </div>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_courses_school_meta">
                            '. __( 'School/Organization', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_courses_school" placeholder="'.esc_html__('Name of university, organization...','wp-seopress-pro').'" aria-label="'.__('School/Organization','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_courses_school.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_courses_website_meta">
                            '. __( 'School/Organization Website', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_courses_website" placeholder="'.esc_html__('Enter the URL like https://example.com/','wp-seopress-pro').'" aria-label="'.__('School/Organization Website','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_courses_website.'" />
                    </p>
                </div>
                <div class="wrap-rich-snippets-recipes">
                    <p class="notice">
                        '.__('Mark up your recipe content with structured data to provide rich cards and host-specific lists for your recipes, such as cooking and preparation times, nutrition information...','wp-seopress-pro').'
                    </p>
                    <ul>
                        <li>'.__('Use recipe markup for content about preparing a particular dish. For example, "facial scrub" or "party ideas" are not valid names for a dish.','wp-seopress-pro').'</li>
                    </ul>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_name_meta">
                            '. __( 'Recipe name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_recipes_name" placeholder="'.esc_html__('The name of your dish','wp-seopress-pro').'" aria-label="'.__('Recipe name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_desc_meta">'. __( 'Short recipe description', 'wp-seopress-pro' ) .'</label>
                        <textarea id="seopress_pro_rich_snippets_recipes_desc_meta" style="width:100%" name="seopress_pro_rich_snippets_recipes_desc" placeholder="'.esc_html__('A short summary describing the dish.','wp-seopress-pro').'" aria-label="'.__('Short recipe description','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_desc.'">'.$seopress_pro_rich_snippets_recipes_desc.'</textarea>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_cat_meta">
                            '. __( 'Recipe category', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_recipes_cat" placeholder="'.esc_html__('Eg: appetizer, entree, or dessert','wp-seopress-pro').'" aria-label="'.__('Recipe category','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_cat.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                        <span class="advise">'. __('Minimum size: 185px by 185px, aspect ratio 1:1', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_recipes_img_meta" type="text" name="seopress_pro_rich_snippets_recipes_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_img.'" />
                        <input id="seopress_pro_rich_snippets_recipes_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_prep_time_meta">
                            '. __( 'Preparation time (in minutes)', 'wp-seopress-pro' ) .'</label>
                        <input type="number" name="seopress_pro_rich_snippets_recipes_prep_time" placeholder="'.esc_html__('Eg: 30 min','wp-seopress-pro').'" aria-label="'.__('Preparation time (in minutes)','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_prep_time.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_cook_time_meta">
                            '. __( 'Cooking time (in minutes)', 'wp-seopress-pro' ) .'</label>
                        <input type="number" name="seopress_pro_rich_snippets_recipes_cook_time" placeholder="'.esc_html__('Eg: 45 min','wp-seopress-pro').'" aria-label="'.__('Cooking time (in minutes)','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_cook_time.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_calories_meta">
                            '. __( 'Calories', 'wp-seopress-pro' ) .'</label>
                        <input type="number" name="seopress_pro_rich_snippets_recipes_calories" placeholder="'.esc_html__('Number of calories','wp-seopress-pro').'" aria-label="'.__('Calories','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_calories.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_recipes_yield_meta">
                            '. __( 'Recipe yield', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_recipes_yield" placeholder="'.esc_html__('Eg: number of people served, or number of servings','wp-seopress-pro').'" aria-label="'.__('Recipe yield','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_recipes_yield.'" />
                    </p>
                </div>
                <div class="wrap-rich-snippets-videos">
                    <p class="notice">
                        '.__('Mark up your video content with structured data to make Google Search an entry point for discovering and watching videos. ','wp-seopress-pro').'
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_videos_name_meta">
                            '. __( 'Video name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_videos_name" placeholder="'.esc_html__('The title of your video','wp-seopress-pro').'" aria-label="'.__('Video name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_videos_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_videos_description_meta">'. __( 'Video description', 'wp-seopress-pro' ) .'</label>
                        <textarea id="seopress_pro_rich_snippets_videos_description_meta" style="width:100%" name="seopress_pro_rich_snippets_videos_description" placeholder="'.esc_html__('The description of the video','wp-seopress-pro').'" aria-label="'.__('Video description','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_videos_description.'">'.$seopress_pro_rich_snippets_videos_description.'</textarea>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_videos_img_meta">'. __( 'Video thumbnail', 'wp-seopress-pro' ) .'</label>
                        <span class="advise">'. __('Minimum size: 160px by 90px - Max size: 1920x1080px - crawlable and indexable', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_videos_img_meta" type="text" name="seopress_pro_rich_snippets_videos_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Video thumbnail','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_videos_img.'" />
                        <input id="seopress_pro_rich_snippets_videos_img_width" type="hidden" name="seopress_pro_rich_snippets_videos_img_width" value="'.$seopress_pro_rich_snippets_videos_img_width.'" />
                        <input id="seopress_pro_rich_snippets_videos_img_height" type="hidden" name="seopress_pro_rich_snippets_videos_img_height" value="'.$seopress_pro_rich_snippets_videos_img_height.'" />
                        <input id="seopress_pro_rich_snippets_videos_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_videos_duration_meta">
                            '. __( 'Duration of your video (in minutes)', 'wp-seopress-pro' ) .'</label>
                        <input type="number" name="seopress_pro_rich_snippets_videos_duration" placeholder="'.esc_html__('eg: 120 min','wp-seopress-pro').'" aria-label="'.__('Duration of your video (in minutes)','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_videos_duration.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_videos_url_meta">
                            '. __( 'Video URL', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_videos_url" placeholder="'.esc_html__('Eg: https://example.com/video.mp4','wp-seopress-pro').'" aria-label="'.__('Video URL','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_videos_url.'" />
                    </p>
                </div>
                <div class="wrap-rich-snippets-events">
                    <p class="notice">
                        '.__('Event markup describes the details of organized events. When you use it in your content, that event becomes relevant for enhanced search results for relevant queries.','wp-seopress-pro').'
                    </p>
                    <ul>
                        <li>'.__('<strong>Expired events.</strong> Events data for any feature will never be shown for expired events. However, you do not have to remove markup for expired events.','wp-seopress-pro').'</li>
                        <li>'.__('<strong>Indicate the performer.</strong> Each event item must specify a performer property corresponding to the event\'s performer; that is, a musician, musical group, presenter, actor, and so on.','wp-seopress-pro').'</li>
                        <li>'.__('<strong>Do not include promotional elements in the name.</strong>','wp-seopress-pro').'</li>
                            <ul class="sublist">
                                <li><span class="dashicons dashicons-no"></span>'.__('Promoting non-event products or services: "Trip package: San Diego/LA, 7 nights"','wp-seopress-pro').'</li>
                                <li><span class="dashicons dashicons-no"></span>'.__('Prices in event titles: "Music festival - only $10!" Instead, highlight ticket prices using the tickets property in your markup.','wp-seopress-pro').'</li>
                                <li><span class="dashicons dashicons-no"></span>'.__('Using a non-event for a title, such as: "Sale on dresses!"','wp-seopress-pro').'</li>
                                <li><span class="dashicons dashicons-no"></span>'.__('Discounts or purchase opportunties, such as: "Concert - buy your tickets now," or "Concert - 50 percent off until Saturday!"','wp-seopress-pro').'</li>
                            </ul>
                        <li>'.__('<strong>Multi-day events.</strong> If your event/ticket info is for the festival itself, specify both the start and end date of the festival. If your event/ticket info is for a specific performance that is part of the festival, specify the specific date of the performance. If the specific date is unavailable, specify both the start and end date of the festival.','wp-seopress-pro').'</li>
                    </ul>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_type_meta">'. __( 'Select your event type', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_events_type">
                            <option ' . selected( 'BusinessEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="BusinessEvent">'. __( 'Business Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ChildrensEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="ChildrensEvent">'. __( 'Children\'s Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ComedyEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="ComedyEvent">'. __( 'Comedy Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CourseInstance', $seopress_pro_rich_snippets_events_type, false ) . ' value="CourseInstance">'. __( 'Course Instance', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'DanceEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="DanceEvent">'. __( 'Dance Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'DeliveryEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="DeliveryEvent">'. __( 'Delivery Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'EducationEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="EducationEvent">'. __( 'Education Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ExhibitionEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="ExhibitionEvent">'. __( 'Exhibition Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Festival', $seopress_pro_rich_snippets_events_type, false ) . ' value="Festival">'. __( 'Festival', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'FoodEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="FoodEvent">'. __( 'Food Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'LiteraryEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="LiteraryEvent">'. __( 'Literary Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'MusicEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="MusicEvent">'. __( 'Music Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PublicationEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="PublicationEvent">'. __( 'Publication Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SaleEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="SaleEvent">'. __( 'Sale Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ScreeningEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="ScreeningEvent">'. __( 'Screening Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SocialEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="SocialEvent">'. __( 'Social Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SportsEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="SportsEvent">'. __( 'Sports Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'TheaterEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="TheaterEvent">'. __( 'Theater Event', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'VisualArtsEvent', $seopress_pro_rich_snippets_events_type, false ) . ' value="VisualArtsEvent">'. __( 'Visual Arts Event', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_name_meta">
                            '. __( 'Event name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_name" placeholder="'.esc_html__('The name of your event','wp-seopress-pro').'" aria-label="'.__('Event name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_desc_meta">
                            '. __( 'Event description (default excerpt, or beginning of the content)', 'wp-seopress-pro' ) .'</label>
                        <textarea id="seopress_pro_rich_snippets_events_desc" style="width:100%" name="seopress_pro_rich_snippets_events_desc" placeholder="'.esc_html__('Enter your event description','wp-seopress-pro').'" aria-label="'.__('Event description','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_desc.'">'.$seopress_pro_rich_snippets_events_desc.'</textarea>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_img_meta">'. __( 'Image thumbnail', 'wp-seopress-pro' ) .'</label>
                        <span class="advise">'. __('Minimum width: 720px - Recommended size: 1920px -  .jpg, .png, or. gif format - crawlable and indexable', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_events_img_meta" type="text" name="seopress_pro_rich_snippets_events_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image thumbnail','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_img.'" />
                        <input id="seopress_pro_rich_snippets_events_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_start_date_meta">
                            '. __( 'Start date', 'wp-seopress-pro' ) .'</label>
                        <input type="text" id="seopress-date-picker1" class="seopress-date-picker" autocomplete="false" name="seopress_pro_rich_snippets_events_start_date" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('Start date','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_start_date.'" />
                    </p> 
                    <p>
                        <label for="seopress_pro_rich_snippets_events_start_time_meta">
                            '. __( 'Start time', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_start_time" placeholder="'.esc_html__('Eg: HH:MM','wp-seopress-pro').'" aria-label="'.__('Start time','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_start_time.'" />
                    </p>                
                    <p>
                        <label for="seopress_pro_rich_snippets_events_end_date_meta">
                            '. __( 'End date', 'wp-seopress-pro' ) .'</label>
                        <input type="text" id="seopress-date-picker2" class="seopress-date-picker" autocomplete="false" name="seopress_pro_rich_snippets_events_end_date" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('End date','wp-seopress-pro').'"  value="'.$seopress_pro_rich_snippets_events_end_date.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_end_time_meta">
                            '. __( 'End time', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_end_time" placeholder="'.esc_html__('Eg: HH:MM','wp-seopress-pro').'" aria-label="'.__('End time','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_end_time.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_location_name_meta">
                            '. __( 'Location name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_location_name" placeholder="'.esc_html__('Eg: Hotel du Palais','wp-seopress-pro').'" aria-label="'.__('Location name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_location_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_location_url_meta">
                            '. __( 'Location Website', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_location_url" placeholder="'.esc_html__('Eg: http://www.hotel-du-palais.com/','wp-seopress-pro').'" aria-label="'.__('Location Website','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_location_url.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_location_address_meta">
                            '. __( 'Location Address', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_location_address" placeholder="'.esc_html__('Eg: 1 Avenue de l\'Imperatrice, 64200 Biarritz','wp-seopress-pro').'" aria-label="'.__('Location Address','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_location_address.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_name_meta">
                            '. __( 'Offer name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_offers_name" aria-label="'.__('Offer name','wp-seopress-pro').'" placeholder="'.esc_html__('Eg: General admission','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_offers_name.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_cat_meta">'. __( 'Select your offer category', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_events_offers_cat">
                            <option ' . selected( 'Primary', $seopress_pro_rich_snippets_events_offers_cat, false ) . ' value="Primary">'. __( 'Primary', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Secondary', $seopress_pro_rich_snippets_events_offers_cat, false ) . ' value="Secondary">'. __( 'Secondary', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Presale', $seopress_pro_rich_snippets_events_offers_cat, false ) . ' value="Presale">'. __( 'Presale', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Premium', $seopress_pro_rich_snippets_events_offers_cat, false ) . ' value="Premium">'. __( 'Premium', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_price_meta">
                            '. __( 'Price', 'wp-seopress-pro' ) .'</label>
                            <p>'.__('The lowest available price, including service charges and fees, of this type of ticket.','wp-seopress-pro').'</p>
                        <input type="text" name="seopress_pro_rich_snippets_events_offers_price" placeholder="'.esc_html__('Eg: 10','wp-seopress-pro').'" aria-label="'.__('Price','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_offers_price.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_price_currency_meta">'. __( 'Select your currency', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_events_offers_price_currency">
                            <option ' . selected( 'none', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="none">'. __( 'Select a Currency', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'USD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="USD">'. __( 'U.S. Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'GBP', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="GBP">'. __( 'Pound Sterling', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'EUR', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="EUR">'. __( 'Euro', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ARS', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="ARS">'. __( 'Argentina Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'AUD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="AUD">'. __( 'Australian Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'BRL', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="BRL">'. __( 'Brazilian Real', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'BGN', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="BGN">'. __( 'Bulgarian lev', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CAD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="CAD">'. __( 'Canadian Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CLP', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="CLP">'. __( 'Chilean Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CZK', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="CZK">'. __( 'Czech Koruna', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'DKK', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="DKK">'. __( 'Danish Krone', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'HKD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="HKD">'. __( 'Hong Kong Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'HUF', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="HUF">'. __( 'Hungarian Forint', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'INR', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="INR">'. __( 'Indian rupee', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ILS', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="ILS">'. __( 'Israeli New Sheqel', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'JPY', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="JPY">'. __( 'Japanese Yen', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'MYR', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="MYR">'. __( 'Malaysian Ringgit', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'MXN', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="MXN">'. __( 'Mexican Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'NOK', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="NOK">'. __( 'Norwegian Krone', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'NZD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="NZD">'. __( 'New Zealand Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PHP', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="PHP">'. __( 'Philippine Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PLN', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="PLN">'. __( 'Polish Zloty', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'IDR', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="IDR">'. __( 'Indonesian rupiah', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'RUB', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="RUB">'. __( 'Russian Ruble', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SGD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="SGD">'. __( 'Singapore Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ZAR', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="ZAR">'. __( 'South African Rand', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SEK', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="SEK">'. __( 'Swedish Krona', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CHF', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="CHF">'. __( 'Swiss Franc', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'TWD', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="TWD">'. __( 'Taiwan New Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'THB', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="THB">'. __( 'Thai Baht', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'UAH', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="UAH">'. __( 'Ukrainian hryvnia', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'VND', $seopress_pro_rich_snippets_events_offers_price_currency, false ) . ' value="VND">'. __( 'Vietnamese đồng', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_availability_meta">'. __( 'Availability', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_events_offers_availability">
                            <option ' . selected( 'InStock', $seopress_pro_rich_snippets_events_offers_availability, false ) . ' value="InStock">'. __( 'In Stock', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SoldOut', $seopress_pro_rich_snippets_events_offers_availability, false ) . ' value="SoldOut">'. __( 'Sold Out', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PreOrder', $seopress_pro_rich_snippets_events_offers_availability, false ) . ' value="PreOrder">'. __( 'Pre Order', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_rich_snippets_events_offers_valid_from_meta_date">'. __( 'Valid From', 'wp-seopress-pro' ) .'</label>
                        '.__('The date when tickets go on sale','wp-seopress-pro').'
                        <input type="text" id="seopress-date-picker3" class="seopress-date-picker" autocomplete="false" name="seopress_rich_snippets_events_offers_valid_from_date" aria-label="'.__('The date when tickets go on sale','wp-seopress-pro').'" value="'.$seopress_rich_snippets_events_offers_valid_from_date.'" />
                        <label for="seopress_rich_snippets_events_offers_valid_from_meta_time">'. __( 'Time', 'wp-seopress-pro' ) .'</label>
                        '.__('The time when tickets go on sale','wp-seopress-pro').'
                        <input type="time" name="seopress_rich_snippets_events_offers_valid_from_time" aria-label="'.__('The time when tickets go on sale','wp-seopress-pro').'" value="'.$seopress_rich_snippets_events_offers_valid_from_time.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_offers_url_meta">
                            '. __( 'Website to buy tickets', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_offers_url" placeholder="'.esc_html__('Eg: https://fnac.com/','wp-seopress-pro').'" aria-label="'.__('Website to buy tickets','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_offers_url.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_events_performer_meta">
                            '. __( 'Performer name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_events_performer" placeholder="'.esc_html__('Eg: Lana Del Rey','wp-seopress-pro').'" aria-label="'.__('Performer name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_events_performer.'" />
                    </p>
                </div>
                <div class="wrap-rich-snippets-products">
                    <p class="notice">
                        '.__('Add markup to your product pages so Google can provide detailed product information in rich Search results - including Image Search. Users can see price, availability... right on Search results.','wp-seopress-pro').'
                    </p>
                    <ul>
                        <li>'.__('<strong>Use markup for a specific product, not a category or list of products.</strong> For example, "shoes in our shop" is not a specific product.','wp-seopress-pro').'</li>
                        <li>'.__('<strong>Adult-related products are not supported.</strong>','wp-seopress-pro').'</li>
                        <li>'.__('<strong>Works best with WooCommerce.</strong>','wp-seopress-pro').'</li>
                    </ul>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_name_meta">
                            '. __( 'Product name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_product_name" placeholder="'.esc_html__('The name of your product','wp-seopress-pro').'" aria-label="'.__('Product name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_name.'" />
                        <span class="description">'.__('Default: product title','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_description_meta">'. __( 'Product description', 'wp-seopress-pro' ) .'</label>
                        <textarea id="seopress_pro_rich_snippets_product_description_meta" style="width:100%" name="seopress_pro_rich_snippets_product_description" placeholder="'.esc_html__('The description of the product','wp-seopress-pro').'" aria-label="'.__('Product description','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_description.'">'.$seopress_pro_rich_snippets_product_description.'</textarea>
                            <span class="description">'.__('Default: product excerpt','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_img_meta">'. __( 'Thumbnail', 'wp-seopress-pro' ) .'</label>
                        <span class="advise">'. __('Pictures clearly showing the product, e.g. against a white background, are preferred.', 'wp-seopress-pro') .'</span>
                        <input id="seopress_pro_rich_snippets_product_img_meta" type="text" name="seopress_pro_rich_snippets_product_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Thumbnail','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_img.'" />
                        <input id="seopress_pro_rich_snippets_product_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                        <span class="description">'.__('Default: product image','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_price_meta">
                            '. __( 'Product price', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_product_price" placeholder="'.esc_html__('Eg: 30','wp-seopress-pro').'" aria-label="'.__('Product price','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_price.'" />
                        <span class="description">'.__('Default: active product price','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_price_valid_date_meta">
                            '. __( 'Product price valid until', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_product_price_valid_date" class="seopress-date-picker" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('Product price valid until','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_price_valid_date.'" />
                        <span class="description">'.__('Default: sale price dates To field','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_sku_meta">
                            '. __( 'Product SKU', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_product_sku" placeholder="'.esc_html__('Eg: 0446310786','wp-seopress-pro').'" aria-label="'.__('Product SKU','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_sku.'" />
                        <span class="description">'.__('Default: product SKU','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_global_ids_meta">
                            '. __( 'Product Global Identifiers type', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_product_global_ids">
                            <option ' . selected( 'none', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="none">'. __( 'Select a global identifiers', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'gtin8', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="gtin8">'. __( 'gtin8', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'gtin13', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="gtin13">'. __( 'gtin13', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'gtin14', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="gtin14">'. __( 'gtin14', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'mpn', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="mpn">'. __( 'mpn', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'isbn', $seopress_pro_rich_snippets_product_global_ids, false ) . ' value="isbn">'. __( 'isbn', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_global_ids_value_meta">
                            '. __( 'Product Global Identifiers value', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_product_global_ids_value" placeholder="'.esc_html__('Eg: 925872','wp-seopress-pro').'" aria-label="'.__('Product Global Identifiers','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_product_global_ids_value.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_brand_meta">
                            '. __( 'Product Brand', 'wp-seopress-pro' ) .'</label>';

                            if (function_exists('seopress_get_taxonomies')) {
                                $seopress_get_taxonomies = seopress_get_taxonomies();
                                if (!empty(seopress_get_taxonomies())) {
                                    echo '<select name="seopress_pro_rich_snippets_product_brand">';
                                        echo '<option ' . selected( 'none', $seopress_pro_rich_snippets_product_brand, false ) . ' value="none">'. __( 'Select a taxonomy', 'wp-seopress-pro' ) .'</option>';
                                        
                                        foreach ($seopress_get_taxonomies as $key => $value) {
                                            echo '<option ' . selected( $key, $seopress_pro_rich_snippets_product_brand, false ) . ' value="'.$key.'">'. $key .'</option>';
                                        }
                                    echo '</select>';
                                }
                            }
                    echo '</p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_price_currency_meta">
                            '. __( 'Product currency', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_product_price_currency">
                            <option ' . selected( 'none', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="none">'. __( 'Select a Currency', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'USD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="USD">'. __( 'U.S. Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'GBP', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="GBP">'. __( 'Pound Sterling', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'EUR', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="EUR">'. __( 'Euro', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ARS', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="ARS">'. __( 'Argentina Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'AUD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="AUD">'. __( 'Australian Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'BRL', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="BRL">'. __( 'Brazilian Real', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'BGN', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="BGN">'. __( 'Bulgarian lev', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CAD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="CAD">'. __( 'Canadian Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CLP', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="CLP">'. __( 'Chilean Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CZK', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="CZK">'. __( 'Czech Koruna', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'DKK', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="DKK">'. __( 'Danish Krone', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'HKD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="HKD">'. __( 'Hong Kong Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'HUF', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="HUF">'. __( 'Hungarian Forint', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'INR', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="INR">'. __( 'Indian rupee', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ILS', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="ILS">'. __( 'Israeli New Sheqel', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'JPY', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="JPY">'. __( 'Japanese Yen', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'MYR', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="MYR">'. __( 'Malaysian Ringgit', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'MXN', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="MXN">'. __( 'Mexican Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'NOK', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="NOK">'. __( 'Norwegian Krone', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'NZD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="NZD">'. __( 'New Zealand Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PHP', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="PHP">'. __( 'Philippine Peso', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PLN', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="PLN">'. __( 'Polish Zloty', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'IDR', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="IDR">'. __( 'Indonesian rupiah', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'RUB', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="RUB">'. __( 'Russian Ruble', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SGD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="SGD">'. __( 'Singapore Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'ZAR', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="ZAR">'. __( 'South African Rand', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SEK', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="SEK">'. __( 'Swedish Krona', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'CHF', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="CHF">'. __( 'Swiss Franc', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'TWD', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="TWD">'. __( 'Taiwan New Dollar', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'THB', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="THB">'. __( 'Thai Baht', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'UAH', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="UAH">'. __( 'Ukrainian hryvnia', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'VND', $seopress_pro_rich_snippets_product_price_currency, false ) . ' value="VND">'. __( 'Vietnamese đồng', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_condition_meta">'. __( 'Product Condition', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_product_condition">
                            <option ' . selected( 'NewCondition', $seopress_pro_rich_snippets_product_condition, false ) . ' value="NewCondition">'. __( 'New', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'UsedCondition', $seopress_pro_rich_snippets_product_condition, false ) . ' value="UsedCondition">'. __( 'Used', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'DamagedCondition', $seopress_pro_rich_snippets_product_condition, false ) . ' value="DamagedCondition">'. __( 'Damaged', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'RefurbishedCondition', $seopress_pro_rich_snippets_product_condition, false ) . ' value="RefurbishedCondition">'. __( 'Refurbished', 'wp-seopress-pro' ) .'</option>
                        </select>
                        <span class="description">'.__('Default: new','wp-seopress-pro').'</span>
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_product_availability_meta">'. __( 'Product Availability', 'wp-seopress-pro' ) .'</label>
                        <select name="seopress_pro_rich_snippets_product_availability">
                            <option ' . selected( 'InStock', $seopress_pro_rich_snippets_product_availability, false ) . ' value="InStock">'. __( 'In Stock', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'InStoreOnly', $seopress_pro_rich_snippets_product_availability, false ) . ' value="InStoreOnly">'. __( 'In Store Only', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'OnlineOnly', $seopress_pro_rich_snippets_product_availability, false ) . ' value="OnlineOnly">'. __( 'Online Only', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'LimitedAvailability', $seopress_pro_rich_snippets_product_availability, false ) . ' value="LimitedAvailability">'. __( 'Limited Availability', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'SoldOut', $seopress_pro_rich_snippets_product_availability, false ) . ' value="SoldOut">'. __( 'Sold Out', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'OutOfStock', $seopress_pro_rich_snippets_product_availability, false ) . ' value="OutOfStock">'. __( 'Out Of Stock', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'Discontinued', $seopress_pro_rich_snippets_product_availability, false ) . ' value="Discontinued">'. __( 'Discontinued', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PreOrder', $seopress_pro_rich_snippets_product_availability, false ) . ' value="PreOrder">'. __( 'Pre Order', 'wp-seopress-pro' ) .'</option>
                            <option ' . selected( 'PreSale', $seopress_pro_rich_snippets_product_availability, false ) . ' value="PreSale">'. __( 'Pre Sale', 'wp-seopress-pro' ) .'</option>
                        </select>
                    </p>
                </div>
                <div class="wrap-rich-snippets-review">
                    <p class="notice">
                        '.__('A simple review about something. When Google finds valid reviews or ratings markup, they may show a rich snippet that includes stars and other summary info from reviews or ratings.','wp-seopress-pro').'
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_review_item_meta">
                            '. __( 'Review item name', 'wp-seopress-pro' ) .'</label>
                        <input type="text" name="seopress_pro_rich_snippets_review_item" placeholder="'.esc_html__('The item name reviewed','wp-seopress-pro').'" aria-label="'.__('Review item name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_review_item.'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_review_img_meta">'. __( 'Review item image', 'wp-seopress-pro' ) .'</label>
                        <input id="seopress_pro_rich_snippets_review_img_meta" type="text" name="seopress_pro_rich_snippets_review_img" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Review item name','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_review_img.'" />
                        <input id="seopress_pro_rich_snippets_review_img" class="button" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />
                    </p>
                    <p>
                        <label for="seopress_pro_rich_snippets_review_rating_meta">
                            '. __( 'Your rating', 'wp-seopress-pro' ) .'</label>
                        <input type="number" max="5" min="1" step="0.1" name="seopress_pro_rich_snippets_review_rating" placeholder="'.esc_html__('The item rating','wp-seopress-pro').'" aria-label="'.__('Your rating','wp-seopress-pro').'" value="'.$seopress_pro_rich_snippets_review_rating.'" />
                    </p>
                </div>
                <p><a href="https://search.google.com/structured-data/testing-tool/#url='.get_permalink().'" target="_blank" class="button">'.__('Validate my schema','wp-seopress-pro').'</a></p>
            </div>
        </div>
        <div id="seopress-schemas-tabs-2">';
            include_once ( dirname( __FILE__ ) . '/admin-metaboxes-schemas.php');
        echo '</div>
    </div>';
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    //Save datas
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    add_action('save_post', 'seopress_pro_save_metabox');
    function seopress_pro_save_metabox($post_id){
        if ( 'attachment' !== get_post_type($post_id)) {
            if(isset($_POST['seopress_pro_rich_snippets_type'])){
              update_post_meta($post_id, '_seopress_pro_rich_snippets_type', esc_html($_POST['seopress_pro_rich_snippets_type']));
            }
            
            //Automatic
            if(isset($_POST['seopress_pro_schemas'])){
                update_post_meta($post_id, '_seopress_pro_schemas', $_POST['seopress_pro_schemas']);
            }

            //Article
            if(isset($_POST['seopress_pro_rich_snippets_article_type'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_article_type', esc_html($_POST['seopress_pro_rich_snippets_article_type']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_article_title'])){
              update_post_meta($post_id, '_seopress_pro_rich_snippets_article_title', esc_html($_POST['seopress_pro_rich_snippets_article_title']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_article_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img', esc_html($_POST['seopress_pro_rich_snippets_article_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_article_img_width'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_width', esc_html($_POST['seopress_pro_rich_snippets_article_img_width']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_article_img_height'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_height', esc_html($_POST['seopress_pro_rich_snippets_article_img_height']));
            }
            //Local Business
            if(isset($_POST['seopress_pro_rich_snippets_lb_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_name', esc_html($_POST['seopress_pro_rich_snippets_lb_name']));
            }            
            if(isset($_POST['seopress_pro_rich_snippets_lb_type'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_type', esc_html($_POST['seopress_pro_rich_snippets_lb_type']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img', esc_html($_POST['seopress_pro_rich_snippets_lb_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_img_width'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_width', esc_html($_POST['seopress_pro_rich_snippets_lb_img_width']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_img_height'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_height', esc_html($_POST['seopress_pro_rich_snippets_lb_img_height']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_street_addr'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_street_addr', esc_html($_POST['seopress_pro_rich_snippets_lb_street_addr']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_city'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_city', esc_html($_POST['seopress_pro_rich_snippets_lb_city']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_state'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_state', esc_html($_POST['seopress_pro_rich_snippets_lb_state']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_pc'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_pc', esc_html($_POST['seopress_pro_rich_snippets_lb_pc']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_country'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_country', esc_html($_POST['seopress_pro_rich_snippets_lb_country']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_lat'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lat', esc_html($_POST['seopress_pro_rich_snippets_lb_lat']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_lon'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lon', esc_html($_POST['seopress_pro_rich_snippets_lb_lon']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_website'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_website', esc_html($_POST['seopress_pro_rich_snippets_lb_website']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_tel'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_tel', esc_html($_POST['seopress_pro_rich_snippets_lb_tel']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_price'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_price', esc_html($_POST['seopress_pro_rich_snippets_lb_price']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_lb_opening_hours'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_opening_hours', $_POST['seopress_pro_rich_snippets_lb_opening_hours']);
            }
            //FAQ
            if(isset($_POST['seopress_pro_rich_snippets_faq'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_faq', $_POST['seopress_pro_rich_snippets_faq']);
            }
            //Course
            if(isset($_POST['seopress_pro_rich_snippets_courses_title'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_title', esc_html($_POST['seopress_pro_rich_snippets_courses_title']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_courses_desc'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_desc', esc_html($_POST['seopress_pro_rich_snippets_courses_desc']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_courses_school'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_school', esc_html($_POST['seopress_pro_rich_snippets_courses_school']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_courses_website'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_website', esc_html($_POST['seopress_pro_rich_snippets_courses_website']));
            }
            //Recipe
            if(isset($_POST['seopress_pro_rich_snippets_recipes_name'])){
              update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_name', esc_html($_POST['seopress_pro_rich_snippets_recipes_name']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_desc'])){
              update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_desc', esc_html($_POST['seopress_pro_rich_snippets_recipes_desc']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_cat'])){
              update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cat', esc_html($_POST['seopress_pro_rich_snippets_recipes_cat']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img', esc_html($_POST['seopress_pro_rich_snippets_recipes_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_prep_time'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_prep_time', esc_html($_POST['seopress_pro_rich_snippets_recipes_prep_time']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_cook_time'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cook_time', esc_html($_POST['seopress_pro_rich_snippets_recipes_cook_time']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_calories'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_calories', esc_html($_POST['seopress_pro_rich_snippets_recipes_calories']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_recipes_yield'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_yield', esc_html($_POST['seopress_pro_rich_snippets_recipes_yield']));
            }        
            //Video
            if(isset($_POST['seopress_pro_rich_snippets_videos_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_name', esc_html($_POST['seopress_pro_rich_snippets_videos_name']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_description'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_description', esc_html($_POST['seopress_pro_rich_snippets_videos_description']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img', esc_html($_POST['seopress_pro_rich_snippets_videos_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_img_width'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_width', esc_html($_POST['seopress_pro_rich_snippets_videos_img_width']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_img_height'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_height', esc_html($_POST['seopress_pro_rich_snippets_videos_img_height']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_duration'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_duration', esc_html($_POST['seopress_pro_rich_snippets_videos_duration']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_videos_url'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_url', esc_html($_POST['seopress_pro_rich_snippets_videos_url']));
            }
            //Event
            if(isset($_POST['seopress_pro_rich_snippets_events_type'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_type', esc_html($_POST['seopress_pro_rich_snippets_events_type']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_name', esc_html($_POST['seopress_pro_rich_snippets_events_name']));
            }  
            if(isset($_POST['seopress_pro_rich_snippets_events_desc'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc', esc_html($_POST['seopress_pro_rich_snippets_events_desc']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img', esc_html($_POST['seopress_pro_rich_snippets_events_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_desc'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc', esc_html($_POST['seopress_pro_rich_snippets_events_desc']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_start_date'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_date', esc_html($_POST['seopress_pro_rich_snippets_events_start_date']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_start_time'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_time', esc_html($_POST['seopress_pro_rich_snippets_events_start_time']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_end_date'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_date', esc_html($_POST['seopress_pro_rich_snippets_events_end_date']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_end_time'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_time', esc_html($_POST['seopress_pro_rich_snippets_events_end_time']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_location_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_name', esc_html($_POST['seopress_pro_rich_snippets_events_location_name']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_location_url'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_url', esc_html($_POST['seopress_pro_rich_snippets_events_location_url']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_location_address'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_address', esc_html($_POST['seopress_pro_rich_snippets_events_location_address']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_name', esc_html($_POST['seopress_pro_rich_snippets_events_offers_name']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_cat'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_cat', esc_html($_POST['seopress_pro_rich_snippets_events_offers_cat']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_price'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_currency'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_currency', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_currency']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_availability'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_availability', esc_html($_POST['seopress_pro_rich_snippets_events_offers_availability']));
            }
            if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_date'])){
                update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_date', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_date']));
            }
            if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_time'])){
                update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_time', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_time']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_offers_url'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_url', esc_html($_POST['seopress_pro_rich_snippets_events_offers_url']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_events_performer'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_events_performer', esc_html($_POST['seopress_pro_rich_snippets_events_performer']));
            }
            //Product
            if(isset($_POST['seopress_pro_rich_snippets_product_name'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_name', esc_html($_POST['seopress_pro_rich_snippets_product_name']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_description'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_description', esc_html($_POST['seopress_pro_rich_snippets_product_description']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img', esc_html($_POST['seopress_pro_rich_snippets_product_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_price'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price', esc_html($_POST['seopress_pro_rich_snippets_product_price']));
            }              
            if(isset($_POST['seopress_pro_rich_snippets_product_price_valid_date'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_valid_date', esc_html($_POST['seopress_pro_rich_snippets_product_price_valid_date']));
            }            
            if(isset($_POST['seopress_pro_rich_snippets_product_sku'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_sku', esc_html($_POST['seopress_pro_rich_snippets_product_sku']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_global_ids'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_brand'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_brand', esc_html($_POST['seopress_pro_rich_snippets_product_brand']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_value'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_value', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_value']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_price_currency'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_currency', esc_html($_POST['seopress_pro_rich_snippets_product_price_currency']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_condition'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_condition', esc_html($_POST['seopress_pro_rich_snippets_product_condition']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_product_availability'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_product_availability', esc_html($_POST['seopress_pro_rich_snippets_product_availability']));
            }
            //Review
            if(isset($_POST['seopress_pro_rich_snippets_review_item'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_review_item', esc_html($_POST['seopress_pro_rich_snippets_review_item']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_review_img'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img', esc_html($_POST['seopress_pro_rich_snippets_review_img']));
            }
            if(isset($_POST['seopress_pro_rich_snippets_review_rating'])){
                update_post_meta($post_id, '_seopress_pro_rich_snippets_review_rating', esc_html($_POST['seopress_pro_rich_snippets_review_rating']));
            }
        }
    }
}

if (seopress_get_toggle_rich_snippets_option() =='1' && seopress_rich_snippets_enable_option() =='1') {
    if (is_user_logged_in()) {
        if (is_super_admin()) {
            echo seopress_pro_admin_std_metaboxe_display();
        } else {
            global $wp_roles;
                
            //Get current user role
            if(isset(wp_get_current_user()->roles[0])) {
                $seopress_user_role = wp_get_current_user()->roles[0];
                //If current user role matchs values from Security settings then apply
                if (function_exists('seopress_advanced_security_metaboxe_sdt_role_hook_option') && seopress_advanced_security_metaboxe_sdt_role_hook_option() !='') {
                    if( array_key_exists( $seopress_user_role, seopress_advanced_security_metaboxe_sdt_role_hook_option())) {
                        //do nothing
                    } else {
                        echo seopress_pro_admin_std_metaboxe_display();
                    }
                } else {
                    echo seopress_pro_admin_std_metaboxe_display();
                }
            }
        }
    }
}
