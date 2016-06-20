<?php
/*
  Template Name: Products List
 */

set_time_limit(0);

$facetsJSON = get_meta_values(  'facets-' .  (int)$_GET['cat']);



$facets = json_decode( $facetsJSON[0] ); 

$jsonPath = get_template_directory() . '/assets/json/data_rc.json';
$jsonData = file_get_contents($jsonPath);
$dataSet = json_decode($jsonData);


use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

// Try both the $singleHandler and $multiHandler independently
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost'])
    ->setHandler($singleHandler)
    ->build();


 
    
/*

    foreach($dataSet as $id=>$dataIn){
        
        
        
         $params = [
            'index' => 'my_products_index',
            'type' => 'my_products_typee',
            'id' => 'productsX_' . $dataIn->product->productDetailId ,
            'body' =>  $dataIn
        ];       
         
         $response = $client->index($params);
    }

        
  */      
         



    /*

    $cats[] =   'Scissors & Cutting Tools';
    $cats[] =   'Ribbons & Trimmings';
    $cats[] =   'Zips & Fastenings';
    $cats[] =   'Threads';
    $cats[] =   'Needles';
    $cats[] =   'Binding & Elastics';
    $cats[] =   'Pins & Pin Cushions';
    $cats[] =   'Repairs & Alterations';
    $cats[] =   'Buttons';
    $cats[] =   'Customising & Decoration';
    $cats[] =   'Thread';


    $nameArr[] =   'Sewing needles';
    $nameArr[] =   'Sewing machine';
    $nameArr[] =   'Sewing needles';
    $nameArr[] =   'Sewing Needle & Thread';
    $nameArr[] =   'Pins';
    $nameArr[] =   'Small Butons';
    $nameArr[] =   'Medium Button';
    $nameArr[] =   'Large buttons';
    $nameArr[] =   'Small Cloth';
    $nameArr[] =   'Large Cloth';
    $nameArr[] =   'Thimble';



    $price[] =   '1.99';
    $price[] =   '5.99';
    $price[] =   '9.99';
    $price[] =   '4.55';
    $price[] =   '9.55';
    $price[] =   '8.88';
    $price[] =   '10.99';
    $price[] =   '50.55';
    $price[] =   '150.55';
    $price[] =   '170.99';
    $price[] =   '17.99';


    
 
    
    for($i=0;$i<=100000;$i++)
    {
        $id = rand(0, 50000000);
        $dataRand1 = rand(1,10);
        $dataRand2 = rand(1,10);
        $dataRand3 = rand(1,10);
        $dataRand4 = rand(1,10);
        
        $dataSet->id      = $id;
        $dataSet->name      = $nameArr[ $dataRand1 ];
        $dataSet->cat       = $cats[ $dataRand2 ];
        $dataSet->imageUrl  = $dataRand3 . '.jpg';
        $dataSet->priceGbp     = $price[ $dataRand4 ];;
        
        $dataSetArr = (array)$dataSet;
        
        $params = [
            'index' => 'my_products_index',
            'type' => 'my_products_typee',
            'id' => 'productsX_' . $id,
            'body' =>  $dataSetArr
        ];
        
        
        
        $response = $client->index($params);
        
        
    }
    */


?>

<?php get_header(); ?>
<script src="http://code.angularjs.org/1.2.16/angular.js"></script>
<script src="http://rawgit.com/YousefED/ElasticUI/master/examples/demo/lib/elasticsearch.angular.js"></script>
<script src="http://rawgit.com/YousefED/ElasticUI/master/examples/demo/lib/elastic.js"></script>
<script src="http://rawgit.com/YousefED/ElasticUI/master/dist/elasticui.min.js"></script>
<script>
    angular
            .module('tutorial', ['elasticui'])
            .constant('euiHost', 'http://localhost:9200'); // ACTION: change to cluster address
</script>
<div id="content" ng-app="tutorial" eui-index="'my_products_index'">

    <!-- Side Bar -->
    <div id="inner-content" class="row">


        <div class="sidebar large-3 medium-3 columns" role="complementary">

            <div id="side-facets">

                <section class="filter-by mod">
                    <header>
                        <p><strong>Filter by</strong></p>
                    </header>
                </section>

                
                
                
                
                
                
                <?php 
                
                
//                foreach($facets as $facet):
//                    
//                    echo $facet->name;
//                    
//                    echo '<select>';
//                
//                    foreach($facet->options as $option ):
//                        
//                        echo  '<option>'. $option .'</option>';
//                        
//                    endforeach;
//                
//                    echo '</select>';    
//                    
//                    
                    
                   
//                endforeach;
                
               ?>
                
                <h3>Search</h3>
                <eui-searchbox field="'product.base.name'"></eui-searchbox> <!-- ACTION: change to field to search on -->
                <h3>Price</h3>
                <eui-singleselect field="'product.webPrice'" size="5"></eui-singleselect> <!-- ACTION: change to field to use as facet -->                
                <h3>Gemstone</h3>
                <eui-singleselect field="'gemstone'" size="5"></eui-singleselect> <!-- ACTION: change to field to use as facet -->
                <h3>Product Category</h3>
                <eui-checklist field="'product.base.category'" size="10"></eui-checklist> <!-- ACTION: change to field to use as facet -->
                <h3>Results Per Page</h3>
                <select ng-model="indexVM.pageSize">
                    <option ng-repeat="item in [12, 20, 50, 100, 200]">{{item}}</option>
                </select>

                

                
            </div>

              

        </div>



        <!-- End Side Bar -->





        <!-- Thumbnails -->





        <main id="main" class="large-9 medium-9 columns" role="main">

            <div class="row">

                <h2><?php echo (string)$_GET['title'] // not safe ?></h2>

                <div class="large-4 small-6 columns" ng-repeat="doc in indexVM.results.hits.hits">

                    <img src="{{doc._source.product.base.imageUri}}">

                    <div class="panel">

                        <h5><a href="/products-list/{{doc._source.product.productDetailId}}/{{doc._source.product.base.name}}">{{doc._source.product.base.name}}</a></h5>

                        <p style="font-size:12px;">{{doc._source.product.base.name}}</p>

                        <h6 class="subheader">&pound;{{doc._source.product.webPrice}}</h6>
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>

                </div>
                <div style="clear:both">&nbsp;</div>
                <eui-simple-paging></eui-simple-paging>

            </div>

            <!-- End Thumbnails -->
         
        </main>
    </div>
</div>

<!-- Footer -->





<?php get_footer(); ?>
