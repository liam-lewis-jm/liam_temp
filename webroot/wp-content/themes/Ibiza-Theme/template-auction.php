<?php
/*
  Template Name: Auction Template
 */
?>

<?php get_header(); ?>
<div id="content">
    
    <div id="operationLogInfo"></div>
    
    <div id="inner-content" class="home-inner-content row" ng-controller="AuctionPage" ng-app="ibiza-auction">

        <div ng-repeat="message in messages">
            {{message}}
        </div>

        <main id="main" class="large-12 columns auction-page" role="main">

            <div class="row">
                <div class="large-12 columns breadcrumb-title">
                    <ul class="breadcrumbs show-for-medium">
                    <li><a href="<?php get_template_directory_uri(); ?>">Home</a></li>
                    <li class="current"><a href="<?php get_template_directory_uri(); ?>">Watch</a></li>
                    </ul>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <div id="dvVideoHolderHome" style="background-color: #000">
                        <img style="width: 100%" src="/global/img/tv-preview.jpg" />
                    </div>
                    <div class="show-for-large row no-padding columns auction-on-next-large white-house">
                        <div class="medium-6 no-padding columns">
                            <div class="large-2 columns no-padding on-now">On Now</div>
                            <div class="large-10 columns">
                                <h4>08:00 - 09:00</h4>
                                <p>Title of the show and who is the presenter</p>
                            </div>
                        </div>
                        <div class="medium-6 no-padding columns">
                            <div class="large-2 columns no-padding on-now">On Now</div>
                            <div class="large-10 columns">
                                <h4>09:00 - 10:00</h4>
                                <p>Title of the show and who is the presenter</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="large-4 medium-8 columns auction-buy-panel white-house">
                    <div class="aution-buy-pointer"></div>
                    <div class="row">
                        <div class="large-12 columns">
                            <h2>{{productData.data.name}}</h2>
                            <p>Product Code: <span>{{productData.data.productcode}}</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <h4>£{{productData.auction.price}}</h4>
                        </div>
                        <div class="large-4 columns">
                            <p>- [] +</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 columns">
                            <input type="button" value="LOGIN TO BUY" class="add-to-basket" />
                        </div>
                        <div class="large-6 columns">
                            <p>or <a href="#">Create an account</a></p>
                        </div>
                    </div>
                    <div class="row product-gallery">
                        <div class="main-photo large-9 columns">
                            <img src="{{productData.data.images[0].url}}" />
                        </div>
                        <div class="thumb-photos large-3 columns">
                            <ul>
                                <li ng-repeat="pics in productData.data.images">
                                    <div class="prodThumb" data-this-src="{{pics.url}}" style="background-image: url({{pics.url}})"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="hide-for-large medium-4 columns">
                    <div class="medium-12 no-padding columns auction-on-next-small">
                        <div class="medium-6 no-padding columns">
                            <h4>08:00 - 09:00</h4>
                            <p>Title of the show and who is the presenter</p>
                        </div>
                        <div class="medium-6 no-padding columns">
                            <h4>09:00 - 10:00</h4>
                            <p>Title of the show and who is the presenter</p>
                        </div>
                    </div>
                    <div class="medium-12 no-padding columns message-the-studio-small">
                        <h3>Message The Studio</h3>
                        <p>Got questions or just want to get involved?
                            <br /><a href="#">Login</a> or <a href="#">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row white-house">
                <div class="large-12 columns">
                    <div class="large-4 show-for-large columns message-the-studio-large">
                        <h3>Message The Studio</h3>
                        <p>Got questions or just want to get involved?
                            <br /><a href="#">Login</a> or <a href="#">Create an account</a>
                        </p>
                    </div>
                    <div class="large-8 medium-12 columns auction-description tabber">
                        <h3>More information about The Sewing Quarter Japanese Veg Dyed Fashion Fabric, Charcoal</h3>
                        <div class="large-12 no-padding">
                            <div data-tabbed="desc" class="tabber-tab active">Description <div class="down-arrow"></div></div>
                            <div data-tabbed="spec" class="tabber-tab">Specifications <div class="down-arrow"></div></div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="tabber-content active" data-content="desc">
                            <p>{{productData.data.description}}</p>
                        </div>
                        <div class="tabber-content" data-content="spec">
                            <p>Spec spec spec spec spec spec spec spec spec spec spec spec spec spec spec spec spec spec spec.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <h3>Products From Today's Show</h3>
                    <div ng-repeat="item in todaysProductsData.data" ng-if="$index % 4 == 0" class="row">
                        <div class="large-3 columns">
                            <img src="{{todaysProductsData.data[$index].data.images[0].url}}" />
                            <h4><a href="#">{{todaysProductsData.data[$index].data.name}}</a></h4>
                            <span class="price">£{{todaysProductsData.data[$index].data.price}}</span>
                        </div>
                        <div class="large-3 columns">
                            <img src="{{todaysProductsData.data[$index + 1].data.images[0].url}}" />
                            <h4><a href="#">{{todaysProductsData.data[$index + 1].data.name}}</a></h4>
                            <span class="price" ng-if="todaysProductsData.data[$index + 1]">£{{todaysProductsData.data[$index + 1].data.price}}</span>
                        </div>
                        <div class="large-3 columns">
                            <img src="{{todaysProductsData.data[$index + 2].data.images[0].url}}" />
                            <h4><a href="#">{{todaysProductsData.data[$index + 2].data.name}}</a></h4>
                            <span class="price" ng-if="todaysProductsData.data[$index + 2]">£{{todaysProductsData.data[$index + 2].data.price}}</span>
                        </div>
                        <div class="large-3 columns">
                            <img src="{{todaysProductsData.data[$index + 3].data.images[0].url}}" />
                            <h4><a href="#">{{todaysProductsData.data[$index + 3].data.name}}</a></h4>
                            <span class="price" ng-if="todaysProductsData.data[$index + 3]">£{{todaysProductsData.data[$index + 3].data.price}}</span>
                        </div>
                    </div>
                </div>
                <div class="large-4 columns">
                    <div class="programme-guide">
                        <h3>Programme Guide</h3>
                    </div>
                    <div class="newsletter">
                        <p>Sign up to hear about our latest news and special offers</p>
                        <input type="" style="height: 37px" placeholder="yourname@emailaddress.co.uk" /><button aria-expanded="false" aria-haspopup="true" data-yeti-box="example-dropdown2" data-is-focus="false" aria-controls="example-dropdown2" class="button" type="submit" style="vertical-align: top">Submit</button>
                        <div class="social">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_Twitter.png">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_Facebook.png">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_GPlus.png">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_Pinterest.png">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_Tumblr.png">
                            <img src="/wp-content/themes/Ibiza-Theme/assets/images/Icon_YouTube.png">
                        </div>                                                            
                    </div>
                </div>
            </div>

        </main> <!-- end #main -->

    </div> <!-- end #inner-content -->    
    
