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
        ->setHosts(['http://ibizaschemas.product:80/ProductCatalog.Api/api/webapi/search'])
        ->setHandler($singleHandler)
        ->build();





$params = [
    'index' => 'documents',
    'type' => 'document',
    'id' => 'productsX_' . get_query_var('products')
];

$response = $client->get($params);


print_r( $response  );
die;
?>

<?php get_header(); ?>


<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.elevateZoom-3.0.8.min.js"></script>
 
<div class="row columns">
    <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li class="disabled">Gene Splicing</li>
            <li>
                <span class="show-for-sr">Current: </span> <?php echo $response['_source']['product']['base']['name']; ?>
            </li>
            
            
            
        </ul>
    </nav>
</div>
<div class="row">
    <div class="medium-6 columns">
        
       <a href="<?php echo $response['_source']['product']['base']['imageUri']; ?>" id="zoom"> <img id="zoom_01"   data-zoom-image="<?php echo $response['_source']['product']['base']['imageUri']; ?>" src="<?php echo $response['_source']['product']['base']['imageUri']; ?>">
        <div class="clear">&nbsp;</div>
        <div class="">


            <!-- Slider main container -->
            <div class="swiper-container-products">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">

                    
                    <div class="swiper-slide t">
                        <a href="<?php echo $response['_source']['product']['base']['imageUri']; ?>"
                           data-zoom-image="<?php echo $response['_source']['product']['base']['imageUri']; ?>"  
                           data-image="<?php echo $response['_source']['product']['base']['imageUri']; ?>">                        
                        <img class="gallery" data-zoom-image="<?php echo $response['_source']['product']['base']['imageUri']; ?>" src="<?php echo $response['_source']['product']['base']['imageUri']; ?>">
                        </a>
                        
                    </div>
                    
                    <?php for($i=0;$i<=6;$i++): ?>
                    

                    <div class="swiper-slide">
                        <a href="#"  class="elevatezoom-gallery" 
                           data-zoom-image="https://placeholdit.imgix.net/~text?txtsize=47&txt=Image <?php echo $i?>&w=1000&h=800"  
                           data-image="https://placeholdit.imgix.net/~text?txtsize=47&txt=Image <?php echo $i?>&w=250&h=200">
                           <img class="gallery elevatezoom-gallery" src="https://placeholdit.imgix.net/~text?txtsize=47&txt=Image <?php echo $i?>&w=250&h=200" /></a>
                    </div>
                    
                    <?php endfor; ?>
                </div>


            </div>

        </div>

    </div>
    <div class="medium-6 large-5 columns">
        <h3><?php echo $response['_source']['product']['base']['name']; ?></h3>

        <h4>&pound;<?php echo $response['_source']['product']['webPrice']; ?> </h4>
        
        <p><?php echo $response['_source']['product']['base']['description']; ?></p>
        <!--        <label>Size
                    <select>
                        <option value="husker">Small</option>
                        <option value="starbuck">Medium</option>
                        <option value="hotdog">Large</option>
                        <option value="apollo">Yeti</option>
                    </select>
                </label>-->
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
                <img id="zoom_01" class="thumbnail" data-zoom-image="<?php echo $response['_source']['product']['base']['imageUri']; ?>" src="<?php echo $response['_source']['product']['base']['imageUri']; ?>">
            </div>
            <div class="column large-6">
                <p id="basket-description"><?php echo $response['_source']['product']['base']['name']; ?></p>
                <p id="basket-total">Total &pound;<?php echo $response['_source']['product']['webPrice']; ?></p>
                <button class="button large expanded" type="button" data-toggle="example-dropdown2" onclick="window.location='https://secure.localdev.jewellerymaker.com/basket.aspx'">Checkout</button>
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
    
    var zoomConfig = {cursor: 'crosshair', responsive: true ,   zoomType : "inner",}; 
    var image = jQuery('.elevatezoom-gallery');
    var zoomImage = jQuery('img#zoom_01');    
    
    
    jQuery( document ).ready(function() {

        
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
                url: 'http://localdev.jewellerymaker.com/proxy.php?auctionID=-1&productCode=<?php echo $response['_source']['product']['productCode']; ?>&productDetailID=<?php echo $response['_source']['product']['productDetailId']; ?>&quantity=' + quantity
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
