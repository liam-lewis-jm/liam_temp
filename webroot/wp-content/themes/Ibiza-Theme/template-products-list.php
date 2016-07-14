<?php
/*
  Template Name: Products List
 */

set_time_limit(0);

//$jsonPath   = get_template_directory_uri() . '/assets/json/data_rc.json';
//$jsonData   = file_get_contents($jsonPath);
//$dataSet    = json_decode($jsonData);

$sort               = array( 0 => 'Default' , 1 => 'Price (Low - High)' , 2 => 'Price (High - Low)' );
$ignore_query_strs  = array( 'cat' , 'title' , 'count' , 'sort' , 'pager' , 'q' );
$page_sizes         = array( 1 , 5 , 12 , 20 ,50 ,100 ,200 );
$join_str           = array();


$jsonPath           = 'http://ibizaschemas.product/ProductCatalog.Api/api/category/categoryId/' . $_GET['cat'];
$facetsJSON         = @file_get_contents($jsonPath);
// remove suppression on production
$facets             = json_decode($facetsJSON);

$category           = 0;
$filter_cat_str     = '';
if(!$facets) {
    $facets = array();
}else{
    $facets = $facets[0]->facets;
}

if( isset( $_GET['cat'] ) && is_numeric( $_GET['cat'] ) ) {
    
    $category       = (int)$_GET['cat'];
    $filter_cat_str = "ejs.TermFilter('_category', '" . $category ."')";
    
}


$rangePath      = 'http://ibizaschemas.product/ProductCatalog.Api/api/pricerange/range/0/20000';
$rangeJSON      = @file_get_contents($rangePath);
$range          = json_decode($rangeJSON);


?>

<?php get_header(); ?>

<div id="content"   ng-controller="IndexController" ng-app="ibiza"  eui-index="'product'"  <?php echo  $filter_cat_str ? 'eui-filter="ejs.BoolFilter().must('. $filter_cat_str.')"' : '' ; ?>  ng-model='querystring'  eui-enabled='true' <?php  echo $_GET['q'] ?  'eui-query="ejs.QueryStringQuery(\'' . $_GET['q'] .'*\').lenient(true).fields(\'name\')"' : ''; ?>>
<!--    
        <a href="#" id="disable_filter">Button</a>-->
    
    <div id="loading_container" class="row" style=" left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;background: white none repeat scroll 0% 0%; height: 75%; z-index: 0; position: absolute; width: 100%; display: block ! important;" class="">
        
        
    <img src="https://d13yacurqjgara.cloudfront.net/users/1275/screenshots/1198509/plus.gif" style="margin: 0px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100px;">
        
    </div>
    
    <!-- Side Bar -->
    <div id="inner-content" class="row" <?php echo $filter_cat_str1;?>>
         
        
        <nav aria-label="You are here:" role="navigation"   class="column">
            <ul class="breadcrumbs">
                <?php echo implode('', breacdcrumbs('cat-' . (int) $_GET['cat'])); ?></p>
            </ul>
        </nav>
        <div class="sidebar large-3 medium-3 columns" role="complementary">

            <div id="side-facets">

                <h3>Search</h3>
                
                <eui-searchbox field="'name'"></eui-searchbox> <!-- ACTION: change to field to search on -->

                <?php
                foreach( $facets as $facet ): 
                    
                ?>
                
                <h3><?php echo ucwords( $facet->displayname ); ?></h3>

                <?php 
                    
                    switch ( $facet->name ):
                        case 'price':
                            
                ?>

                <?php foreach($range->ranges as $the_the_range):  ?>
                
                <eui-range field="'<?php echo $facet->name; ?>.raw'"  min="'<?php echo $the_the_range->start ?>'"  max="'<?php echo $the_the_range->end ?>'"   size="10"></eui-range>

                <?php endforeach;?>
                
                <?php 
                
                    break;
                    default: 
                ?>
                <eui-checklist field="'<?php echo $facet->name; ?>.raw'" size="10"></eui-checklist> <!-- ACTION: change to field to use as facet -->

                
                <?php 
                    endswitch; 
                ?>

                <?php endforeach; ?>
                

                <h3>Results Per Page</h3>
                <select ng-model="indexVM.pageSize" id="count" data-id="the_count">
                    <?php foreach( $page_sizes as $key => $page_size ): 

                    $selected == 'selected="selected"';

                    if( isset( $_GET['count'] ) &&  $_GET['count'] == $$page_size ){

                        $selected == 'selected="selected"';

                    }
                    ?>
                    <option value="<?php echo $page_size; ?>"  <?php echo $selected;?>><?php echo $page_size; ?></option>
                    <?php endforeach; ?>                    
                </select>

            </div>

        </div>



        <!-- End Side Bar -->


        <!-- Thumbnails -->
        <main id="main" class="large-9 medium-9 columns" role="main" >

            <div class="row">

                <h3><?php echo (string) $_GET['title']; // not safe  ?></h3>
                <div></div>
                <div class="large-4 small-6 columns" ng-repeat="doc in indexVM.results.hits.hits"  >

                    

                    <div class="panel"  ng-if="doc._index=='product'" >
                        <img src="{{doc._source.images[0].url}}" />
                        <h5><a href="/products-list/{{doc._source.productcode}}/{{doc._source['_friendly-uri-suffix']}}">{{doc._source.name}}</a></h5>

                        <p style="font-size:12px;">{{doc._source.description}}</p>

                        <h6 class="subheader">&pound;{{ doc._source.price | number : 2}}</h6>
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>

                    <div class="panel"  ng-if="doc._index=='howto'" >
                        <img src="{{doc._source.image}}" />
                        <h5><a href="/products-list/{{doc._id}}/{{doc._source.name}}?type={{doc._type}}">{{doc._source.name}}</a></h5>

                        <p style="font-size:12px;">{{doc._source.introduction}}</p>

                    </div>

                </div>
                
                <div style="clear:both">&nbsp;</div>
                
                <div style="float: left; clear: left; margin-top: 40px;">
                
                    <eui-simple-paging></eui-simple-paging>
                    
                    <select id="sort_order">
                        

                        <?php foreach( $sort as $key => $sort_opt ): ?>
                        
                        <option value="<?php echo $key; ?>" ><?php echo $sort_opt; ?></option>
                        
                        <?php endforeach; ?>
                        
                    </select>
                    
                </div>
                
            </div>

            <!-- End Thumbnails -->

        </main>
    </div>
