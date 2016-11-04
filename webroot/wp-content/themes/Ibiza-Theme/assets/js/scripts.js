jQuery(document).foundation();
/*
 These functions make sure WordPress
 and Foundation play nice together.
 */

var ibizaHubProxy = (function() {
    getCurrentAuction();
    return {
        ibizaHubProxy: jQuery.connection.ibizaHubProxy,

        // Starts connection with Hub and call Hub functions.
        startServer: function() {
            var self = this;
            self.ibizaHubProxy.connection.url =  api_location + "/ProductCatalog.Api/signalr";
            self.ibizaHubProxy.connection.start();
        },

        //Register callback listeners to get data from Hub(Server-Side)
        clientEventsListerners: function () {
            var self = this;

            this.ibizaHubProxy.client.auctionUpdate = function (data) {
                getCurrentAuction(1);
            };
                        
            this.ibizaHubProxy.client.todaysProductsRefresh = function () {
                getCurrentAuction(1);
            };
            
            this.ibizaHubProxy.client.auctionRefresh = function () {
                getCurrentAuction(1);
                
            };
        },

        init: function () {
            this.startServer();
            this.clientEventsListerners();
        }
    };
})();

function getCurrentAuction(update) {
    jQuery.ajax({
        dataType: "json",
        url:  api_location + "/ProductCatalog.api/api/legacy/auction"
    }).done(function(data) {
        if (!data) {
            return;
        }
        
        for (var i = 0; i < data.length; i++) {
            if ((data[i]["auction"]["price"]) && (data[i]["auction"]["status"] === "inprogress" || data[i]["auction"]["status"] === "complete")) {
                data[i]["data"]["price"] = data[i]["auction"]["price"].toFixed(2);
            } else {
                data[i]["data"]["price"] = data[i]["data"]["price"].toFixed(2);
            }
        }
        
        if( update ==1 ){

            Push.create("Price Update", {
                body: "The price for " + data[0]["data"]["name"].trim() + " is now £" +  data[0]["data"]["price"],
                icon: data[0]["data"]["images"][0]["url"],
                timeout: 14000,
                onClick: function () {
                    
                    if (window.location.href.indexOf("todays-products") == -1 ) {
                        window.location.href = '/todays-products';
                    }                    
                    this.close();
                }
            });
            
        }
        
        if (window.location.href.indexOf("todays-products") > 1) {
          buildTodaysProductsAuction(data);
        } else {
            if (data[0]) {
                jQuery("#triangle").addClass("active-product");
                jQuery("#triangle-outter").addClass("active-product");
                jQuery("#product_0").addClass("active-product");
                jQuery("#productImg_0").attr("src", data[0]["data"]["images"][0]["url"]);
                jQuery("#productName_0").html("<a href=\"/p/" + data[0]["data"]["productcode"] + "\">" + data[0]["data"]["name"].trim() + "</a>");
                jQuery("#productPrice_0").html("<strong>&pound;" + numberWithCommas(data[0]["data"]["price"]) + "</strong>");
            }
            if (data[1]) {
                jQuery("#product_1").addClass("part-sell");
                jQuery("#productImg_1").attr("src",data[1]["data"]["images"][1]["url"]);
                jQuery("#productName_1").html("<a href=\"/p/" + data[1]["data"]["productcode"] + "\">" + data[1]["data"]["name"].trim() + "</a>");
                jQuery("#productPrice_1").html("<strong>&pound;" + numberWithCommas(data[1]["data"]["price"]) + "</strong>");
            } else {
                jQuery("#product_1").removeClass("part-sell");
            }
        }
        getRecentAuctions();
    });
};

function getRecentAuctions() {
    jQuery.ajax({
        dataType: "json",
        url:api_location + "/ProductCatalog.api/api/legacy/todaysproducts"
    }).done(function(data) {
        if (!data) {
            return;
        }
        
        for (var i = 0; i < data.length; i++) {
            if ((data[i]["auction"]["price"]) && (data[i]["auction"]["status"] === "inprogress" || data[i]["auction"]["status"] === "complete")) {
                data[i]["data"]["price"] = data[i]["auction"]["price"].toFixed(2);
            } else {
                data[i]["data"]["price"] = data[i]["data"]["price"].toFixed(2);
            }
        }
        if (window.location.href.indexOf("todays-products") > 1) {
            buildTodaysProducts(data);
        } else {
            var i, j
            for (i = 1, j = 0; i < 4; i++, j++) {
                if (jQuery("#product_" + i).hasClass("part-sell") === true) {
                    j--;
                    continue;
                } else {
                    jQuery("#productImg_" + i).attr("src",(data[j]["data"]["images"][0]["url"] ? data[j]["data"]["images"][0]["url"] : data[j]["data"]["imageUrl"]));
                    jQuery("#productName_" + i).html("<a href=\"/p/" + data[j]["data"]["productcode"] + "\">" + data[j]["data"]["name"].trim() + "</a>");
                    jQuery("#productPrice_" + i).html("<strong>&pound;" + numberWithCommas(data[j]["data"]["price"]) + "</strong>");
                }
            }
        }
    });
};

