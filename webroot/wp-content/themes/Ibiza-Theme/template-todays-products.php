<?php
/*
  Template Name: Today's Products
 */


global $ibiza_api;

$todaysProducts = json_decode(file_get_contents($ibiza_api::api_location . '/ProductCatalog.api/api/legacy/todaysproducts'));
?>

<?php get_header(); ?>

<div id="content">
    <div id="inner-content" class="row">
        <main id="main" class='large-8 medium-11 columns' role="main" >
            <div id="dvVideoHolderHome" style="background-color: #000">
                <img style="width:100%" src="//cdn.jewellerymaker.com/global/img/tv-preview.jpg" />
            </div>
        </main>
        <article id="current-product" class="large-4 medium-6 columns">
            <!-- This is built using Javascript -->
        </article>
        <article id="part-sell" class="large-4 medium-6 columns">
            <!-- This is built using Javascript -->
        </article>
    </div>
    
    <section id="dvDayShowProducts" class="row">
        <!--Built using Javascript-->
    </section>
</div>


<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/vendor/plugins/jwplayer/jwplayer.js"></script>
<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/video.js"></script>
<script type="text/javascript">
    jQuery(function () {
        jQuery('[id$="dvVideoHolderHome"]').Video({
            container      : 'dvVideoHolderHome',
            channel        : 'JEWELLERYMAKER',
            autoStart      : true,
            controls       : false,
            mute           : true,
            pageIdentifier : 'homepage',
            edge           : ''
        });
    });
</script>

<?php get_footer(); ?>