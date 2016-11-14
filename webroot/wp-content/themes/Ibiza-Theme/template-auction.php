<?php
/*
  Template Name: Auction Template
 */
?>

<?php get_header(); ?>

<div id="content">
    
    <div id="operationLogInfo"></div>
    
    <div id="inner-content" class="home-inner-content row">

        <main id="main" class="large-12 columns auction-page" role="main">

            <div class="row">
                <div class="large-12 columns breadcrumb-title">
                    <ul class="breadcrumbs show-for-medium">
                    <li><a href="<?php get_template_directory_uri(); ?>">Home</a></li>
                    <li class="current"><a href="<?php get_template_directory_uri(); ?>">Watch</a></li>
                    </ul>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <div id="dvVideoHolderHome" style="background-color: #000">
                        <img style="width: 100%" src="/global/img/tv-preview.jpg" />
                    </div>
                    <div class="show-for-large medium-12 no-padding columns">
                        <h1 style="background:red;">LARGE onNext</h1>
                    </div>
                </div>
                <div class="large-4 medium-8 columns auction-buy-panel">
                    <div class="row">
                        <div class="large-12 columns">
                            <h3>The Sewing Quarter Japanese Veg Dyed Fashion Fabric, Charcoal</h3>
                            <p>Product Code: <span>123456789</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <h4>£20.00 <span>per metre</span></h4>
                        </div>
                        <div class="large-4 columns">
                            <p>- [] +</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 columns">
                            <input type="button" value="LOGIN TO BUY" class="add-to-basket" />
                        </div>
                        <div class="large-6 columns">
                            <p>or <a href="#">Create an account</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-10 columns">
                            <img src="http://ibiza.dev/wp-content/themes/Ibiza-Theme/assets/images/howto4.jpg" />
                        </div>
                        <div class="large-2 columns">
                            <ul>
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="hide-for-large medium-4 columns">
                    <h1 style="background:red;">SMALLER onNext</h1>
                    <h1 style="background:blue;">SMALLER messageTheStudio</h1>
                </div>
            </div>

            <div class="row">
                <div class="large-4 show-for-large columns">
                    <h1 style="background:blue;">SMALLER messageTheStudio</h1>
                </div>
                <div class="large-8 medium-12 columns">
                    <h1 style="background:purple;">Description</h1>
                </div>
            </div>

        </main> <!-- end #main -->

    </div> <!-- end #inner-content -->    
    
</div> <!-- end #content -->


<script src="http://www.jewellerymaker.com/global/js/vendor/plugins/flowplayer/flowplayer.min.js"></script>
<script type="text/javascript" src="http://www.jewellerymaker.com/global/js/vendor/plugins/hls/hls.min.js"></script>
    
<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/video.js"></script>
<script type="text/javascript">
    function resizeSlider(){
        if(jQuery(window).width() <= 1023){
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height(500);
            });
        }else{
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height('auto');
            });
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height(jQuery(this).parents('#inner-content').height());
            });
        }
    };

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

       //hero slider height
        jQuery('.swiper-slide').each(function(){
            resizeSlider();
        });

    });

    jQuery(window).resize(function(){
        resizeSlider();
    });

</script>
<?php get_footer(); ?>