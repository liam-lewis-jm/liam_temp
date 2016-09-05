<!-- By default, this menu will use off-canvas for small
         and a topbar for medium-up -->





<div class="rows">




    <div class="menu large-4 columns">
        <?php joints_top_nav(); ?>
    </div>



    <ul class="menu large-4 columns">
        <li><a href="<?php echo home_url(); ?>"><img src="/wp-content/themes/Ibiza-Theme/assets/images/logo.jpg" alt="<?php bloginfo('name'); ?>"  ></a></li>
    </ul>
    <div class="large-4  columns">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("searchbar")) : ?>

            <?php dynamic_sidebar('searchbar'); ?>

        <?php endif; ?>
    </div>
</div>

<div style="clear:both"></div>

<div class="top-bar" id="top-bar-menu">

    <div class="top-bar show-for-medium">
        h	
    </div>
    <div class="top-bar-right float-right show-for-small-only">
        <ul class="menu">
            <!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
            <li><a data-toggle="off-canvas"><?php _e('Menu', 'jointswp'); ?></a></li>
        </ul>
    </div>
</div>