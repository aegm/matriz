/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    //CALENDAR WIDGET
    /*$('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });*/
    //SLIDER REVOLUTION 4.x SCRIPTS
    revapi = $('.tp-banner').revolution(
            {
                delay: 9000,
                startwidth: 1170,
                startheight: 560,
                hideThumbs: 10,
                fullWidth: "on",
                forceFullWidth: "on"
            });
    //CAROUSEL WIDGET
    $("#owl-blog").owlCarousel({
        items: 2,
        lazyLoad: true,
        navigation: true,
        pagination: false,
        autoPlay: false
    });
})

