<?php
/*
  Template Name: Products List
 */

global $ibiza_api;

$join_str           = array();
$cat                = $ibiza_api->get_product_list_category(  get_query_var('the_id') );
$sort               = $ibiza_api->get_product_list_sort_options();
$ignore_query_strs  = $ibiza_api->get_product_list_ignored_query_strings();
$page_sizes         = $ibiza_api->get_product_list_pages_sizes();
$jsonPath           = $ibiza_api->get_product_list_api_url( $cat );
$facets             = $ibiza_api->get_product_list_facets( $jsonPath , $cat );
$range              = $ibiza_api->get_product_list_price_range(); 
$catss              = $ibiza_api->get_product_list_top_level_categorys( $cat );
$facetsOb           = $ibiza_api->get_product_list_facets_object();
// most follow after above as get_product_list_top_level_categorys set whether or not it is top level
$top_level          = $ibiza_api->is_top_level;    
$filter_cat_str     = "ejs.TermFilter('_category', '" . $cat ."')";
$title              = $ibiza_api->get_product_list_title( get_query_var('products') );
$index              = 'product';

if($cat==0){
    $filter_cat_str     = '';
}


$breadcrumbs        = breacdcrumbs('cat-' . $cat  );
$cat_title          = $ibiza_api->cat_data->title; 
$segments           = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                        


if( $segments[0] == 'how-to-guides'  ){
    $index              = 'howto';
    $cat_title          = $cat_title;
    $sort               =  array();
} 


?>

<?php get_header(); ?>