function buildTodaysProductsAuction(data) {
    var html = "";
    for (var i = 0; i < data.length; i++) {
        html += "<div  class=\"column large-12 small-9 row\">";
        html += "<p>" + data[i]["data"]["name"].trim() + "</p>";
        html += "<p>" + data[i]["data"]["productcode"] + "</p>";
        html += "<img class=\"large-6\" src=\"" + data[i]["data"]["images"][0]["url"] + "\"/>";
        html += "<span id=\"auctionPrice\">&pound;" +  numberWithCommas(data[i]["data"]["price"]) + "</span>";
        html += "<p>" + data[i]["data"]["description"] + "</p>";
        html += "<button style=\"background: #00B109\" data-toggle=\"example-dropdown2\" type=\"button\" class=\"button\" class=\"add-basket\" aria-controls=\"example-dropdown2\" data-is-focus=\"false\" data-yeti-box=\"example-dropdown2\" aria-haspopup=\"true\" aria-expanded=\"false\">Add to basket</button>";
        html += "</div>";   
    }
    jQuery("#current-product").html(html);
};

function buildTodaysProducts(data) {
    var html = "";
    for (var i = 0; i < data.length; i++) {
        html += "<article id=\"" + data[i]["data"]["productcode"] + "\" class=\"columns large-3 small-4 text-center " + (i+1 === data.length ? "end" : "") + "\">";
        html += "<a href=\"/p/" + data[i]["data"]["productcode"] + "\">";
        html += "<div>";
        html += "<img src=\"" + data[i]["data"]["images"][0]["url"] + "\"/>";
        html += "<p>" + data[i]["data"]["name"] + "</p>";
        html += "<p>" + data[i]["data"]["price"] + "</p>";
        html += "</div>";
        html += "</a>";
        html += "</article>";
    }
    jQuery("#dvDayShowProducts").html(html);
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

function toggleFacets(e) {
    console.log(e);
};

jQuery(document).ready(function () {

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

    jQuery('#menu-main-1').append('<li class="main-nav__backdrop"></li>');

    //initialize swiper when document ready  
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        loop: true
    });





    jQuery('.ibiza-menu  > .menus').first().after('<ul style="width: 100%; height: 57px; background: rgb(255, 0, 0) none repeat scroll 0% 0% ! important;"><img src="/wp-content/themes/Ibiza-Theme/assets/images/menu-banner.png" /></ul>');
    
    var grid_arr = new Array();
    var grid_ops = { itemSelector: '.menu-item-has-children',  columnWidth: 322 };

    jQuery(".top-bar  .menu-item")
        .mouseover(function () {

            jQuery('#tri').remove();
            jQuery('a',this).first().append('<div id="tri"></div>');

            if ( jQuery(' > .ibiza-menu ul' , this  ).length > 0 ) {
                
                jQuery('.main-nav__backdrop').css( { 'opacity' : 1 ,   'visibility' : 'visible'  } );
                

                //
                var index = jQuery('li' ,this).index('#menu-main-1 li');
                if( !jQuery('.menus' ,this ).hasClass('masonry') ){
                    
                    var $grid       =  jQuery('.menus' ,this).masonry(grid_ops);
                    grid_arr[index] = $grid;
                    jQuery('.menus' ,this ).addClass('masonry');
                    
                }else{
                    
                    grid_arr[index].masonry('destroy');
                    grid_arr[index] =  jQuery('.menus' ,this).masonry(grid_ops);                    
                    
                }
           }else{
               jQuery('.ibiza-menu',this).remove();
               //no needed quick work around
           }

        }).mouseout(function () {
            
            //jQuery('#tri').remove();
            jQuery('.main-nav__backdrop').css({ 'visibility' : 'hidden' , 'opacity' : 0  } );
        });
        
        
        jQuery(".ibiza-menu").mouseleave(function () {
            jQuery('#tri').remove();
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

    var sliding = 0;
    jQuery('.search-link').click( function(){
        
        
        if(sliding==1)
            return;
        
        sliding = 1;
        jQuery('.search-container').slideToggle(function(){
            sliding = 0;
        });
        jQuery(this).toggleClass('active');
    });
     
    ibizaHubProxy.init();
});

