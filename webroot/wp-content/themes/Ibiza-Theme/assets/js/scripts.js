jQuery(document).foundation();
/*
 These functions make sure WordPress
 and Foundation play nice together.
 */

jQuery(document).ready(function () {

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

    jQuery('#menu-main-2').append('<li class="main-nav__backdrop"></li>');



    //initialize swiper when document ready  
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        loop: true
    });


    //initialize swiper when document ready  
    var mySwiper = new Swiper('.swiper-container-products', {
        // Optional parameters
        loop: true,
        slidesPerView: 4,
        spaceBetween: 4,
        breakpoints: {
            // when window width is <= 320px
            320: {
                slidesPerView: 1,
                spaceBetweenSlides: 10
            },
            // when window width is <= 480px
            480: {
                slidesPerView: 2,
                spaceBetweenSlides: 20
            },
            // when window width is <= 640px
            640: {
                slidesPerView: 3,
                spaceBetweenSlides: 30
            }

        }
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

});