</div>

<!-- Footer -->
<script src="<?php echo get_template_directory_uri(); ?>/vendor/angular/angular.min.js" type='text/javascript'></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/purl.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/vendor/elasticsearch/elasticsearch.angular.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/elastic.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/elasticui.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/elastic/new/app.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/vendor/history.js/scripts/compressed/history.adapter.jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/vendor/history.js/scripts/compressed/history.js"></script>

<script>
var started             = 0;
var query_str_arr       = {};   
var state_change        = 0;
var indexVm             = {};
<?php // quick fix to monitor the state -1 is when state have been changed, and we want to prevent another state being puished
      // State 1 is when someone click a facet and the state has been pushed, on this case there is a state event, we reset state back to default of 0?>

function setSort( sortIn )
{
        
    var sort = parseInt( sortIn );
    
    switch( sort ) {

        case 1:
            indexVm.sort = ejs.Sort('price').order('acs') ;
            break;
        case 2:
            indexVm.sort = ejs.Sort('price').order('desc') ;
            break;
        default:
            indexVm.sort = null;
            //
    }        
    
}

function setPage( pageIn )
{
        
    var page        = parseInt( pageIn );
    indexVm.page    = null;
    
    if( page ) {
        
        indexVm.page = page ;
        
    }        
    
}


function fadeSomethingIn()
{
    jQuery('#loading_container').fadeIn();
}

function elastic_callback(body, updateOnlyIfCountChanged) {
    
    
    // add page to query as it may have updated
    // only a ever single value, so remove then readd new value
    
    jQuery('#loading_container').fadeOut( function(){
    
        /// app must run once after out first call back, to add and facets from the query string
        if( started == 0 ){
            
            
            
            //jQuery('#loading_container').stop().animate({opacity:'100'});
            app();
            started = 1;
            
        }else{
          
            // pager needs to run every time we hit the callback, incase it has changed
            if(  typeof  query_str_arr == "undefined"  &&  query_str_arr['pager'][0] == indexVm.page ){

                return;
                
            }
            
            if( query_str_arr['pager'] ){

                removeQueryString( 'pager' , query_str_arr['pager'][0] );  

            }

            addQueryString( 'pager' , indexVm.page );
            state_change    = 1;

            push_state( null , query_str_arr );                     
            <?php /**
             * @todo make sure double reload is not causing any bugs
             */
            ?>
        }
        
    });
    
  
    
}


