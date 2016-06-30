<?php
/*
  Template Name: Product Page
 */


use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$singleHandler = ClientBuilder::singleHandler();
$multiHandler = ClientBuilder::multiHandler();

// Try both the $singleHandler and $multiHandler independently
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://ibizaschemas.product:80/ProductCatalog.Api/api/elastic/'])
    ->setHandler($singleHandler)
    ->build();

$params = [
    'index' => 'product',
    'type' => 'document',
    'id' =>  get_query_var('products') ,
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
$core['description']    = 1;
$core['productcode']    = 1;
$core['legacycode']     = 1;
$core['price']          = 1;
$core['images']         = 1;
$core['review']         = 1;
$core['category']       = 1;

$schema = json_decode( file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/schema/title/' .  $response['_source']['_schema'] ) );

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
    <div class="medium-6 columns">
        
       <a href="<?php echo $response['_source']['images'][0]['url']; ?>" id="zoom"> <img id="zoom_01"   data-zoom-image="<?php echo $response['_source']['images'][0]['url']; ?>" src="<?php echo $response['_source']['images'][0]['url']; ?>">
        <div class="clear">&nbsp;</div>
        <div class="">


            <!-- Slider main container -->
            <div class="swiper-container-products">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">

                    
                    <?php foreach( $response['_source']['images'] as $i => $image ): ?>
                    

                    <div class="swiper-slide">
                        <a href="<?php echo $image['url']; ?>"
                           data-zoom-image="<?php echo $image['url']; ?>"  
                           data-image="<?php echo $image['url']; ?>">                        
                        <img class="gallery" data-zoom-image="<?php echo $image; ?>" src="<?php echo $image['url']; ?>">
                        </a>
                        
                    </div>
                    
                    <?php endforeach; ?>
                </div>


            </div>

        </div>

    </div>
    <div class="medium-6 large-5 columns">
        <h3 id="product_name"><?php echo $response['_source']['name']; ?></h3>

        <h4 id="product_price"><?php echo $schema->properties->price->prepend ?><?php echo $response['_source']['price']; ?> </h4>
        
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

        

        <?php $variantProducts =  json_decode( file_get_contents( 'http://52.18.1.60/ProductCatalog.Api/api/metadata/55873135' ) ); ?>
        
        <ul class="inline-list row">
            
            <?php  foreach($variantProducts->variants as $product):?>
                
            <li style="    display: block;
    float: left;
    list-style: outside none none;
    margin-left: 1.22222rem;"><a class="product_refresh" data-name="<?php echo $product->name ?>" data-id="<?php echo $product->id ?>" title="<?php echo $product->name ?>" href="/products-list/<?php echo $product->id ?>/<?php echo $product->name ?>"><img src="<?php echo $product->image ?>" /></a></li>
            
            <?php endforeach; ?>
            
        </ul>        
        
        
        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="middle">Quantity</label>
            </div>
            <div class="small-9 columns">
                <input type="text" id="middle-label" placeholder="One fish two fish">
            </div>
        </div>
        
        

        
        <button id="add-basket" class="button large expanded" type="button" data-toggle="example-dropdown2">Add to basket</button>
        <div class="dropdown-pane top column row" id="example-dropdown2" data-dropdown>
            <div class="column large-6">
                <img id="zoom_01" class="thumbnail" data-zoom-image="<?php echo $response['_source']['images'][0]['url']; ?>" src="<?php echo $response['_source']['images'][0]['url']; ?>">
            </div>
            <div class="column large-6">
                <p id="basket-description"><?php echo $response['_source']['product']['base']['name']; ?></p>
                <p id="basket-total">Total &pound;<?php echo $response['_source']['product']['webPrice']; ?></p>
                <button class="button large expanded" type="button" data-toggle="example-dropdown2" onclick="window.location='https://secure.localdev.jewellerymaker.com/basket.aspx'">Checkout</button>
            </div>
           
         </div>

    </div>
</div>
</div>
<div class="column row">
    <hr>
    <ul class="tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a></li>
        <li class="tabs-title"><a href="#panel2">Similar Products</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
            <h4>Reviews</h4>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="http://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you.</p>
                </div>
            </div>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="http://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
                </div>
            </div>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="http://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
                </div>
            </div>
            <label>
                My Review
                <textarea placeholder="None"></textarea>
            </label>
            <button class="button">Submit Review</button>
        </div>
        <div class="tabs-panel" id="panel2">
            <div class="row medium-up-3 large-up-5">
                <div class="column">
                    <img class="thumbnail" src="http://placehold.it/350x200">
                    <h5>Other Product <small>$22</small></h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="http://placehold.it/350x200">
                    <h5>Other Product <small>$22</small></h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="http://placehold.it/350x200">
                    <h5>Other Product <small>$22</small></h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="http://placehold.it/350x200">
                    <h5>Other Product <small>$22</small></h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="http://placehold.it/350x200">
                    <h5>Other Product <small>$22</small></h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row column">
    <hr>
    <ul class="menu">
        <li>Yeti Store</li>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li class="float-right">Copyright 2016</li>
    </ul>
</div>

<!-- Footer -->


<script>
    
    var zoomConfig      = {cursor: 'crosshair', responsive: true ,   zoomType : "inner",}; 
    var image           = jQuery('.elevatezoom-gallery');
    var zoomImage       = jQuery('img#zoom_01');    
    
    
    jQuery( document ).ready(function() {


        jQuery('.product_refresh').click( function( e ) { 
            
            e.preventDefault();
            
            var product_name    = jQuery( this ).attr( 'data-name' );
            var product_id      = jQuery( this ).attr( 'data-id' );
            var url             = "/products-list/" + product_id  + "/" + product_name + '?json=1';
            
            jQuery.ajax({
                dataType  : 'json' ,
                url: url
            })  .done(function( data ) {
                if ( console && console.log ) {
                    console.log(  data );
                    jQuery('#basket-total').text('£' +  data.BasketTotal );
                    jQuery('#basket-description').text('£' +  data.Description );
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
