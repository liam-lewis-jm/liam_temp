<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php'); 

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php'); 

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php'); 



add_action('init','wpse71305_register_types');

function wpse71305_register_types(){

     //You'll need to register the country taxonomy here too.
     //Add 'country' tag.
     add_rewrite_tag('%products%', '([^&/]+)');

     //Register hotel post type with %country$ tag
    $args = array(  
        'has_archive'=>true,  
        'rewrite' => array(  
            'slug'=>'products-list/%products%',  
            'with_front'=> false,  
            'feed'=> true,  
            'pages'=> true  
        )  
    );  
    register_post_type('hotel',$args);  
}


add_filter( 'template_include', 'so_13997743_custom_template' );

function so_13997743_custom_template( $template )
{
    
    $hasProduct = get_query_var ( 'products' );
    
    if($hasProduct){
        
        $template = plugin_dir_path( __FILE__ ) . 'product.php';
    }
    

    return $template;
}