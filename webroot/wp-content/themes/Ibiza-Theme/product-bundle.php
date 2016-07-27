<?php
/*
  Template Name: Product Page
 */


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
$response               = $rst[0]->data;
$schema                 = json_decode( @file_get_contents( 'http://ibizaschemas.product/productcatalog.api/api/schema/title/' .  $rst[0]->{'$schema'} ) );


?>

<?php //get_header(); ?>


<div id="result">
    <div class="row" id="prodcut_main">
        
        <h4 id="product_name"><?php echo $response->name; ?></h4>
        
        <hr />
        
        <div class="medium-6 columns">

            <img id="zoom_01"   data-zoom-image="<?php echo $response->images[0]->url; ?>" src="<?php echo $response->images[0]->url; ?>">

        </div>
        <div class="medium-6 columns">

           

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


        </div>
    </div>
</div>

    



<?php //get_footer(); ?>