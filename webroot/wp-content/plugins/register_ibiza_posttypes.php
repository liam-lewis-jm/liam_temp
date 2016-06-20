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

	register_post_type( 'home',
		array(
			'labels' => array(
				'name' => __( 'Home Widgets' ),
				'singular_name' => __( 'Home' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'site'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
