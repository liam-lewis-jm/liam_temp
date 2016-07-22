<?php

include_once('IbizaPostTypePlugin_LifeCycle.php');

class IbizaPostTypePlugin_Plugin extends IbizaPostTypePlugin_LifeCycle {

    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return array of option meta data.
     */
    public function getOptionMetaData() {
        //  http://plugin.michael-simpson.com/?page_id=31
        return array(
            //'_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'ATextInput' => array(__('Enter in some text', 'my-awesome-plugin')),
            'AmAwesome' => array(__('I like this awesome plugin', 'my-awesome-plugin'), 'false', 'true'),
            'CanDoSomething' => array(__('Which user role can do something', 'my-awesome-plugin'),
                'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone')
        );
    }

//    protected function getOptionValueI18nString($optionValue) {
//        $i18nValue = parent::getOptionValueI18nString($optionValue);
//        return $i18nValue;
//    }

    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'Ibiza Post Type Plugin';
    }

    protected function getMainPluginFileName() {
        return 'ibiza-post-type-plugin.php';
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */
    protected function installDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
        //            `id` INTEGER NOT NULL");
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }

    /**
     * Perform actions when upgrading from version X to version Y
     * See: http://plugin.michael-simpson.com/?page_id=35
     * @return void
     */
    public function upgrade() {
        
    }

    
    function my_dashboard_setup_function() {
        //add_meta_box( 'my_dashboard_widget', 'My Widget Name', array( &$this,  'my_dashboard_widget_function' ) , 'dashboard', 'home_product', 'high' );
        add_meta_box( 'ContentScheduler_sectionid1', 
                __( 'Product Details', 
                'contentscheduler' ), 
                array($this, 'my_dashboard_widget_function'), 
                'home_product' , 'side' );   
        
        
    }
    function my_dashboard_widget_function() {
        // widget content goes here
        ?>
        
        <div id="product_image"><p></p></div>
        <div id="product_name"><p></p></div>
        <div id="product_price"><p></p></div>
        <script>
        
        
        function getProduct()
        {
            
            jQuery.getJSON( "http://52.18.1.60/ProductCatalog.Api/api/document/data.productcode/" + jQuery('#title').val()   , function( dataIn ) {
                var items = [];
                console.log( dataIn['data'] );
                //jQuery( '#product_name p' ).text( data.data.name );
                //jQuery( '#product_price p' ).text( data.data.price );
                //jQuery( '#product_image p' ).html( '<img src="' + data.data['images']['0']['url'] + '" />' );
            });            
            
        }
        
        jQuery( document ).ready(function( $ ) {
            
            getProduct();
            
            jQuery( "#title" ).keyup(function() {
                
                if( jQuery(this).val().length>3 ){
                    
                    getProduct();
                    

                    
                }
            });
        
        });        
        
        
        </script>
        <?php
    }     
    
    public function addActionsAndFilters() {

        // Add options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        //add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));
        //
        //
        add_action( 'admin_menu', array(&$this,  'my_dashboard_setup_function' ) );

        // Hooking up our function to theme setup
        add_action( 'init',array(&$this, 'create_posttype') );        
        
       
        
        // Example adding a script & style just for the options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        //        if (strpos($_SERVER['REQUEST_URI'], $this->getSettingsSlug()) !== false) {
        //            wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
        //            wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        }
        // Add Actions & Filters
        // http://plugin.michael-simpson.com/?page_id=37
        // Adding scripts & styles to all pages
        // Examples:
        //        wp_enqueue_script('jquery');
        //        wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
        // Register short codes
        // http://plugin.michael-simpson.com/?page_id=39
        // Register AJAX hooks
        // http://plugin.michael-simpson.com/?page_id=41
    }

    function create_posttype() {

        register_post_type('home', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
                // let's now add all the options for this post type
                array('labels' => array(
                'name' => __('Home Widgets', 'jointswp'), /* This is the Title of the Group */
                'singular_name' => __('Home', 'jointswp'), /* This is the individual type */
                'all_items' => __('All Home Page Content', 'jointswp'), /* the all items menu item */
                'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
                'add_new_item' => __('Add New Custom Type', 'jointswp'), /* Add New Display Title */
                'edit' => __('Edit', 'jointswp'), /* Edit Dialog */
                'edit_item' => __('Edit Post Types', 'jointswp'), /* Edit Display Title */
                'new_item' => __('New Post Type', 'jointswp'), /* New Display Title */
                'view_item' => __('View Post Type', 'jointswp'), /* View Display Title */
                'search_items' => __('Search Post Type', 'jointswp'), /* Search Custom Type Title */
                'not_found' => __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
                'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
                'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __('This is the example custom post type', 'jointswp'), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
            'rewrite' => array('slug' => 'site', 'with_front' => false), /* you can specify its url slug */
            'capability_type' => 'post',
            'hierarchical' => false,
            'taxonomies' => array('category', 'Test'),
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'taxonomies')
                ) /* end of options */
        ); /* end of register post type */
    

        register_post_type('home_product', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
                // let's now add all the options for this post type
                array('labels' => array(
                'name' => __('Home Product Widgets', 'jointswp'), /* This is the Title of the Group */
                'singular_name' => __('Home Product', 'jointswp'), /* This is the individual type */
                'all_items' => __('All Custom Posts', 'jointswp'), /* the all items menu item */
                'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
                'add_new_item' => __('Add New Product Home Page Content', 'jointswp'), /* Add New Display Title */
                'edit' => __('Edit', 'jointswp'), /* Edit Dialog */
                'edit_item' => __('Edit Post Types', 'jointswp'), /* Edit Display Title */
                'new_item' => __('New Post Type', 'jointswp'), /* New Display Title */
                'view_item' => __('View Post Type', 'jointswp'), /* View Display Title */
                'search_items' => __('Search Post Type', 'jointswp'), /* Search Custom Type Title */
                'not_found' => __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
                'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
                'parent_item_colon' => ''
            ), /* end of arrays */
            'description'           => __('This is the example custom post type', 'jointswp'), /* Custom Type Description */
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'show_ui'               => true,
            'query_var'             => true,
            'menu_position'         => 8, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon'             => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
            'rewrite'               => array('slug' => 'site', 'with_front' => false), /* you can specify its url slug */
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'taxonomies'            => array('category', 'Test'),
            /* the next one is important, it tells what's enabled in the post editor */
            'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'taxonomies')
                ) /* end of options */
        ); /* end of register post type */
        
        
//        add_meta_box( 'ContentScheduler_sectionid', 
//                __( 'Content Scheduler', 
//                'contentscheduler' ), 
//                array($this, 'ContentScheduler_custom_box_fn'), 
//                'home_product' );
//        
//    }

}



        // b. Print / draw the box callback
        function ContentScheduler_custom_box_fn()
        {
            // need $post in global scope so we can get id?
            global $post;
            // Use nonce for verification
            wp_nonce_field( 'content_scheduler_values', 'ContentScheduler_noncename' );
            // Get the current value, if there is one
            $the_data = get_post_meta( $post->ID, '_cs-enable-schedule', true );
            $the_data = ( empty( $the_data ) ? 'Disable' : $the_data );
            // Checkbox for scheduling this Post / Page, or ignoring
            $items = array( "Disable", "Enable");
            foreach( $items as $item)
            {
                $checked = ( $the_data == $item ) ? ' checked="checked" ' : '';
                echo "<label><input ".$checked." value='$item' name='_cs-enable-schedule' id='cs-enable-schedule' type='radio' /> $item</label>  ";
            } // end foreach
            echo "<br />\n<br />\n";
            // Field for datetime of expiration
            // TODO datetime conversion
            // should be unix timestamp at this point, in UTC
            // for display, we need to convert this to local time and then format
            
            // datestring is the original human-readable form
            // $datestring = ( get_post_meta( $post->ID, '_cs-expire-date', true) );
            // timestamp should just be a unix timestamp
            $timestamp = ( get_post_meta( $post->ID, '_cs-expire-date', true) );
            if( !empty( $timestamp ) ) {
                // we need to convert that into human readable so we can put it into our field
                $datestring = DateUtilities::getReadableDateFromTimestamp( $timestamp );
            } else {
                $datestring = '';
            }
            // Should we check for format of the date string? (not doing that presently)
            echo '<label for="cs-expire-date">' . __("Expiration date and hour", 'contentscheduler' ) . '</label><br />';
            echo '<input type="text" id="cs-expire-date" name="_cs-expire-date" value="'.$datestring.'" size="25" />';
            echo '<br />Input date and time in any valid Date and Time format.';
        }

        // c. Save data from the box callback
        function ContentScheduler_save_postdata_fn( $post_id )
        {
            // verify this came from our screen and with proper authorization,
            // because save_post can be triggered at other times
            if( !empty( $_POST['ContentScheduler_noncename'] ) )
            {
                if ( !wp_verify_nonce( $_POST['ContentScheduler_noncename'], 'content_scheduler_values' ))
                {
                    return $post_id;
                }
            }
            else
            {
                return $post_id;
            }
            // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
            // to do anything
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
            {
                return $post_id;
            }
            // Check permissions, whether we're editing a Page or a Post
            if ( 'page' == $_POST['post_type'] )
            {
                if ( !current_user_can( 'edit_page', $post_id ) )
                return $post_id;
            }
            else
            {
                if ( !current_user_can( 'edit_post', $post_id ) )
                return $post_id;
            }
            
            // OK, we're authenticated: we need to find and save the data
            // First, let's make sure we'll do date operations in the right timezone for this blog
            // $this->setup_timezone();
            // Checkbox for "enable scheduling"
            $enabled = ( empty( $_POST['_cs-enable-schedule'] ) ? 'Disable' : $_POST['_cs-enable-schedule'] );
            // Value should be either 'Enable' or 'Disable'; otherwise something is screwy
            if( $enabled != 'Enable' AND $enabled != 'Disable' )
            {
                // $enabled is something we don't expect
                // let's make it empty
                $enabled = 'Disable';
                // Now we're done with this function?
                return false;
            }
            // Textbox for "expiration date"
            $dateString = $_POST['_cs-expire-date'];            
            $offsetHours = 0;
            // if it is empty then set it to tomorrow
            // we just want to pass an offset into getTimestampFromReadableDate since that is where our DateTime is made
            if( empty( $dateString ) ) {
                // set it to now + 24 hours
                $offsetHours = 24;
            }
            // TODO handle datemath if field reads "default"
            if( trim( strtolower( $dateString ) ) == 'default' )
            {
                // get the default value from the database
                $default_expiration_array = $this->options['exp-default'];
                if( !empty( $default_expiration_array ) )
                {
                    $default_hours = $default_expiration_array['def-hours'];
                    $default_days = $default_expiration_array['def-days'];
                    $default_weeks = $default_expiration_array['def-weeks'];
                }
                else
                {
                    $default_hours = '0';
                    $default_days = '0';
                    $default_weeks = '0';
                }
            
                // we need to move weeks into days and days into hours
                $default_hours += ( $default_weeks * 7 + $default_days ) * 24 * 60 * 60;
                
                // if it is valid, get the published or scheduled datetime, add the default to it, and set it as the $date
                if ( !empty( $_POST['save'] ) )
                {
                    if( $_POST['save'] == 'Update' )
                    {
                        $publish_date = $_POST['aa'] . '-' . $_POST['mm'] . '-' . $_POST['jj'] . ' ' . $_POST['hh'] . ':' . $_POST['mn'] . ':' . $_POST['ss'];
                    }
                    else
                    {
                        $publish_date = $_POST['post_date'];
                    }
                    // convert publish_date string into unix timestamp
                    $publish_date = DateUtilities::getTimestampFromReadableDate( $publish_date );
                }
                else
                {
                    $publish_date = time(); // current unix timestamp
                    // no conversion from string needed
                }
                
                // time to add our default
                // we need $publish_date to be in unix timestamp format, like time()
                $expiration_date = $publish_date + $default_hours * 60 * 60;
                $_POST['_cs-expire-date'] = $expiration_date;
            }
            else
            {
                $expiration_date = DateUtilities::getTimestampFromReadableDate( $dateString, $offsetHours );
            }
            // We probably need to store the date differently,
            // and handle timezone situation
            update_post_meta( $post_id, '_cs-enable-schedule', $enabled );
            update_post_meta( $post_id, '_cs-expire-date', $expiration_date );
            return true;
        }

}