/*
  *	Editor Xtended - Animate It!
  * Copyright (C) 2014 eLEOPARD Design Studios Pvt Ltd. All rights reserved

  * This program is free software: you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 3 of the License, or
  * (at your option) any later version.

  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.

  * You should have received a copy of the GNU General Public License
  * along with this program.  If not, see <http://www.gnu.org/licenses/>.

  * For any other query please contact us at contact[at]eleopard[dot]in

*/

(function($){
    $.fn.viewportChecker = function(useroptions){
       
        var options = {
            classToAdd: 'eds-scroll-visible',
            offset: 75,
            callbackFunction: function(elem){}
        };
        $.extend(options, useroptions);

       
        var $elem = this,
            windowHeight = $(window).height();

        this.checkElements = function(){
            
            var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
                viewportTop = $(scrollElem).scrollTop(),
                viewportBottom = (viewportTop + windowHeight);

            $elem.each(function(){
                var $obj = $(this);
                var scroll_offset = $obj.attr('eds_scroll_offset');
                
                if ($obj.hasClass(options.classToAdd)){
                    return;
                }

                var elemTop = '';
                if(scroll_offset != null && scroll_offset != ''){
                	elemTop = Math.round( $obj.offset().top ) + Math.round(Number(scroll_offset) * $obj.height() * 0.01),
                    	elemBottom = elemTop + ($obj.height());
                }else{
                	elemTop = Math.round( $obj.offset().top ) + Math.round(options.offset * $obj.height() * 0.01),
                	elemBottom = elemTop + ($obj.height());
                }
                
                // Add class if in viewport
                if ((elemTop < viewportBottom) && (elemBottom > viewportTop)){
                    $obj.addClass(options.classToAdd);

                    
                    options.callbackFunction($obj);
                }
            });
        };

        
        $(window).scroll(this.checkElements);
        this.checkElements();

        
        $(window).resize(function(e){
            windowHeight = e.currentTarget.innerHeight;
        });
    };
})(jQuery);
