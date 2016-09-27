<?php
/*
  Template Name: Home Template
 */
?>

<?php get_header(); ?>

<div id="content">
    
    <div id="operationLogInfo"></div>
    
    <div id="inner-content" class="row">

        <?php if (is_front_page()): ?>

            <main id="main" class="large-8 medium-8 columns" role="main">

            <?php else: ?>

            <main id="main" class="large-8 medium-8 columns" role="main">

            <?php endif; ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <!-- To see additional archive styles, visit the /parts directory -->
                        <?php get_template_part('parts/loop', 'archive'); ?>

                    <?php endwhile; ?>	

                    <?php joints_page_navi(); ?>

                <?php else : ?>

                    <?php get_template_part('parts/content', 'missing'); ?>

                <?php endif; ?>

                <!-- Temp style -->
                <div id="dvVideoHolderHome" style="background-color: #000">
                    <img style="width:100%" src="//cdn.jewellerymaker.com/global/img/tv-preview.jpg" />
                </div>       

                <!-- temp inline as design not final -->
                <div class="text-center show-for-xlarge" id="tv-options">
                    <div class="large-6 columns" style="padding-right: 0;border-right: 1px solid #e1e1e1;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/tv-icon.png" /> <a href="/tv-schedule/" class="upper">View the TV Schedule</a></div>
                    <div class="large-6 columns" style="padding-left: 0"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" /> <a href="" class="upper">View all products from Today</a></div>
                </div>
                
                <?php if (is_active_sidebar('homepageleft')) : ?>

                    <?php dynamic_sidebar('homepageleft'); ?>

                <?php endif; ?>                

            </main> <!-- end #main -->

            
            <?php if (is_active_sidebar('homepagesidebar')) : ?>

                <?php dynamic_sidebar('homepagesidebar'); ?>

            <?php endif; ?>

    </div> <!-- end #inner-content -->
    
    
    

    
    
</div> <!-- end #content -->


<div class="row show-for-xxlarge">
        <div class="medium-6 medium-centered">
               <div class="row">

                        <div style="background: white none repeat scroll 0% 0%; padding-left: 0px;" class="medium-6 columns">
                          <div style="position: relative; vertical-align: bottom; height: 49px; line-height: 49px; display: inline-block; background: rgb(76, 235, 233) none repeat scroll 0px 0px; padding: 0px 10px;">
                          On Now
                          <div style="width: 0px; height: 0px; border-style: solid; border-width: 24.5px 0px 24.5px 21px; border-color: transparent transparent transparent rgb(76, 235, 232); position: absolute; top: 0px; right: -21px;">
                              
                          </div>
                          </div>
                            
                            <div class="tv-schedule-details">
                              <p>08:00 - 09:00</p>
                              <p>Title of the show and who the presenter</p>
                            </div>
                        </div>
                   
                        <div style="background: white none repeat scroll 0% 0%; padding-left: 0px;" class="medium-6 columns">
                          <div style="position: relative; vertical-align: bottom; height: 49px; line-height: 49px; display: inline-block; background: rgb(76, 235, 233) none repeat scroll 0px 0px; padding: 0px 10px;">
                          On Next
                            <div style="width: 0px; height: 0px; border-style: solid; border-width: 24.5px 0px 24.5px 21px; border-color: transparent transparent transparent rgb(76, 235, 232); position: absolute; top: 0px; right: -21px;"></div>
                          </div>

                            <div class="tv-schedule-details">
                              <p>08:00 - 09:00</p>
                              <p>Title of the show and who the presenter</p>
                            </div>                            
                            

                        </div>                        
               
               
               </div><!-- /.row -->
        </div><!-- /.medium-6.center -->
</div>

<div style="margin-top: 35px; background: rgb(255, 255, 255) url(/wp-content/themes/Ibiza-Theme/assets/images/fold-bg.png) repeat-x scroll 0px 0px;" class="fullwidth">

    <section class="row" id="second-band">

        <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>
        <div class="text-center">
                <?php dynamic_sidebar('homepagebelowmaincontent'); ?>
        </div>
        <?php endif; ?>

        <?php if (is_active_sidebar('homepagebelowmaincontent_left1') && is_active_sidebar('homepagebelowmaincontent_left2') ) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-3 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left1'); ?>

        </article>          

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-3 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left2'); ?>

        </article>          


        <?php else: ?>



        <?php if (is_active_sidebar('homepagebelowmaincontent_left1')) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-6 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left1'); ?>

        </article>          

        <?php endif; ?>     

        <?php if (is_active_sidebar('homepagebelowmaincontent_left2')) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-6 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left2'); ?>

        </article>          

        <?php endif; ?>     




        <?php endif; ?> 


        <?php if (is_active_sidebar('homepagebelowmaincontent_right')) : ?>

        <article class="learning__item box1--videos mobile-full tablet-and-up-half ">

            <?php dynamic_sidebar('homepagebelowmaincontent_right'); ?>

        </article>         

        <?php endif; ?>  

        <div class="clear"></div>
        
        
        <?php if (is_active_sidebar('homepagebelowmaincontent_full')) : ?>

        <article class="large-12">

            <?php dynamic_sidebar('homepagebelowmaincontent_full'); ?>

        </article>

        <?php endif; ?>        
        

    </section>        

</div>


    <section class="row" id="third-band">

        <?php if (is_active_sidebar('homepagebelowmaincontent_full2')) : ?>

        <article class="">

            <?php dynamic_sidebar('homepagebelowmaincontent_full2'); ?>

        </article>

        <?php endif; ?>

    </section>


<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/vendor/plugins/jwplayer/jwplayer.js"></script>
<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/video.js"></script>
<script type="text/javascript">
    jQuery(function () {

        jQuery('[id$="dvVideoHolderHome"]').Video({
            container      : 'dvVideoHolderHome',
            channel        : 'JEWELLERYMAKER',
            autoStart      : true,
            controls       : false,
            mute           : true,
            pageIdentifier : 'homepage',
            edge           : ''
        });

       jQuery('#add-basket').click( function( e ){

           var quantity    = 1;

           jQuery.ajax({
               dataType  : 'json' ,
               url: 'http://<?php echo $_SERVER['SERVER_NAME']; ?>/proxy.php?auctionID=-1&productCode=<?php echo 'WTTY01'; //$response['_source']['legacyCode']; ?>&productDetailID=<?php echo '361247'; //$response['_source']['product']['productDetailId']; ?>&quantity=' + quantity
           }).done(function( data ) {

               jQuery('#basket-total').text('£' +  data.BasketTotal );
               jQuery('#basket-description').text('£' +  data.Description );                    
               window.location = 'https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/basket.aspx';

             });
        });              

    });
</script>
<?php get_footer(); ?>