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

            <main id="main" class="large-6 medium-6 columns" role="main">

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

                
                <?php if (is_active_sidebar('homepageleft')) : ?>

                    <?php dynamic_sidebar('homepageleft'); ?>

                <?php endif; ?>                

            </main> <!-- end #main -->

            
            <?php if (is_active_sidebar('homepagesidebar')) : ?>

                <?php dynamic_sidebar('homepagesidebar'); ?>

            <?php endif; ?>

    </div> <!-- end #inner-content -->
    
</div> <!-- end #content -->

<hr />

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

    <article class="learning__item box1--videos mobile-full tablet-and-up-half">

        <?php dynamic_sidebar('homepagebelowmaincontent_right'); ?>

    </article>         

    <?php endif; ?>  
       
    <div class="clear"></div>
    
</section>        

<hr />

<section class="row" id="third-band">
    
    <?php if (is_active_sidebar('homepagebelowmaincontent_full')) : ?>

    <article class="">

        <?php dynamic_sidebar('homepagebelowmaincontent_full'); ?>

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