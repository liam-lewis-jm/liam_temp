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
                    <article class="large-12 columns">
                        <?php dynamic_sidebar('featured-products'); ?>
                    </article>
                </section>

                <!-- End Thumbnails -->
            </main>
    <script type="text/javascript">
    // Height matching code
    function heightMatcher(A,B){
        jQuery(B).height('auto');
        jQuery(B).height(jQuery(B).height());
        jQuery(A).height(jQuery(B).height());
    };
    jQuery(document).ready(function(){
        heightMatcher('.catLarge','.catLargeRight');
        jQuery('.catLarge').find('*').css('height','100%');
    });
    jQuery(window).resize(function(){
        heightMatcher('.catLarge','.catLargeRight');
    });
    </script>
    