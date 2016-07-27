<?php
/*
  Template Name: Product Page
 */

/*
use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$product_type   = sanitize( $_GET['type'] );
$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

// Try both the $singleHandler and $multiHandler independently
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://ibizaschemas.product:80/ProductCatalog.Api/api/elastic/product/'])
    ->setHandler($singleHandler)
    ->build();

*/
/*
$params = [
    'index' => 'product',
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





$response               = $client->get($params);*/


/*
$json           = '{"query":{ "ids":{ "values": [ ' . get_query_var('products') . ' ] } } }';

$indexParams    = [
        'client' => [
        'curl' => [
            CURLOPT_HTTPHEADER => [
                'Content-type: application/json',
            ]
        ]
    ],
    
];



$indexParams['body']    = $json;*/
//$rst                    = $client->search($indexParams);
$core['name']           = 1;
$core['description']    = 1;
$core['productcode']    = 1;
$core['legacycode']     = 1;
$core['price']          = 1;
$core['images']         = 1;
$core['review']         = 1;
$core['category']       = 1;
$core['_mongo']         = 1;
$core['_schema']        = 1;
$core['_category']      = 1;
$core['items']          = 1;

$rst                    = json_decode( file_get_contents('http://52.18.1.60/ProductCatalog.Api/api/document/data.productcode/' . get_query_var('products') ));




//$response['_source']    = $rst['hits']['hits'][0]['_source'];
$response    = $rst[0]->data;