<div id="content"   ng-controller="IndexController" ng-app="ibiza"  eui-index="'<?php echo $index; ?>'"  <?php echo  $filter_cat_str ? 'eui-filter="ejs.BoolFilter().must('. $filter_cat_str.')"' : '' ; ?>  ng-model='querystring'  eui-enabled='true' <?php  echo $_GET['q'] ?  'eui-query="ejs.QueryStringQuery(\'' . $_GET['q'] .'*\').lenient(true).fields(\'name\')"' : ''; ?>>
<!--    
        <a href="#" id="disable_filter">Button</a>-->
    
    <div id="loading_container" class="row" style=" left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;background: #fff none repeat scroll 0% 0%; height: 75%; z-index: 0; position: absolute; width: 100%; " class="">
        
        
        
    </div>
    
    <div id="loading_container2" class="row" style=" left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;background: white none repeat scroll 0% 0%; height: 75%; z-index: 0; position: absolute; width: 100%; " class="">
        
        
    <img src="https://d13yacurqjgara.cloudfront.net/users/1275/screenshots/1198509/plus.gif" style="margin: 0px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100px;">
        
    </div>


    <!-- Side Bar -->
    <div class="medium-10 medium-offset-1">
        <div class="columns cat-desc row">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <?php echo implode('', $breadcrumbs); ?>
                </ul>
            </nav>
            <?php if($ibiza_api->cat_data->bannerimage):?>
                <div style="height:200px;overflow: hidden">
                    <img style="width: 100%" src="<?php echo$ibiza_api->cat_data->bannerimage; ?>" />
                </div>
            <?php endif; ?>

            <h3><?php echo ucwords($cat_title); ?></h3>

            <?php if($ibiza_api->cat_data->description): ?>
                <?php echo nl2br( $ibiza_api->cat_data->description);?>                   
            <?php else:?>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="product-list-container">
        <div id="inner-content-product-list" class="row" <?php echo $filter_cat_str1;?>>
            <div class="sidebar columns large-2 medium-12 small-12 large-text-left text-center" role="complementary">

                <?php if($index=='howto'): ?>
                <div id="side-facets">

                      <h3>Search</h3>

                      <eui-searchboxx>
                          <p onclick="toggleFacets(jQuery(this).parent());">></p>
                      </eui-searchboxx> 
                </div>
                <?php endif; ?>

                <?php if($top_level == false && $index=='product'): ?>










                <div class="applied-filters">
                    <p>Applied Filters</p>
                    <ul class="add_facets"></ul>
                    <button id="reset-filter" aria-expanded="false" aria-haspopup="true" data-yeti-box="example-dropdown2" data-is-focus="false" aria-controls="example-dropdown2" class="button" style="vertical-align: top">RESET ALL</button>
                </div>




                <div id="side-facets">
                    <?php
                    if(count($facets))
                    foreach( $facets as $facet ): 

                    ?>


                    <?php 

                        switch ( $facet->name ):
                            case 'price':
                    ?>
                    <h3><?php echo ucwords( $facet->displayname ); ?></h3>

                    <?php foreach($range->ranges as $the_the_range):  ?>
                    <eui-range display="'<?php echo ucwords( $facet->displayname ); ?>'" field="'<?php echo $facet->name; ?>.raw'"  min="'<?php echo $the_the_range->start ?>'"  max="'<?php echo $the_the_range->end ?>'"   size="10"></eui-range>

                    <?php endforeach;?>
                    <?php

                        break;
                        default:
                    ?>
                    <hr>
                    <eui-checklist  display="'<?php echo ucwords( $facet->displayname ); ?>'" field="'<?php echo $facet->name; ?>.raw'" size="10"><p onclick="toggleFacets(jQuery(this).parent());">toggle</p></eui-checklist> <!-- ACTION: change to field to use as facet -->
                    <?php 
                        endswitch; 
                    ?>

                    <?php endforeach; ?>

                </div>










                <?php else: ?>

                <ul>

                <?php foreach($catss as $cat): ?>

                    <li><a href="<?php echo $cat->url; ?>"><?php echo $cat->post_title; ?></a></li>

                <?php endforeach; ?>


                </ul>

                <?php endif; ?>
            </div>



            <!-- End Side Bar -->


            <!-- Thumbnails -->
            <main id="main" class="large-10 show-for-large product-category-page columns" role="main" >

                <section class="row" id="second-band">

                    <?php if (is_active_sidebar('pop-cat-1') && is_active_sidebar('pop-cat-2') ) : ?>

                    <article class="large-6 category-boxes catLarge columns">

                        <?php dynamic_sidebar('pop-cat-1'); ?>

                    </article>          

                    <article class="large-6 category-boxes catLargeRight columns">

                        <?php dynamic_sidebar('pop-cat-2'); ?>

                    </article>          


                    <?php else: ?>



                    <?php if (is_active_sidebar('pop-cat-1')) : ?>

                    <article class="large-6 category-boxes catLarge columns">

                        <?php dynamic_sidebar('pop-cat-1'); ?>

                    </article>          

                    <?php endif; ?>     

                    <?php if (is_active_sidebar('pop-cat-2')) : ?>

                    <article class="large-6 category-boxes catLargeRight columns">

                        <?php dynamic_sidebar('pop-cat-2'); ?>

                    </article>          

                    <?php endif; ?>     




                    <?php endif; ?> 

                    <div class="clear"></div>
                    
                    
                    <?php if (is_active_sidebar('pop-cat-3')) : ?>

                    <article class="large-12">

                        <?php dynamic_sidebar('pop-cat-3'); ?>

                    </article>

                    <?php endif; ?>        
                </section>

                <section class="row">
                    <article class="large-12 columns">
                        <?php dynamic_sidebar('featured-products'); ?>
                    </article>
                </section>

                <!-- End Thumbnails -->
            </main>
        </div>
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
var searchables         = '';
<?php  

function add_quotes( $string ) {
  $ret = "\'" . $string . "\'";
  return   $ret;
}

if(count($facetsOb[0]->searchables)):

$facetsOb[0]->searchables = array_map( 'add_quotes', $facetsOb[0]->searchables); 

?>

searchables         = '<?php print  implode( ',' , $facetsOb[0]->searchables  ); ?>';
<?php 
endif;
//// quick fix to monitor the state -1 is when state have been changed, and we want to prevent another state being puished
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


