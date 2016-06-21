<?php

/**
 * @package Register_Ibiza_Posttypes
 * @version 1.0
 */
/*
  Plugin Name: Register Ibiza Posttypes
  Plugin URI: http://wordpress.org/plugins/hello-dolly/
  Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
  Author: Matt Mullenweg
  Version: 1.6
  Author URI: http://ma.tt/
 */

function create_posttype() {

    register_post_type( 'home', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
            // let's now add all the options for this post type
            array('labels' => array(
                    'name' => __('Home Widgets', 'jointswp'), /* This is the Title of the Group */
                    'singular_name' => __('Home', 'jointswp'), /* This is the individual type */
                    'all_items' => __('All Custom Posts', 'jointswp'), /* the all items menu item */
                    'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
                    'add_new_item' => __('Add New Custom Type', 'jointswp'), /* Add New Display Title */
                    'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
                    'edit_item' => __('Edit Post Types', 'jointswp'), /* Edit Display Title */
                    'new_item' => __('New Post Type', 'jointswp'), /* New Display Title */
                    'view_item' => __('View Post Type', 'jointswp'), /* View Display Title */
                    'search_items' => __('Search Post Type', 'jointswp'), /* Search Custom Type Title */ 
                    'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */ 
                    'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
                    'parent_item_colon' => ''
                    ), /* end of arrays */
                    'description' => __( 'This is the example custom post type', 'jointswp' ), /* Custom Type Description */
                    'public' => true,
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'show_ui' => true,
                    'query_var' => true,
                    'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
                    'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
                    'rewrite'	=> array( 'slug' => 'site', 'with_front' => false ), /* you can specify its url slug */
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    /* the next one is important, it tells what's enabled in the post editor */
                    'supports' => array( 'title', 'editor',  'thumbnail', 'excerpt',  'custom-fields',  'revisions')
            ) /* end of options */
    ); /* end of register post type */
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
