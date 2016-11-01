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

            <main id="main" class="large-6 medium-12 columns" role="main">

            <?php else: ?>

            <main id="main" class="large-6 medium-12 columns" role="main">

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
                    <img style="width: 100%" src="/global/img/tv-preview.jpg" />
                </div>
                        
                        
                        <!-- temp inline as design not final -->
                <div class="text-center show-for-large" id="tv-options">
                    <div class="large-6 columns" style="padding-right: 0;border-right: 1px solid #e1e1e1;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tv-icon.png" /> <a href="/tv-schedule/" class="upper">View the TV Schedule</a>
                    </div>
                    <div class="large-6 columns" style="padding-left: 0">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" /> <a href="/todays-products/" class="upper">View all products from Today</a>
                    </div>
                </div> 
                
                
            </main> <!-- end #main -->

            
            
            <?php if (is_active_sidebar('homepagebelowmaincontent_left1')) : ?>
                <div class="large-6 medium-12 columns">
                    <?php dynamic_sidebar('homepagebelowmaincontent_left1'); ?>
                </div>

            <?php endif; ?>
            

            
            <div class="text-center medium-4 small-12 column show-for-small hide-for-large" id="tv-options">
                <div class="medium-6 small-6 columns" style="padding-left: 0;">
                    
                    <div class="block">
                        <div class="centered">
                    
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tv-icon.png" /> 
                            <a href="/tv-schedule/" class="upper">View the TV Schedule</a>
                    
                        </div>
                    </div>
                </div>
                    
                <div class="medium-6 small-6 columns" style="padding-left: 0">
                    
                    <div class="block">
                        <div class="centered">
                    
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" />
                            <a href="" class="upper">View all products from Today</a>
                            
                        </div>
                    </div>
                </div>
            </div>                
            
            

    </div> <!-- end #inner-content -->
    
    
    

    
    
</div> <!-- end #content -->


<div style="margin-top: 35px; background: rgb(255, 255, 255);" class="fullwidth">

    <section class="row" id="second-band">

        <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>
        <div class="text-center">
                <?php dynamic_sidebar('homepagebelowmaincontent'); ?>
        </div>
        <?php endif; ?>
    

        <?php if (is_active_sidebar('homepagebelowmaincontent_left2')) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-6 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left2'); ?>

        </article>          

        <?php endif; ?>     


        <?php if (1 == 2 && is_active_sidebar('homepagebelowmaincontent_right')) : ?>

        <article class="learning__item box1--videos mobile-full tablet-and-up-half ">

            <?php dynamic_sidebar('homepagebelowmaincontent_right'); ?>

        </article>         

        <?php endif; ?>  

        <div class="clear"></div>
        
        
        <?php if (1 == 2 && is_active_sidebar('homepagebelowmaincontent_full')) : ?>

        <article class="large-12">

            <?php dynamic_sidebar('homepagebelowmaincontent_full'); ?>

        </article>

        <?php endif; ?>


        <?php if (is_active_sidebar('homepagebelowmaincontent_4by2_first')) : ?>

        <article class="learning__item box1--videos mobile-full tablet-and-up-half ">

            <?php dynamic_sidebar('homepagebelowmaincontent_4by2_first'); ?>

        </article>         

        <?php endif; ?>          
        

    </section>        

</div>


    <section class="row" id="third-band">

        <?php if (is_active_sidebar('homepagebelowmaincontent_4by2_second')) : ?>

        <article class="">

            <?php dynamic_sidebar('homepagebelowmaincontent_4by2_second'); ?>

        </article>

        <?php endif; ?>

    </section>

<script src="http://www.jewellerymaker.com/global/js/vendor/plugins/flowplayer/flowplayer.min.js"></script>
    <script type="text/javascript" src="http://www.jewellerymaker.com/global/js/vendor/plugins/hls/hls.min.js"></script>
    
<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/video.js"></script>
<script type="text/javascript">
    jQuery(function () {


        jQuery('[id$="dvVideoHolderHome"]').Video({
            container: 'dvVideoHolderHome',
            channel: 'JEWELLERYMAKER',
            autoStart: true,
            controls: false,
            mute: true,
            //quality: 'thumbnail',
            pageIdentifier: 'homepage',
            edge: '',
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