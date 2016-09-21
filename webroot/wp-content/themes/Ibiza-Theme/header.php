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

        <script>var api_location = "<?php global $ibiza_api; echo $ibiza_api::api_location; ?>";</script>
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
                    <div class="fullwidth site-top-bar">
                        <div class="row show-for-xlarge-only">

                            <div class="large-4 columns">
                                <p class="font-small rating-text">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stars.png" />
                                    <span>Rated excellent by our customers</span>
                                </p>
                            </div>


                            <div class="large-4 columns text-center">
                                <img class="slogan" src="<?php echo get_template_directory_uri(); ?>/assets/images/slogan.png" title="" alt="" />
                            </div>                            


                            <div class="large-4 columns panel clearfix">

                                <ul class="menu right ">

                                    <?php if (_LOGGED_IN): ?>

                                        <li><a href="https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/account.aspx?_ga=1.111643779.624630137.1465816634">My Account</a></li>
                                        <li class="separator">|</li>
                                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>?logout=1">Logout</a></li>

                                    <?php else: ?>

                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-icon.png" title="" alt="" />
                                            <a class="font-small"   style="display: inline-block" href="https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/login.aspx?_ga=1.246909059.624630137.1465816634">Login / Register </a>
                                        </li>

                                    <?php endif; ?>

                                    <li class="separator">|</li>

                                    <li>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tel-icon.png" title="" alt="" />
                                        <a class="font-small" style="display: inline-block" href="tel:0800 6444 655">0800 6444 655</a>
                                    </li>
                                </ul>                    

                            </div>




                        </div>
                    </div>


                    <div class="fullwidth header-outter">
                        <nav class="header row upper" role="banner">

                            <!-- This navs will be applied to the topbar, above all content 
                                     To see additional nav styles, visit the /parts directory -->
                            <?php get_template_part('parts/nav', 'offcanvas-topbar'); ?>

                        </nav> <!-- end .header -->
                    </div>
                    
                    <div class="clear">&nbsp;</div>
                    
                    <div class="row" style="">
                        <div>
                        <div class="large-3  columns tv-channel-con">
                            <div class="row">
                                <div style="padding: 0px;" class="large-3  columns">
                                    <img src="http://localdev.jewellerymaker.com/wp-content/themes/Ibiza-Theme/assets/images/virgin-icon.png">
                                </div>

                                <div class="large-2  columns">
                                    <p style="font-size: 22px;margin:0; text-align: center;">80</p>
                                </div>

                                <div style="padding:  7px 0 0 6px ;" class="large-6  columns end ">
                                    <p style="font-weight: bold; font-size: 9px;margin:0;line-height:9px;">8am until midnight<br>7 days a weeks</p>
                                </div>
                            </div>


                        </div>

                        <div class="large-3  columns  tv-channel-con">
                            <div class="row">
                                <div style="padding: 0px;" class="large-3  columns">
                                    <img src="http://localdev.jewellerymaker.com/wp-content/themes/Ibiza-Theme/assets/images/freesat-icon.png">
                                </div>

                                <div class="large-2  columns" style="padding: 0px 0px;">
                                    <p style="font-size: 22px;margin:0;  text-align: center;">813</p>
                                </div>

                                <div style="padding:  7px 0 0 6px ;;" class="large-6  columns end ">
                                    <p style="font-weight: bold; font-size: 9px;margin:0;line-height:9px;">8am until midnight<br>7 days a weeks</p>
                                </div>
                            </div>


                        </div>

                        <div class="large-3  columns  tv-channel-con">
                            <div class="row">
                                <div style="padding: 0px;" class="large-3  columns">
                                    <img src="http://localdev.jewellerymaker.com/wp-content/themes/Ibiza-Theme/assets/images/sky-icon.png">
                                </div>

                                <div class="large-2  columns" style="padding: 0px 0px;">
                                    <p style="font-size: 22px;margin:0;  text-align: center;">617</p>
                                </div>

                                <div style="padding: 7px 0 0 6px ;" class="large-6  columns end ">
                                    <p style="font-weight: bold; font-size: 9px;margin:0;line-height:9px;">8am until midnight<br>7 days a weeks</p>
                                </div>
                            </div>


                        </div>

                        <div class="large-3  columns   tv-channel-con">
                            <div class="row">
                                <div style="padding: 0px;" class="large-3  columns">
                                    <img src="http://localdev.jewellerymaker.com/wp-content/themes/Ibiza-Theme/assets/images/freeview-icon.png">
                                </div>

                                <div class="large-2  columns" style="padding: 0px 0px;">
                                    <p style="font-size: 22px;margin:0; ; text-align: center;">76</p>
                                </div>

                                <div style="padding:  7px 0 0 6px ;" class="large-6  columns end ">
                                    <p style="font-weight: bold; font-size: 9px;margin:0;line-height:9px;">8am until midnight<br>7 days a weeks</p>
                                </div>
                            </div>


                        </div>

                        </div>

                    </div>                    
