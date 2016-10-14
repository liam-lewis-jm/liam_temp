<?php
/*
  Template Name: Product Page
 */



global $ibiza_api;
$product_type           = sanitize( $_GET['type'] );
$response               = $ibiza_api->get_howto(get_query_var('the_id'));
$core['name']           = 1;
$core['category']       = 1;
$core['image']          = 1;
$core['steps']          = 1;
$core['products']       = 1;
$core['images']         = 1;
$core['subtitle']       = 1;
$core['introduction']   = 1;
$core['_category']      = 1;

if( isset( $_GET['json'] ) ){
    echo json_encode( $response );
    die;
}



?>

<?php get_header(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.elevateZoom-3.0.8.min.js"></script>
<div>
    <div class="row columns">
        <nav aria-label="You are here:" role="navigation">

            <ul class="breadcrumbs">

                <?php echo  implode( '' , breacdcrumbs( 'cat-' . (int)$response->data->category[0]  ) ) ; ?>

                <li>
                    <span class="show-for-sr">Current: </span> <?php echo $response->data->name; ?>
                </li>

            </ul>
        </nav>
    </div>
</div>

<div id="result">
    <div class="row" id="prodcut_main">

        <div class="medium-6 large-6 columns right">
            <h3 id="product_name">Project: <?php echo $response->data->name; ?></h3>

            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pound-icon.png" /> &pound;75.00
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/level-icon.png" /><?php echo( $response->data->level[0] ); ?>
            
            <p  id="product_description"><?php echo $response->data->introduction; ?></p>

            
            <div style="clear:both;margin:10px 0">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/facebook-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/twitter-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/pin-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/google-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/print-icon.png">
            </div>            


            <div class="row">

                <div class="medium-6 large-6 columns">

                    <h5><?php echo  $response->data->subtitle ?></h5>
                    <p><?php echo  $response->data->introduction ?></p>
                </div>
                
                
                <div class="medium-6 large-6  columns">
                    <?php ///print_r( $response->data->image ); ?>
                    <a href="<?php echo $response->data->image; ?>" rel="groups" class="th various" title="<?php echo $response->data->name; ?>"><img src="<?php echo $response->data->image[0]->url; ?>" /></a>
                </div>                 
                
                
            </div>

            
      
    
    
        </div>

        
     
        
        <div class="row">
        
        <div class="medium-4 large-4 columns">                    
            
            <ul class="tabs" data-tabs id="example-tabs">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"><span>What you will need</span></a></li>
                <li class="tabs-title"><a href="#panel2"><span>Notes</span></a></li>
            </ul>

            <div class="tabs-content" data-tabs-content="example-tabs">
                <div class="tabs-panel is-active" id="panel1">
                    
                        <p>Click on the links below to shop for products you will need:</p>
                        <?php 
                            foreach($response->data->products as $key => $product):  
                        ?>
                            <div class="required-products row" id="product-<?php echo $product->product;?>">
                                
                                <div class="product-meta">
                                    <div class="product-image large-3 columns"><img src=""/></div>
                                    <div class="product-info large-9  columns hidden">
                                        <p class="product-title"><a rel="groups" href="/p/<?php echo $product->product ?>/?bundle=2" class="howto_products" ><?php echo $product->title; ?></a></p>
                                        <p class="product-price"></p>
                                        <input type="submit" value="Add to Basket" />
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    
                    
                </div>
                <div class="tabs-panel" id="panel2">
                    <div class="row medium-up-12 large-up-12">
                        <div class="column">

                        </div>
                    </div>
                </div>
            </div>            
            
            
            <form>
            <fieldset>
                <legend><img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail-icon.png" />Email Newsletter Sign Up</legend>
                    
                <input class="large-6 column" name="first_name" placeholder="First name" />


                <input class="large-6 column" name="last_name" placeholder="Last name" />

                <input class="large-12 column" name="email" placeholder="Email Address" />
                    
                
                <input type="submit" value="Submit" />
                
            </fieldset>
            </form>
        </div>
        
        <div class="medium-8 large-8 columns">
            <?php ///print_r( $response->data->image ); ?>
            <a href="<?php echo $response->data->image; ?>" rel="groups" class="th various" title="<?php echo $response->data->name; ?>"><img src="<?php echo $response->data->image[0]->url; ?>" /></a>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <!-- Slider main container -->
                    <!-- Additional required wrapper -->

                    <?php foreach( $response->data->steps  as $key=> $step ): ?>

                    <div class="large-6 columns">

                        <span style="display: inline-block; background: red none repeat scroll 0% 0%; height: 25px; width: 25px; border-radius: 15px; text-align: center; line-height: 25px; color: rgb(255, 255, 255);"><?php echo $key+1; ?></span>

                        <h5><?php echo $step->title ?></h5>
                        <p style="font-size:12px;"><?php echo $step->description; ?></p>                        
                        
                        <a rel="groups" class="th various" href="<?php echo $step->image; ?>"
                           data-zoom-image="<?php echo $step->image; ?>"  
                           data-image="<?php echo $step->image; ?>" title="&lt;b&gt;<?php echo $step->title ?>&lt;/b&gt; <?php echo $step_image->description; ?>">                        
                        <img  src="<?php echo $step->image; ?>">
                        </a>

                    </div>

                    <?php endforeach; ?>
            </div>
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

                
        jQuery( ".required-products a" ).each(function( index ) {

            var url = jQuery(this).attr( 'href' ).replace('bundle' , 'json' );
            
            jQuery.getJSON( url , function( data ) {

               console.log(data.images[0].url);
                
                jQuery( '.product-image img' ,  '#product-' + data.productcode ).attr( 'src' , data.images[0].url );
                jQuery( '.product-price' ,  '#product-' + data.productcode ).text( '£' + data.price.toFixed(2) );
                
                
            });


        });
        
        
	jQuery(".various").fancybox({
		maxWidth	: 800   ,
		maxHeight	: 600   ,
		fitToView	: false ,
		width		: '70%' ,
		height		: '100%' ,
		autoSize	: false ,
		closeClick	: false ,
		openEffect	: 'none',
		closeEffect	: 'none',
                type            : 'ajax',
                nextEffect      : 'none',
                prevEffect      : 'none',
                type            : 'image' ,
		helpers	: {
			title	: {
				type: 'over'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}                
	});

	jQuery(".howto_products").fancybox({
		maxWidth	: 800   ,
		maxHeight	: 600   ,
		fitToView	: false ,
		width		: '70%' ,
		height		: '70%' ,
		autoSize	: false ,
		closeClick	: false ,
		openEffect	: 'none',
		closeEffect	: 'none',
                type            : 'ajax',
                nextEffect      : 'none',
                prevEffect      : 'none'           
	});


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
            var url             = "/p/" + product_id  + "/" + product_name + '?json=1&type=<?php echo $product_type; ?>';
            
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
                url: 'http://<?php echo $_SERVER['SERVER_NAME']; ?>/proxy.php?auctionID=-1&productCode=<?php echo 'WTTY01'; //$response['_source']['legacyCode']; ?>&productDetailID=<?php echo '361247'; //$response['_source']['product']['productDetailId']; ?>&quantity=' + quantity
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
