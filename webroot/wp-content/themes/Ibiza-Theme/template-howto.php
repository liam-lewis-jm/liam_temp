<?php
/*
  Template Name: How to guides
 */


global $ibiza_api;

$cat                = $ibiza_api->get_product_list_category(  get_query_var('the_id') );
$catss              = $ibiza_api->get_product_list_top_level_categorys( 99 , 23935 );
$title              = $ibiza_api->get_product_list_title( get_query_var('products') );
$cat_title          = $ibiza_api->cat_data->title; 

?>

<?php get_header(); ?>

<div id="content"   ng-controller="IndexController" ng-app="ibiza"  eui-index="'<?php echo $index; ?>'"  <?php echo  $filter_cat_str ? 'eui-filter="ejs.BoolFilter().must('. $filter_cat_str.')"' : '' ; ?>  ng-model='querystring'  eui-enabled='true' <?php  echo $_GET['q'] ?  'eui-query="ejs.QueryStringQuery(\'' . $_GET['q'] .'*\').lenient(true).fields(\'name\')"' : ''; ?>>
    

    <!-- Side Bar -->
    <div id="inner-content" class="row" <?php echo $filter_cat_str1;?>>
         
        
        <nav aria-label="You are here:" role="navigation"   class="column">
            <ul class="breadcrumbs">
                <?php //echo @implode('', $breadcrumbs); ?></p>
            </ul>
        </nav>
        <div class="sidebar large-3 columns show-for-large " role="complementary">
            
            <h3>How To Categories</h3>
            
           <ul>
            
            <?php foreach($catss as $cat): ?>
            
                <li><a href="<?php echo $cat->url; ?>"><?php echo $cat->post_title; ?></a></li>
            
            <?php endforeach; ?>
            
                
            </ul>
        </div>



        <!-- End Side Bar -->

        
        <!-- Thumbnails -->
        <main id="main" class="large-9 medium-12 small-12 columns" role="main" >

            <div class="row">

                <div class="columns" >
                    <img src="<?php echo $ibiza_api->cat_data->bannerimage; ?>" style="width:100%" />
                    
                    <h3><?php echo ucwords( $cat_title );    ?></h3>
                    
                    
                    
                    
                    <?php if($ibiza_api->cat_data->description): ?>
                    <?php echo nl2br( $ibiza_api->cat_data->description);?>                   
                    <?php else:?>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <?php endif; ?>
                    
                    <hr />
                    
                    
                
                
                
              
                
                <?php 
                
                $i      = 0;
                $total  = 0;
                
                foreach($catss as $cat){
                    if( $cat->post_content==1 ){
                        $total++;
                    }
                }
                    
                ?>                
                
                <?php $i = 0;?>
                
                
                
                
                <?php foreach($catss as $cat):  ?>
                
                  
                    <?php if( $cat->post_content==1 ):?>
                    
                    <?php $seg = explode( '/',$cat->url);  ?>
                
                    <?php $cat_data     =  get_post_meta( $cat->ID ) ; 
                          $cat_data_ob  =  json_decode( $cat_data['cat-' . $seg[2] ][0] );
                          
                    ?>
                
                <div class="large-3 medium-3 columns padded-column box <?php echo  $i == ( $total - 1) ? ' end ' : '' ; ?>">
                    <img src="<?php echo $cat_data_ob->image?$cat_data_ob->image:'http://johnlewis.scene7.com/is/image/JohnLewis/electricals_area_img4_120315?$opacity-blur$'; ?>" />
                    <a href="<?php print $cat->url; ?>">
                    <span class="caption fade-caption">
			<h3><?php echo $cat->post_title;?></h3>
			<p><?php echo $cat_data_ob->intro ? $cat_data_ob->intro :'nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.'; ?></p>
                    </span>                    
                    </a>
                </div>
                
                
                <?php $i++;?>   
                    <?php endif; ?>
                
                <?php endforeach; ?>
                
                
            </div>

        
            
            <!-- End Thumbnails -->

        </main>
        
    </div>
</div>

<?php get_footer(); ?>
