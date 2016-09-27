/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var mySwiperBanner = null;

jQuery( document ).ready(function() {
    //initialize swiper when document ready  
    mySwiperBanner = new Swiper('.swiper-container-banner', {
        loop                : false ,
        pagination          : '.swiper-pagination',
        paginationClickable : true 
    });
    
    jQuery( window ).resize(function() {
        var height = jQuery('.swiper-container-banner .swiper-slide').css('width');
        jQuery('.swiper-container-banner .swiper-slide').height(height);
    
    });    
    
});    
    