<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Requests schemas using WP Query
///////////////////////////////////////////////////////////////////////////////////////////////////
global $post;
$tmp = $post;

$args = array(
    'post_type' => 'seopress_schemas',
    'posts_per_page' => -1,
    //'fields' => 'ids',
);

$sp_schemas_query = new WP_Query( $args );
 
$sp_schemas_ids = array();

if ( $sp_schemas_query->have_posts() ) {
    while ( $sp_schemas_query->have_posts() ) {
        $sp_schemas_query->the_post();
        if (get_post_meta(get_the_ID(), '_seopress_pro_rich_snippets_rules', true)) {
            if (get_current_screen()->post_type == get_post_meta(get_the_ID(), '_seopress_pro_rich_snippets_rules', true)) {
                $sp_schemas_ids[] = get_the_ID();
            }
        }
    }
    wp_reset_postdata();
}

$post = $tmp;

///////////////////////////////////////////////////////////////////////////////////////////////////
//Display schemas inside Automatic tab
///////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($sp_schemas_ids)) {

    echo '<ul>';
        foreach ($sp_schemas_ids as $id) {

        	//All datas
        	$seopress_pro_schemas                               = get_post_meta($post->ID,'_seopress_pro_schemas');

        	//Type
            $seopress_pro_rich_snippets_type 					= get_post_meta($id,'_seopress_pro_rich_snippets_type',true);

            //Article
            if ($seopress_pro_rich_snippets_type == 'articles') {
	            $seopress_pro_rich_snippets_article_title           = get_post_meta($id,'_seopress_pro_rich_snippets_article_title',true);
	            $check_article_title = isset($seopress_pro_schemas[0][$id]['rich_snippets_article']['title']) ? $seopress_pro_schemas[0][$id]['rich_snippets_article']['title'] : NULL;

	            $seopress_pro_rich_snippets_article_img           	= get_post_meta($id,'_seopress_pro_rich_snippets_article_img',true);
	            $check_article_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_article']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_article']['img'] : NULL;
        	}
            //Business
            if ($seopress_pro_rich_snippets_type == 'localbusiness') {
	            $seopress_pro_rich_snippets_lb_name           		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_name',true);
	            $check_lb_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['name'] : NULL;

	            $seopress_pro_rich_snippets_lb_type           		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_type',true);
	            $check_lb_type = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['type']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['type'] : NULL;

	            $seopress_pro_rich_snippets_lb_img           		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_img',true);
	            $check_lb_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['img'] : NULL;

	            $seopress_pro_rich_snippets_lb_street_addr          = get_post_meta($id,'_seopress_pro_rich_snippets_lb_street_addr',true);
	            $check_lb_street_addr = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['street_addr']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['street_addr'] : NULL;

	            $seopress_pro_rich_snippets_lb_city          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_city',true);
	            $check_lb_city = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['city']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['city'] : NULL;

	            $seopress_pro_rich_snippets_lb_state          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_state',true);
	            $check_lb_state = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['state']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['state'] : NULL;

	            $seopress_pro_rich_snippets_lb_pc          			= get_post_meta($id,'_seopress_pro_rich_snippets_lb_pc',true);
	            $check_lb_pc = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['pc']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['pc'] : NULL;

	            $seopress_pro_rich_snippets_lb_country          	= get_post_meta($id,'_seopress_pro_rich_snippets_lb_country',true);
	            $check_lb_country = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['country']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['country'] : NULL;

	            $seopress_pro_rich_snippets_lb_lat          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_lat',true);
	            $check_lb_lat = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['lat']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['lat'] : NULL;

	            $seopress_pro_rich_snippets_lb_lon          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_lon',true);
	            $check_lb_lon = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['lon']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['lon'] : NULL;

	            $seopress_pro_rich_snippets_lb_website          	= get_post_meta($id,'_seopress_pro_rich_snippets_lb_website',true);
	            $check_lb_website = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['website']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['website'] : NULL;

	            $seopress_pro_rich_snippets_lb_tel          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_tel',true);
	            $check_lb_tel = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['tel']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['tel'] : NULL;

	            $seopress_pro_rich_snippets_lb_price          		= get_post_meta($id,'_seopress_pro_rich_snippets_lb_price',true);
	            $check_lb_price = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['price']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['price'] : NULL;

	            $check_lb_opening_hours = isset($seopress_pro_schemas[0][$id]['rich_snippets_lb']['opening_hours']) ? $seopress_pro_schemas[0][$id]['rich_snippets_lb']['opening_hours'] : NULL;
	        }

            //Course
            if ($seopress_pro_rich_snippets_type == 'courses') {
	            $seopress_pro_rich_snippets_courses_title          	= get_post_meta($id,'_seopress_pro_rich_snippets_courses_title',true);
	            $check_courses_title = isset($seopress_pro_schemas[0][$id]['rich_snippets_courses']['title']) ? $seopress_pro_schemas[0][$id]['rich_snippets_courses']['title'] : NULL;

	            $seopress_pro_rich_snippets_courses_desc          	= get_post_meta($id,'_seopress_pro_rich_snippets_courses_desc',true);
	            $check_courses_desc = isset($seopress_pro_schemas[0][$id]['rich_snippets_courses']['desc']) ? $seopress_pro_schemas[0][$id]['rich_snippets_courses']['desc'] : NULL;

	            $seopress_pro_rich_snippets_courses_school          = get_post_meta($id,'_seopress_pro_rich_snippets_courses_school',true);
	            $check_courses_desc = isset($seopress_pro_schemas[0][$id]['rich_snippets_courses']['school']) ? $seopress_pro_schemas[0][$id]['rich_snippets_courses']['school'] : NULL;

	            $seopress_pro_rich_snippets_courses_website         = get_post_meta($id,'_seopress_pro_rich_snippets_courses_website',true);
	            $check_courses_website = isset($seopress_pro_schemas[0][$id]['rich_snippets_courses']['website']) ? $seopress_pro_schemas[0][$id]['rich_snippets_courses']['website'] : NULL;

	            $seopress_pro_rich_snippets_courses_school         = get_post_meta($id,'_seopress_pro_rich_snippets_courses_school',true);
	            $check_courses_school = isset($seopress_pro_schemas[0][$id]['rich_snippets_courses']['school']) ? $seopress_pro_schemas[0][$id]['rich_snippets_courses']['school'] : NULL;
	        }

	        //Recipe
	        if ($seopress_pro_rich_snippets_type == 'recipes') {
	            $seopress_pro_rich_snippets_recipes_name          	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_name',true);
	            $check_recipes_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['name'] : NULL;

	            $seopress_pro_rich_snippets_recipes_desc          	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_desc',true);
	            $check_recipes_desc = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['desc']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['desc'] : NULL;

	            $seopress_pro_rich_snippets_recipes_cat          	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_cat',true);
	            $check_recipes_cat = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['cat']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['cat'] : NULL;

	            $seopress_pro_rich_snippets_recipes_img          	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_img',true);
	            $check_recipes_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['img'] : NULL;

	            $seopress_pro_rich_snippets_recipes_prep_time      	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_prep_time',true);
	            $check_recipes_prep_time = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['prep_time']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['prep_time'] : NULL;

	            $seopress_pro_rich_snippets_recipes_cook_time      	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_cook_time',true);
	            $check_recipes_cook_time = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['cook_time']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['cook_time'] : NULL;

	            $seopress_pro_rich_snippets_recipes_calories      	= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_calories',true);
	            $check_recipes_calories = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['calories']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['calories'] : NULL;

	            $seopress_pro_rich_snippets_recipes_yield      		= get_post_meta($id,'_seopress_pro_rich_snippets_recipes_yield',true);
	            $check_recipes_yield = isset($seopress_pro_schemas[0][$id]['rich_snippets_recipes']['yield']) ? $seopress_pro_schemas[0][$id]['rich_snippets_recipes']['yield'] : NULL;
	        }

            //Video
            if ($seopress_pro_rich_snippets_type == 'videos') {
	            $seopress_pro_rich_snippets_videos_name      		= get_post_meta($id,'_seopress_pro_rich_snippets_videos_name',true);
	            $check_videos_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_videos']['name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_videos']['name'] : NULL;

	            $seopress_pro_rich_snippets_videos_description      = get_post_meta($id,'_seopress_pro_rich_snippets_videos_description',true);
	            $check_videos_description = isset($seopress_pro_schemas[0][$id]['rich_snippets_videos']['description']) ? $seopress_pro_schemas[0][$id]['rich_snippets_videos']['description'] : NULL;

	            $seopress_pro_rich_snippets_videos_img      		= get_post_meta($id,'_seopress_pro_rich_snippets_videos_img',true);
	            $check_videos_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_videos']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_videos']['img'] : NULL;

	            $seopress_pro_rich_snippets_videos_duration      	= get_post_meta($id,'_seopress_pro_rich_snippets_videos_duration',true);
	            $check_videos_duration = isset($seopress_pro_schemas[0][$id]['rich_snippets_videos']['duration']) ? $seopress_pro_schemas[0][$id]['rich_snippets_videos']['duration'] : NULL;

	            $seopress_pro_rich_snippets_videos_url      		= get_post_meta($id,'_seopress_pro_rich_snippets_videos_url',true);
	            $check_videos_url = isset($seopress_pro_schemas[0][$id]['rich_snippets_videos']['url']) ? $seopress_pro_schemas[0][$id]['rich_snippets_videos']['url'] : NULL;
	        }

            //Events
            if ($seopress_pro_rich_snippets_type == 'events') {
	            $seopress_pro_rich_snippets_events_type      		= get_post_meta($id,'_seopress_pro_rich_snippets_events_type',true);
	            $check_events_type = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['type']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['type'] : NULL;

	            $seopress_pro_rich_snippets_events_name      		= get_post_meta($id,'_seopress_pro_rich_snippets_events_name',true);
	            $check_events_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['name'] : NULL;

	            $seopress_pro_rich_snippets_events_desc      		= get_post_meta($id,'_seopress_pro_rich_snippets_events_desc',true);
	            $check_events_desc = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['desc']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['desc'] : NULL;

	            $seopress_pro_rich_snippets_events_img      		= get_post_meta($id,'_seopress_pro_rich_snippets_events_img',true);
	            $check_events_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['img'] : NULL;

	            $seopress_pro_rich_snippets_events_start_date      	= get_post_meta($id,'_seopress_pro_rich_snippets_events_start_date',true);
	            $check_events_start_date = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['start_date']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['start_date'] : NULL;

	            $seopress_pro_rich_snippets_events_start_time      	= get_post_meta($id,'_seopress_pro_rich_snippets_events_start_time',true);
	            $check_events_start_time = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['start_time']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['start_time'] : NULL;

	            $seopress_pro_rich_snippets_events_end_date      	= get_post_meta($id,'_seopress_pro_rich_snippets_events_end_date',true);
	            $check_events_end_date = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['end_date']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['end_date'] : NULL;

	            $seopress_pro_rich_snippets_events_end_time      	= get_post_meta($id,'_seopress_pro_rich_snippets_events_end_time',true);
	            $check_events_end_time = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['end_time']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['end_time'] : NULL;

	            $seopress_pro_rich_snippets_events_location_name    = get_post_meta($id,'_seopress_pro_rich_snippets_events_location_name',true);
	            $check_events_location_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['location_name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['location_name'] : NULL;

	            $seopress_pro_rich_snippets_events_location_url    	= get_post_meta($id,'_seopress_pro_rich_snippets_events_location_url',true);
	            $check_events_location_url = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['location_url']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['location_url'] : NULL;

	            $seopress_pro_rich_snippets_events_location_address = get_post_meta($id,'_seopress_pro_rich_snippets_events_location_address',true);
	            $check_events_location_address = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['location_address']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['location_address'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_name 		= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_name',true);
	            $check_events_offers_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_name'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_cat 		= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_cat',true);
	            $check_events_offers_cat = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_cat']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_cat'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_price 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_price',true);
	            $check_events_offers_price = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_price']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_price'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_price_currency 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_price_currency',true);
	            $check_events_offers_price_currency = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_price_currency']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_price_currency'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_availability 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_availability',true);
	            $check_events_offers_availability = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_availability']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_availability'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_valid_from_date 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_valid_from_date',true);
	            $check_events_offers_valid_from_date = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_valid_from_date']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_valid_from_date'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_valid_from_time 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_valid_from_time',true);
	            $check_events_offers_valid_from_time = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_valid_from_time']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_valid_from_time'] : NULL;

	            $seopress_pro_rich_snippets_events_offers_url 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_offers_url',true);
	            $check_events_offers_url = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_url']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['offers_url'] : NULL;

	            $seopress_pro_rich_snippets_events_performer 	= get_post_meta($id,'_seopress_pro_rich_snippets_events_performer',true);
	            $check_events_performer = isset($seopress_pro_schemas[0][$id]['rich_snippets_events']['performer']) ? $seopress_pro_schemas[0][$id]['rich_snippets_events']['performer'] : NULL;
	        }

            //Products
            if ($seopress_pro_rich_snippets_type == 'products') {
	            $seopress_pro_rich_snippets_product_name 		= get_post_meta($id,'_seopress_pro_rich_snippets_product_name',true);
	            $check_product_name = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['name']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['name'] : NULL;

	            $seopress_pro_rich_snippets_product_description = get_post_meta($id,'_seopress_pro_rich_snippets_product_description',true);
	            $check_product_description = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['description']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['description'] : NULL;

	            $seopress_pro_rich_snippets_product_img 		= get_post_meta($id,'_seopress_pro_rich_snippets_product_img',true);
	            $check_product_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['img'] : NULL;

	            $seopress_pro_rich_snippets_product_price 		= get_post_meta($id,'_seopress_pro_rich_snippets_product_price',true);
	            $check_product_price = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['price']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['price'] : NULL;

	            $seopress_pro_rich_snippets_product_price_valid_date = get_post_meta($id,'_seopress_pro_rich_snippets_product_price_valid_date',true);
	            $check_product_price_valid_date = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['price_valid_date']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['price_valid_date'] : NULL;

	            $seopress_pro_rich_snippets_product_sku 		= get_post_meta($id,'_seopress_pro_rich_snippets_product_sku',true);
	            $check_product_sku = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['sku']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['sku'] : NULL;

	            $seopress_pro_rich_snippets_product_brand 		= get_post_meta($id,'_seopress_pro_rich_snippets_product_brand',true);
	            $check_product_brand = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['brand']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['brand'] : NULL;

	            $seopress_pro_rich_snippets_product_global_ids 	= get_post_meta($id,'_seopress_pro_rich_snippets_product_global_ids',true);
	            $check_product_global_ids = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['global_ids']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['global_ids'] : NULL;

	            $seopress_pro_rich_snippets_product_global_ids_value 	= get_post_meta($id,'_seopress_pro_rich_snippets_product_global_ids_value',true);
	            $check_product_global_ids_value = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['global_ids_value']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['global_ids_value'] : NULL;
	            
	            $seopress_pro_rich_snippets_product_price_currency 	= get_post_meta($id,'_seopress_pro_rich_snippets_product_price_currency',true);
	            $check_product_currency = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['currency']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['currency'] : NULL;

	            $seopress_pro_rich_snippets_product_condition 	= get_post_meta($id,'_seopress_pro_rich_snippets_product_condition',true);
	            $check_product_condition = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['condition']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['condition'] : NULL;

	            $seopress_pro_rich_snippets_product_availability = get_post_meta($id,'_seopress_pro_rich_snippets_product_availability',true);
	            $check_product_availability = isset($seopress_pro_schemas[0][$id]['rich_snippets_product']['availability']) ? $seopress_pro_schemas[0][$id]['rich_snippets_product']['availability'] : NULL;
	        }

            //Review
            if ($seopress_pro_rich_snippets_type == 'review') {
	            $seopress_pro_rich_snippets_review_item 		= get_post_meta($id,'_seopress_pro_rich_snippets_review_item',true);
	            $check_review_item = isset($seopress_pro_schemas[0][$id]['rich_snippets_review']['item']) ? $seopress_pro_schemas[0][$id]['rich_snippets_review']['item'] : NULL;

	            $seopress_pro_rich_snippets_review_img 			= get_post_meta($id,'_seopress_pro_rich_snippets_review_img',true);
	            $check_review_img = isset($seopress_pro_schemas[0][$id]['rich_snippets_review']['img']) ? $seopress_pro_schemas[0][$id]['rich_snippets_review']['img'] : NULL;

	            $seopress_pro_rich_snippets_review_rating 		= get_post_meta($id,'_seopress_pro_rich_snippets_review_rating',true);
	            $check_review_rating = isset($seopress_pro_schemas[0][$id]['rich_snippets_review']['rating']) ? $seopress_pro_schemas[0][$id]['rich_snippets_review']['rating'] : NULL;
	        }

	        if ($seopress_pro_rich_snippets_type != 'none' || $seopress_pro_rich_snippets_type !='') {
            	echo '<li class="schema_type">'.$seopress_pro_rich_snippets_type;

            	if (current_user_can('manage_options') && is_admin()) {
            		echo '<span><a href="'.admin_url('post.php?post='.$id.'&action=edit').'">'.__('Edit','wp-seopress-pro').'</a></span>';
            	}

            	echo '</li>';
            }

            //Article
            if ($seopress_pro_rich_snippets_type == 'articles') {
	            
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_article_title == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_article][title]_meta">
		                            '. __( 'Headline <em>(max limit: 110)</em>', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_article][title]" name="seopress_pro_schemas['.$id.'][rich_snippets_article][title]" placeholder="'.esc_html__('The headline of the article','wp-seopress-pro').'" aria-label="'.__('Headline <em>(max limit: 110)</em>','wp-seopress-pro').'" value="'.$check_article_title.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_article_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_article][img]_meta">
		                            '. __( 'Image', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_article][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_article][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image','wp-seopress-pro').'" value="'.$check_article_img.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }

            //Local Business
            if ($seopress_pro_rich_snippets_type == 'localbusiness') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][name]_meta">
		                            '. __( 'Name of your business', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][name]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][name]" placeholder="'.esc_html__('eg: SEOPress','wp-seopress-pro').'" aria-label="'.__('Name of your business','wp-seopress-pro').'" value="'.$check_lb_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_type == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][type]_meta">
		                            '. __( 'Select a business type', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][type]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][type]" placeholder="'.esc_html__('eg: TravelAgency','wp-seopress-pro').'" aria-label="'.__('Select a business type','wp-seopress-pro').'" value="'.$check_lb_type.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][img]_meta">
		                            '. __( 'Image', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Select your image','wp-seopress-pro').'" value="'.$check_lb_img.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_street_addr == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][street_addr]_meta">
		                            '. __( 'Street Address', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][street_addr]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][street_addr]" placeholder="'.esc_html__('eg: Place Bellevue','wp-seopress-pro').'" aria-label="'.__('Street Address','wp-seopress-pro').'" value="'.$check_lb_street_addr.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_city == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][city]_meta">
		                            '. __( 'City', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][city]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][city]" placeholder="'.esc_html__('eg: Biarritz','wp-seopress-pro').'" aria-label="'.__('City','wp-seopress-pro').'" value="'.$check_lb_city.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_state == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][state]_meta">
		                            '. __( 'State', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][state]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][state]" placeholder="'.esc_html__('eg: Pyrenees Atlantiques','wp-seopress-pro').'" aria-label="'.__('State','wp-seopress-pro').'" value="'.$check_lb_state.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_pc == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][pc]_meta">
		                            '. __( 'Postal code', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][pc]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][pc]" placeholder="'.esc_html__('eg: 64200','wp-seopress-pro').'" aria-label="'.__('Postal code','wp-seopress-pro').'" value="'.$check_lb_pc.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_country == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][country]_meta">
		                            '. __( 'Country', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][country]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][country]" placeholder="'.esc_html__('eg: France','wp-seopress-pro').'" aria-label="'.__('Country','wp-seopress-pro').'" value="'.$check_lb_country.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_lat == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][lat]_meta">
		                            '. __( 'Latitude', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][lat]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][lat]" placeholder="'.esc_html__('eg: 43.4831389','wp-seopress-pro').'" aria-label="'.__('Latitude','wp-seopress-pro').'" value="'.$check_lb_lat.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_lon == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][lon]_meta">
		                            '. __( 'Longitude', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][lon]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][lon]" placeholder="'.esc_html__('eg: -1.5630987','wp-seopress-pro').'" aria-label="'.__('Longitude','wp-seopress-pro').'" value="'.$check_lb_lon.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_website == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][website]_meta">
		                            '. __( 'URL', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][website]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][website]" placeholder="'.get_home_url().'" aria-label="'.__('URL','wp-seopress-pro').'" value="'.$check_lb_website.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_tel == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][tel]_meta">
		                            '. __( 'Telephone', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][tel]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][tel]" placeholder="'.esc_html__('eg: +33559240138','wp-seopress-pro').'" aria-label="'.__('Telephone','wp-seopress-pro').'" value="'.$check_lb_tel.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_lb_price == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][price]_meta">
		                            '. __( 'Price range', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_lb][price]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][price]" placeholder="'.esc_html__('eg: $$, €€€, or ££££...','wp-seopress-pro').'" aria-label="'.__('Price range','wp-seopress-pro').'" value="'.$check_lb_price.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		                echo '<p>
	                        <label for="seopress_pro_rich_snippets_lb_opening_hours_meta">
	                            '. __( 'Opening hours', 'wp-seopress-pro' ) .'</label>
	                    </p>';

	                    $options = $check_lb_opening_hours;
	                    
	                    $days = array(__('Monday','wp-seopress-pro'), __('Tuesday','wp-seopress-pro'), __('Wednesday','wp-seopress-pro'), __('Thursday','wp-seopress-pro'), __('Friday','wp-seopress-pro'), __('Saturday','wp-seopress-pro'), __('Sunday','wp-seopress-pro') );

	                    $hours = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');

	                    $mins = array('00', '15', '30', '45');

	                    echo '<ul class="wrap-opening-hours">';

	                    foreach ($days as $key => $day) {

	                        $check_day = isset($options[$key]['open']);
	                        
	                        $check_day_am = isset($options[$key]['am']['open']);

	                        $check_day_pm = isset($options[$key]['pm']['open']);

	                        $selected_start_hours = isset($options[$key]['am']['start']['hours']) ? $options[$key]['am']['start']['hours'] : NULL;

	                        $selected_start_mins = isset($options[$key]['am']['start']['mins']) ? $options[$key]['am']['start']['mins'] : NULL;
	                        
	                        echo '<li>';

	                            echo '<span class="day"><strong>'.$day.'</strong></span>';

	                            echo '<ul>';
	                                 //Closed?
	                                echo '<li>';

	                                    echo '<input id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][open]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][open]" type="checkbox"';
	                                        if ('1' == $check_day) echo 'checked="yes"'; 
	                                        echo ' value="1"/>';
	                                    
	                                    echo '<label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][open]">'. __( 'Closed all the day?', 'wp-seopress-pro' ) .'</label> ';
	                                    
	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['open'])) {
	                                        esc_attr($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['open']);
	                                    }
	                                echo '</li>';

	                                //AM
	                                echo '<li>';
	                                    echo '<input id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][open]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][open]" type="checkbox"';
	                                        if ('1' == $check_day_am) echo 'checked="yes"'; 
	                                        echo ' value="1"/>';                            
	                                    
	                                    echo '<label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][open]">'. __( 'Open in the morning?', 'wp-seopress-pro' ) .'</label> ';

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['open'])) {
	                                        esc_attr($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['open']);
	                                    }

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][start][hours]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][start][hours]">';

	                                        foreach ($hours as $hour) {
	                                            echo '<option '; 
	                                            if ($hour == $selected_start_hours) echo 'selected="selected"'; 
	                                            echo ' value="'.$hour.'">'. $hour .'</option>';
	                                        }

	                                    echo '</select>';

	                                    echo ' : ';

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][start][mins]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][start][mins]">';

	                                        foreach ($mins as $min) {
	                                            echo '<option '; 
	                                            if ($min == $selected_start_mins) echo 'selected="selected"'; 
	                                            echo ' value="'.$min.'">'. $min .'</option>';
	                                        }

	                                    echo '</select>';

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['start']['hours'])) {
	                                        esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['start']['hours']);
	                                    }

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['start']['mins'])) {
	                                        esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['am']['start']['mins']);
	                                    }

	                                    echo ' - ';

	                                    $selected_end_hours = isset($options[$key]['am']['end']['hours']) ? $options[$key]['am']['end']['hours'] : NULL;

	                                    $selected_end_mins = isset($options[$key]['am']['end']['mins']) ? $options[$key]['am']['end']['mins'] : NULL;

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][end][hours]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][end][hours]">';

	                                        foreach ($hours as $hour) {
	                                            echo '<option '; 
	                                            if ($hour == $selected_end_hours) echo 'selected="selected"'; 
	                                            echo ' value="'.$hour.'">'. $hour .'</option>';
	                                        }

	                                    echo '</select>';

	                                    echo ' : ';

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][end][mins]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][am][end][mins]">';

	                                        foreach ($mins as $min) {
	                                            echo '<option '; 
	                                            if ($min == $selected_end_mins) echo 'selected="selected"'; 
	                                            echo ' value="'.$min.'">'. $min .'</option>';
	                                        }

	                                    echo '</select>';
	                                echo '</li>';
	                                
	                                //PM
	                                echo '<li>';
	                                    $selected_start_hours2 = isset($options[$key]['pm']['start']['hours']) ? $options[$key]['pm']['start']['hours'] : NULL;

	                                    $selected_start_mins2 = isset($options[$key]['pm']['start']['mins']) ? $options[$key]['pm']['start']['mins'] : NULL;

	                                    echo '<input id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][open]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][open]" type="checkbox"';
	                                        if ('1' == $check_day_pm) echo 'checked="yes"'; 
	                                        echo ' value="1"/>';

	                                    echo '<label for="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][open]">'. __( 'Open in the afternoon?', 'wp-seopress-pro' ) .'</label> ';

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['open'])) {
	                                        esc_attr($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['open']);
	                                    }

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][start][hours]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][start][hours]">';

	                                        foreach ($hours as $hour) {
	                                            echo '<option '; 
	                                            if ($hour == $selected_start_hours2) echo 'selected="selected"'; 
	                                            echo ' value="'.$hour.'">'. $hour .'</option>';
	                                        }

	                                    echo '</select>';

	                                    echo ' : ';

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][start][mins]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][start][mins]">';

	                                        foreach ($mins as $min) {
	                                            echo '<option '; 
	                                            if ($min == $selected_start_mins2) echo 'selected="selected"'; 
	                                            echo ' value="'.$min.'">'. $min .'</option>';
	                                        }

	                                    echo '</select>';

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['start']['hours'])) {
	                                        esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['start']['hours']);
	                                    }

	                                    if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['start']['mins'])) {
	                                        esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['start']['mins']);
	                                    }

	                                    echo ' - ';

	                                    $selected_end_hours2 = isset($options[$key]['pm']['end']['hours']) ? $options[$key]['pm']['end']['hours'] : NULL;

	                                    $selected_end_mins2 = isset($options[$key]['pm']['end']['mins']) ? $options[$key]['pm']['end']['mins'] : NULL;

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][end][hours]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][end][hours]">';

	                                        foreach ($hours as $hour) {
	                                            echo '<option '; 
	                                            if ($hour == $selected_end_hours2) echo 'selected="selected"'; 
	                                            echo ' value="'.$hour.'">'. $hour .'</option>';
	                                        }

	                                    echo '</select>';

	                                    echo ' : ';

	                                    echo '<select id="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][end][mins]" name="seopress_pro_schemas['.$id.'][rich_snippets_lb][opening_hours]['.$key.'][pm][end][mins]">';

	                                        foreach ($mins as $min) {
	                                            echo '<option '; 
	                                            if ($min == $selected_end_mins2) echo 'selected="selected"'; 
	                                            echo ' value="'.$min.'">'. $min .'</option>';
	                                        }

	                                    echo '</select>';

	                                echo '</li>';
	                            echo '</ul>';

	                        if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['end']['hours'])) {
	                            esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['end']['hours']);
	                        }

	                        if (isset($options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['end']['mins'])) {
	                            esc_attr( $options['seopress_pro_schemas'][$id]['rich_snippets_lb']['opening_hours'][$key]['pm']['end']['mins']);
	                        }

	                        $check_lb_opening_hours = $options;
	                        echo '</li>';
	                    }
	                    echo '</ul>';
	            echo '</li>';
	        }

            //Courses
            if ($seopress_pro_rich_snippets_type == 'courses') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_courses_title == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_courses][title]_meta">
		                            '. __( 'Title', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_courses][title]" name="seopress_pro_schemas['.$id.'][rich_snippets_courses][title]" placeholder="'.esc_html__('The title of your lesson, course...','wp-seopress-pro').'" aria-label="'.__('Title','wp-seopress-pro').'" value="'.$check_courses_title.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_courses_desc == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_courses][desc]_meta">
		                            '. __( 'Course description', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_courses][desc]" name="seopress_pro_schemas['.$id.'][rich_snippets_courses][desc]" placeholder="'.esc_html__('Enter your course/lesson description','wp-seopress-pro').'" aria-label="'.__('Course description','wp-seopress-pro').'" value="'.$check_courses_desc.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_courses_school == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_courses][school]_meta">
		                            '. __( 'School/Organization', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_courses][school]" name="seopress_pro_schemas['.$id.'][rich_snippets_courses][school]" placeholder="'.esc_html__('Name of university, organization...','wp-seopress-pro').'" aria-label="'.__('School/Organization','wp-seopress-pro').'" value="'.$check_courses_school.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_courses_website == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_courses][website]_meta">
		                            '. __( 'School/Organization Website', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_courses][website]" name="seopress_pro_schemas['.$id.'][rich_snippets_courses][website]" placeholder="'.esc_html__('Enter the URL like https://example.com/','wp-seopress-pro').'" aria-label="'.__('School/Organization Website','wp-seopress-pro').'" value="'.$check_courses_website.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }

            //Recipes
            if ($seopress_pro_rich_snippets_type == 'recipes') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][name]_meta">
		                            '. __( 'Recipe name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][name]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][name]" placeholder="'.esc_html__('The name of your dish','wp-seopress-pro').'" aria-label="'.__('Recipe name','wp-seopress-pro').'" value="'.$check_recipes_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_desc == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][desc]_meta">
		                            '. __( 'Short recipe description', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][desc]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][desc]" placeholder="'.esc_html__('A short summary describing the dish.','wp-seopress-pro').'" aria-label="'.__('Short recipe description','wp-seopress-pro').'" value="'.$check_recipes_desc.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_cat == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cat]_meta">
		                            '. __( 'Recipe category', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cat]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cat]" placeholder="'.esc_html__('Eg: appetizer, entree, or dessert','wp-seopress-pro').'" aria-label="'.__('Recipe category','wp-seopress-pro').'" value="'.$check_recipes_cat.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][img]_meta">
		                            '. __( 'Image', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image','wp-seopress-pro').'" value="'.$check_recipes_img.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_prep_time == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][prep_time]_meta">
		                            '. __( 'Preparation time (in minutes)', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][prep_time]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][prep_time]" placeholder="'.esc_html__('Eg: 30','wp-seopress-pro').'" aria-label="'.__('Preparation time (in minutes)','wp-seopress-pro').'" value="'.$check_recipes_prep_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_cook_time == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cook_time]_meta">
		                            '. __( 'Cooking time (in minutes)', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cook_time]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][cook_time]" placeholder="'.esc_html__('Eg: 45','wp-seopress-pro').'" aria-label="'.__('Cooking time (in minutes)','wp-seopress-pro').'" value="'.$check_recipes_cook_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_calories == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][calories]_meta">
		                            '. __( 'Calories', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][calories]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][calories]" placeholder="'.esc_html__('Number of calories','wp-seopress-pro').'" aria-label="'.__('Calories','wp-seopress-pro').'" value="'.$check_recipes_cook_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_recipes_yield == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_recipes][yield]_meta">
		                            '. __( 'Recipe yield', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_recipes][yield]" name="seopress_pro_schemas['.$id.'][rich_snippets_recipes][yield]" placeholder="'.esc_html__('Eg: number of people served, or number of servings','wp-seopress-pro').'" aria-label="'.__('Recipe yield','wp-seopress-pro').'" value="'.$check_recipes_yield.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }

            //Videos
            if ($seopress_pro_rich_snippets_type == 'videos') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_videos_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_videos][name]_meta">
		                            '. __( 'Video name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_videos][name]" name="seopress_pro_schemas['.$id.'][rich_snippets_videos][name]" placeholder="'.esc_html__('The title of your video','wp-seopress-pro').'" aria-label="'.__('Video name','wp-seopress-pro').'" value="'.$check_videos_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_videos_description == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_videos][description]_meta">
		                            '. __( 'Video description', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_videos][description]" name="seopress_pro_schemas['.$id.'][rich_snippets_videos][description]" placeholder="'.esc_html__('The description of the video','wp-seopress-pro').'" aria-label="'.__('Video description','wp-seopress-pro').'" value="'.$check_videos_description.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_videos_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_videos][img]_meta">
		                            '. __( 'Video thumbnail', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_videos][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_videos][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Video thumbnail','wp-seopress-pro').'" value="'.$check_videos_img.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_videos_duration == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_videos][duration]_meta">
		                            '. __( 'Duration of your video (in minutes)', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_videos][duration]" name="seopress_pro_schemas['.$id.'][rich_snippets_videos][duration]" placeholder="'.esc_html__('eg: 120 min','wp-seopress-pro').'" aria-label="'.__('Duration of your video (in minutes)','wp-seopress-pro').'" value="'.$check_videos_duration.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_videos_url == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_videos][url]_meta">
		                            '. __( 'Video URL', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_videos][url]" name="seopress_pro_schemas['.$id.'][rich_snippets_videos][url]" placeholder="'.esc_html__('Eg: https://example.com/video.mp4','wp-seopress-pro').'" aria-label="'.__('Video URL','wp-seopress-pro').'" value="'.$check_videos_url.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }

            //Events
            if ($seopress_pro_rich_snippets_type == 'events') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_type == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][type]_meta">
		                            '. __( 'Event type', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][type]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][type]" placeholder="'.esc_html__('Select your event type','wp-seopress-pro').'" aria-label="'.__('Event type','wp-seopress-pro').'" value="'.$check_events_type.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][name]_meta">
		                            '. __( 'Event name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][name]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][name]" placeholder="'.esc_html__('The name of your event','wp-seopress-pro').'" aria-label="'.__('Event name','wp-seopress-pro').'" value="'.$check_events_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_desc == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][desc]_meta">
		                            '. __( 'Event description', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][desc]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][desc]" placeholder="'.esc_html__('Enter your event description','wp-seopress-pro').'" aria-label="'.__('Event description','wp-seopress-pro').'" value="'.$check_events_desc.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][img]_meta">
		                            '. __( 'Image thumbnail', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Image thumbnail','wp-seopress-pro').'" value="'.$check_events_img.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_start_date == 'manual_date_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][start_date]_meta">
		                            '. __( 'Start date', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" class="seopress-date-picker" id="seopress_pro_schemas['.$id.'][rich_snippets_events][start_date]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][start_date]" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('Start date','wp-seopress-pro').'" value="'.$check_events_start_date.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_start_time == 'manual_time_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][start_time]_meta">
		                            '. __( 'Start time', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][start_time]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][start_time]" placeholder="'.esc_html__('Eg: HH:MM','wp-seopress-pro').'" aria-label="'.__('Start time','wp-seopress-pro').'" value="'.$check_events_start_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_end_date == 'manual_date_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][end_date]_meta">
		                            '. __( 'End date', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" class="seopress-date-picker" id="seopress_pro_schemas['.$id.'][rich_snippets_events][end_date]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][end_date]" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('End date','wp-seopress-pro').'" value="'.$check_events_end_date.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_end_time == 'manual_time_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][end_time]_meta">
		                            '. __( 'End time', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][end_time]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][end_time]" placeholder="'.esc_html__('Eg: HH:MM','wp-seopress-pro').'" aria-label="'.__('End time','wp-seopress-pro').'" value="'.$check_events_end_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_location_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][location_name]_meta">
		                            '. __( 'Location name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][location_name]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][location_name]" placeholder="'.esc_html__('Eg: Hotel du Palais','wp-seopress-pro').'" aria-label="'.__('Location name','wp-seopress-pro').'" value="'.$check_events_location_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_location_url == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][location_url]_meta">
		                            '. __( 'Location Website', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][location_url]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][location_url]" placeholder="'.esc_html__('Eg: http://www.hotel-du-palais.com/','wp-seopress-pro').'" aria-label="'.__('Location Website','wp-seopress-pro').'" value="'.$check_events_location_url.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_location_address == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][location_address]_meta">
		                            '. __( 'Location Address', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][location_address]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][location_address]" placeholder="'.esc_html__('Eg: 1 Avenue de l\'Imperatrice, 64200 Biarritz','wp-seopress-pro').'" aria-label="'.__('Location Address','wp-seopress-pro').'" value="'.$check_events_location_address.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_name]_meta">
		                            '. __( 'Offer name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_name]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_name]" placeholder="'.esc_html__('Eg: General admission','wp-seopress-pro').'" aria-label="'.__('Offer name','wp-seopress-pro').'" value="'.$check_events_offers_name.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_cat == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_cat]_meta">
		                            '. __( 'Offer category', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_cat]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_cat]" placeholder="'.esc_html__('Select your offer category','wp-seopress-pro').'" aria-label="'.__('Offer category','wp-seopress-pro').'" value="'.$check_events_offers_cat.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_price == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price]_meta">
		                            '. __( 'Offer price', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price]" placeholder="'.esc_html__('Eg: 10','wp-seopress-pro').'" aria-label="'.__('Offer price','wp-seopress-pro').'" value="'.$check_events_offers_price.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_price_currency == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price_currency]_meta">
		                            '. __( 'Offer price currency', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price_currency]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_price_currency]" placeholder="'.esc_html__('Eg: USD, EUR...','wp-seopress-pro').'" aria-label="'.__('Offer price currency','wp-seopress-pro').'" value="'.$check_events_offers_price_currency.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_availability == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_availability]_meta">
		                            '. __( 'Availability', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_availability]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_availability]" placeholder="'.esc_html__('Eg: InStock, SoldOut, PreOrder','wp-seopress-pro').'" aria-label="'.__('Availability','wp-seopress-pro').'" value="'.$check_events_offers_availability.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_valid_from_date == 'manual_date_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_date]_meta">
		                            '. __( 'Valid From', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_date]" class="seopress-date-picker" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_date]" placeholder="'.esc_html__('The date when tickets go on sale','wp-seopress-pro').'" aria-label="'.__('Valid From','wp-seopress-pro').'" value="'.$check_events_offers_valid_from_date.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_valid_from_time == 'manual_time_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_time]_meta">
		                            '. __( 'Time', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_time]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_valid_from_time]" placeholder="'.esc_html__('The time when tickets go on sale','wp-seopress-pro').'" aria-label="'.__('Time','wp-seopress-pro').'" value="'.$check_events_offers_valid_from_time.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_offers_url == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_url]_meta">
		                            '. __( 'Website to buy tickets', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_url]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][offers_url]" placeholder="'.esc_html__('Eg: https://fnac.com/','wp-seopress-pro').'" aria-label="'.__('Website to buy tickets','wp-seopress-pro').'" value="'.$check_events_offers_url.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_events_performer == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_events][performer]_meta">
		                            '. __( 'Performer name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_events][performer]" name="seopress_pro_schemas['.$id.'][rich_snippets_events][performer]" placeholder="'.esc_html__('Eg: Lana Del Rey','wp-seopress-pro').'" aria-label="'.__('Performer name','wp-seopress-pro').'" value="'.$check_events_performer.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }

            //Products
            if ($seopress_pro_rich_snippets_type == 'products') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_name == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][name]_meta">
		                            '. __( 'Product name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][name]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][name]" placeholder="'.esc_html__('The name of your product','wp-seopress-pro').'" aria-label="'.__('Product name','wp-seopress-pro').'" value="'.$check_product_name.'" />
								<span class="description">'.__('Default: product title','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_description == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][description]_meta">
		                            '. __( 'Product description', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][description]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][description]" placeholder="'.esc_html__('The description of the product','wp-seopress-pro').'" aria-label="'.__('Product description','wp-seopress-pro').'" value="'.$check_product_description.'" />
								<span class="description">'.__('Default: product excerpt','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][img]_meta">
		                            '. __( 'Thumbnail', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Thumbnail','wp-seopress-pro').'" value="'.$check_product_img.'" />
                        		<span class="description">'.__('Default: product image','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_price == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][price]_meta">
		                            '. __( 'Product price', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][price]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][price]" placeholder="'.esc_html__('Eg: 30','wp-seopress-pro').'" aria-label="'.__('Product price','wp-seopress-pro').'" value="'.$check_product_price.'" />
		                        <span class="description">'.__('Default: active product price','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_price_valid_date == 'manual_date_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][price_valid_date]_meta">
		                            '. __( 'Product price valid until', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" class="seopress-date-picker" id="seopress_pro_schemas['.$id.'][rich_snippets_product][price_valid_date]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][price_valid_date]" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('Product price valid until','wp-seopress-pro').'" value="'.$check_product_price_valid_date.'" />
								<span class="description">'.__('Default: sale price dates To field','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_sku == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][sku]_meta">
		                            '. __( 'Product SKU', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][sku]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][sku]" placeholder="'.esc_html__('Eg: 0446310786','wp-seopress-pro').'" aria-label="'.__('Product SKU','wp-seopress-pro').'" value="'.$check_product_sku.'" />
		                        <span class="description">'.__('Default: product SKU','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_global_ids == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids]_meta">
		                            '. __( 'Product Global Identifiers type', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids]" placeholder="'.esc_html__('Eg: gtin8','wp-seopress-pro').'" aria-label="'.__('Product Global Identifiers type','wp-seopress-pro').'" value="'.$check_product_global_ids.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_global_ids_value == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids_value]_meta">
		                            '. __( 'Product Global Identifiers', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids_value]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][global_ids_value]" placeholder="'.esc_html__('Eg: 925872','wp-seopress-pro').'" aria-label="'.__('Product Global Identifiers','wp-seopress-pro').'" value="'.$check_product_global_ids_value.'" />
		                    </p>';
		            }
	            echo '</li>';

	           	echo '<li>';
		            if ($seopress_pro_rich_snippets_product_brand == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][brand]_meta">
		                            '. __( 'Select a brand', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][brand]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][brand]" placeholder="'.esc_html__('eg: category','wp-seopress-pro').'" aria-label="'.__('Select a brand','wp-seopress-pro').'" value="'.$check_product_brand.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_price_currency == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][currency]_meta">
		                            '. __( 'Product currency', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][currency]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][currency]" placeholder="'.esc_html__('Eg: USD, EUR','wp-seopress-pro').'" aria-label="'.__('Product currency','wp-seopress-pro').'" value="'.$check_product_currency.'" />
								<span class="description">'.__('Default: USD','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_condition == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][condition]_meta">
		                            '. __( 'Product Condition', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][condition]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][condition]" placeholder="'.esc_html__('Eg: NewCondition, UsedCondition...','wp-seopress-pro').'" aria-label="'.__('Product Condition','wp-seopress-pro').'" value="'.$check_product_condition.'" />
		                        <span class="description">'.__('Default: new','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_product_availability == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_product][availability]_meta">
		                            '. __( 'Product Availability', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_product][availability]" name="seopress_pro_schemas['.$id.'][rich_snippets_product][availability]" placeholder="'.esc_html__('Eg: InStock, InStoreOnly...','wp-seopress-pro').'" aria-label="'.__('Product Availability','wp-seopress-pro').'" value="'.$check_product_availability.'" />
		                        <span class="description">'.__('Default: In Stock','wp-seopress-pro').'</span>
		                    </p>';
		            }
	            echo '</li>';
	        }


            //Review
            if ($seopress_pro_rich_snippets_type == 'review') {
	            echo '<li>';
		            if ($seopress_pro_rich_snippets_review_item == 'manual_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_review][item]_meta">
		                            '. __( 'Review item name', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_review][item]" name="seopress_pro_schemas['.$id.'][rich_snippets_review][item]" placeholder="'.esc_html__('The item name reviewed','wp-seopress-pro').'" aria-label="'.__('Review item name','wp-seopress-pro').'" value="'.$check_review_item.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_review_img == 'manual_img_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_review][img]_meta">
		                            '. __( 'Review item image', 'wp-seopress-pro' ) .'</label>
		                        <input type="text" id="seopress_pro_schemas['.$id.'][rich_snippets_review][img]" name="seopress_pro_schemas['.$id.'][rich_snippets_review][img]" placeholder="'.esc_html__('Select your image','wp-seopress-pro').'" aria-label="'.__('Review item image','wp-seopress-pro').'" value="'.$check_review_img.'" />
		                    </p>';
		            }
	            echo '</li>';

	            echo '<li>';
		            if ($seopress_pro_rich_snippets_review_rating == 'manual_rating_single') {
		                echo '<p>
		                        <label for="seopress_pro_schemas['.$id.'][rich_snippets_review][rating]_meta">
		                            '. __( 'Your rating', 'wp-seopress-pro' ) .'</label>
		                        <input type="number" step="0.1" min="0" max="5" id="seopress_pro_schemas['.$id.'][rich_snippets_review][rating]" name="seopress_pro_schemas['.$id.'][rich_snippets_review][rating]" placeholder="'.esc_html__('The item rating','wp-seopress-pro').'" aria-label="'.__('Your rating','wp-seopress-pro').'" value="'.$check_review_rating.'" />
		                    </p>';
		            }
	            echo '</li>';
	        }
            
        }
    echo '</ul>';
}