function app()
{
   
    console.log( 'App started' );
    var ignore          = new Array();
    var shouldRefresh   = false; // should refresh if something is updated baseed on query string, iideally need a way to only search once everything is set up, temp solution
    var count           = jQuery.url().param('count');
    var pager           = jQuery.url().param('pager');
    var sort            = jQuery.url().param('sort');
      
    if ( undefined !=  count ) {
          
        indexVm.pageSize  = count;
        jQuery('#count option[value="' + pager + '"]').attr("selected" , "selected" );
        // do a UI update
        shouldRefresh     = true;
        addQueryString( 'count' ,count );
          
    }
      
    if ( undefined !=  pager ) {

        setPage( pager ); 
        shouldRefresh     = true;
        addQueryString( 'pager' , pager );
    }

    if ( undefined !=  sort ) {

        setSort( sort );
        jQuery('#sort_order').val( sort );
        // do a UI update          
        shouldRefresh     = true;
        addQueryString( 'sort' , sort );
    }

    // if a facet is selected, should refresh can change to false, as adding facets will do the refresh for us
    // add out q string params we should ignore
    
    <?php foreach( $ignore_query_strs as $query_str ): ?>ignore.push( '<?php echo $query_str; ?>' );
    <?php endforeach; ?>
    
    console.log( 'Ignore the following' );
    console.log( ignore );

    // move to functon
    // rebuild query string
    console.log( 'Start rebuild' );
    for( var data in jQuery.url().param() )
    {
        
        var params   = jQuery.url().param( data ).split(',');

        if( jQuery.inArray(  data ,  ignore  ) == -1 ){
            
            shouldRefresh     = false;
            //  no need to refresh
            for( var param in params )
            {
                // set check boxes in ui
                state_change = -1; // prevent state from changing
                jQuery('[data-id="the_value_' + data + '_'+  params[param] + '"]').trigger("click");
                
            }
        }
    } 
    
    console.log( 'End rebuild' );

    if( shouldRefresh ){

        indexVm.refresh( true );
        console.log( 'Refresh results' );
    }
    
    console.log( 'Complete' );
    
}

function push_state( changedEl , query_str_arr )
{
    var protocol    = jQuery.url().attr('protocol');
    var url         = jQuery.url().attr('host');
    var directory   = jQuery.url().attr('directory');
    var q           = jQuery.url().param('q');
    var cat         = jQuery.url().param('cat');
    var title       = jQuery.url().param('title');
    
    if(q){
        History.pushState({state: jQuery( changedEl ).attr('data-id')  }, "State 1",  protocol + '://' + url +  directory  +  '?q=' + q + '&' + toQueryString(query_str_arr, '') );
    }else{
        History.pushState({state: jQuery( changedEl ).attr('data-id')  }, "State 1",  protocol + '://' + url +  directory  +  '?cat=' + cat + '&title=' + title + '&' + toQueryString(query_str_arr, '') );       
    }
    
}

function addQueryString( field , value ){
    
    if(query_str_arr[field]){

        query_str_arr[field].push(value);

    }else{

        query_str_arr[field] = Array(1).fill(value);

    }    
    
}

function removeQueryString( field , value ){

    if( jQuery.inArray(  value , query_str_arr[field] ) != -1 ){

        query_str_arr[field].splice( jQuery.inArray(value, query_str_arr[field] ), 1 );

    }
            
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
        
    jQuery( '#count' ).change( function(){ 
        
        // only a ever single value, so remove then readd new value        
        state_change        = 1;
        setPage( 1 ); 
        
        // reset back to page 1
        if( query_str_arr['pager'] ){
            
            removeQueryString( 'pager' , query_str_arr['pager'][0] );  
            
        }         
        
        addQueryString( 'pager' , 1 );
        
        // reset back to page 1
        if( query_str_arr['count'] ){
            
            removeQueryString( 'count' , query_str_arr['count'][0] );  
            
        }        
        
        addQueryString( 'count' , jQuery(this).val() );
        push_state( this  , query_str_arr )
    
    });
    
    jQuery( '#sort_order' ).change( function(){ 
    
        state_change = 1;
        var sort = jQuery( this ).val();
        setSort( sort );
        
        // only a ever single value, so remove then readd new value
        
        if( query_str_arr['sort'] ){
            
            removeQueryString( 'sort' , query_str_arr['sort'][0] );  
            
        }
          
        addQueryString( 'sort' , sort );
        push_state( this  , query_str_arr );        
        
        indexVm.refresh( false );
    
    });
    
    
    jQuery('#disable_filter').click( function(){
        
        indexVm.sort = ejs.Sort('name').order('acs') ;
        indexVm.refresh( false );
        
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
    
    jQuery(document).on('change', '.ng-scope input', function() {
        
        fadeSomethingIn();

        var field       = jQuery( this ).parents('eui-checklist,eui-range').attr( 'field' ).replace( /\'/g ,'' ) ;
        var value       = jQuery(this).attr('data-id').replace( 'the_value_' + field + '_' ,'' ) ;   
        var changedEl   = this;

        console.log( value );

        if( jQuery(this).attr('checked') ){

            addQueryString( field , value );
        
        }else{
            
            removeQueryString( field , value );
            // remove item from
            
        }
        
        if( state_change==-1 ){
            
            state_change    = 0;
            
        }else{
            state_change    = 1;
            push_state( changedEl , query_str_arr  );

        }
    });
 });    
</script>


<?php get_footer(); ?>
