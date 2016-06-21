<?php
/*
  Template Name: Products List
 */

set_time_limit(0);



//$jsonPath   = get_template_directory_uri() . '/assets/json/data_rc.json';
//$jsonData   = file_get_contents($jsonPath);
//$dataSet    = json_decode($jsonData);




$jsonPath   = 'http://52.18.1.60/ProductCatalog.Api/api/webapi/facets/32';
$facetsJSON = file_get_contents($jsonPath);
$facets     = json_decode( $facetsJSON ); 


use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

// Try both the $singleHandler and $multiHandler independently
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://productcatalog.localdev/ProductCatalog.Api/api/webapi/search'])
    ->setHandler($singleHandler)
    ->build();


?>

<?php get_header(); ?>
<script src="http://code.angularjs.org/1.2.16/angular.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/elasticsearch.angular.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/elastic.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/elasticui.js"></script>
<script>
    angular
            .module('ibiza', ['elasticui'])
            .constant('euiHost', 'http://ibizaschemas.product/ProductCatalog.Api/api/webapi/'); // ACTION: change to cluster address
</script>
<div id="content" ng-app="ibiza" eui-index="'my_products_index'" eui-query="ejs.MatchQuery('category', '<?php echo $_GET['cat']; ?>')" ng-model="querystring" eui-enabled="true"  >

    <!-- Side Bar -->
    <div id="inner-content" class="row">

        
        <p><?php echo  implode( ' > ' , breacdcrumbs( 'cat-' . (int)$_GET['cat'] ) ) ; ?></p>
        
        <div class="sidebar large-3 medium-3 columns" role="complementary">

            <div id="side-facets">

                <section class="filter-by mod">
                    <header>
                        <p><strong>Filter by</strong></p>
                    </header>
                </section>
                
                <h3>Search</h3>
                
                
                <eui-searchbox field="'product.base.name'"></eui-searchbox> <!-- ACTION: change to field to search on -->
                
                <!--<h3>Price</h3>
               <eui-singleselect field="'product.webPrice'" size="5"></eui-singleselect>-->   
                
                

                
                <?php foreach( $facets as $facet): ?>
                
                <h3><?php echo ucwords( $facet ); ?></h3>
                <eui-checklist field="'<?php echo $facet; ?>'" size="10"></eui-checklist> <!-- ACTION: change to field to use as facet -->
                
                <?php endforeach;?>
                
                
                
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

                    <img src="{{doc._source.images[0].url}}">

                    <div class="panel">

                        <h5><a href="/products-list/{{doc._source.productcode}}/{{doc._source['_friendly-uri-suffix']}}">{{doc._source.name}}</a></h5>

                        <p style="font-size:12px;">{{doc._source.description}}</p>

                        <h6 class="subheader">&pound;{{doc._source.price}}</h6>
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