function fadeContainerIn()
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
            /*if(  typeof  query_str_arr == "undefined"  &&  query_str_arr['pager'][0] == indexVm.page ){

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
            ?>*/
            jQuery('#loading_container2').fadeOut( function(){
                
                
                
                setTimeout(function(){ 
                
    
                    jQuery( 'ul.nav-list' ).each(function( index ) {

                        if( jQuery( this ).children('li.ng-scope').length<=0 ){
                            
                            jQuery( this ).parent().hide();
                        }else{
                            jQuery( this ).parent().show();
                        }

                    }); 
                    
                }, 150);
                
               
                
            });

            setTimeout(function(){  addMobileMenu(); }, 750);
            /**
             * @todo need more reliable way, as this will not work for slow connections
             */
        }
        
    });
    
  
    
}


function addSelectedFilter( changedEl , selectedFacet )
{

    var elSelectedFacet =  '<li data-idx="'+ jQuery( changedEl ).attr('data-id') +'"> X ' + selectedFacet + '</li>';
        
    jQuery( elSelectedFacet ).appendTo( '.add_facets' );

    jQuery( document ).on( "click", 'li[data-idx="'+ jQuery( changedEl ).attr('data-id') +'"]', function() {

        jQuery('#inner-content-product-list input[data-id="'+ jQuery( changedEl ).attr('data-id') +'"]').click();

    });    
    
}


function app()
{
   
    console.log( 'App started' );
    var ignore          = new Array();
    var shouldRefresh   = false; // should refresh if something is updated baseed on query string, iideally need a way to only search once everything is set up, temp solution
    var hasQueryParam   = false;
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
            
            shouldRefresh       = false;
            hasQueryParam       = true;
            //  no need to refresh
            for( var param in params )
            {
                // set check boxes in ui
                state_change = -1; // prevent state from changing
                jQuery('[data-id="the_value_' + data + '.raw_'+  params[param] + '"]').trigger("click");
                
            }
        }
    } 
    
    console.log( 'End rebuild' );

    if( shouldRefresh ){

        indexVm.refresh( true );
        console.log( 'Refresh results' );
    }else{
        
        if(hasQueryParam==false)
        {
            jQuery('#loading_container2').fadeOut();
        }
    }
    //
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
        History.pushState({state: jQuery( changedEl ).attr('data-id')  }, "State 1",  protocol + '://' + url +  directory  +  '?' + toQueryString(query_str_arr, '') );       
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

function addMobileMenu()
{
    
    jQuery('#off-canvas-left .sidebar').remove();        
    var sideBar = jQuery('.sidebar').clone(false,false);
    jQuery(sideBar).appendTo('#off-canvas-left');
    jQuery('.show-for-large' , '#off-canvas-left').removeClass('show-for-large');
    jQuery('.sidebar').show();

    jQuery('#off-canvas-left input').click( function(){

       jQuery('#inner-content-product-list input[data-id="'+ jQuery( this ).attr('data-id') +'"]').click();

    });       
}

