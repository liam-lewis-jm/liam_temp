<?php
/*
Template Name: Home Template
*/
?>

<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
                    <?php if(is_front_page()): ?>
                    
		    <main id="main" class="large-6 medium-6 columns" role="main">
				
                    <?php else:  ?>
                        
                    <main id="main" class="large-8 medium-8 columns" role="main">
		    
                    <?php endif; ?>
			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive' ); ?>
				    
				<?php endwhile; ?>	

					<?php joints_page_navi(); ?>
					
				<?php else : ?>
											
					<?php get_template_part( 'parts/content', 'missing' ); ?>
						
				<?php endif; ?>
					
                                        
                            <!-- Temp style -->
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/lIdJZXknVM0" frameborder="0" allowfullscreen></iframe>
                            
                            <h2>On todays show</h2>
                            
                            <ul>
                                
                                <li> -------- </li>
                                <li> -------- </li>
                                <li> -------- </li>
                                <li> -------- </li>
                                
                            </ul>
                            
                            
		    </main> <!-- end #main -->
		    
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("homepagesidebar") ) : ?>

                        <?php dynamic_sidebar( 'homepagesidebar' ); ?>

                    <?php endif; ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>