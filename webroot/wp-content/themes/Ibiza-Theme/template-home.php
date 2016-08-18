<?php
/*
  Template Name: Home Template
 */
?>

<?php get_header(); ?>

<div id="content">
    
    <div id="operationLogInfo"></div>
    
    <div id="banner-content" class="row show-for-large">
        <div class="swiper-container-banner">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper" style="transform: translate3d(-600px, 0px, 0px); transition-duration: 0ms;">
                
                <div class="swiper-slide" style="background: #ccc">
                    <img src="http://johnlewis.scene7.com/is/image/JohnLewis/knitting_needles_banner_100516" />
                    
                    <div class="info">
                        <h2>One-kit wonder</h2> 
                        <p>Needles and hooks at the ready: we have the finest wool to complete your knitting project. Treat your designs with the premium yarns they deserve. Opt for merino wool, cashmere and silk blends for unparalleled comfort in your creations</p> 
                        <div class="cq-linkstack"> 
                            <ul> 
                                <li> <a href="/browse/sport-leisure/haberdashery/knitting-needles-crochet-hooks/_/N-enl?intcmp=cp_spo_wool_fuwi1_top_knittingneedles_x100516">Shop Knitting Needles &amp; Hooks</a> </li> 
                                <li> <a href="/browse/sport-leisure/haberdashery/knitting-crochet-patterns/_/N-enj?intcmp=cp_spo_wool_fuwi1_top_knittingpatterns_x100516">Shop Knitting &amp; Crochet Patterns</a> </li> 
                            </ul> 
                        </div>                    
                    </div>
                </div>
                
                <div class="swiper-slide" style="background: #333">
                    <img src="http://johnlewis.scene7.com/is/image/JohnLewis/habysets_bnr_141015" />   
                    
                    <div class="info">
                        <h2>One-kit wonder</h2> 
                        <p>Needles and hooks at the ready: we have the finest wool to complete your knitting project. Treat your designs with the premium yarns they deserve. Opt for merino wool, cashmere and silk blends for unparalleled comfort in your creations</p> 
                        <div class="cq-linkstack"> 
                            <ul> 
                                <li> <a href="/browse/sport-leisure/haberdashery/knitting-needles-crochet-hooks/_/N-enl?intcmp=cp_spo_wool_fuwi1_top_knittingneedles_x100516">Shop Knitting Needles &amp; Hooks</a> </li> 
                                <li> <a href="/browse/sport-leisure/haberdashery/knitting-crochet-patterns/_/N-enj?intcmp=cp_spo_wool_fuwi1_top_knittingpatterns_x100516">Shop Knitting &amp; Crochet Patterns</a> </li> 
                            </ul> 
                        </div>                    
                    </div>                    
                    
                </div>

            </div>
            
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>            
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>            
        </div>
        
        
    </div>
    
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
    <hr />
    
    <div class="row">

        <?php 


        use Elasticsearch\ClientBuilder;

        require 'vendor/autoload.php';

        $singleHandler = ClientBuilder::singleHandler();
        $multiHandler = ClientBuilder::multiHandler();                



        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://ibizaschemas.product:80/ProductCatalog.Api/api/elastic/product/'])
            ->setHandler($singleHandler)
            ->build();


        $indexParams    = [
                'client' => [
                'curl' => [
                    CURLOPT_HTTPHEADER => [
                        'Content-type: application/json',
                    ]
                ]
            ],

        ];

        $response               = $client->search($indexParams);



        $core['name']           = 1;
        $core['description']    = 1;
        $core['productcode']    = 1;
        $core['legacycode']     = 1;
        $core['price']          = 1;
        $core['images']         = 1;
        $core['review']         = 1;
        $core['category']       = 1;



        foreach($response['hits']['hits'] as $key =>$productIn ){



            if ($key==6)
                break;
            ?>



        <div class="columns large-2">


            <p style="font-size: 13px; text-align: center; font-weight: bold; margin: 10px 0px 0px;"><?php echo $productIn['_source']['name']; ?></p>
            <a href="/p/<?php echo $productIn['_id']; ?>/">
            <?php 
             echo '<img src="' . $productIn['_source']['images'][0]['url'] . '" />';
            ?>
            </a>

            <span>&pound;<?php echo number_format( $productIn['_source']['price'] , 2); ?></span>
        </div>
        <?php 

        }

        ?>
        <div style="clear:both">&nbsp;</div>
    </div>    
    
</div> <!-- end #content -->

<hr />

<section class="row" id="second-band">
    
    <div class="text-center">
        <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>

            <?php dynamic_sidebar('homepagebelowmaincontent'); ?>

        <?php endif; ?>
    </div>

    <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-3 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left1'); ?>

        </article>          

    <?php endif; ?>     

    <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>

        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-3 columns">

            <?php dynamic_sidebar('homepagebelowmaincontent_left2'); ?>

        </article>          

    <?php endif; ?>  

    <?php if (is_active_sidebar('homepagebelowmaincontent')) : ?>

        <article class="learning__item box1--videos mobile-full tablet-and-up-half">

            <?php dynamic_sidebar('homepagebelowmaincontent_right'); ?>

        </article>         

    <?php endif; ?>  
       
    <div class="clear"></div>
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