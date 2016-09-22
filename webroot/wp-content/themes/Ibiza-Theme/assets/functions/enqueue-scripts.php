<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  global $ibiza_api;
    // Load What-Input files in footer
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/what-input.min.js', array(), '', true );
    
    // Adding Foundation scripts file in the footer
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.js', array( 'jquery' ), '6.2', true );
    
    // Adding scripts file in the footer
    
    // Adding swiper scripts file in the footer
    wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/vendor/Swiper/dist/js/swiper.jquery.min.js', array( 'jquery' ), '', true );
    
    
    
    // Adding swiper scripts file in the footer
    wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/vendor/fancybox/source/jquery.fancybox.js', array( 'jquery' ), '', true );
   
    wp_enqueue_script( 'signalr-js', get_template_directory_uri() . '/vendor/signalr/jquery.signalR.min.js', array( 'jquery' ), '', true );
    
    
    
    wp_enqueue_script( 'hub-js',  $ibiza_api::api_location . '/ProductCatalog.Api/signalr/hubs', array( 'jquery' ), '', true );
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );

    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );
   
    // Register main swiper stylesheet
    wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/vendor/Swiper/dist/css/swiper.min.css', array(), '', 'all' );
   
    // Register main swiper stylesheet
    wp_enqueue_style( 'fancy-css', get_template_directory_uri() . '/vendor/fancybox/source/jquery.fancybox.css', array(), '', 'all' );

    
    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);