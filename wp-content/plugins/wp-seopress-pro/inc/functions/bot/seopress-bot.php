<?php

defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

/**
 * Main plugin class.
 *
 * @since 1.0.0
 *
 * @package SEOPress_Bot_batch
 * @author  Thomas Griffin + Benjamin Denis
 */
class SEOPress_Bot_batch {

    /**
     * Number of posts to check per batch.
     *
     * @since 1.0.0
     *
     * @var int
     */
    public $num = 10;

    /**
     * Main plugin method for querying data. The default order is oldest items first,
     * since that's typically where batch updating needs to happen. Change the 'order'
     * param to 'DESC' to start with newest first.
     *
     * @since 1.0.0
     *
     * @param int $ppp    The posts_per_page number to use in the query.
     * @param int $offset The offset to use for querying data.
     * @return mixed      An array of data to be processed in bulk fashion.
     */

    public function get_query_data( $ppp, $offset ) {
        //Include Custom Post Types
        function seopress_bot_scan_settings_post_types_option() {
            $seopress_bot_scan_settings_post_types_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_post_types_option ) ) {
                foreach ($seopress_bot_scan_settings_post_types_option as $key => $seopress_bot_scan_settings_post_types_value)
                    $options[$key] = $seopress_bot_scan_settings_post_types_value;
                 if (isset($seopress_bot_scan_settings_post_types_option['seopress_bot_scan_settings_post_types'])) { 
                    return $seopress_bot_scan_settings_post_types_option['seopress_bot_scan_settings_post_types'];
                 }
            }
        }
        if (seopress_bot_scan_settings_post_types_option() !='') {
            $seopress_bot_post_types_cpt_array = array();
            foreach (seopress_bot_scan_settings_post_types_option() as $cpt_key => $cpt_value) {
                foreach ($cpt_value as $_cpt_key => $_cpt_value) {
                    if($_cpt_value =='1') {
                        array_push($seopress_bot_post_types_cpt_array, $cpt_key);
                    }
                }
            }
            $args = array( 
                'posts_per_page' => $ppp,
                'offset' => $offset,
                'cache_results' => false,
                'order' => 'DESC',
                'orderby' => 'date',
                'post_type' => $seopress_bot_post_types_cpt_array,
                'post_status' => 'publish',
            );

            return get_posts( $args );
        }
    }

    /**
     * Loops through the array of data and processes it as necessary.
     *
     * @since 1.0.0
     *
     * @param array $data An array of data to process.
     */
    public function process_query_data( $data ) {
        //Type of links
        function seopress_bot_scan_settings_type_option() {
            $seopress_bot_scan_settings_type_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_type_option ) ) {
                foreach ($seopress_bot_scan_settings_type_option as $key => $seopress_bot_scan_settings_type_value)
                    $options[$key] = $seopress_bot_scan_settings_type_value;
                 if (isset($seopress_bot_scan_settings_type_option['seopress_bot_scan_settings_type'])) { 
                    return $seopress_bot_scan_settings_type_option['seopress_bot_scan_settings_type'];
                 }
            }
        }

        //404 only
        function seopress_bot_scan_settings_404_option() {
            $seopress_bot_scan_settings_404_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_404_option ) ) {
                foreach ($seopress_bot_scan_settings_404_option as $key => $seopress_bot_scan_settings_404_value)
                    $options[$key] = $seopress_bot_scan_settings_404_value;
                 if (isset($seopress_bot_scan_settings_404_option['seopress_bot_scan_settings_404'])) { 
                    return $seopress_bot_scan_settings_404_option['seopress_bot_scan_settings_404'];
                 }
            }
        }

        //Timeout
        function seopress_bot_scan_settings_timeout_option() {
            $seopress_bot_scan_settings_timeout_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_timeout_option ) ) {
                foreach ($seopress_bot_scan_settings_timeout_option as $key => $seopress_bot_scan_settings_timeout_value)
                    $options[$key] = $seopress_bot_scan_settings_timeout_value;
                 if (isset($seopress_bot_scan_settings_timeout_option['seopress_bot_scan_settings_timeout'])) { 
                    return $seopress_bot_scan_settings_timeout_option['seopress_bot_scan_settings_timeout'];
                 }
            }
        }        

        //Links cleaning
        function seopress_bot_scan_settings_cleaning_option() {
            $seopress_bot_scan_settings_cleaning_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_cleaning_option ) ) {
                foreach ($seopress_bot_scan_settings_cleaning_option as $key => $seopress_bot_scan_settings_cleaning_value)
                    $options[$key] = $seopress_bot_scan_settings_cleaning_value;
                 if (isset($seopress_bot_scan_settings_cleaning_option['seopress_bot_scan_settings_cleaning'])) { 
                    return $seopress_bot_scan_settings_cleaning_option['seopress_bot_scan_settings_cleaning'];
                 }
            }
        }

        //Cleaning seopress_bot post type
        if (seopress_bot_scan_settings_cleaning_option() ==1) {
            if (current_user_can('manage_options') && is_admin()) {
                global $wpdb;

                // delete all posts by post type.
                $sql = 'DELETE `posts`, `pm`
                    FROM `' . $wpdb->prefix . 'posts` AS `posts` 
                    LEFT JOIN `' . $wpdb->prefix . 'postmeta` AS `pm` ON `pm`.`post_id` = `posts`.`ID`
                    WHERE `posts`.`post_type` = \'seopress_bot\'';
                $wpdb->query($sql);
            }
        }

        // Loop through each post and add a custom field.
        foreach ( (array) $data as $post ) {
            setup_postdata( $post );
            
            if ($post->post_content !='') {
                
                $unfiltered_content = str_replace( '<!--more-->', '', $post->post_content );
                $filtered_content = apply_filters( 'the_content', $unfiltered_content );

                $dom = new domDocument;
                libxml_use_internal_errors(true);
                $dom->loadHTML($filtered_content);
                $dom->preserveWhiteSpace = false;
                libxml_clear_errors();
                 
                $links = $dom->getElementsByTagName('a');

                if (!empty($links)) {
                    foreach($links as $link){
                        if ($link->getAttribute('href') !='#') {
                            
                            if (seopress_bot_scan_settings_timeout_option() !='') {
                                $args = array('timeout' => seopress_bot_scan_settings_timeout_option(), 'sslverify' => false);
                            } else {
                                $args = array('timeout' => 5, 'sslverify' => false);
                            }

                            $response = wp_remote_get($link->getAttribute('href'), $args);
                            $bot_status_code = wp_remote_retrieve_response_code($response);

                            if(seopress_bot_scan_settings_type_option() !='')  {
                                $bot_status_type = wp_remote_retrieve_header($response, 'content-type');
                            }
                            
                            if (seopress_bot_scan_settings_404_option() !='') {
                                if ($bot_status_code =='404' || strpos(json_encode($response), 'cURL error 6')) {
                                    $check_page_id = get_page_by_title( $link->getAttribute('href'), OBJECT, 'seopress_bot');
                                    if (($check_page_id->post_title != $link->getAttribute('href') && get_post_meta($check_page_id->ID,'seopress_bot_source_url', true) != $link->getAttribute('href'))) {
                                        wp_insert_post(array('post_title' => $link->getAttribute('href'), 'post_type' => 'seopress_bot', 'post_status' => 'publish', 'meta_input' => array( 'seopress_bot_response' => json_encode($response), 'seopress_bot_type' => $bot_status_type, 'seopress_bot_status' => $bot_status_code, 'seopress_bot_source_url' => get_permalink($post), 'seopress_bot_source_id' => $post->ID, 'seopress_bot_source_title' => get_the_title($post), 'seopress_bot_a_title' => $link->title )));
                                    } elseif ($check_page_id->post_title == $link->getAttribute('href')) {
                                        $seopress_bot_count = get_post_meta($check_page_id->ID,'seopress_bot_count', true);
                                        update_post_meta($check_page_id->ID, 'seopress_bot_count', ++$seopress_bot_count);
                                    }
                                }
                            } else {
                                $check_page_id = get_page_by_title( $link->getAttribute('href'), OBJECT, 'seopress_bot');
                                if (($check_page_id->post_title != $link->getAttribute('href') && get_post_meta($check_page_id->ID,'seopress_bot_source_url', true) != $link->getAttribute('href'))){
                                    wp_insert_post(array('post_title' => $link->getAttribute('href'), 'post_type' => 'seopress_bot', 'post_status' => 'publish', 'meta_input' => array( 'seopress_bot_response' => json_encode($response), 'seopress_bot_type' => $bot_status_type, 'seopress_bot_status' => $bot_status_code, 'seopress_bot_source_url' => get_permalink($post), 'seopress_bot_source_id' => $post->ID, 'seopress_bot_source_title' => get_the_title($post), 'seopress_bot_a_title' => $link->title )));
                                } elseif ($check_page_id->post_title == $link->getAttribute('href')) {
                                    $seopress_bot_count = get_post_meta($check_page_id->ID,'seopress_bot_count', true);
                                    update_post_meta($check_page_id->ID, 'seopress_bot_count', ++$seopress_bot_count);
                                }
                            }
                        }
                    }
                }
            }
            wp_reset_postdata();
        }
    }

    
    /**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static $instance;
    /**
     * Unique plugin slug identifier.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $plugin_slug = 'seopress-bot-batch';
    /**
     * Plugin file.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $file = __FILE__;
    /**
     * Plugin menu hook.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $hook = false;
    /**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Load the plugin.
        add_action( 'init', array( $this, 'init' ), 0 );
        add_action( 'wp_ajax_seopress_bot_batch', array( $this, 'process_bulk_routine' ) );
    }
    /**
     * Processes the bulk editing routine experience.
     *
     * @since 1.0.0
     */
    public function process_bulk_routine() {
        // Run a security check first to ensure we initiated this action.
        check_ajax_referer( $this->plugin_slug, 'nonce' );
        // Prepare variables.
        $step   = absint( $_POST['step'] );
        $steps  = absint( $_POST['steps'] );
        $ppp    = $this->num;
        $offset = 1 == $step ? 0 : $ppp * ($step - 1) - 1;
        $done   = false;
        // Possibly return early if the offset exceeds the total steps and the $ppp is equal to the difference.
        if ( $offset > ($steps - ($this->num * 2)) && $ppp == ($offset - $steps) ) {
            die( json_encode( array( 'success' => true ) ) );
        }
        // If our offset is greater than our steps but $ppp is different, set $ppp to the difference.
        if ( $offset > ($steps - ($this->num * 2)) ) {
            $ppp    = $offset - $steps;
            $done   = true;
        }
        
        // If we have matched our limit, set done to true.
        if ( ($step * $ppp) >= $steps ) {
            $done = true;
        }
        // Grab all of our data.
        $data = $this->get_query_data( $ppp, $offset );
        // If we have no data or it returns false, we are done!
        if ( empty( $data ) || ! $data ) {
            wp_cache_flush();
            die( json_encode( array( 'done' => true ) ) );
        }
        // Process our query data.
        $this->process_query_data( $data );
        
        // Flush the internal cache after every successful step.
        wp_cache_flush();
        // Send back our response to say we need to process more items.
        die( json_encode( array( 'done' => $done ) ) );
    }
    /**
     * Loads the plugin into WordPress.
     *
     * @since 1.0.0
     */
    public function init() {
        add_action( 'admin_menu', array( $this, 'menu' ) );
    }
    /**
     * Loads the admin menu item under the SEOPress menu.
     *
     * @since 1.0.0
     */
    public function menu() {
        $this->hook = add_submenu_page('seopress-option', __('Broken links','wp-seopress-pro'), __('BOT','wp-seopress-pro'), 'manage_options', $this->plugin_slug, array( $this, 'menu_cb' ));
    }

    /**
     * Outputs the menu view.
     *
     * @since 1.0.0
     */
    public function menu_cb() {
        //Number of content to scan
        function seopress_bot_scan_settings_number_option() {
            $seopress_bot_scan_settings_number_option = get_option("seopress_bot_option_name");
            if ( ! empty ( $seopress_bot_scan_settings_number_option ) ) {
                foreach ($seopress_bot_scan_settings_number_option as $key => $seopress_bot_scan_settings_number_value)
                    $options[$key] = $seopress_bot_scan_settings_number_value;
                 if (isset($seopress_bot_scan_settings_number_option['seopress_bot_scan_settings_number'])) { 
                    return $seopress_bot_scan_settings_number_option['seopress_bot_scan_settings_number'];
                 }
            }
        }
        if (seopress_bot_scan_settings_number_option() !='') {
            $limit = seopress_bot_scan_settings_number_option();
        } else {
            $limit = 100;
        }

        $processing = isset( $_GET['seopress-bot-batch'] ) || isset( $_GET['seopress-batch-step'] ) ? true : false;
        $step       = isset( $_GET['seopress-batch-step'] ) ? absint( $_GET['seopress-batch-step'] ) : 1;
        $steps      = isset( $_GET['seopress-batch-limit'] ) ? round( ( absint( $_GET['seopress-batch-limit'] ) / $this->num ), 0 ) : 0;
        $nonce      = wp_create_nonce( $this->plugin_slug );
        
        $this->options = get_option( 'seopress_bot_option_name' );
        
        if (is_plugin_active('wp-seopress/seopress.php')) {
            if (function_exists('seopress_admin_header')) {
                echo seopress_admin_header();
            }
        }

        ?>
        <div class="seopress-option">
            <?php
            global $wp_version, $title;
            $current_tab = '';
            $tag = version_compare( $wp_version, '4.4' ) >= 0 ? 'h1' : 'h2';
            echo '<'.$tag.'><span class="dashicons dashicons-admin-generic"></span>'.$title.'</'.$tag.'>';
            ?>

            <div id="seopress-tabs" class="wrap">
                <?php 
                    $plugin_settings_tabs = array(
                        'tab_seopress_scan' => __( "Scan", "wp-seopress-pro" ),
                        'tab_seopress_scan_settings' => __( "Settings", "wp-seopress-pro" )
                    );

                    echo '<div class="nav-tab-wrapper">';
                    foreach ( $plugin_settings_tabs as $tab_key => $tab_caption ) {
                        echo '<a id="'. $tab_key .'-tab" class="nav-tab" href="?page=seopress-bot-batch#tab=' . $tab_key . '">' . $tab_caption . '</a>';
                    }
                    echo '</div>';
                ?>

                <!-- Scan -->
                <div class="seopress-tab <?php if ($current_tab == 'tab_seopress_scan') { echo 'active'; } ?>" id="tab_seopress_scan">
                    <?php do_settings_sections( 'seopress-settings-admin-bot' ); ?>
                    <br>
                    <br>
                    <hr>
                    <br>
                    <?php if (get_option('seopress-bot-log') !='') { ?>
                            <strong><?php _e('Latest scan: ','wp-seopress-pro'); ?></strong>
                            <?php echo get_option('seopress-bot-log'); ?>
                            <br><br>
                            <strong><?php _e('Links found: ','wp-seopress-pro'); ?></strong>
                            <?php echo wp_count_posts( 'seopress_bot' )->publish; ?>
                            <br>
                        <form method="post">
                            <input type="hidden" name="seopress_action" value="export_csv_links_settings" />
                            <p>
                                <?php wp_nonce_field( 'seopress_export_csv_links_nonce', 'seopress_export_csv_links_nonce' ); ?>
                                <?php submit_button( __( 'Export CSV', 'wp-seopress' ), 'secondary', '', false ); ?>
                                <br>
                                <br>
                            </p>
                        </form>
                    <?php
                    } else { 
                        _e('No scan','wp-seopress-pro');
                    } ?>
                    <hr>

                    <div class="wrap-bot-form">
                        <?php if ( $processing ) : ?>

                            <p><?php _e( 'Scan in progress. Please be patient as this may take several minutes to complete depending on the amount of content.', 'wp-seopress-pro' ); ?> <img class="seopress-batch-loading" src="<?php echo includes_url( 'images/spinner-2x.gif' ); ?>" alt="<?php esc_attr_e( 'Loading...', 'wp-seopress-pro' ); ?>" width="20px" height="20px" style="vertical-align:bottom" /></p>
                            
                            <p class="seopress-batch-step"><strong><?php printf( __( 'Currently on step %d of %d', 'wp-seopress-pro' ), (int) $step, (int) $steps ); ?></strong></p>

                            <div id="seopress-batch-loading" class="progress">
                                <?php $count = $step; ?>
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $count*10; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count*10; ?>%">
                                <span class="sr-only"><?php echo $count*10; ?>% Complete</span>
                                </div>
                            </div>
                            
                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    // Trigger the bulk upgrades to continue to processing.
                                    $.post( ajaxurl, { action: 'seopress_bot_batch', step: '<?php echo $step; ?>', steps: '<?php echo absint( $_GET['seopress-batch-limit'] ); ?>', nonce: '<?php echo $nonce; ?>' }, function(res){
                                        if ( res && res.success || res && res.done ) {
                                            $('.seopress-batch-step').after('<?php echo $this->get_success_message(); ?>');
                                            $('#seopress-batch-loading').remove();
                                            $('.seopress-batch-loading').remove();
                                            return;
                                        } else {
                                            document.location.href = '<?php echo add_query_arg( array( 'page' => $this->plugin_slug, 'seopress-bot-batch' => 1, 'seopress-batch-step' => (int) $step + 1, 'seopress-batch-limit' => absint( $_GET['seopress-batch-limit'] ) ), admin_url( 'admin.php?page=seopress-bot-batch' ) ); ?>';
                                        }
                                    }, 'json');
                                });
                            </script>
                            <?php else : ?>
                            <form id="seopress-bot-batch" method="get" action="<?php echo add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php?page=seopress-bot-batch' ) ); ?>">
                                <input type="hidden" name="page" value="<?php echo $this->plugin_slug; ?>" />
                                <input type="hidden" name="seopress-bot-batch" value="1" />
                                <input type="hidden" name="seopress-batch-step" value="1" />
                                <input type="hidden" name="seopress-batch-limit" value="<?php echo $limit; ?>" /> 
                                <p>
                                    <input id="submit" class="button button-primary" type="submit" name="submit" value="<?php esc_attr_e( 'Request the Bot', 'wp-seopress-pro' ); ?>" />
                                </p>
                            </form>
                        <?php endif; ?>
                    </div>
                </div><!--end .wrap-bot-form-->
                
                <!-- Settings -->
                <div class="seopress-tab <?php if ($current_tab == 'tab_seopress_scan_settings') { echo 'active'; } ?>" id="tab_seopress_scan_settings">
                    <form method="post" action="<?php echo admin_url('options.php'); ?>">
                        <?php settings_fields( 'seopress_bot_option_group' ); ?>
                        <?php do_settings_sections( 'seopress-settings-admin-bot-settings' ); ?>
                        <?php submit_button(); ?>
                    </form>
                </div>

            </div><!--seopress-tabs-->
        </div>
        <?php
    }
    /**
     * Returns the batch update completed message.
     *
     * @since 1.0.0
     *
     * @return string $message The batch update completed message.
     */
    public function get_success_message() {
        //Log date
        update_option('seopress-bot-log', current_time( 'Y-m-d H:i' ), 'yes');

        $message  = '<div class="updated"><p>' . esc_attr(__( 'The Scan is complete', 'wp-seopress-pro' )) . '</p></div>';
        $message .= '<p><a class="button button-secondary" href="' . add_query_arg( array( 'page' => $this->plugin_slug ), admin_url( 'admin.php?page=seopress-bot-batch' ) ) . '" title="' . esc_attr__( 'Rescan?', 'wp-seopress-pro' ) . '">' . esc_attr__(__( 'Rescan', 'wp-seopress-pro' )) . '</a></p>';
        return $message;
    }
    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The SEOPress_Bot_batch object.
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof SEOPress_Bot_batch ) ) {
            self::$instance = new SEOPress_Bot_batch();
        }
        return self::$instance;
    }
}
// Load the main plugin class.
$seopress_bot_batch = SEOPress_Bot_batch::get_instance();