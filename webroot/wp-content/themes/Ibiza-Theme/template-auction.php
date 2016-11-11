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
                    <li><a href="<?php get_template_directory_uri(); ?>">Watch</a></li>
                    </ul>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="large-6">
                    <div id="dvVideoHolderHome" style="background-color: #000">
                        <img style="width: 100%" src="/global/img/tv-preview.jpg" />
                    </div>
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