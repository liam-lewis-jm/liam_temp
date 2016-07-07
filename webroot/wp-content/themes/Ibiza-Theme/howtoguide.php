<?php
/*
  Template Name: Product Page
 */


use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$product_type   = sanitize( $_GET['type'] );

$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

// Try both the $singleHandler and $multiHandler independently
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://ibizaschemas.product:80/ProductCatalog.Api/api/elastic/'])
    ->setHandler($singleHandler)
    ->build();



$params = [
    'index' => 'howto',
    'type'  => $product_type ,
    'id'    =>  get_query_var('products') ,
        'client' => [
        'curl' => [
            CURLOPT_HTTPHEADER => [
                'Content-type: application/json',
            ]
        ]
    ]
];

$response               = $client->get($params);

$core['name']           = 1;
$core['category']    = 1;
$core['image']    = 1;
$core['steps']     = 1;
$core['products']          = 1;
$core['images']         = 1;
$core['subtitle']         = 1;
$core['introduction']       = 1;
$core['_category']       = 1;

$schema                 = json_decode( @file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/schema/title/' .  $response['_source']['_schema'] ) );
$variantProducts        = json_decode( @file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/metadata/' . get_query_var('products') ) );


if( isset( $_GET['json'] ) ){
    echo json_encode( $response );
    die;
}

?>

<?php get_header(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.elevateZoom-3.0.8.min.js"></script>
 
<div class="row columns">
    <nav aria-label="You are here:" role="navigation">
        
        <ul class="breadcrumbs">
            
            <?php echo  implode( '' , breacdcrumbs( 'cat-' . (int)$response['_source']['category'][0]  ) ) ; ?>

            <li>
                <span class="show-for-sr">Current: </span> <?php echo $response['_source']['name']; ?>
            </li>
            
        </ul>
    </nav>
</div>
<div id="result">
<div class="row" id="prodcut_main">

    <div class="medium-6 large-6 columns">
        <h3 id="product_name"><?php echo $response['_source']['name']; ?></h3>

        
        <fieldset>
            <p>Click on the links below to shop for products you will need:</p>
            <ul>
            <?php foreach($response['_source']['products'] as $key => $product): ?>
            
                <li><a href="/products-list/<?php echo $product['product'] ?>/<?php echo $product['title'] ?>/?type=product"><?php echo $product['title']; ?></a></li>
                
            <?php endforeach; ?>
            </ul>
        </fieldset>
        
        
        
        <p  id="product_description"><?php echo $response['_source']['description']; ?></p>
        
        <?php foreach($schema->properties as $key => $property): ?>
        <?php   if( !isset( $core[$key] ) && isset($response['_source'][$key]) ): ?>
        
        <div class="medium-6 large-6 columns">
            <p><?php echo $property->title; ?></p>
        </div>
        
        
        <div class="medium-6 large-6 columns">
            <p><?php echo  $property->prepend .  $response['_source'][$key] . $property->append; ?></p>
        </div>         
                 
                 
                 
        <?php endif; ?>   
         
        
        <?php endforeach; ?>

        

         
        
        <ul class="inline-list row">
            
            
            <?php   if($variantProducts): ?>
            
            <?php       foreach($variantProducts->variants as $product):?>
                
            <li style="    display: block;
                            float: left;
                            list-style: outside none none;
                            margin-left: 1.22222rem;"><a class="product_refresh" data-name="<?php echo $product->name ?>" data-id="<?php echo $product->id ?>" title="<?php echo $product->name ?>" href="/products-list/<?php echo $product->id ?>/<?php echo $product->name ?>"><img src="<?php echo $product->image ?>" /></a></li>

            <?php       endforeach; ?>
            
            
            <?php endif ?>
            
        </ul>        
        
        
        <div class="row">
            
            <div class="columns">
            
                <h5><?php echo  $response['_source']['subtitle'] ?></h5>
                <p><?php echo  $response['_source']['introduction'] ?></p>
            </div>
        </div>
        
        <div class="row">
        <div class="large-12 columns">
        
            <ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-3">
            <?php foreach( $response['_source']['steps']  as $step ): ?>
            
            
            
            
                <li>
                    <h5><?php echo $step['title'] ?></h5>
                    <p style="font-size:12px;"><?php echo $step['description'] ?></p>
                </li>
            
            
            <?php $i++ ?>
            
            <?php endforeach; ?>
                </ul>
 
    </div>
</div>

    </div>
    
    
    
    
    <div class="medium-6 columns">
        
       <img id="zoom_01"  src="<?php echo $response['_source']['image']; ?>" />
        <div class="clear">&nbsp;</div>
        <div class="row">


            <!-- Slider main container -->
                <!-- Additional required wrapper -->
                    
                    <?php foreach( $response['_source']['steps']  as $key=> $step_image ): ?>
                    
                    <div class="large-6 columns">
                        
                        <span style="display: inline-block; background: red none repeat scroll 0% 0%; height: 25px; width: 25px; border-radius: 15px; text-align: center; line-height: 25px; color: rgb(255, 255, 255);"><?php echo $key+1; ?></span>
                        
                        <a class="th" href="<?php echo $step_image['image']; ?>"
                           data-zoom-image="<?php echo $step_image['image']; ?>"  
                           data-image="<?php echo $step_image['image']; ?>">                        
                        <img  src="<?php echo $step_image['image']; ?>">
                        </a>
                        
                    </div>
                    
                    <?php endforeach; ?>



        </div>

    </div>    
    
    
    
</div>
</div>



<!-- Footer -->


<script>
    
    var zoomConfig      = {cursor: 'crosshair', responsive: true ,   zoomType : "inner",}; 
    var image           = jQuery('.elevatezoom-gallery');
    var zoomImage       = jQuery('img#zoom_01');    
    
    
    jQuery( document ).ready(function() {


        //initialize swiper when document ready  
        var mySwiper_products = new Swiper('.swiper-container-products', {
            // Optional parameters
            loop: true,
            slidesPerView: 4,
            spaceBetween: 4,
            breakpoints: {
                // when window width is <= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetweenSlides: 10
                },
                // when window width is <= 480px
                480: {
                    slidesPerView: 2,
                    spaceBetweenSlides: 20
                },
                // when window width is <= 640px
                640: {
                    slidesPerView: 3,
                    spaceBetweenSlides: 30
                }

            }
        });



        jQuery('.product_refresh').click( function( e ) { 
            
            e.preventDefault();
            
            var product_name    = jQuery( this ).attr( 'data-name' );
            var product_id      = jQuery( this ).attr( 'data-id' );
            var url             = "/products-list/" + product_id  + "/" + product_name + '?json=1&type=<?php echo $product_type; ?>';
            
            jQuery.ajax({
                dataType  : 'json' ,
                url: url
            })  .done(function( data ) {
                if ( console && console.log ) {
                    console.log(  data );

                        
                    mySwiper_products.removeAllSlides();
                        
                    for( var image in  data._source.images ){
                        
                        mySwiper_products.appendSlide('<div class="swiper-slide"><img src="'  + data._source.images[image].url  + '" /></div>')
                    }
                    
                        
                    jQuery('.zoomContainer').remove();
                    zoomImage.removeData('elevateZoom');
                    // Reinitialize EZ
                    

                    jQuery('#product_name').text( data._source.name );
                    jQuery('#product_description').text( data._source.description );
                    jQuery('#product_price').text( '<?php echo $schema->properties->price->prepend ?>' + data._source.price.toFixed(2) );
                    jQuery('#zoom').attr('href' , data._source.images[0].url );

                    // Remove old instance od EZ
                    jQuery('.zoomContainer').remove();
                    zoomImage.removeData('elevateZoom');
                    // Update source for images
                    zoomImage.attr('src',  data._source.images[0].url );
                    zoomImage.data('zoom-image',  data._source.images[0].url );
                    // Reinitialize EZ
                    zoomImage.elevateZoom(zoomConfig);
                    
                    
                }
              });
            
        });

        
        jQuery("#zoom").fancybox({
                        fitToView	: true
                });

        jQuery("#zoom_01").elevateZoom( zoomConfig );


        image.on('click', function(e){

            e.preventDefault();
            // Remove old instance od EZ
            jQuery('.zoomContainer').remove();
            zoomImage.removeData('elevateZoom');
            // Update source for images
            zoomImage.attr('src', jQuery(this).data('image'));
            zoomImage.data('zoom-image', jQuery(this).data('zoom-image'));
            // Reinitialize EZ
            zoomImage.elevateZoom(zoomConfig);


        });

        jQuery('#add-basket').click( function(){
            
            var quantity = jQuery('#middle-label').val();
            
            jQuery.ajax({
                dataType  : 'json' ,
                url: 'http://localdev.jewellerymaker.com/proxy.php?auctionID=-1&productCode=<?php echo 'WTTY01'; //$response['_source']['legacyCode']; ?>&productDetailID=<?php echo '361247'; //$response['_source']['product']['productDetailId']; ?>&quantity=' + quantity
            })  .done(function( data ) {
                if ( console && console.log ) {
                    console.log(  data );
                    jQuery('#basket-total').text('£' +  data.BasketTotal );
                    jQuery('#basket-description').text('£' +  data.Description );
                }
              });

        }); 
    
    });

</script>


<?php get_footer(); ?>
