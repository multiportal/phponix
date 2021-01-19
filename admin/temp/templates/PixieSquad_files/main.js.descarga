/* Main JS File */
(function($){
    "use strict";

    // back to top btn
     $("a.back-to-top").on("click tap", function(e){
        e.preventDefault();
        // animated scroll 
        $("html, body").animate({ scrollTop: 0 }, 500, 'swing');
    });
                
    $("#slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        pagination: false,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        paginationSpeed : 400,
        singleItem:true,
        afterAction: function (elem) {
            var current = this.currentItem;
            var h4 = elem.find(".owl-item").find('h3');
            var h5 = elem.find(".owl-item").find('h1');
            var h6 = elem.find(".owl-item").find('h2');
            var h6 = elem.find(".owl-item").find('h2');
            var a2 = elem.find(".owl-item").find('a.anim4');
            var h3 = elem.find(".owl-item").eq(current).find('h3');
            var h1 = elem.find(".owl-item").eq(current).find('h1');
            var h2 = elem.find(".owl-item").eq(current).find('h2');
            var a = elem.find(".owl-item").eq(current).find('a.anim4');
            h4.hide();
            h5.hide();
            h6.hide();
            a2.hide();
            h1.fadeIn();
            h2.fadeIn();
            h3.fadeIn();
            a.fadeIn();
        }
    });

    var productSlider = $("#productSlider");

    productSlider.owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 800,
        pagination: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        paginationSpeed : 800,
        singleItem:true,
        afterMove: function (elem) {
            var current = this.currentItem;
           var h3all = elem.find(".owl-item").find('.item').find('h3');
            var pall = elem.find(".owl-item").find('.item').find('p');
            var actionsAll = elem.find(".owl-item").find('.item').find('.anim3');
           var h3 = elem.find(".owl-item").eq(current).find('.item').find('h3');
            var p = elem.find(".owl-item").eq(current).find('.item').find('p');
            var actions = elem.find(".owl-item").eq(current).find('.item').find('.anim3');
           h3all.hide();
            pall.hide();
            actionsAll.hide();
           h3.fadeIn();
            p.fadeIn();
            actions.fadeIn();
        }
    });

    var teamSlider = $("#team-container");

    teamSlider.owlCarousel({
        navigation : false,
        slideSpeed : 1200,
        pagination: false,
        paginationSpeed : 1000,
        mouseDrag : true,
        touchDrag : false,
        singleItem: true
    });

    // custom next/prev
    $(".team-right").on( 'click tap', function(){
        teamSlider.trigger('owl.next');
    });
    $(".team-left").on( 'click tap', function(){
        teamSlider.trigger('owl.prev');
    });

    var sponsorSlider = $("#sponsors");

    sponsorSlider.owlCarousel({
        pagination: false,
        navigation: false,
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        rewindNav : true,
        items : 3,
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,1]
    });
    $(".sponsorNext").click(function(e){
        e.preventDefault();
        sponsorSlider.trigger('owl.next');
    });
    $(".sponsorPrev").click(function(e){
        e.preventDefault();
        sponsorSlider.trigger('owl.prev');
    });

    $('div#button').click(function() {
        $('div#button').removeClass();
        $(this).toggleClass('active');
    });

    /* Single post scripts */

    var sponsorSlider = $("#sponsors");

    sponsorSlider.owlCarousel({
        pagination: false,
         navigation: false,
         autoPlay: 3000, //Set AutoPlay to 3 seconds
         rewindNav : true,
         items : 3,
         itemsDesktop : [1199,2],
         itemsDesktopSmall : [979,1]
    });
    var desktopPlayerSlider = $(".desktop-player-slider");

    desktopPlayerSlider.owlCarousel({
        navigation: false,
        autoPlay: 4000,
        slideSpeed : 800,
        pagination: true,
        singleItem:true,
    });

    var responsiveslider = $("#responsive-slider");

    responsiveslider.owlCarousel({
         pagination: false,
         navigation: false,
         autoPlay: 3000, //Set AutoPlay to 3 seconds
         rewindNav : true,
         items : 2,
         itemsMobile : [460,2]
    });

    var playerSlider = $(".playerSlider");

    playerSlider.owlCarousel({
         pagination: true,
         responsive: false,
         navigation: false,
         autoPlay: 1500, //Set AutoPlay to 3 seconds
         rewindNav : true,
         items : 1,
    });
})(jQuery);