</div> <!-- end #content -->

<script src="http://www.jewellerymaker.com/global/js/vendor/plugins/flowplayer/flowplayer.min.js"></script>
<script type="text/javascript" src="http://www.jewellerymaker.com/global/js/vendor/plugins/hls/hls.min.js"></script>

<!-- angular -->
<script src="<?php echo get_template_directory_uri(); ?>/vendor/angular/angular.min.js" type='text/javascript'></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app-auction.js"></script>

<script type="text/javascript" src="//cdn.jewellerymaker.com/global/js/video.js"></script>
<script type="text/javascript">
    function resizeSlider(){
        if(jQuery(window).width() <= 1023){
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height(500);
            });
        }else{
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height('auto');
            });
            jQuery('.swiper-slide').each(function(){
                jQuery(this).height(jQuery(this).parents('#inner-content').height());
            });
        }
    };

    jQuery(function () {

        //Tabber
        jQuery('.tabber').each(function(){
            jQuery('[data-tabbed]').click(function(){
                jQuery('.tabber-content.active').removeClass('active');
                jQuery('[data-content='+jQuery(this).data('tabbed')).addClass('active');
                jQuery('.tabber-tab.active').removeClass('active');
                jQuery(this).addClass('active');
            });
        });


        jQuery('[id$="dvVideoHolderHome"]').Video({
            container: 'dvVideoHolderHome',
            channel: 'JEWELLERYMAKER',
            autoStart: true,
            controls: false,
            mute: true,
            //quality: 'thumbnail',
            pageIdentifier: 'homepage',
            edge: '',
         });


       jQuery('#add-basket').click( function( e ){

           var quantity    = 1;

           jQuery.ajax({
               dataType  : 'json' ,
               url: 'http://<?php echo $_SERVER['SERVER_NAME']; ?>/proxy.php?auctionID=-1&productCode=<?php echo 'WTTY01'; //$response['_source']['legacyCode']; ?>&productDetailID=<?php echo '361247'; //$response['_source']['product']['productDetailId']; ?>&quantity=' + quantity
           }).done(function( data ) {

               jQuery('#basket-total').text('£' +  data.BasketTotal );
               jQuery('#basket-description').text('£' +  data.Description );                    
               window.location = 'https://secure.<?php echo $_SERVER['SERVER_NAME']; ?>/basket.aspx';

             });
        });

       //hero slider height
        jQuery('.swiper-slide').each(function(){
            resizeSlider();
        });

        jQuery('.main-photo').fancybox({
            padding: 0,
            nextEffect: 'none',
            prevEffect: 'none'
        });
    });

    jQuery(window).resize(function(){
        resizeSlider();
    });

</script>
<?php get_footer(); ?>