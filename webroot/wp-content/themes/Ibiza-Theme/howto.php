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
<div class="full">
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
    <div class="row" id="howto_main">

        <div class="small-12 medium-12 large-6 columns right">
            <h3 id="product_name"><span>Project:</span> <?php echo $response->data->name; ?></h3>

            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pound-icon.png" /><span class="icon_text">&pound;75.00</span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/level-icon.png" /><span class="icon_text"><?php echo( $response->data->level[0] ); ?></span>
            <h5><?php echo  $response->data->subtitle ?></h5>
            <p  id="product_description"><?php echo $response->data->introduction; ?></p>

            
            <div style="clear:both;margin:10px 0" class="show-for-xlarge">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/facebook-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/twitter-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/pin-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/google-icon.png">
                <img src="/wp-content/themes/Ibiza-Theme/assets/images/print-icon.png">
            </div>            
        </div>
                
                
        <div class="small-12 large-6  columns">
            

            <div class="swiper-container-howto-main">
                
                <div class="swiper-wrapper">
                    <?php foreach( $response->data->image as $image ): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $image->url; ?>" rel="groups" class="th various" title="<?php echo $response->data->name; ?>"><img src="<?php echo $image->url; ?>" /></a>
                    </div>
                    <?php endforeach; ?>   
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>                 
                
                
    </div>
     
    <div>&nbsp;</div>  
        <div class="row">
        
        <div class="medium-4 large-4 columns">                    
            
            <ul class="tabs" data-tabs id="howto-tabs">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"><span>What you will need</span></a><div class="tri"></div></li>
                <li class="tabs-title"><a href="#panel2"><span>Notes</span></a><div class="tri"></div></li>
            </ul>

            <div class="tabs-content" data-tabs-content="howto-tabs">
                <div class="tabs-panel is-active" id="panel1">
                    
                        <?php 
                            foreach($response->data->products as $key => $productGroups):  
                        ?>
                        
                    <div class="sq-border">
                        <p class="arrow"><?php echo $productGroups->title; ?></p>
                        
                        <?php foreach($productGroups->productgroup as $product):?>
                        
                            <div class="required-products row" id="product-<?php echo $product->product;?>">
                                
                                <div class="product-meta">
                                    <div class="product-image  small-3 medium-3 large-3 columns"><img src=""/></div>
                                    <div class="product-info  small-9 medium-9  large-9  columns hidden">
                                        <p class="product-title"><a rel="groups" href="/p/<?php echo $product->product ?>/?bundle=2" class="howto_products" ><?php echo $product->title; ?></a></p>
                                        <p class="product-price"></p>
                                        <input value="Add to Basket" style="background: rgb(229, 111, 99) none repeat scroll 0% 0%; color: rgb(255, 255, 255); border: 0px none; text-transform: uppercase; font-size: 12px; padding: 4px 16px;" type="submit">
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>
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
                <legend><span>Email Newsletter Sign Up</span></legend>
                    
                <p>Aswell as hearing about all the latest news &amp; offers from The Sewing Quarter, you’ll also receive, tips, guides and projects.</p>
                
                <input class="large-5 column" name="first_name" placeholder="First name" />


                <input class="large-5 large-push-1 column" name="last_name" placeholder="Last name" />

                <input class="large-11 column" name="email" placeholder="Email Address" />
                    
                
                <input type="submit" value="Submit" class="submit" />
                
            </fieldset>
            </form>
        </div>
        
        <div class="small-12  large-8 columns">
            <div style="margin:10px 0;background: transparent url(&quot;http://ibiza.dev/wp-content/themes/Ibiza-Theme/assets/css/../images/bg.png&quot;) repeat scroll 0% 0%; padding: 27px 40px;">
            <div class="row" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 19px;">
            <?php ///print_r( $response->data->image ); ?>
                <!-- Slider main container -->
                    <!-- Additional required wrapper -->
                    
                    <?php $i =0; ?>
                    
                    <?php foreach( $response->data->steps  as $key=> $steproups ): ?>
                    <h5><?php echo $steproups->title ?></h5>
                        <?php foreach( $steproups->stepgroup  as $key_inner=> $step ): ?>
                    
                    
                        <?php $i++;  ?>
                    
                    <div class="large-12 columns" style="padding:0">
                            <div class="large-1 small-1 columns" style="padding:0">
                                <span style="display: inline-block; background: #00bcb4; height: 25px; width: 25px; border-radius: 15px; text-align: center; line-height: 25px; color: rgb(255, 255, 255);"><?php echo $i; ?></span>
                            </div>
                            
                            <div class="large-11 small-11 columns">
                                <h5><?php echo $step->title ?></h5>
                                <p style="font-size:12px;"><?php echo $step->description; ?></p>                        
                            
                            
                            <?php 
                            $col = 12;
                            switch ( count($step->image) )
                            {
                                case 1:
                                    $col = 12;
                                    break;
                                case 2:
                                    $col = 6;
                                    break;
                                case 3:
                                    $col = 4;
                                    break;
                                case 4:
                                    $col = 3;
                                    break;
                                default:
                                    $col = 2;
                                    break;
                            }
                            ?>
                            
                            <?php foreach($step->image as $image):   ?>
                                <div class="medium-<?php echo $col; ?> large-<?php echo $col; ?> columns" style="padding:0 2px 0 0">
                                    <a rel="groups" class="th various" href="<?php echo $image->url; ?>"
                                       data-zoom-image="<?php echo $image->url; ?>"  
                                       data-image="<?php echo $image->url; ?>" title="&lt;b&gt;<?php echo $step->title ?>&lt;/b&gt; <?php echo $step->description; ?>">                        
                                    <img  src="<?php echo $image->url; ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
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



        var mySwiper = new Swiper('.swiper-container-howto-main', {
            // Optional parameters
            loop: true ,
            slidesPerView: 1,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev'            
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
                    slidesPerView: 1,
                    spaceBetweenSlides: 20
                },
                // when window width is <= 640px
                640: {
                    slidesPerView: 1,
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
