<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Register SEOPress Schemas Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////
function seopress_schemas_fn() {

    $labels = array(
        'name'                  => _x( 'Schemas', 'Post Type General Name', 'wp-seopress-pro' ),
        'singular_name'         => _x( 'Schema', 'Post Type Singular Name', 'wp-seopress-pro' ),
        'menu_name'             => __( 'Schemas', 'wp-seopress-pro' ),
        'name_admin_bar'        => __( 'Schemas', 'wp-seopress-pro' ),
        'archives'              => __( 'Item Archives', 'wp-seopress-pro' ),
        'parent_item_colon'     => __( 'Parent Item:', 'wp-seopress-pro' ),
        'all_items'             => __( 'All schemas', 'wp-seopress-pro' ),
        'add_new_item'          => __( 'Add New schema', 'wp-seopress-pro' ),
        'add_new'               => __( 'Add schema', 'wp-seopress-pro' ),
        'new_item'              => __( 'New schema', 'wp-seopress-pro' ),
        'edit_item'             => __( 'Edit schema', 'wp-seopress-pro' ),
        'update_item'           => __( 'Update schema', 'wp-seopress-pro' ),
        'view_item'             => __( 'View schema', 'wp-seopress-pro' ),
        'search_items'          => __( 'Search schema', 'wp-seopress-pro' ),
        'not_found'             => __( 'Not found', 'wp-seopress-pro' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'wp-seopress-pro' ),
        'featured_image'        => __( 'Featured Image', 'wp-seopress-pro' ),
        'set_featured_image'    => __( 'Set featured image', 'wp-seopress-pro' ),
        'remove_featured_image' => __( 'Remove featured image', 'wp-seopress-pro' ),
        'use_featured_image'    => __( 'Use as featured image', 'wp-seopress-pro' ),
        'insert_into_item'      => __( 'Insert into item', 'wp-seopress-pro' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-seopress-pro' ),
        'items_list'            => __( 'Schemas list', 'wp-seopress-pro' ),
        'items_list_navigation' => __( 'Schemas list navigation', 'wp-seopress-pro' ),
        'filter_items_list'     => __( 'Filter schema list', 'wp-seopress-pro' ),
    );
    $args = array(
        'label'                 => __( 'Schemas', 'wp-seopress-pro' ),
        'description'           => __( 'List of Schemas', 'wp-seopress-pro' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_icon'             => 'dashicons-excerpt-view',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,       
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'seopress_schemas', $args );
}
add_action( 'init', 'seopress_schemas_fn', 10 );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Set title placeholder for Schemas Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////
function seopress_schemas_cpt_title( $title ){
     $screen = get_current_screen();
     if  ( 'seopress_schemas' == $screen->post_type ) {
          $title = __('Enter the name of your schema', 'wp-seopress-pro');
     }
     return $title;
}
 
add_filter( 'enter_title_here', 'seopress_schemas_cpt_title' );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Set messages for Schemas Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////

function seopress_schemas_set_messages($messages) {
    global $post, $post_ID, $typenow;
    $post_type = 'seopress_schemas';
    
    if( $typenow === 'seopress_schemas' ) {
        $obj = get_post_type_object($post_type);
        $singular = $obj->labels->singular_name;

        $messages[$post_type] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => __($singular.' updated.'),
            2 => __('Custom field updated.'),
            3 => __('Custom field deleted.'),
            4 => __($singular.' updated.'),
            5 => isset($_GET['revision']) ? sprintf( __($singular.' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => __($singular.' published.'),
            7 => __('Schema saved.'),
            8 => sprintf( __($singular.' submitted.'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
            9 => sprintf( __($singular.' scheduled for: <strong>%1$s</strong>. '), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
            10 => sprintf( __($singular.' draft updated.'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
    } else {
        return $messages;
    }
}

add_filter('post_updated_messages', 'seopress_schemas_set_messages' );

function seopress_schemas_set_messages_list( $bulk_messages, $bulk_counts ) {

    $bulk_messages['seopress_schemas'] = array(
        'updated'   => _n( '%s schema updated.', '%s schemas updated.', $bulk_counts['updated'] ),
        'locked'    => _n( '%s schema not updated, somebody is editing it.', '%s schemas not updated, somebody is editing them.', $bulk_counts['locked'] ),
        'deleted'   => _n( '%s schema permanently deleted.', '%s schemas permanently deleted.', $bulk_counts['deleted'] ),
        'trashed'   => _n( '%s schema moved to the Trash.', '%s schemas moved to the Trash.', $bulk_counts['trashed'] ),
        'untrashed' => _n( '%s schema restored from the Trash.', '%s schemas restored from the Trash.', $bulk_counts['untrashed'] ),
    );

    return $bulk_messages;

}
add_filter( 'bulk_post_updated_messages', 'seopress_schemas_set_messages_list', 10, 2 );

///////////////////////////////////////////////////////////////////////////////////////////////////
//Columns for Schemas Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////

add_filter('manage_edit-seopress_schemas_columns', 'seopress_schemas_columns');
add_action('manage_seopress_schemas_posts_custom_column', 'seopress_schemas_display_column', 10, 2);

function seopress_schemas_columns($columns) {
    $columns['seopress_schemas_type'] = __('Data type', 'wp-seopress-pro');
    $columns['seopress_schemas_cpt'] = __('Post type', 'wp-seopress-pro');
    unset($columns['date']);
    return $columns;
}

function seopress_schemas_display_column($column, $post_id) {
    if ($column == 'seopress_schemas_type') {
        if (get_post_meta($post_id, "_seopress_pro_rich_snippets_type", true)) {
            echo get_post_meta($post_id, "_seopress_pro_rich_snippets_type", true);
        }
    }
    if ($column == 'seopress_schemas_cpt') {
        if (get_post_meta($post_id, "_seopress_pro_rich_snippets_rules", true)) {
            echo get_post_meta($post_id, "_seopress_pro_rich_snippets_rules", true);
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////
//Display metabox for Schemas Custom Post Type
///////////////////////////////////////////////////////////////////////////////////////////////////
add_action('add_meta_boxes','seopress_schemas_init_metabox');
function seopress_schemas_init_metabox(){
    add_meta_box('seopress_schemas', __('Your schema','wp-seopress'), 'seopress_schemas_cpt', 'seopress_schemas', 'normal', 'default');
}

function seopress_schemas_cpt($post){
        global $typenow;

        //Enqueue scripts
        wp_enqueue_script( 'jquery-ui-accordion' );

        wp_enqueue_script( 'seopress-pro-schemas-js', plugins_url('assets/js/seopress-pro-schemas.js', dirname(dirname( __FILE__ ))), array('jquery'), SEOPRESS_PRO_VERSION, false );

        wp_enqueue_script( 'seopress-pro-media-uploader-js', plugins_url('assets/js/seopress-pro-media-uploader.js', dirname(dirname( __FILE__ ))), array('jquery'), SEOPRESS_PRO_VERSION, false );
        
        wp_enqueue_script( 'seopress-pro-rich-snippets-js', plugins_url('assets/js/seopress-pro-rich-snippets.js', dirname(dirname( __FILE__ ))), array('jquery'), SEOPRESS_PRO_VERSION, false );
        
        wp_enqueue_media();

        wp_enqueue_script('jquery-ui-datepicker');
        
        //Post types
        if (function_exists('seopress_get_post_types')) {
            $seopress_get_post_types = seopress_get_post_types();
        }

        //Mapping fields
        function seopress_schemas_mapping_array($post_meta_name, $case) {
            global $post;

            //Custom fields
            if (function_exists('seopress_get_custom_fields')) {
                $seopress_get_custom_fields = seopress_get_custom_fields();
            }

            //init default case array
            $seopress_schemas_mapping_case = array(
                'Select an option' => array('none' => __('None','wp-seopress-pro')),
                'Site Meta' => array(
                    'site_title' => __('Site Title','wp-seopress-pro'),
                    'tagline' => __('Tagline','wp-seopress-pro'),
                    'site_url' => __('Site URL','wp-seopress-pro'),
                ),
                'Post Meta' => array(
                    'post_title' => __('Post Title','wp-seopress-pro'),
                    'post_excerpt' => __('Excerpt','wp-seopress-pro'),
                    'post_content' => __('Content','wp-seopress-pro'),
                    'post_permalink' => __('Permalink','wp-seopress-pro'),
                    'post_author_name' => __('Author','wp-seopress-pro'),
                    'post_date' => __('Publish date','wp-seopress-pro'),
                    'post_updated' => __('Last update','wp-seopress-pro'),
                ),
                'Product meta (WooCommerce)' => array(
                    'product_regular_price' => __('Regular Price','wp-seopress-pro'),
                    'product_sale_price' => __('Sale Price','wp-seopress-pro'),
                    'product_date_from' => __('Sale price dates "From"','wp-seopress-pro'),
                    'product_date_to' => __('Sale price dates "To"','wp-seopress-pro'),
                    'product_sku' => __('SKU','wp-seopress-pro'),
                    'product_category' => __('Product category','wp-seopress-pro'),
                ),
                'Custom fields' => array(
                    'custom_fields' => __('Select your custom field','wp-seopress-pro'),
                ),
            );

            $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_cf',true);

            $seopress_schemas_cf = '<select name="'.$post_meta_name.'_cf" class="cf">';
            
            foreach ($seopress_get_custom_fields as $value) {
                $seopress_schemas_cf .= '<option ' . selected( $value, $post_meta_value, false ) . ' value="'.$value.'">'.$value.'</option>';
            }

            $seopress_schemas_cf .= '</select>';

            switch ($case) {
                case 'default':
                    $seopress_schemas_mapping_case['Manual'] = array(
                        'manual_global' => __('Manual text','wp-seopress-pro'),
                        'manual_single' => __('Manual text on each post','wp-seopress-pro')
                    );

                    $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_global',true);

                    $seopress_schemas_manual_global = '<input type="text" id="'.$post_meta_name.'_manual_global" name="'.$post_meta_name.'_manual_global" class="manual_global" placeholder="'.esc_html__('Enter a global value here','wp-seopress-pro').'" aria-label="'.__('Manual value','wp-seopress-pro').'" value="'.$post_meta_value.'" />';

                    break;
                case 'image':
                        $seopress_schemas_mapping_case = array(
                            'Select an option' => array('none' => __('None','wp-seopress-pro')),
                            'Site Meta' => array(
                                'knowledge_graph_logo' => __('Knowledge Graph logo (SEO > Social)','wp-seopress-pro'),
                            ),
                            'Post Meta' => array(
                                'post_thumbnail' => __('Featured image','wp-seopress-pro'),
                                'post_author_picture' => __('Post author picture','wp-seopress-pro'),
                            ),
                            'Custom fields' => array(
                                'custom_fields' => __('Select your custom field','wp-seopress-pro'),
                            ),
                            'Manual' => array(
                                'manual_img_global' => __('Manual Image URL','wp-seopress-pro'),
                                'manual_img_library_global' => __('Manual Image from Library','wp-seopress-pro'),
                                'manual_img_single' => __('Manual text on each post','wp-seopress-pro'),
                            )
                        );

                        $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_img_global',true);

                        $seopress_schemas_manual_img_global = '<input type="text" id="'.$post_meta_name.'_manual_img_global" name="'.$post_meta_name.'_manual_img_global" class="manual_img_global" placeholder="'.esc_html__('Enter a global value here','wp-seopress-pro').'" aria-label="'.__('Manual Image URL','wp-seopress-pro').'" value="'.$post_meta_value.'" />';

                        $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_img_library_global',true);
                        $post_meta_value2 = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_img_library_global_width',true);
                        $post_meta_value3 = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_img_library_global_height',true);

                        $seopress_schemas_manual_img_library_global = '<input type="text" id="'.$post_meta_name.'_manual_img_library_global" name="'.$post_meta_name.'_manual_img_library_global" class="manual_img_library_global" placeholder="'.esc_html__('Select your global image from the media library','wp-seopress-pro').'" aria-label="'.__('Manual Image URL','wp-seopress-pro').'" value="'.$post_meta_value.'" />

                        <input id="'.$post_meta_name.'_manual_img_library_global_width" type="hidden" name="'.$post_meta_name.'_manual_img_library_global_width" class="manual_img_library_global_width" value="'.$post_meta_value2.'" />
                        
                        <input id="'.$post_meta_name.'_manual_img_library_global_height" type="hidden" name="'.$post_meta_name.'_manual_img_library_global_height" class="manual_img_library_global_height" value="'.$post_meta_value3.'" />
                        
                        <input id="'.$post_meta_name.'_manual_img_library_global_btn" class="button manual_img_library_global" type="button" value="'.__('Upload an Image','wp-seopress-pro').'" />';

                    break;
                case 'date':
                        //date case
                        $seopress_schemas_mapping_case['Manual'] = array(
                            'manual_date_global' => __('Manual date','wp-seopress-pro'),
                            'manual_date_single' => __('Manual date on each post','wp-seopress-pro')
                        );

                        $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_date_global',true);

                        $seopress_schemas_manual_date_global = '<input type="text" class="seopress-date-picker manual_date_global" autocomplete="false" name="'.$post_meta_name.'_manual_date_global" class="manual_global" placeholder="'.esc_html__('Eg: YYYY-MM-DD','wp-seopress-pro').'" aria-label="'.__('Global date','wp-seopress-pro').'" value="'.$post_meta_value.'" />';
                    break;
                case 'time':
                        //time case
                        $seopress_schemas_mapping_case['Manual'] = array(
                            'manual_time_global' => __('Manual time','wp-seopress-pro'),
                            'manual_time_single' => __('Manual time on each post','wp-seopress-pro')
                        );

                        $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_time_global',true);

                        $seopress_schemas_manual_time_global = '<input type="time" placeholder="'.__('HH:MM','wp-seopress-pro').'" id="'.$post_meta_name.'_manual_time_global" name="'.$post_meta_name.'_manual_time_global" class="manual_time_global" aria-label="'.__('Time','wp-seopress-pro').'" value="'.$post_meta_value.'" />';
                    break;
                case 'rating':
                        //rating case
                        $seopress_schemas_mapping_case['Manual'] = array(
                            'manual_rating_global' => __('Manual rating','wp-seopress-pro'),
                            'manual_rating_single' => __('Manual rating on each post','wp-seopress-pro')
                        );

                        $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name.'_manual_rating_global',true);

                        $seopress_schemas_manual_rating_global = '<input type="number" id="'.$post_meta_name.'_manual_rating_global" name="'.$post_meta_name.'_manual_rating_global" min="0" max="5" step="0.1" class="manual_rating_global" aria-label="'.__('Rating','wp-seopress-pro').'" value="'.$post_meta_value.'" />';
                    break;
            }

            $post_meta_value = get_post_meta($post->ID,'_'.$post_meta_name,true);

            $html = '<select name="'.$post_meta_name.'" class="dyn">';
            foreach ($seopress_schemas_mapping_case as $key => $value) {
                $html .= '<optgroup label="'.$key.'">';
                    foreach ($value as $_key => $_value) {
                        $html .= '<option ' . selected( $_key, $post_meta_value, false ) . ' value="'.$_key.'">'. __( $_value, 'wp-seopress-pro' ) .'</option>';
                    }
                $html .= '</optgroup>';
            }
            $html .= '</select>';

            if (isset($seopress_schemas_manual_global)) {
                $html .= $seopress_schemas_manual_global;
            }
            if (isset($seopress_schemas_manual_img_global)) {
                $html .= $seopress_schemas_manual_img_global;
            }
            if (isset($seopress_schemas_manual_img_library_global)) {
                $html .= $seopress_schemas_manual_img_library_global;
            }
            if (isset($seopress_schemas_manual_date_global)) {
                $html .= $seopress_schemas_manual_date_global;
            }
            if (isset($seopress_schemas_manual_time_global)) {
                $html .= $seopress_schemas_manual_time_global;
            }
            if (isset($seopress_schemas_manual_rating_global)) {
                $html .= $seopress_schemas_manual_rating_global;
            }
            if (isset($seopress_schemas_cf)) {
                $html .= $seopress_schemas_cf;
            }

            return $html;
        }

        //Get datas
        $seopress_pro_rich_snippets_type                                = get_post_meta($post->ID,'_seopress_pro_rich_snippets_type',true);
        $seopress_pro_rich_snippets_rules                               = get_post_meta($post->ID,'_seopress_pro_rich_snippets_rules',true);

        //Article
        $seopress_pro_rich_snippets_article_type                        = get_post_meta($post->ID,'_seopress_pro_rich_snippets_article_type',true);

        //Local Business
        $seopress_pro_rich_snippets_lb_opening_hours                    = get_post_meta($post->ID,'_seopress_pro_rich_snippets_lb_opening_hours',false);

echo    '<tr id="term-seopress" class="form-field">
            <td>
                <div id="seopress_pro_cpt" class="seopress-your-schema">
                    <div class="inside">
                        <div id="seopress-your-schema">
                            <div class="box-left">
                                <div class="wrap-rich-snippets-type schema-steps">
                                    <label for="seopress_pro_rich_snippets_type_meta">'. __( 'Select your data type:', 'wp-seopress-pro' ) .'</label>
                                    <select id="seopress_pro_rich_snippets_type" name="seopress_pro_rich_snippets_type">
                                        <option ' . selected( 'none', $seopress_pro_rich_snippets_type, false ) . ' value="none">'. __( 'None', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'articles', $seopress_pro_rich_snippets_type, false ) . ' value="articles">'. __( 'Article', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'localbusiness', $seopress_pro_rich_snippets_type, false ) . ' value="localbusiness">'. __( 'Local Business', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'courses', $seopress_pro_rich_snippets_type, false ) . ' value="courses">'. __( 'Course', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'recipes', $seopress_pro_rich_snippets_type, false ) . ' value="recipes">'. __( 'Recipe', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'videos', $seopress_pro_rich_snippets_type, false ) . ' value="videos">'. __( 'Video', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'events', $seopress_pro_rich_snippets_type, false ) . ' value="events">'. __( 'Event', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'products', $seopress_pro_rich_snippets_type, false ) . ' value="products">'. __( 'Product', 'wp-seopress-pro' ) .'</option>
                                        <option ' . selected( 'review', $seopress_pro_rich_snippets_type, false ) . ' value="review">'. __( 'Review', 'wp-seopress-pro' ) .'</option>
                                    </select>';
                                echo '</div>
                                <div class="wrap-rich-snippets-rules schema-steps">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_rules_meta">'. __( 'Show this schema if is:', 'wp-seopress' ) .'</label>
                                        <select name="seopress_pro_rich_snippets_rules">
                                        ';

                                        foreach ($seopress_get_post_types as $key => $value) {
                                            echo '<option ' . selected( $key, $seopress_pro_rich_snippets_rules, false ) . ' value="'.$key.'">'. __( $value->labels->name, 'wp-seopress' ) .'</option>';
                                        }
                                        
                                    echo '</select>
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-articles schema-steps">';
                                    if (function_exists('seopress_rich_snippets_publisher_logo_option') && seopress_rich_snippets_publisher_logo_option() !='') {
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
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_article_title', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_article_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_article_img', 'image').'
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-local-business">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_name_meta">
                                            '. __( 'Name of your business', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_type_meta">'. __( 'Select a business type', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_type', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_street_addr_meta">
                                            '. __( 'Street Address', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_street_addr', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_city_meta">
                                            '. __( 'City', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_city', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_state_meta">
                                            '. __( 'State', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_state', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_pc_meta">
                                            '. __( 'Postal code', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_pc', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_country_meta">
                                            '. __( 'Country', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_country', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_lat_meta">
                                            '. __( 'Latitude', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_lat', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_lon_meta">
                                            '. __( 'Longitude', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_lon', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_website_meta">
                                            '. __( 'URL', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_website', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_tel_meta">
                                            '. __( 'Telephone', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_tel', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_lb_price_meta">
                                            '. __( 'Price range', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_lb_price', 'default').'
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

                                        $check_day = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['open']);
                                        
                                        $check_day_am = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['open']);

                                        $check_day_pm = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['open']);

                                        $selected_start_hours = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['hours']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['hours'] : NULL;

                                        $selected_start_mins = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['mins']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['mins'] : NULL;
                                        
                                        echo '<li>';

                                            echo '<span class="day"><strong>'.$day.'</strong></span>';

                                            echo '<ul>';
                                                 //Closed?
                                                echo '<li>';

                                                    echo '<input id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][open]" type="checkbox"';
                                                        if ('1' == $check_day) echo 'checked="yes"'; 
                                                        echo ' value="1"/>';
                                                    
                                                    echo '<label for="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][open]">'. __( 'Closed all the day?', 'wp-seopress-pro' ) .'</label> ';
                                                    
                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['open'])) {
                                                        esc_attr($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['open']);
                                                    }
                                                echo '</li>';

                                                //AM
                                                echo '<li>';
                                                    echo '<input id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][am][open]" type="checkbox"';
                                                        if ('1' == $check_day_am) echo 'checked="yes"'; 
                                                        echo ' value="1"/>';                            
                                                    
                                                    echo '<label for="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][open]">'. __( 'Open in the morning?', 'wp-seopress-pro' ) .'</label> ';

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['open'])) {
                                                        esc_attr($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['open']);
                                                    }

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][start][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][am][start][hours]">';

                                                        foreach ($hours as $hour) {
                                                            echo '<option '; 
                                                            if ($hour == $selected_start_hours) echo 'selected="selected"'; 
                                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                                        }

                                                    echo '</select>';

                                                    echo ' : ';

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][start][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][am][start][mins]">';

                                                        foreach ($mins as $min) {
                                                            echo '<option '; 
                                                            if ($min == $selected_start_mins) echo 'selected="selected"'; 
                                                            echo ' value="'.$min.'">'. $min .'</option>';
                                                        }

                                                    echo '</select>';

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['hours'])) {
                                                        esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['hours']);
                                                    }

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['mins'])) {
                                                        esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['start']['mins']);
                                                    }

                                                    echo ' - ';

                                                    $selected_end_hours = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['end']['hours']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['end']['hours'] : NULL;

                                                    $selected_end_mins = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['end']['mins']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['am']['end']['mins'] : NULL;

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][end][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][am][end][hours]">';

                                                        foreach ($hours as $hour) {
                                                            echo '<option '; 
                                                            if ($hour == $selected_end_hours) echo 'selected="selected"'; 
                                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                                        }

                                                    echo '</select>';

                                                    echo ' : ';

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][am][end][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][am][end][mins]">';

                                                        foreach ($mins as $min) {
                                                            echo '<option '; 
                                                            if ($min == $selected_end_mins) echo 'selected="selected"'; 
                                                            echo ' value="'.$min.'">'. $min .'</option>';
                                                        }

                                                    echo '</select>';
                                                echo '</li>';
                                                
                                                //PM
                                                echo '<li>';
                                                    $selected_start_hours2 = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['hours']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['hours'] : NULL;

                                                    $selected_start_mins2 = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['mins']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['mins'] : NULL;

                                                    echo '<input id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][open]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][pm][open]" type="checkbox"';
                                                        if ('1' == $check_day_pm) echo 'checked="yes"'; 
                                                        echo ' value="1"/>';

                                                    echo '<label for="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][open]">'. __( 'Open in the afternoon?', 'wp-seopress-pro' ) .'</label> ';

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['open'])) {
                                                        esc_attr($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['open']);
                                                    }

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][start][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][pm][start][hours]">';

                                                        foreach ($hours as $hour) {
                                                            echo '<option '; 
                                                            if ($hour == $selected_start_hours2) echo 'selected="selected"'; 
                                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                                        }

                                                    echo '</select>';

                                                    echo ' : ';

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][start][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][pm][start][mins]">';

                                                        foreach ($mins as $min) {
                                                            echo '<option '; 
                                                            if ($min == $selected_start_mins2) echo 'selected="selected"'; 
                                                            echo ' value="'.$min.'">'. $min .'</option>';
                                                        }

                                                    echo '</select>';

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['hours'])) {
                                                        esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['hours']);
                                                    }

                                                    if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['mins'])) {
                                                        esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['start']['mins']);
                                                    }

                                                    echo ' - ';

                                                    $selected_end_hours2 = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['hours']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['hours'] : NULL;

                                                    $selected_end_mins2 = isset($options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['mins']) ? $options[0]['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['mins'] : NULL;

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][end][hours]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][pm][end][hours]">';

                                                        foreach ($hours as $hour) {
                                                            echo '<option '; 
                                                            if ($hour == $selected_end_hours2) echo 'selected="selected"'; 
                                                            echo ' value="'.$hour.'">'. $hour .'</option>';
                                                        }

                                                    echo '</select>';

                                                    echo ' : ';

                                                    echo '<select id="seopress_pro_rich_snippets_lb_opening_hours['.$key.'][pm][end][mins]" name="seopress_pro_rich_snippets_lb_opening_hours[seopress_pro_rich_snippets_lb_opening_hours]['.$key.'][pm][end][mins]">';

                                                        foreach ($mins as $min) {
                                                            echo '<option '; 
                                                            if ($min == $selected_end_mins2) echo 'selected="selected"'; 
                                                            echo ' value="'.$min.'">'. $min .'</option>';
                                                        }

                                                    echo '</select>';

                                                echo '</li>';
                                            echo '</ul>';

                                        if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['hours'])) {
                                            esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['hours']);
                                        }

                                        if (isset($options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['mins'])) {
                                            esc_attr( $options['seopress_pro_rich_snippets_lb_opening_hours'][$key]['pm']['end']['mins']);
                                        }

                                        $seopress_pro_rich_snippets_lb_opening_hours = $options;
                                    }

                                    echo '</ul>
                                </div>

                                <div class="wrap-rich-snippets-courses">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_courses_title_meta">
                                            '. __( 'Title', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_courses_title', 'default').'
                                    </p>
                                    <p style="margin-bottom:0">
                                        <label for="seopress_pro_rich_snippets_courses_desc_meta">'. __( 'Course description', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_courses_desc', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_courses_school_meta">
                                            '. __( 'School/Organization', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_courses_school', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_courses_website_meta">
                                            '. __( 'School/Organization Website', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_courses_website', 'default').'
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-recipes">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_name_meta">
                                            '. __( 'Recipe name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_desc_meta">'. __( 'Short recipe description', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_desc', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_cat_meta">
                                            '. __( 'Recipe category', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_cat', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_img_meta">'. __( 'Image', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_prep_time_meta">
                                            '. __( 'Preparation time (in minutes)', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_prep_time', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_cook_time_meta">
                                            '. __( 'Cooking time (in minutes)', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_cook_time', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_calories_meta">
                                            '. __( 'Calories', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_calories', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_recipes_yield_meta">
                                            '. __( 'Recipe yield', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_recipes_yield', 'default').'
                                    </p>
                                </div>
                                
                                <div class="wrap-rich-snippets-videos">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_videos_name_meta">
                                            '. __( 'Video name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_videos_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_videos_description_meta">'. __( 'Video description', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_videos_description', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_videos_img_meta">'. __( 'Video thumbnail', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_videos_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_videos_duration_meta">
                                            '. __( 'Duration of your video (in minutes)', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_videos_duration', 'time').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_videos_url_meta">
                                            '. __( 'Video URL', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_videos_url', 'default').'
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-events">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_type_meta">'. __( 'Select your event type', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_type', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_name_meta">
                                            '. __( 'Event name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_desc_meta">
                                            '. __( 'Event description (default excerpt, or beginning of the content)', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_desc', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_img_meta">'. __( 'Image thumbnail', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_start_date_meta">
                                            '. __( 'Start date', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_start_date', 'date').'
                                    </p> 
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_start_time_meta">
                                            '. __( 'Start time', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_start_time', 'time').'
                                    </p>                
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_end_date_meta">
                                            '. __( 'End date', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_end_date', 'date').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_end_time_meta">
                                            '. __( 'End time', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_end_time', 'time').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_location_name_meta">
                                            '. __( 'Location name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_location_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_location_url_meta">
                                            '. __( 'Location Website', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_location_url', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_location_address_meta">
                                            '. __( 'Location Address', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_location_address', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_name_meta">
                                            '. __( 'Offer name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_cat_meta">'. __( 'Select your offer category', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_cat', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_price_meta">
                                            '. __( 'Price', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_price', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_price_currency_meta">'. __( 'Select your currency', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_price_currency', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_availability_meta">'. __( 'Availability', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_availability', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_rich_snippets_events_offers_valid_from_meta_date">'. __( 'Valid From', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_rich_snippets_events_offers_valid_from_date', 'date').'
                                        <label for="seopress_rich_snippets_events_offers_valid_from_meta_time">'. __( 'Time', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_rich_snippets_events_offers_valid_from_time', 'time').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_offers_url_meta">
                                            '. __( 'Website to buy tickets', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_offers_url', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_events_performer_meta">
                                            '. __( 'Performer name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_events_performer', 'default').'
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-products">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_name_meta">
                                            '. __( 'Product name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_name', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_description_meta">'. __( 'Product description', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_description', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_img_meta">'. __( 'Thumbnail', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_price_meta">
                                            '. __( 'Product price', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_price', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_price_valid_date">'. __( 'Product price valid until', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_price_valid_date', 'date').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_sku_meta">
                                            '. __( 'Product SKU', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_sku', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_global_ids_meta">
                                            '. __( 'Product Global Identifiers type', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_global_ids', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_global_ids_value_meta">
                                            '. __( 'Product Global Identifiers', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_global_ids_value', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_brand_meta">
                                            '. __( 'Product Brand', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_brand', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_price_currency_meta">
                                            '. __( 'Product currency', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_price_currency', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_condition_meta">'. __( 'Product Condition', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_condition', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_product_availability_meta">'. __( 'Product Availability', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_product_availability', 'default').'
                                    </p>
                                </div>

                                <div class="wrap-rich-snippets-review">
                                    <p>
                                        <label for="seopress_pro_rich_snippets_review_item_meta">
                                            '. __( 'Review item name', 'wp-seopress-pro' ) .'</label>
                                            '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_review_item', 'default').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_review_img_meta">'. __( 'Review item image', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_review_img', 'image').'
                                    </p>
                                    <p>
                                        <label for="seopress_pro_rich_snippets_review_rating_meta">
                                            '. __( 'Your rating', 'wp-seopress-pro' ) .'</label>
                                        '.seopress_schemas_mapping_array('seopress_pro_rich_snippets_review_rating', 'rating').'
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>';
}

