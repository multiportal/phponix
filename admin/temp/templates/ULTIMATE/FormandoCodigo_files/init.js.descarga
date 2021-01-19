(function($) {
    $(function() {

        $('.button-collapse').sideNav();
        $('.parallax').parallax();

    }); // end of document ready
})(jQuery); // end of jQuery name space

$(window).load(function() {
    $(document).on('click', '.navbar .dropdown-menu', function(e) {
        e.stopPropagation();
    });
});

FixMegaNavbar(navHeight);
$(window).bind('scroll', function() {
    FixMegaNavbar(navHeight);
});

function FixMegaNavbar(navHeight) {
    //$("body").css("margin-top","0px");
    if (!$('#miNav').hasClass('navbar-fixed-bottom')) {
        if ($(window).scrollTop() > navHeight) {
            $('#miNav').addClass('navbar-fixed-top')
                //$('body').css({'margin-top': $('#miNav').height()+'px'});
            $('#miNav').children('div').addClass('container');
            $('#miNav').children('div').addClass('container');
            $('.brand-color').removeClass('hidden').addClass("show");
            $('.brand-white').removeClass('show').addClass("hidden");
        } else {
            $('#miNav').removeClass('navbar-fixed-top');
            $('.brand-color').removeClass('show').addClass("hidden");
            $('.brand-white').removeClass('hidden').addClass("show");
            $('#miNav').children('div').addClass('container');
            $('body').css({
                'margin-top': ''
            });
        }
    }
}