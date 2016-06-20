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


function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {

    global $wpdb;

    if( empty( $key ) ) {
        return;
    }

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND pm.meta_value !=  'null' 
        AND pm.meta_value !=  '' 
        LIMIT 1
    ", $key, $status  ) );

    return $r;
}


class SH_BreadCrumbWalker extends Walker{
    /**
     * @see Walker::$tree_type
     * @var string
     */
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    /**
     * @see Walker::$db_fields
     * @var array
     */
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * delimiter for crumbs
     * @var string
     */
    var $delimiter = ' > ';

    /**
     * @see Walker::start_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth, $args) {

        //Check if menu item is an ancestor of the current page
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $current_identifiers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' ); 
        $ancestor_of_current = array_intersect( $current_identifiers, $classes );     


        if( $ancestor_of_current ){
            $title = apply_filters( 'the_title', $item->title, $item->ID );

            //Preceed with delimter for all but the first item.
            if( 0 != $depth )
                $output .= $this->delimiter;

            //Link tag attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            //Add to the HTML output
            $output .= '<a'. $attributes .'>'.$title.'</a>';
        }
    }
}

 echo wp_nav_menu( array( 
    'container' => 'none', 
    'theme_location' => 'primary',
    'walker'=> new SH_BreadCrumbWalker, 
    'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
 ) );