add_action('save_post','seopress_schemas_save_metabox');
function seopress_schemas_save_metabox($post_id){
    if(isset($_POST['seopress_pro_rich_snippets_rules'])){
      update_post_meta($post_id, '_seopress_pro_rich_snippets_rules', esc_html($_POST['seopress_pro_rich_snippets_rules']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_type'])){
      update_post_meta($post_id, '_seopress_pro_rich_snippets_type', esc_html($_POST['seopress_pro_rich_snippets_type']));
    }
    //Article
    if(isset($_POST['seopress_pro_rich_snippets_article_type'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_type', esc_html($_POST['seopress_pro_rich_snippets_article_type']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_title'])){
      update_post_meta($post_id, '_seopress_pro_rich_snippets_article_title', esc_html($_POST['seopress_pro_rich_snippets_article_title']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_title_cf'])){
      update_post_meta($post_id, '_seopress_pro_rich_snippets_article_title_cf', esc_html($_POST['seopress_pro_rich_snippets_article_title_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_title_manual_global'])){
      update_post_meta($post_id, '_seopress_pro_rich_snippets_article_title_manual_global', esc_html($_POST['seopress_pro_rich_snippets_article_title_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_article_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_cf', esc_html($_POST['seopress_pro_rich_snippets_article_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_article_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_article_img_manual_img_library_global_height']));
    }
    //Local Business
    if(isset($_POST['seopress_pro_rich_snippets_lb_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_name', esc_html($_POST['seopress_pro_rich_snippets_lb_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_name_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_type'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_type', esc_html($_POST['seopress_pro_rich_snippets_lb_type']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_type_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_type_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_type_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_type_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_type_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_type_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img', esc_html($_POST['seopress_pro_rich_snippets_lb_img']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_lb_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_lb_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_street_addr'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_street_addr', esc_html($_POST['seopress_pro_rich_snippets_lb_street_addr']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_street_addr_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_street_addr_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_street_addr_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_street_addr_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_street_addr_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_street_addr_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_city'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_city', esc_html($_POST['seopress_pro_rich_snippets_lb_city']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_city_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_city_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_city_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_city_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_city_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_city_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_state'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_state', esc_html($_POST['seopress_pro_rich_snippets_lb_state']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_state_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_state_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_state_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_state_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_state_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_state_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_pc'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_pc', esc_html($_POST['seopress_pro_rich_snippets_lb_pc']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_pc_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_pc_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_pc_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_pc_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_pc_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_pc_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_country'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_country', esc_html($_POST['seopress_pro_rich_snippets_lb_country']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_country_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_country_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_country_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_country_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_country_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_country_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lat'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lat', esc_html($_POST['seopress_pro_rich_snippets_lb_lat']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lat_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lat_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_lat_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lat_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lat_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_lat_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lon'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lon', esc_html($_POST['seopress_pro_rich_snippets_lb_lon']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lon_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lon_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_lon_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_lon_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_lon_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_lon_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_website'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_website', esc_html($_POST['seopress_pro_rich_snippets_lb_website']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_website_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_website_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_website_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_website_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_website_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_website_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_tel'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_tel', esc_html($_POST['seopress_pro_rich_snippets_lb_tel']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_tel_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_tel_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_tel_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_tel_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_tel_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_tel_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_price'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_price', esc_html($_POST['seopress_pro_rich_snippets_lb_price']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_price_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_price_cf', esc_html($_POST['seopress_pro_rich_snippets_lb_price_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_price_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_price_manual_global', esc_html($_POST['seopress_pro_rich_snippets_lb_price_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_lb_opening_hours'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_lb_opening_hours', $_POST['seopress_pro_rich_snippets_lb_opening_hours']);
    }
    //Course
    if(isset($_POST['seopress_pro_rich_snippets_courses_title'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_title', esc_html($_POST['seopress_pro_rich_snippets_courses_title']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_title_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_title_cf', esc_html($_POST['seopress_pro_rich_snippets_courses_title_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_title_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_title_manual_global', esc_html($_POST['seopress_pro_rich_snippets_courses_title_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_desc'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_desc', esc_html($_POST['seopress_pro_rich_snippets_courses_desc']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_desc_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_desc_cf', esc_html($_POST['seopress_pro_rich_snippets_courses_desc_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_desc_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_desc_manual_global', esc_html($_POST['seopress_pro_rich_snippets_courses_desc_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_school'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_school', esc_html($_POST['seopress_pro_rich_snippets_courses_school']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_school_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_school_cf', esc_html($_POST['seopress_pro_rich_snippets_courses_school_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_school_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_school_manual_global', esc_html($_POST['seopress_pro_rich_snippets_courses_school_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_website'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_website', esc_html($_POST['seopress_pro_rich_snippets_courses_website']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_website_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_website_cf', esc_html($_POST['seopress_pro_rich_snippets_courses_website_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_courses_website_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_courses_website_manual_global', esc_html($_POST['seopress_pro_rich_snippets_courses_website_manual_global']));
    }
    //Recipe
    if(isset($_POST['seopress_pro_rich_snippets_recipes_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_name', esc_html($_POST['seopress_pro_rich_snippets_recipes_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_name_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_desc'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_desc', esc_html($_POST['seopress_pro_rich_snippets_recipes_desc']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_desc_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_desc_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_desc_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_desc_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_desc_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_desc_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cat'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cat', esc_html($_POST['seopress_pro_rich_snippets_recipes_cat']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cat_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cat_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_cat_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cat_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cat_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_cat_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_recipes_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_prep_time'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_prep_time', esc_html($_POST['seopress_pro_rich_snippets_recipes_prep_time']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_prep_time_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_prep_time_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_prep_time_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_prep_time_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_prep_time_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_prep_time_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cook_time'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cook_time', esc_html($_POST['seopress_pro_rich_snippets_recipes_cook_time']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cook_time_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cook_time_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_cook_time_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_cook_time_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_cook_time_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_cook_time_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_calories'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_calories', esc_html($_POST['seopress_pro_rich_snippets_recipes_calories']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_calories_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_calories_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_calories_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_calories_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_calories_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_calories_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_yield'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_yield', esc_html($_POST['seopress_pro_rich_snippets_recipes_yield']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_yield_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_yield_cf', esc_html($_POST['seopress_pro_rich_snippets_recipes_yield_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_recipes_yield_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_recipes_yield_manual_global', esc_html($_POST['seopress_pro_rich_snippets_recipes_yield_manual_global']));
    }
    //Video
    if(isset($_POST['seopress_pro_rich_snippets_videos_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_name', esc_html($_POST['seopress_pro_rich_snippets_videos_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_name_cf', esc_html($_POST['seopress_pro_rich_snippets_videos_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_videos_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_description'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_description', esc_html($_POST['seopress_pro_rich_snippets_videos_description']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_description_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_description_cf', esc_html($_POST['seopress_pro_rich_snippets_videos_description_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_description_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_description_manual_global', esc_html($_POST['seopress_pro_rich_snippets_videos_description_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_videos_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_cf', esc_html($_POST['seopress_pro_rich_snippets_videos_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_videos_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_duration'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_duration', esc_html($_POST['seopress_pro_rich_snippets_videos_duration']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_duration_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_duration_cf', esc_html($_POST['seopress_pro_rich_snippets_videos_duration_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_duration_manual_time_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_duration_manual_time_global', esc_html($_POST['seopress_pro_rich_snippets_videos_duration_manual_time_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_url'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_url', esc_html($_POST['seopress_pro_rich_snippets_videos_url']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_url_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_url_cf', esc_html($_POST['seopress_pro_rich_snippets_videos_url_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_videos_url_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_videos_url_manual_global', esc_html($_POST['seopress_pro_rich_snippets_videos_url_manual_global']));
    }
    //Event
    if(isset($_POST['seopress_pro_rich_snippets_events_type'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_type', esc_html($_POST['seopress_pro_rich_snippets_events_type']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_type_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_type_cf', esc_html($_POST['seopress_pro_rich_snippets_events_type_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_type_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_type_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_type_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_name', esc_html($_POST['seopress_pro_rich_snippets_events_name']));
    } 
    if(isset($_POST['seopress_pro_rich_snippets_events_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_name_cf', esc_html($_POST['seopress_pro_rich_snippets_events_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc', esc_html($_POST['seopress_pro_rich_snippets_events_desc']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc_cf', esc_html($_POST['seopress_pro_rich_snippets_events_desc_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_desc_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_events_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img_cf', esc_html($_POST['seopress_pro_rich_snippets_events_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_events_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc', esc_html($_POST['seopress_pro_rich_snippets_events_desc']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc_cf', esc_html($_POST['seopress_pro_rich_snippets_events_desc_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_desc_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_desc_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_desc_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_date'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_date', esc_html($_POST['seopress_pro_rich_snippets_events_start_date']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_date_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_date_cf', esc_html($_POST['seopress_pro_rich_snippets_events_start_date_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_date_manual_date_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_date_manual_date_global', esc_html($_POST['seopress_pro_rich_snippets_events_start_date_manual_date_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_time'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_time', esc_html($_POST['seopress_pro_rich_snippets_events_start_time']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_time_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_time_cf', esc_html($_POST['seopress_pro_rich_snippets_events_start_time_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_start_time_manual_time_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_start_time_manual_time_global', esc_html($_POST['seopress_pro_rich_snippets_events_start_time_manual_time_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_date'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_date', esc_html($_POST['seopress_pro_rich_snippets_events_end_date']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_date_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_date_cf', esc_html($_POST['seopress_pro_rich_snippets_events_end_date_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_date_manual_date_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_date_manual_date_global', esc_html($_POST['seopress_pro_rich_snippets_events_end_date_manual_date_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_time'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_time', esc_html($_POST['seopress_pro_rich_snippets_events_end_time']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_time_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_time_cf', esc_html($_POST['seopress_pro_rich_snippets_events_end_time_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_end_time_manual_time_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_end_time_manual_time_global', esc_html($_POST['seopress_pro_rich_snippets_events_end_time_manual_time_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_name', esc_html($_POST['seopress_pro_rich_snippets_events_location_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_name_cf', esc_html($_POST['seopress_pro_rich_snippets_events_location_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_location_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_url'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_url', esc_html($_POST['seopress_pro_rich_snippets_events_location_url']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_url_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_url_cf', esc_html($_POST['seopress_pro_rich_snippets_events_location_url_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_url_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_url_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_location_url_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_address'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_address', esc_html($_POST['seopress_pro_rich_snippets_events_location_address']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_address_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_address_cf', esc_html($_POST['seopress_pro_rich_snippets_events_location_address_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_location_address_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_location_address_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_location_address_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_name', esc_html($_POST['seopress_pro_rich_snippets_events_offers_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_name_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_cat'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_cat', esc_html($_POST['seopress_pro_rich_snippets_events_offers_cat']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_cat_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_cat_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_cat_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_cat_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_cat_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_cat_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_currency'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_currency', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_currency']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_currency_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_currency_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_currency_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_price_currency_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_price_currency_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_price_currency_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_availability'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_availability', esc_html($_POST['seopress_pro_rich_snippets_events_offers_availability']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_availability_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_availability_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_availability_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_availability_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_availability_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_availability_manual_global']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_date'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_date', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_date']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_date_cf'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_date_cf', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_date_cf']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_date_manual_global'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_date_manual_global', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_date_manual_global']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_time'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_time', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_time']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_time_cf'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_time_cf', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_time_cf']));
    }
    if(isset($_POST['seopress_rich_snippets_events_offers_valid_from_time_manual_global'])){
        update_post_meta($post_id, '_seopress_rich_snippets_events_offers_valid_from_time_manual_global', esc_html($_POST['seopress_rich_snippets_events_offers_valid_from_time_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_url'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_url', esc_html($_POST['seopress_pro_rich_snippets_events_offers_url']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_url_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_url_cf', esc_html($_POST['seopress_pro_rich_snippets_events_offers_url_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_offers_url_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_offers_url_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_offers_url_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_performer'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_performer', esc_html($_POST['seopress_pro_rich_snippets_events_performer']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_performer_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_performer_cf', esc_html($_POST['seopress_pro_rich_snippets_events_performer_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_events_performer_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_events_performer_manual_global', esc_html($_POST['seopress_pro_rich_snippets_events_performer_manual_global']));
    }
    //Product
    if(isset($_POST['seopress_pro_rich_snippets_product_name'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_name', esc_html($_POST['seopress_pro_rich_snippets_product_name']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_name_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_name_cf', esc_html($_POST['seopress_pro_rich_snippets_product_name_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_name_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_name_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_name_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_description'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_description', esc_html($_POST['seopress_pro_rich_snippets_product_description']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_description_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_description_cf', esc_html($_POST['seopress_pro_rich_snippets_product_description_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_description_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_description_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_description_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_product_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img_cf', esc_html($_POST['seopress_pro_rich_snippets_product_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_product_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price', esc_html($_POST['seopress_pro_rich_snippets_product_price']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_cf', esc_html($_POST['seopress_pro_rich_snippets_product_price_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_price_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_valid_date'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_valid_date', esc_html($_POST['seopress_pro_rich_snippets_product_price_valid_date']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_valid_date_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_valid_date_cf', esc_html($_POST['seopress_pro_rich_snippets_product_price_valid_date_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_valid_date_manual_date_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_valid_date_manual_date_global', esc_html($_POST['seopress_pro_rich_snippets_product_price_valid_date_manual_date_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_sku'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_sku', esc_html($_POST['seopress_pro_rich_snippets_product_sku']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_sku_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_sku_cf', esc_html($_POST['seopress_pro_rich_snippets_product_sku_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_sku_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_sku_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_sku_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_cf', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_value'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_value', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_value']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_value_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_value_cf', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_value_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_global_ids_value_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_global_ids_value_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_global_ids_value_manual_global']));
    }    
    if(isset($_POST['seopress_pro_rich_snippets_product_brand'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_brand', esc_html($_POST['seopress_pro_rich_snippets_product_brand']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_brand_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_brand_cf', esc_html($_POST['seopress_pro_rich_snippets_product_brand_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_brand_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_brand_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_brand_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_currency'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_currency', esc_html($_POST['seopress_pro_rich_snippets_product_price_currency']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_currency_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_currency_cf', esc_html($_POST['seopress_pro_rich_snippets_product_price_currency_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_price_currency_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_price_currency_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_price_currency_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_condition'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_condition', esc_html($_POST['seopress_pro_rich_snippets_product_condition']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_condition_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_condition_cf', esc_html($_POST['seopress_pro_rich_snippets_product_condition_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_condition_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_condition_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_condition_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_availability'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_availability', esc_html($_POST['seopress_pro_rich_snippets_product_availability']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_availability_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_availability_cf', esc_html($_POST['seopress_pro_rich_snippets_product_availability_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_product_availability_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_product_availability_manual_global', esc_html($_POST['seopress_pro_rich_snippets_product_availability_manual_global']));
    }
    //Review
    if(isset($_POST['seopress_pro_rich_snippets_review_item'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_item', esc_html($_POST['seopress_pro_rich_snippets_review_item']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_item_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_item_cf', esc_html($_POST['seopress_pro_rich_snippets_review_item_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_item_manual_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_item_manual_global', esc_html($_POST['seopress_pro_rich_snippets_review_item_manual_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_img_manual_img_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img_manual_img_global', esc_html($_POST['seopress_pro_rich_snippets_review_img_manual_img_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_img_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img_cf', esc_html($_POST['seopress_pro_rich_snippets_review_img_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img_manual_img_library_global', esc_html($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global_width'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img_manual_img_library_global_width', esc_html($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global_width']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global_height'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_img_manual_img_library_global_height', esc_html($_POST['seopress_pro_rich_snippets_review_img_manual_img_library_global_height']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_rating'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_rating', esc_html($_POST['seopress_pro_rich_snippets_review_rating']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_rating_cf'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_rating_cf', esc_html($_POST['seopress_pro_rich_snippets_review_rating_cf']));
    }
    if(isset($_POST['seopress_pro_rich_snippets_review_rating_manual_rating_global'])){
        update_post_meta($post_id, '_seopress_pro_rich_snippets_review_rating_manual_rating_global', esc_html($_POST['seopress_pro_rich_snippets_review_rating_manual_rating_global']));
    }
}
