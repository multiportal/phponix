/* JS just for front page */
function ValidURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(!regex .test(str)) {
    return false;
  } else {
    return true;
  }
}

(function($){
    "use strict";

    $('#mainnav').lavalamp({
        easing: 'easeOutBack',
	    setOnClick: true
    });
    $('#fixednav').lavalamp({
        easing: 'easeOutBack',
        enableHover: false,
        setOnClick: true
    });

    // set to scrolled start
    var allElements = jQuery("#fixednav .lavalamp-item > a");
    var scrollMap = [];

    // add to object
    allElements.each(function(){
        var thisElem = jQuery(this).attr('href');

        if (ValidURL(thisElem) == false && jQuery(thisElem) != undefined){

            if(jQuery(thisElem).length) {
                var topElement = jQuery(thisElem).offset().top;

                if( thisElem == "#teams" || thisElem == "#news")
                    topElement -= 80;

                scrollMap.push([thisElem, topElement]);
            }

        }
    });
    
    var lastElementScrolled;
    var lengthMap = scrollMap.length;
    
    // get current active element
    var loadedScreenTop = jQuery(window).scrollTop();
    var currElemId, initialized = 0;
    for( var i = lengthMap - 1; i >= 0; i--){

        if( loadedScreenTop > scrollMap[i][1] ){
            currElemId = scrollMap[i][0];
            break;
        }
    }


    // nav animated scroll
    
    $(".main-nav li a").on('click',function(){
        var scrollTo = $(this).attr('href');
        var offsetTop = $(scrollTo).offset().top;
            offsetTop -= 30;
        $("html, body").animate({scrollTop: offsetTop - 35  }, 
                                {duration: 500});
    });

    // detect on scroll change active
    $(window).scroll(function(){
        // toggle show fixed menu
        if( $(window).scrollTop() > 165 ){
	        $("#header .navbar").css('visibility', 'hidden');
	        $("#fixed-menu").slideDown(100);
        }
	    else {
	        $("#header .navbar").css('visibility', 'visible');
	        $("#fixed-menu").hide();
	    }



        var screenTop = $(this).scrollTop();
        var currentElementScrolled, finded = 1;

        // initialize first element
        if( screenTop > 145 && !initialized ){
            // get current menu
            var checkMenu  = $("#fixednav");

            if(checkMenu.length > 0) {
                var firstMenuItem  = $("#fixednav li.lavalamp-item");
            
                var startLeft = firstMenuItem.position().left + 5;
                var startWidth = firstMenuItem.outerWidth();
                
                $("#fixednav div.lavalamp-object").animate({
                        'left': startLeft,
                        'width': startWidth,
                        'height' : 65
                }, 200);
                initialized = 1;
            }
        }

        // find in map

        for( var i = 1; i < lengthMap; i++ ){

            if(screenTop < scrollMap[i][1]){
                currentElementScrolled = scrollMap[i - 1][0];
                finded = 1;
                break;
            }
            finded = 0;

        }

        if(currentElementScrolled == null && scrollMap.hasOwnProperty('0')) // for first and before scrolled
            currentElementScrolled = scrollMap[0][0];
        if( !finded ) // for last one
            currentElementScrolled = scrollMap[lengthMap - 1][0];
        
        if( lastElementScrolled != currentElementScrolled){ // if it's changed

            // get current menu
            var activeMenuItem  = $("li.lavalamp-item > a[href=" + currentElementScrolled + "]").parent("li.lavalamp-item");
        
            var leftItem = activeMenuItem.position().left + 5;
            var widthItem = activeMenuItem.outerWidth();
            
            $("#fixednav div.lavalamp-object").animate({
                    'left': leftItem,
                    'width': widthItem
            }, 200);
        }

        // set current as last to compare
        lastElementScrolled = currentElementScrolled;
    });
    
})(jQuery);