<!-- By default, this menu will use off-canvas for small
         and a topbar for medium-up -->





<div class="rows">




    <div class="menu large-4 columns">
        
        
        <div class="top-bar" id="top-bar-menu">
            <?php joints_top_nav(); ?>
            <div class="top-bar-right float-right show-for-small-only">
                <ul class="menu">
                    <!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
                    <li><a data-toggle="off-canvas"><?php _e('Menu', 'jointswp'); ?></a></li>
                </ul>
            </div>
        </div>        
        
    </div>



    <div class="menu large-4 columns text-center">
        <a href="<?php echo home_url(); ?>"><img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg" alt="<?php bloginfo('name'); ?>"  ></a>
    </div>
    <div class="large-3  columns">
        <?php if (is_active_sidebar('searchbar')) : ?>

            <?php dynamic_sidebar('searchbar'); ?>

        <?php endif; ?>
    </div>
    <div class="large-1  columns" style="padding:0;">
        <?php if (is_active_sidebar('searchbar')) : ?>
        <div class="header-container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon.png" />
            <a href="#basket" class="upper">Basket</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<div style="clear:both"></div>

