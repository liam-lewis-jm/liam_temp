<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->





<div class="rows">
    
    
    
    
    <div class="menu large-4 columns">
<p>Watch Live TV Channel On:</p>

<span>Virgin 756, Freesat 807,<br>
Sky 665, Freeview 76 (8am-12pm)
    </span></div>
    
    
    
    <ul class="menu large-4 columns">
        <li><a href="<?php echo home_url(); ?>"><img height="100" src="http://ibiza.co.uk/wp-content/uploads/2013/12/ibiza-2014.png" alt="<?php bloginfo('name'); ?>" style="height: 75px ! important;"></a></li>
    </ul>
    <div class="large-4  columns">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("searchbar") ) : ?>
    
            <?php dynamic_sidebar( 'searchbar' ); ?>
    
        <?php endif; ?>
    </div>
</div>

<div style="clear:both"></div>

<div class="top-bar" id="top-bar-menu">

	<div class="top-bar show-for-medium">
		<?php joints_top_nav(); ?>	
	</div>
	<div class="top-bar-right float-right show-for-small-only">
		<ul class="menu">
			<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
			<li><a data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
		</ul>
	</div>
</div>