$schema                 = json_decode( @file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/schema/title/' .  $rst[0]->{'$schema'} ) );
//$variantProducts        = json_decode( @file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/metadata/' . get_query_var('products') ) );



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
            
            <?php echo  implode( '' , breacdcrumbs( 'cat-' . (int)$response->category[0]  ) ) ; ?>

            <li>
                <span class="show-for-sr">Current: </span> <?php echo $response->name; ?>
            </li>
            
        </ul>
    </nav>
</div>
<div id="result">
<div class="row" id="prodcut_main">
    <div class="medium-6 columns">
        
        <a href="<?php echo $response->images[0]->url; ?>" id="zoom"> <img id="zoom_01"   data-zoom-image="<?php echo $response->images[0]->url; ?>" src="<?php echo $response->images[0]->url; ?>"></a>
        <div class="clear">&nbsp;</div>
        <div class="">


            <!-- Slider main container -->
            <div class="swiper-container-products">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    
                    <?php foreach( $response->images as $i => $image ): ?>
                    
                    <div class="swiper-slide">
                        
                        <a  rel="group"  class="gallery" href="<?php echo $image->url; ?>"
                           data-zoom-image="<?php echo $image->url; ?>"  
                           data-image="<?php echo $image->url; ?>">                        
                        <img data-zoom-image="<?php echo $image->url; ?>" src="<?php echo $image->url; ?>">
                        </a>
                        
                    </div>
                    
                    <?php endforeach; ?>
                </div>


            </div>

        </div>

    </div>
    <div class="medium-6 large-5 columns">
        <h3 id="product_name"><?php echo $response->name; ?></h3>

        <h4 id="product_price"><?php echo $schema->properties->price->prepend ?><?php echo number_format( $response->price , 2); ?> </h4>
        
        <p  id="product_description"><?php echo $response->description; ?></p>
        
        
        
        <?php //print_r( $schema->properties );die; ?>
        
        <?php foreach($schema->properties as $key => $property): ?>
        <?php   if( !isset( $core[$key] ) && isset($response->$key) && $response->$key && $property->title ): ?>
        
        <div class="medium-6 large-6 columns attr_template">
            <p><?php echo $property->title; ?></p>
        </div>
        
        
        <div class="medium-6 large-6 columns attr_template">
            <p><?php echo $property->prepend .  $response->$key . $property->append; ?></p>
        </div>         
                 
                 
                 
        <?php endif; ?>   
         
        
        <?php endforeach; ?>

        

        
        
            
            
            <?php   if($variantProducts): ?>
            
            <?php       foreach( $variantProducts->dimensions as $dimension ):?>
            <ul class="inline-list row">
            <li><a class="product_refresh" data-name="<?php echo $product->name ?>" data-id="<?php echo $product->id ?>" title="<?php echo $product->name ?>" href="/products-list/<?php echo $product->id ?>/<?php echo $product->name ?>"><img width="25" src="<?php echo $product->image ?>" /></a></li>
            </ul>   
            <?php       endforeach; ?>
            
            
            <?php endif; ?>
            
             
            <?php if( $response->items ): ?>
        
            <p>In this bundle.</p>
            <ul class="inline-list row">
            <?php foreach($response->items as $item  ): ?>
            
                
            <li>
                <a  href="/products-list/<?php echo $item->productcode; ?>" class="product_bundle various">
                <?php

                $pItem  = json_decode( file_get_contents('http://52.18.1.60/ProductCatalog.Api/api/document/data.productcode/' . $item->productcode  ));


                echo '<img width="50" src="' . $pItem[0]->data->images[0]->url . '"/>';
                echo '<br /><span style="font-size:12px;" >'.  $pItem[0]->data->name .'</span>'
                ?>
                </a>
            </li>
            
            
            
        
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>

        
        <div class="row" id="quantity">
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
                <img   class="thumbnail" data-zoom-image="<?php echo $response->images[0]->url; ?>" src="<?php echo $response->images[0]->url; ?>">
            </div>
            <div class="column large-6">
                <p id="basket-description"><?php echo $response->name; ?></p>
                <p id="basket-total">Total &pound;</p>
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


<div style="display:none;" id="attr_template">

    <div class="medium-6 large-6 columns attr_template attr_key">
        <p>Brand</p>
    </div>


    <div class="medium-6 large-6 columns attr_template attr_value">
        <p>Rowan</p>
    </div>

</div>
    
<script>
    
    
    function find_product( data_in  )
    {
        
        var product = null
        
        jQuery.each( data_in  , function( key, val ) {
        
            if( val.id == currentProductId ) {
                
                product = val;
                return false;
            }
        
        });
        
        return product;
        
    }
    
    
    function update_product( el )
    {
            var product_name    = 'product-name'; // not needed! jQuery( this ).attr( 'data-name' );
            
            var product_id      = jQuery( el ).attr( 'data-id' );
            
            var url             = "/products-list/" + product_id  + "/" + product_name + '?json=1';
            
            jQuery.ajax({
                dataType  : 'json' ,
                url: url
            }).done(function( data ) {
                if ( console && console.log ) {
                    console.log(  data );

                        
                    mySwiper_products.removeAllSlides();
                        
                    for( var image in  data._source.images ){
                        
                        var image_link_el_start = '<a data-image="' + data._source.images[image].url + '" data-zoom-image="' + data._source.images[image].url + '" href="' + data._source.images[image].url + '" class="gallery">';
                        var image_link_el_end   = '</a>';
                        mySwiper_products.appendSlide('<div class="swiper-slide">' + image_link_el_start + '<img src="'  + data._source.images[image].url  + '" />' + image_link_el_end + '</div>');
                        
                    }
                    
                    jQuery('.columns .attr_template').remove();

                    for( var d in  data._source ){
                        
                        console.log(data._source[d]);
                        
                        if( jQuery.inArray( d , core )==-1 && data._source[d] && schema[d] ){
                            
                            
                           var el = jQuery( '#attr_template' ).clone();
                           
                           
                           jQuery('.attr_key p' , el ).text( schema[d].title );
                           jQuery('.attr_value p' , el ).text( schema[d].prepend + data._source[d] + schema[d].append );
                           
                           jQuery('#quantity').before( el.html() );
                        }
                        
                        
                        
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
    }
    
    function update_current_dimension_text( el , dimension )
    {
        jQuery( '#current_' + jQuery( el ).parent().attr( 'id' ) ).text( dimension );
    }
    
    function render_dimension( data , d1 , d2 )
    {
        
        jQuery( '.dimension' ).removeClass('current');
        jQuery( '.dimension' ).hide();
        
        jQuery.each( data  , function( key, val ) {
            
            jQuery( '[data-dimension="'+ key +'"]' ).show();
            // all dimenion one should show
            var topDKey = key;
                  

            if( typeof val != 'object' ){


                jQuery( '[data-dimension="'+ key +'"]' ).attr( 'data-id' , val );
                // for 1d only, as we the data we need
            }                  
                  
                  
            if( key == d1 ){
                
                var current_d1_el = jQuery(  '[data-dimension="'+ d1 +'"]' );
                
                current_d1_el.addClass('current');
                
                update_current_dimension_text( current_d1_el , key );
                
                 
                
                
                


                if( typeof val == 'object' ){
                    /// 2d array onoly
                    
                    var i = 0;
                    jQuery.each( val  , function( key, val ) {
                        if( key == d2 ){

                            jQuery( '[data-dimension="'+ d2 +'"]' ).addClass('current');
                            update_current_dimension_text( jQuery( '[data-dimension="'+ d2 +'"]' ) , key );
                        }

                        if( i == 0 ){

                            jQuery( '[data-dimension="'+ topDKey +'"]' ).attr( 'data-id' , val );
                            // set the lvl1 d to the first levl 2 value
                        }

                        jQuery( '[data-dimension="'+ key +'"]' ).attr( 'data-id' , val );
                        jQuery( '[data-dimension="'+ key +'"]' ).show();
                        // show d2 based on the current selected d1

                        i++;

                    });                  
                }
            }

        });
    }
    
    
    
    var currentProductId    = '<?php echo get_query_var('products'); ?>';
    var zoomConfig          = {cursor: 'crosshair', responsive: true ,   zoomType : "inner",}; 
    var image               = jQuery('.gallery');
    var zoomImage           = jQuery('img#zoom_01');    
    var core                = [];
    var schema              = {};
    var variants            = {};
    var current_product     = null;
    var f_dimension1        = null; // final;
    var f_dimension2        = null; // final;   
    var mySwiper_products   = null;
    
    <?php foreach( $core as $attr => $value ): ?>
    
    core.push('<?php echo $attr ?>');
    
    <?php endforeach;?>
        
        
    <?php foreach( $schema->properties as $key => $property ): ?>
    
    <?php   if(!isset($core[$key] ) ): ?>
                
    schema['<?php echo $key ?>'] = { 'append' : '<?php echo $property->append; ?>' , 'prepend' :  '<?php echo $property->prepend; ?>' ,title :  '<?php echo $property->title; ?>' };
                
    <?php   endif; ?>
    <?php endforeach; ?>
    
    jQuery( document ).ready(function() {


	jQuery(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none' ,
                type            : 'ajax'
	});


        jQuery.getJSON( '<?php echo 'http://ibizaschemas.product/productcatalog.api/api/metadata/' . get_query_var('products'); ?>' , function( data ) {
            
            var el          = jQuery( '<div/>' );
            variants        = data;
            //console.log( el );
            
            console.log( data );
            
            jQuery.each( data.dimensions  , function( key, val ) {
                
                
                var dimension_id    = 'dimension_' + val.name.replace( ' ' , '_'  ).toLowerCase();
                var lvl             = key + 1; 
                
                el.append( '<p class="lvl' + lvl + '_text">' + val.name + ' : <span id="current_' + dimension_id  + '" ></span></p>' );            
                el.append( '<ul id="' + dimension_id + '" class="inline-list row">' );
                
                
                
                jQuery.each( val.members  , function( key, val ) {
                    
                    
                    var d_display = val.name;
                    
                    if( val.image.length > 0 ){
                        
                        d_display = '<img src="' + val.image + '" />';
                        
                    }
                    
                    
                    jQuery( 'ul#' + dimension_id  , el  ).append( '<li class="dimension lvl' + lvl + '" data-dimension="'+ val.name +'">' + d_display + '</li>' );
                    
                });
                
                el.append( '</ul>' );

            });
          
            jQuery( '#product_description' ).after( el );
          
            current_product         = find_product( data.variants );
            f_dimension1            = null; // final;
            f_dimension2            = null; // final;
            
            //console.log( data );
            
            jQuery.each( data.transformedVariants  , function( key, val ) {
                
                var dimension1  = key;
                
                // create seperate method for 1d and 2d
  
  
                console.log( 'Test' );
                
                
                if( typeof val === 'object' ) {


                    jQuery.each( val  , function( key, val ) {

                        var dimension2  = key;

                        if( val == currentProductId ){

                            f_dimension1    = dimension1;
                            f_dimension2    = dimension2;
                            return false;

                        }

                    }); 
                    
                    render_dimension( variants.transformedVariants , f_dimension1 , f_dimension2 );
                    
                } else {
                    
                    
                    
                    if( val == currentProductId ){
                        console.log( variants.transformedVariants );
                        f_dimension1    = dimension1;
                        f_dimension2    = '';
                        
                        render_dimension( variants.transformedVariants , f_dimension1 , f_dimension2 );

                    }                    
                    

                }                

            });
            
            

        });



        //initialize swiper when document ready  
        mySwiper_products = new Swiper('.swiper-container-products', {
            // Optional parameters
            loop: false,
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


        jQuery( document ).on( "click", ".dimension", function() {
            
            var dimension       = jQuery( this ).attr('data-dimension');
            
            if( jQuery( this ).hasClass( 'lvl1' ) ){
                
                f_dimension1    = dimension;
                dimension       = '';
                
            }else{
                f_dimension2    = dimension;
            }
             
            render_dimension( variants.transformedVariants , f_dimension1 ,  f_dimension2  );
            
            if( !dimension ){
                
                jQuery( '.lvl2' ).removeClass('current');
                jQuery( '.lvl2_text span' ).text('');
                
            }
            
            update_product( this );
            
        });
        
        

        
        
        
        

        
        jQuery("#zoom").click(function() {

            var fancy   = [];
            var index = 0;
            var curHref = jQuery( this ).attr( 'href' );
            
            jQuery( ".gallery" ).each(function( indexIn ) {
              
              
                if( jQuery( this ).attr( 'href' ) ==  curHref  ){
                    index = indexIn;
                }
              
              
                fancy.push({
                    href :  jQuery(this).attr( 'href' )  ,                
                    //title : '2nd title'
                            });
            });            
            
            jQuery.fancybox.open( fancy , {
                padding : 0 ,
                index   :  index
            });

            return false;

        });

        jQuery("#zoom_01").elevateZoom( zoomConfig );


        jQuery( document ).on( "click", '.gallery' , function(e) {
            
            
        //image.on('click', function(e){
            e.preventDefault();
            // Remove old instance od EZ
            jQuery("#zoom").attr( 'href', jQuery(this).data('image') );
            jQuery('.zoomContainer').remove();
            zoomImage.removeData('elevateZoom');
            // Update source for images
            zoomImage.attr('src', jQuery(this).data('image'));
            zoomImage.data('zoom-image', jQuery(this).data('zoom-image'));
            // Reinitialize EZ
            zoomImage.elevateZoom(zoomConfig);


        });

        jQuery('#add-basket').click( function( e ){
            
            if( jQuery('.lvl2' ).length>0 && jQuery('.lvl2.current' ).length<=0 ){
                
                e.preventDefault();
                
                return alert( 'Please select ' +  jQuery( '.lvl2_text' ).text() +  ' to continue.' );
                
            }
            
            
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