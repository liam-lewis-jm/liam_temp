<?php

// Theme support options
require_once(get_template_directory() . '/assets/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory() . '/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory() . '/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory() . '/assets/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory() . '/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory() . '/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory() . '/assets/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory() . '/assets/translation/translation.php');

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



add_action('init', 'wpse71305_register_types');

/**
 * 
 */
function wpse71305_register_types() {

    //You'll need to register the country taxonomy here too.
    //Add 'country' tag.
    add_rewrite_tag('%products%', '([^&/]+)');

    //Register hotel post type with %country$ tag
    $args = array(
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'products-list/%products%',
            'with_front' => false,
            'feed' => true,
            'pages' => true
        )
    );
    register_post_type('product', $args);
}

add_filter('template_include', 'so_13997743_custom_template');

/**
 * 
 * @param string $template
 * @return string
 */
function so_13997743_custom_template($template) {

    $hasProduct = get_query_var('products');

    if ($hasProduct) {

        $template = plugin_dir_path(__FILE__) . 'product.php';
    }

    return $template;
}

/**
 * 
 * @global type $wpdb
 * @param type $key
 * @param type $type
 * @param type $status
 * @return type
 */
function get_meta_values($key = '', $type = 'post', $status = 'publish') {

    global $wpdb;

    if (empty($key)) {
        return;
    }

    $r = $wpdb->get_col($wpdb->prepare("
        SELECT p.post_parent FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND pm.meta_value !=  'null' 
        AND pm.meta_value !=  '' 
        LIMIT 1
    ", $key, $status));

    return $r;
}
/**
 * 
 * @global type $wpdb
 * @param type $menu_id
 * @param type $type
 * @param type $status
 * @return array
 */
function breacdcrumbs( $menu_id , $type = 'post' , $status = 'publish' ) {

    global $wpdb;

    $r = $wpdb->get_col($wpdb->prepare("
        SELECT p.id FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND pm.meta_value !=  'null' 
        AND pm.meta_value !=  '' 
        LIMIT 1
    ", $menu_id, $status));

    return array_reverse( crumb($r[0], 'publish' ));
}

/**
 * 
 * @global type $wpdb
 * @param type $id
 * @param string $status
 * @param type $output_arr
 * @return string
 */
function crumb($id , $status = 'publish' , $output_arr = array() ) {

    global $wpdb;

    $myrows = $wpdb->get_results(
        $wpdb->prepare($q = "
        SELECT p.post_title,  pm.meta_value AS pid,  pmm.* FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        LEFT JOIN {$wpdb->postmeta} pmm ON p.ID = pm.post_id AND pmm.meta_key  = '_menu_item_url' AND pmm.post_id ='%s'
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND pm.post_id =  '%s' 
        LIMIT 1", $id , '_menu_item_menu_item_parent', $status, $id)
    );
        
    /**
     * Point to note! Quuery joins the current menu item link to save to another query
     * Done by obatining the current menus link, it also retrieves the parent of the current level
     * To pass on to the self return if it !=0 ie the highest level
     */
        
    if ($myrows[0]->pid != 0) {

        $output_arr[] = '<a href="'. $myrows[0]->meta_value .'"> ' . $myrows[0]->post_title . ' </a>';
        return crumb($myrows[0]->pid, $status = 'publish', $output_arr);
        // return self call to get next level up
    } else {
        $output_arr[] = '<a href="/">Home page </a>';
        // top level add homepage link
    }

    return $output_arr;
}
