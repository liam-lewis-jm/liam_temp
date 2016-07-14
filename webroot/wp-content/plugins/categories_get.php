<?php

/**
 * @package Get_Menu_Categories
 * @version 1.0
 */
/*
  Plugin Name: Get Menu Categories
  Plugin URI: http://wordpress.org/plugins/hello-dolly/
  Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
  Author: Matt Mullenweg
  Version: 1.6
  Author URI: http://ma.tt/
 */


define('TOP_NODE', 'categories');
define('PARENT_MENU_ID', '32');

/**
 * 
 */
class Topbar1_Menu_Walker extends Walker_Nav_Menu {

    public $sub_menu_arr = array();

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {


        if ($item->menu_item_parent == 32 OR in_array($item->menu_item_parent, $this->sub_menu_arr)) {
            $this->sub_menu_arr[$item->ID] = $item->ID;

            wp_delete_post($item->ID, true);
        }
    }

}
/**
 * 
 * @return type
 */
function get_json() {

    $jsonPath =  'http://ibizaschemas.product/ProductCatalog.Api/api/categorytree';  //get_template_directory() . '/assets/json/menu.json';
    $cats = json_decode(file_get_contents($jsonPath));

    
    return $cats[0]->{TOP_NODE};
}
/**
 * 
 * @param type $menu_id
 * @param type $new_menu_id
 * @param type $title
 * @param type $menu_position
 * @param type $parent_menu_id
 * @param type $menu_type
 * @return type
 */
function update_menu($menu_id, $new_menu_id, $title, $menu_position = 0, $parent_menu_id = PARENT_MENU_ID, $menu_type = 'custom') {


    return wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $parent_menu_id,
//        'menu-item-db-id'   => $new_menu_id , 
        'menu-item-position' => $menu_position,
        'menu-item-object' => 'page',
        'menu-item-type' => $menu_type,
        'menu-item-status' => 'publish',
        'menu-item-url' => '/products-list?cat=' . $new_menu_id . '&title=' . $title ,
        'menu-item-title' => $title,
    ));
}
/**
 * 
 * @param type $data
 * @param type $menu_id
 * @param type $parent_id
 */
function add_menu( $data, $menu_id, $parent_id = 0 ) {
    
    foreach ($data as $key1 => $dataIn) {

        $child_menu_id = update_menu($menu_id, $dataIn->id, $dataIn->title, $key1, $parent_id);

        update_post_meta($child_menu_id,  'cat-' . $dataIn->id  , '1' );
        // 1 has now use, ignore
        if (count($dataIn->nodes) > 0) {

            add_menu($dataIn->nodes, $menu_id, $child_menu_id);

        }
    }
}
/**
 * 
 */
function do_menu() {

    

    
    wp_nav_menu(array(
        'echo' => false,
        'fallback_cb' => false, // Fallback function (see below)
        'walker' => new Topbar1_Menu_Walker(),
    ));



    $menuname = 'Main';
    $menu_exists = wp_get_nav_menu_object($menuname);
    $menu_id = $menu_exists->term_id;



    $jsonData = get_json();

    if ($menu_exists) {
        add_menu($jsonData, $menu_id, $parent_id = PARENT_MENU_ID);
    }
}


if( $_GET['refresh_ibiza_menu'] == 1  ){
    
    add_action( 'init', 'do_menu' );
    header( 'Location: /wp-admin/nav-menus.php' );
    
}

global $pagenow;

if( $pagenow == 'nav-menus.php' ){
    
    wp_enqueue_script( 'menurefresh-js', get_template_directory_uri()  . '/assets/js/admin-scripts.js', array( 'jquery' ), '', true );
    
}












?>