jQuery( document ).ready(function() {
        
    var qIn = jQuery.url().param('q');         
    
    
    jQuery('#reset-filter').click( function(){

       jQuery('#inner-content-product-list input:checked').click();

    });     
    
    if(typeof  qIn != 'undefined' )
    {
        jQuery('#s-box').val(  jQuery.url().param('q') );
    }        
        
        
    jQuery('.top-bar-left a').click( function(){
       
       
       
    });
        
        
    jQuery('.top-bar-left a').click( function(){
        
        
        
        addMobileMenu();
        
        
    });
        
    jQuery( '#count' ).change( function(){ 
        
        // only a ever single value, so remove then readd new value        
        
        setPage( 1 ); 
        
        
        if( query_str_arr['pager'] ){

            removeQueryString( 'pager' , query_str_arr['pager'][0] );  

        }         

        addQueryString( 'pager' , 1 );

        // reset back to page 1
        if( query_str_arr['count'] ){

            removeQueryString( 'count' , query_str_arr['count'][0] );  

        }        

        addQueryString( 'count' , jQuery(this).val() );        
        
        
        if(state_change!=-1)
        {
            
            state_change        = 1;
            // reset back to page 1
   
            push_state( this  , query_str_arr )
        }
    
    });
    
    jQuery( '#sort_order' ).change( function(e){ 
        
        
        
        
        var sort = jQuery( this ).val();
        setSort( sort );
            
            
        // only a ever single value, so remove then readd new value

        if( query_str_arr['sort'] ){

            removeQueryString( 'sort' , query_str_arr['sort'][0] );  

        }

        addQueryString( 'sort' , sort );            
            
        // condition added to prevent another state being added when user clicks bnack
        if(state_change!=-1 || e.originalEvent)
        {
            state_change = 1;

            push_state( this  , query_str_arr );             
            
        }
       
        indexVm.refresh( false );
        
    
    });
    
    
    jQuery('#disable_filter').click( function(){
        
        indexVm.sort = ejs.Sort('name').order('acs') ;
        indexVm.refresh( false );
        
    });
    
    History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
        
        if( state_change == 1 ){
             console.log( 'abort'  )
            state_change = 0;
            <?php // reset the state ?>
            return;
        }
        var State       = History.getStateByIndex( History.getCurrentIndex() -1   ); // Note: We are using History.getState() instead of event.state
        
        if(typeof State.data.state =='undefined'){
            // if going forward
            State   = State2;
            console.log('Fall back');
        }

        var state_item  = jQuery( '[data-id="' +  State.data.state + '"]' );
        state_change    = -1; <?php // prewvent another state update?>
        
        //console.log(State)
        
        switch(State.data.state)
        {
            case 'the_count':
                
                var v = jQuery.url().param('count');
                
                if(!v)
                {
                    v= 12; // default value
                }                
                
                jQuery("#count").val( v ).change();
                state_change    = 0; 
                break;
            case 'sort':
                
                var v = jQuery.url().param('sort');
                
                if(!v)
                {
                    v= 0;
                }
                
                jQuery("#sort_order").val( v ).change();
                state_change    = 0; 
                break;
            default:
                
                state_item.click(); 
            
        }
        
        
        
        // come back to this

        
    });
    
    jQuery('#inner-content-product-list').on('change', '.ng-scope input[type="checkbox"]', function(e) {
        
        console.log( e );
        //fadeContainerIn();

        var field       = jQuery( this ).parents('eui-checklist,eui-range').attr( 'field' ).replace( /\'/g ,'' );
        var value       = jQuery(this).attr('data-id').replace( 'the_value_' + field + '_' ,'' ) ;   
        
        field           = field.replace('.raw','');
        // cleaner url!
        var changedEl   = this;

        console.log( state_change );

        if( jQuery(this).attr('checked') ){

            addQueryString( field , value );
        
            var selectedFacet   = jQuery(   changedEl )[0].nextSibling.nodeValue;
            selectedFacet       = selectedFacet.substring(0, selectedFacet.lastIndexOf( ' (' )   );
            // removed aggregated data, maybe this should be wrapped in a span, sho we can do via CSS

            addSelectedFilter( changedEl , selectedFacet );
        
        }else{
            
            removeQueryString( field , value );
            // remove item from
            
            
            
            jQuery( 'li[data-idx="'+ jQuery( changedEl ).attr('data-id') +'"]' ).remove();
            
        }
        
        if( state_change==-1 ){
            
            state_change    = 0;
            
        }else{
            state_change    = 1;
            push_state( changedEl , query_str_arr  );

        }
    });
 });

// Height matching code
function heightMatcher(A,B){
    jQuery(B).height('auto');
    jQuery(B).height(jQuery(B).height());
    jQuery(A).height(jQuery(B).height());
};
jQuery(document).ready(function(){
    heightMatcher('.catLarge','.catLargeRight');
    jQuery('.catLarge').find('*').css('height','100%');
});
jQuery(window).resize(function(){
    heightMatcher('.catLarge','.catLargeRight');
});
</script>


<?php get_footer(); ?>
