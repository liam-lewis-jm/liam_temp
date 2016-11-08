<?php

global $ibiza_api;
?>
                            


            <!-- Thumbnails -->
            <main id="main" class="large-10 show-for-large product-category-page columns" role="main" >

                <section class="row" id="second-band">

                    <?php if (is_active_sidebar('pop-cat-1') && is_active_sidebar('pop-cat-2') ) : ?>

                    <article class="large-6 category-boxes catLarge columns">

                        <?php dynamic_sidebar('pop-cat-1'); ?>

                    </article>          

                    <article class="large-6 category-boxes catLargeRight columns">

                        <?php dynamic_sidebar('pop-cat-2'); ?>

                    </article>          


                    <?php else: ?>



                    <?php if (is_active_sidebar('pop-cat-1')) : ?>

                    <article class="large-6 category-boxes catLarge columns">

                        <?php dynamic_sidebar('pop-cat-1'); ?>

                    </article>          

                    <?php endif; ?>     

                    <?php if (is_active_sidebar('pop-cat-2')) : ?>

                    <article class="large-6 category-boxes catLargeRight columns">

                        <?php dynamic_sidebar('pop-cat-2'); ?>

                    </article>          

                    <?php endif; ?>     




                    <?php endif; ?> 

                    <div class="clear"></div>
                    
                    
                    <?php if (is_active_sidebar('pop-cat-3')) : ?>

                    <article class="large-12">

                        <?php dynamic_sidebar('pop-cat-3'); ?>

                    </article>

                    <?php endif; ?>        
                </section>

                <section class="row">
                    <article class="large-12 columns no-padding">
                        <?php dynamic_sidebar('featured-products'); ?>
                    </article>
                </section>

                <!-- End Thumbnails -->
            </main>
    <script type="text/javascript">
    // Height matching code
    function heightMatcher(A,B){
        jQuery(B).height('auto');
        jQuery(B).height(jQuery(B).height());/*This line stops decimal points*/
        jQuery(A).height(jQuery(B).height());
    };
    jQuery(document).ready(function(){
        jQuery('.height-as-width').height((jQuery('.height-as-width').width())*0.9);
        setTimeout(function(){
            heightMatcher('.catLarge','.catLargeRight');
            jQuery('.catLarge').find('*:not(h4)').css('height','100%');
        }, 300);
    });
    jQuery(window).resize(function(){
        jQuery('.height-as-width').height((jQuery('.height-as-width').width())*0.9);
        heightMatcher('.catLarge','.catLargeRight');
        //Put a minimum screen size in here where it is all reset to auto
    });
    </script>
    