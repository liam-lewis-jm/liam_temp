/**
 * Add a button to the menu to refresh ibiza menu pulling from the api.
 * @param {type} param
 */
jQuery(document).ready(function () {

    jQuery( "#save_menu_header" )
    .clone()
    .attr({'id':'refresh_ibiza_menu' , 'value' : 'Refresh Ibiza Menu' })
    .appendTo( ".publishing-action" )
    .click( function(e){

        e.preventDefault();

        if( confirm( 'Are you sure you want to refresh th Ibiza menu, changes will be overwritten.' ) ){
            window.location.href = '/wp-admin/nav-menus.php?refresh_ibiza_menu=1';
        }

    });

});
