<?php

include_once('IbizaApi_LifeCycle.php');

class IbizaApi_Plugin extends IbizaApi_LifeCycle {

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
        return 'Ibiza API';
    }

    protected function getMainPluginFileName() {
        return 'ibiza-api.php';
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

    public function addActionsAndFilters() {

        // Add options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));

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

    // start ibiza api function 
    
    /**
     * start class variables
     */
    const   api_location            = 'http://ibizaschemas.product';
    const   top_level_category      = '32';
    const   wp_menu_id              = '2';
    private $end_points             = array('product_list'  => '/ProductCatalog.Api/api/category/categoryId/'       , 
                                            'price_range'   => '/ProductCatalog.Api/api/pricerange/range/'          ,
                                            'product'       => '/ProductCatalog.Api/api/document/data.productcode/' ,
                                            'product_schema'=> '/productcatalog.api/api/schema/title/'              ,
        );    
    public  $is_top_level           = false;
    private $sort                   = array(0 => 'Default', 1 => 'Price (Low - High)', 2 => 'Price (High - Low)');
    private $page_sizes             = array(1, 5, 12, 20, 50, 100, 200);
    private $ignore_query_strs      = array( 'cat' , 'title' , 'count' , 'sort' , 'pager' , 'q' );
    private $facetsOb               = null;
    /**
     * end class variables
     */    
    
    
    
    
    /**
     * 
     * @return string
     */
    public function get_product_list_title( $title ) {

        // make it safe, method found in fucntions.php
        $title  = $this->sanitize($title);

        // other custom stuff, as requested
        if (isset($_GET['q'])) {

            if (stripos($_GET['q'], 'how') !== false) {
                $title = 'How To';
            } else {
                $title = 'Products';
            }
        }

        return $title;
    }

    /**
     * 
     * @return int
     */
    public function get_product_list_category($cat) {

        // make it safe, method found in fucntions.php
        $category = $this->sanitize($cat);

        return (int) $category;
    }

    /**
     * 
     * @return string
     */
    public function get_product_list_api_url($category) {

        return $this::api_location . $this->end_points['product_list'] .  (int)$category;
    }

    /**
     * 
     * @return Array
     */
    public function get_product_list_sort_options() {

        return $this->sort;
    }

    /**
     * 
     * @return Array
     */
    public function get_product_list_ignored_query_strings() {

        return $this->ignore_query_strs;
    }

    /**
     * 
     * @return Array
     */
    public function get_product_list_pages_sizes() {

        return $this->page_sizes;
    }


    /**
     * 
     * @global type $wpdb
     * @param type $cat
     * @return type
     */
    public function get_product_list_top_level_categorys( $cat ) 
    {

        global $wpdb;
        $r              = $wpdb->get_col($wpdb->prepare("
        SELECT p.id FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND pm.meta_value !=  'null' 
        AND pm.meta_value !=  '' 
        LIMIT 1
        ", 'cat-' . $cat));


        // some be able to find the shop menu, and get correct place automaticly.
        $items          = wp_get_nav_menu_items( $this::wp_menu_id );
        $catss          = array();
        
        foreach ($items as $item) {

            if ($item->ID == $r[0] && $item->menu_item_parent == $this::top_level_category ) {
                $this->is_top_level = true;
            }

            if ($item->menu_item_parent == $r[0]) {

                $catss[$item->post_title] = (object) $item;
            }
        }


        ksort($catss);
        
        return $catss;
        
    }
    
    /**
     * 
     * @param type $jsonPath
     * @return array
     */
    public function get_product_list_facets( $jsonPath ) 
    {
        
        $facetsJSON         = @file_get_contents($jsonPath);
        // remove suppression on production
        $this->facetsOb           = json_decode($facetsJSON);


        if(!$this->facetsOb) {
            $facets = array();
        }else{
            $facets = $this->facetsOb[0]->facets;
        }        
        
        return $facets;
    }
    
    /**
     * 
     * @return type
     */
    public function get_product_list_price_range() 
    {
        
        $rangePath      = $this::api_location .  $this->end_points['price_range'] .  '0/20000';
        $rangeJSON      = @file_get_contents($rangePath);
        $range          = json_decode($rangeJSON);      
        
        return $range;
    }
    
    /**
     * 
     * @return Object
     */
    public function get_product_list_facets_object()
    {
        return $this->facetsOb;
    }
    
    
    // start product page
    
    /**
     *
     * @var array 
     */
    private $core_atrributes = array( 'name'             => 1 ,
                                     'description'      => 1 ,
                                     'productcode'      => 1 ,
                                     'legacycode'       => 1 ,
                                     'price'            => 1 ,
                                     'images'           => 1 ,
                                     'review'           => 1 ,
                                     'category'         => 1 ,
                                     '_mongo'           => 1 ,
                                     '_schema'          => 1 ,
                                     '_category'        => 1 ,
                                     'items'            => 1 );
    
    
    /**
     * Retrieve a product from MongoDB using a product code
     * @param type $product_code
     * @return object
     */
    public function get_product($product_code)
    {
        
        $json_contents          = file_get_contents($this::api_location . $this->end_points['product'] .  strtoupper(  $this->sanitize( $product_code ) ) );
        $rst                    = json_decode( $json_contents );
        
        $this::api_location . $this->end_points['product'] . strtoupper( $this->sanitize( $product_code ) );
        
        return $rst;
    }    
    
    
    /**
     * Retrieve a product from MongoDB using a product code
     * @param type $product_code
     * @return object
     */
    public function get_product_schema($schema)
    {
        
        $json_contents          = file_get_contents($this::api_location . $this->end_points['product_schema'] .   $schema  );
        
        $rst                    = json_decode( $json_contents );
        return $rst;
    }
    
    
    public function get_core_attributes()
    {
        return $this->core_atrributes;
    }
    
    
    // end product page
    
    
    
    // end ibiza api function 
    /**
     * 
     */  
    function sanitize($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                       "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }    
    

}
