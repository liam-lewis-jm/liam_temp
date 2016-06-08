<?php
/*
Template Name: Home Template
*/
?>

<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
                    <?php if(is_front_page()): ?>
                    
		    <main id="main" class="large-5 medium-5 columns" role="main">
				
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
                            <div style="background: grey;width:100%;height:250px;">


                            </div>
		    </main> <!-- end #main -->
		    
		    <?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>