<?php
/*
  Template Name: Products List
 */

set_time_limit(0);

//$jsonPath   = get_template_directory_uri() . '/assets/json/data_rc.json';
//$jsonData   = file_get_contents($jsonPath);
//$dataSet    = json_decode($jsonData);


$ignore_query_strs  = array( 'cat' , 'title' );
$join_str           = array();
foreach( $_GET as $key => $param ){
    
    if( !in_array( $key , $ignore_query_strs ) ) {

        $items =  explode( ',' , $param );
        
        foreach ($items as $item){
            $join_str[] = 'must(ejs.TermFilter(\''. $key .'\', \''. $item .'\'))';
        }
        
    }
    
}

if( count( $join_str ) > 0 ){
    
    $filter         = '.' . implode( '.' , $join_str );
    
}



$jsonPath       = 'http://ibizaschemas.product/ProductCatalog.Api/api/category/categoryId/' . $_GET['cat'];
$facetsJSON     = @file_get_contents($jsonPath);
// remove suppression on production
$facets         = json_decode($facetsJSON);
$category       = 0;
$filter_cat_str = '';
if(!$facets) {
    $facets = array();
}else{
    $facets = $facets[0]->facets;
}

if( isset( $_GET['cat'] ) ) {
    
    $category       = (int)$_GET['cat'];
    $filter_cat_str = "ejs.MatchQuery('_category', '" . $category ."')\"";
    
}

?>

<?php get_header(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/vendor/angular/angular.min.js" type='text/javascript'></script>

<script src="<?php echo get_template_directory_uri(); ?>/vendor/elasticsearch/elasticsearch.angular.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/elastic.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/elasticui.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/app.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/vendor/history.js/scripts/compressed/history.adapter.jquery.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/vendor/history.js/scripts/compressed/history.js"></script>

<script>

var query_str_arr   = {};   
var state_change     = 0;
var indexVm         = {};
<?php // quick fix to monitor the state -1 is when state have been changed, and we want to prevent another state being puished
      // State 1 is when someone click a facet and the state has been pushed, on this case there is a state event, we reset state back to default of 0?>


function fadeSomethingIn()
{
    jQuery('#loading_container').fadeIn();
}

function elastic_callback(body, updateOnlyIfCountChanged) {
    
    jQuery('#loading_container').fadeOut();
    
}


function toQueryString(obj, prefix) {
    
    var str = [], k, v;
    for(var p in obj) {
        if (!obj.hasOwnProperty(p)) {continue;} // skip things from the prototype

        
        if( obj[p].length >0 ){
            
            str.push( p + '=' + obj[p].join(",") );
            console.log(str);
        }
        

    }
    
    return str.join("&");
}
    
jQuery( document ).ready(function() {
    
    
    jQuery('#disable_filter').click( function(){
        
        jQuery('#content').removeAttr('eui-enabled' );
        console.log( indexVm.refresh(true) );
        
    });
    
    History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
        
        if( state_change == 1 ){
            state_change = 0;
            <?php // reset the state ?>
            return;
        }
        var State       = History.getStateByIndex( History.getCurrentIndex() -1  ); // Note: We are using History.getState() instead of event.state

        var state_item  = jQuery( '[data-id="' +  State.data.state + '"]' );
        state_change    = -1; <?php // prewvent another state update?>
        state_item.click(); 
        
    });
    
    
    jQuery(document).on('click', '.pager a', function() {
        
        fadeSomethingIn()
        
    });
    
    jQuery(document).on('change', '.ng-scope input', function() {

        fadeSomethingIn()

        var field       =  jQuery( this ).parents('eui-checklist').attr( 'field' ).replace( /\'/g ,'' ) ;
        var value       =  jQuery(this).attr('data-id').replace( 'the_value_' + field + '_' ,'' ) ;   
        var changedEl   = this;

        if( jQuery(this).attr('checked')   ){

            if(query_str_arr[field]){
                
                query_str_arr[field].push(value);
                
            }else{
             
                query_str_arr[field] = Array(1).fill(value);
            
            }
        
        }else{
            
            console.log( query_str_arr[field] );
            if( jQuery.inArray(  value , query_str_arr[field] ) != -1 ){
                
                query_str_arr[field].splice( jQuery.inArray(value, query_str_arr[field] ), 1 );
                
            }
            // remove item from
            //change state
            
        }
        
        
        if(state_change==-1){
            
            state_change = 0;
            
        }else{
            state_change  =1;
        
            History.pushState({state: jQuery( changedEl ).attr('data-id')  }, "State 1",  'http://localdev.jewellerymaker.com/products-list/?cat=<?php echo $_GET['cat']; ?>&title=<?php echo $_GET['title']; ?>&' + toQueryString(query_str_arr, '') ); // logs {state:1}, "State 1", "?state=1"
        
            console.log(query_str_arr);
        }
        

        
    });
 });    
</script>





<div id="content" ng-controller="IndexController" ng-app="ibiza" eui-index="'documents'"  eui-filter="ejs.BoolFilter().must(<?php echo $filter_cat_str; ?><?php echo $filter; ?>" ng-model='querystring' eui-enabled='true'>
    
   
    
<!--    <a href="#" id="disable_filter">Button</a>-->
    
    <div id="loading_container" class="row" style=" left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;background: white none repeat scroll 0% 0%; height: 75%; z-index: 0; position: absolute; width: 100%; display: block ! important;" class="">
        
        
    <img src="https://d13yacurqjgara.cloudfront.net/users/1275/screenshots/1198509/plus.gif" style="margin: 0px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100px;">
        
    </div>
    
    <!-- Side Bar -->
    <div id="inner-content" class="row" <?php echo $filter_cat_str1;?>>
         
        <div  <?php echo $filter_cat_str1 ;?> />
<!--        <eui-checklist field="'dimensions.raw'" size="5"></eui-checklist>-->
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <?php echo implode('', breacdcrumbs('cat-' . (int) $_GET['cat'])); ?></p>
            </ul>
        </nav>
        <div class="sidebar large-3 medium-3 columns" role="complementary">

            <div id="side-facets">

                <section class="filter-by mod">
                    <header>
                        <p><strong>Filter by</strong></p>
                    </header>
                </section>

                <h3>Search</h3>
                
                <eui-searchbox field="'name'"></eui-searchbox> <!-- ACTION: change to field to search on -->

                <!--<h3>Price</h3>
               <eui-singleselect field="'product.webPrice'" size="5"></eui-singleselect>-->   


                
<!--                <ul eui-aggregation="ejs.TermsAggregation('agg_name').field('material').size(20)">
    <li ng-repeat="bucket in aggResult.buckets">test</li>
</ul>-->
                
                <?php foreach( $facets as $facet ): ?>
                
                <h3><?php echo ucwords( $facet->displayname ); ?></h3>
                <eui-checklist field="'<?php echo $facet->name; ?>'" size="10"></eui-checklist> <!-- ACTION: change to field to use as facet -->
                
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

                <h2><?php echo (string) $_GET['title']; // not safe  ?></h2>
                <div></div>
                <div class="large-4 small-6 columns" ng-repeat="doc in indexVM.results.hits.hits">

                    <img src="{{doc._source.images[0].url}}" />

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
