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

            <main id="main" class="large-8 medium-12 columns" role="main">

            <?php else: ?>

            <main id="main" class="large-8 medium-12 columns" role="main">

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
                <div id="dvVideoHolderHome" style="background-color: #000" class="flowplayer no-brand is-error is-mouseout" data-flowplayer-instance-id="0">
                    <div class="fp-ratio" style="padding-top: 56.25%;"></div><div class="fp-player"><img style="width: 100%" src="http://www.jewellerymaker.com/global/img/tv-preview.jpg"><div class="fp-ui" title="Hit ? for help" style="display: none;">         <div class="fp-waiting"><em></em><em></em><em></em></div>         <a class="fp-fullscreen"></a>         <a class="fp-unload"></a>         <p class="fp-speed"></p>         <div class="fp-controls">            <a class="fp-play"></a>            <div class="fp-timeline">               <div class="fp-buffer"></div>               <div class="fp-progress"></div>            </div>            <div class="fp-timeline-tooltip fp-tooltip"></div>            <div class="fp-volume">               <a class="fp-mute"></a>               <div class="fp-volumeslider">                  <div class="fp-volumelevel"></div>               </div>            </div>         </div>         <div class="fp-time">            <em class="fp-elapsed">00:00</em>            <em class="fp-remaining"></em>            <em class="fp-duration">00:00</em>         </div>         <div class="fp-message"><h2>html5: Unsupported video format. Try installing Adobe Flash.</h2><p>http://get.adobe.com/flashplayer/</p></div><a class="fp-embed" title="Copy to your site"></a><div class="fp-embed-code"><label>Paste this HTML code on your site to embed.</label><textarea></textarea></div></div><div class="fp-help">         <a class="fp-close"></a>         <div class="fp-help-section fp-help-basics">            <p><em>space</em>play / pause</p>            <p><em>q</em>unload | stop</p>            <p><em>f</em>fullscreen</p><p><em>shift</em> + <em>←</em><em>→</em>slower / faster</p>         </div>         <div class="fp-help-section">            <p><em>↑</em><em>↓</em>volume</p>            <p><em>m</em>mute</p>         </div>         <div class="fp-help-section">            <p><em>←</em><em>→</em>seek</p>            <p><em>&nbsp;. </em>seek to previous            </p><p><em>1</em><em>2</em>… <em>6</em> seek to 10%, 20% … 60% </p>         </div>   </div></div></div>
                <!-- temp inline as design not final -->
                <div class="text-center show-for-large" id="tv-options">
                    <div class="large-6 columns" style="padding-right: 0;border-right: 1px solid #e1e1e1;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tv-icon.png" /> <a href="/tv-schedule/" class="upper">View the TV Schedule</a>
                    </div>
                    <div class="large-6 columns" style="padding-left: 0">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" /> <a href="/todays-products/" class="upper">View all products from Today</a>
                    </div>
                </div>
                
                <?php if (is_active_sidebar('homepageleft')) : ?>

                    <?php dynamic_sidebar('homepageleft'); ?>

                <?php endif; ?>  
                
                
              
                

            </main> <!-- end #main -->

            
        
            
            
            <?php if (is_active_sidebar('homepagesidebar')) : ?>

                <?php dynamic_sidebar('homepagesidebar'); ?>

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


<div class="row show-for-xxlarge">
        <div class="medium-6 medium-centered">
               <div class="row">

                        <div style="background: white none repeat scroll 0% 0%; padding-left: 0px;" class="medium-6 columns">
                            <div style="color:#fff;position: relative; vertical-align: bottom; height: 49px; line-height: 49px; display: inline-block; background: #00bcb4 none repeat scroll 0px 0px; padding: 0px 10px;">
                                On Now
                                <div style="width: 0px; height: 0px; border-style: solid; border-width: 24.5px 0px 24.5px 21px; border-color: transparent transparent transparent #00bcb4; position: absolute; top: 0px; right: -21px;"></div>
                            </div>
                            
                            <div class="tv-schedule-details">
                                <p>08:00 - 09:00</p>
                                <p>Title of the show and who the presenter</p>
                            </div>
                        </div>
                   
                        <div style="background: white none repeat scroll 0% 0%; padding-left: 0px;" class="medium-6 columns">
                          <div style="color:#fff;position: relative; vertical-align: bottom; height: 49px; line-height: 49px; display: inline-block; background: #00bcb4 none repeat scroll 0px 0px; padding: 0px 10px;">
                          On Next
                            <div style="width: 0px; height: 0px; border-style: solid; border-width: 24.5px 0px 24.5px 21px; border-color: transparent transparent transparent #00bcb4; position: absolute; top: 0px; right: -21px;"></div>
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
    <script src="http://www.jewellerymaker.com/global/js/vendor/plugins/flowplayer/flowplayer.min.js"></script>
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