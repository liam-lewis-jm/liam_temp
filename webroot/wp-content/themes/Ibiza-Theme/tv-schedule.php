<?php
/*
  Template Name: TV Schedule
 */

global $ibiza_api;

$join_str   = array();
$data       = json_decode( file_get_contents( 'http://ibizaschemas.product/ProductCatalog.api/api/legacy/tvschedule/89/full' ) );
?>

<?php get_header(); ?>

<div id="content">

    <div class="row" id="inner-content">

        <main role="main" class="large-12 medium-12 columns" id="main">
            <article itemtype="http://schema.org/WebPage" itemscope="" role="article" class="post-2 page type-page status-publish hentry" id="post-2">

                <header class="article-header">
                    <h1 class="page-title text-center">TV Schedule</h1>
                </header> <!-- end article header -->
                
            </article>
            
            <section itemprop="articleBody" class="entry-content">
                <div class="swiper-container-tv-schedule" style="position: relative;overflow: hidden;">
                    
                    <div class="swiper-button-prev" style="position: relative; float: left; margin: auto 34%;"></div>
                    <div class="swiper-button-next" style="position: relative; margin: auto 65%;"></div>
                     
                    <div class="swiper-wrapper">
                <?php foreach( $data as $tvs ): ?>
                    
                        
                        <div class="swiper-slide">
                            <h3 style="text-align: center; position: relative; bottom: 45px;"><?php print( date( 'l d-m-Y', strtotime( $tvs->scheduleDay ) ) ); ?></h3>
                            <?php foreach( $tvs->schedule as $d ): ?>
                            <h3><?php print_r($d->title);  ?> <?php echo  date( 'H:i' , strtotime( $d->fromDate) ) ?> - <?php echo  date( 'H:i' , strtotime( $d->toDate) ) ?></h3>
                            <p><?php print_r($d->synopsis); ?></p>
                            <?php endforeach; ?>
                        </div>

                    
                <?php endforeach; ?>
                </div> 
                </div>
            </section>
            
        </main>


    </div>

    <script>
    
    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var mySwiperTvS = null;

 



jQuery( document ).ready(function() {
    
    
    
    //initialize swiper when document ready  
    mySwiperTvS = new Swiper('.swiper-container-tv-schedule', {
        nextButton : '.swiper-button-next',
        prevButton : '.swiper-button-prev',
    });    
    
     
    
});
    
    
    </script>
    
    <?php get_footer(); ?>
