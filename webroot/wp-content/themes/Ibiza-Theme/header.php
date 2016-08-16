<!doctype html>

<html class="no-js"  <?php language_attributes(); ?>>

    <head>
        <meta charset="utf-8">

        <!-- Force IE to use the latest rendering engine available -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta class="foundation-mq">

        <!-- If Site Icon isn't set in customizer -->
        <?php if (!function_exists('has_site_icon') || !has_site_icon()) { ?>
            <!-- Icons & Favicons -->
            <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
            <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
            <!--[if IE]>
                    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
            <![endif]-->
            <meta name="msapplication-TileColor" content="#f01d4f">
            <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">
        <?php } ?>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>

        <!-- Drop Google Analytics here -->
        <!-- end analytics -->


    </head>

    <!-- Uncomment this line if using the Off-Canvas Menu --> 

    <body <?php body_class(); ?> >

<!--        <div class="header" style="margin: 0px;  overflow: hidden;">

        </div>-->

        <div class="off-canvas-wrapper">

            <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

                <?php get_template_part('parts/content', 'offcanvas'); ?>
                <?php get_template_part('parts/content', 'offcanvas_left'); ?>

                <div class="off-canvas-content" data-off-canvas-content>
                
                    
                    
                    
            <div class="row show-for-xlarge-only">
                <div class="large-6 columns">
                    
                    
                    <ul class="menu">
                        
                      <?php if(_LOGGED_IN): ?>
                      
                      <li><a href="https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/account.aspx?_ga=1.111643779.624630137.1465816634">My Account</a></li>
                        
                      <?php else:?>
                        
                      <li><a href="https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/login.aspx?_ga=1.246909059.624630137.1465816634">Sign up / Login</a></li>
                      
                      <?php endif; ?>
                      <li><a href="tel:0800 6444 655">0800 6444 655</a></li>
                      <li><a href="#">92815 Independent Reviews</a></li>
                    </ul>                    
                                        
                    
                </div>
                <div class="large-6 columns">
                    
                    
                    <ul class="menu float-right">
                      <li><a href="https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/basket.aspx?_ga=1.141642677.624630137.1465816634">Your Bag</a></li>
                    </ul>                    
                    
                    
                </div>
            </div>                    
                    
                    <nav class="header row" role="banner">

                        <!-- This navs will be applied to the topbar, above all content 
                                 To see additional nav styles, visit the /parts directory -->
                        <?php get_template_part('parts/nav', 'offcanvas-topbar'); ?>

                    </nav> <!-- end .header -->