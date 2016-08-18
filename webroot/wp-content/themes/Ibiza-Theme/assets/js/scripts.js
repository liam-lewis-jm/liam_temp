jQuery(document).foundation();
/*
 These functions make sure WordPress
 and Foundation play nice together.
 */
/*
var mongoHubModule = (function() {
    return {
        mongoHub: jQuery.connection.mongoHub,

        // Starts connection with Hub and call Hub functions.
        startServer: function() {
            var self = this;
            self.mongoHub.connection.url = "http://52.18.1.60/ProductCatalog.Api/signalr";
            self.mongoHub.connection.start()
                .done(function() {
                    self.mongoHub.server.startMongoHub();
                });
        },

        //Register callback listeners to get data from Hub(Server-Side)
        clientEventsListerners: function () {
            var self = this;

            this.mongoHub.client.updateData = function (data) {
                //console.log(data);
                //jQuery("#operationLogInfo").html(data);
            };
        },

        init: function () {
            this.startServer();
            this.clientEventsListerners();
        }
    }
})();
*/
jQuery(document).ready(function () {

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

    jQuery('#menu-main-1').append('<li class="main-nav__backdrop"></li>');

    //initialize swiper when document ready  
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        loop: true
    });

    //initialize swiper when document ready  
    var mySwiper = new Swiper('.swiper-container-banner', {
        // Optional parameters
        loop                : true ,
        pagination          : '.swiper-pagination',
        paginationClickable : true
    });






    jQuery(".top-bar .menu-item")
        .mouseover(function () {

            if ( jQuery(' > .ibiza-menu ul' , this  ).length > 0 ) {

                jQuery('.main-nav__backdrop').css( { 'opacity' : 1 ,   'visibility' : 'visible'  } );

           }

        })
        .mouseout(function () {
            jQuery('.main-nav__backdrop').css({ 'visibility' : 'hidden' , 'opacity' : 0  } );
        });
        
    // Makes sure last grid item floats left
    jQuery('.archive-grid .columns').last().addClass('end');

    // Adds Flex Video to YouTube and Vimeo Embeds
    jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function () {
        if (jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5) {
            jQuery(this).wrap("<div class='widescreen flex-video'/>");
        } else {
            jQuery(this).wrap("<div class='flex-video'/>");
        }
    });

     
    //mongoHubModule.init();
     










});
