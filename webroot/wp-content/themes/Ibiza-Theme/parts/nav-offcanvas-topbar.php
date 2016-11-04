<!-- By default, this menu will use off-canvas for small
         and a topbar for medium-up -->





<div class="rows">




    <div class="menu large-4 columns show-for-large">
        
        <div class="top-bar" id="top-bar-menu">
            <?php joints_top_nav(); ?>
        </div>        
        
    </div>


    <div class="small-2 medium-4  hide-for-large columns medium-top-margin-push small-top-margin-push">
        <a data-toggle="off-canvas"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/menu.png" title="" alt="" /></a>
    </div> 


    <div class="small-2 show-for-small-only columns small-top-margin-push">
        <a data-toggle="off-canvas"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/telephone-icon.png" title="" alt="" /></a>
    </div>    

    <div class="menu large-4 small-4 columns text-center">
        <a href="<?php echo home_url(); ?>" class="show-for-small-only"><img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-logo.jpg" alt="<?php bloginfo('name'); ?>"  ></a>
        <a href="<?php echo home_url(); ?>" class="show-for-medium"><img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg" alt="<?php bloginfo('name'); ?>"  ></a>
    </div>
    <div class="large-2  small-1 small-push-1 medium-push-2 columns small-top-margin-push large-push-1 medium-right-align">
        <div class="header-container">
            <a href="#" class="search-link"><span class="show-for-large">Search</span></a>
        </div>
    </div>
    <div class="large-2 small-1  large-push-0  columns small-top-margin-push medium-right-align">
        <?php if (is_active_sidebar('searchbar')) : ?>
        <div class="header-container">
            <a href="#basket" class="upper  basket-link"><span class="show-for-large">Basket</span></a>
        </div>
        <?php endif; ?>
    </div>
</div>

<div style="clear:both"></div>

