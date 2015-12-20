'use strict';
(function($){
    var appRouteInstance =  AppRoutes.getInstance;
    appRouteInstance.createNewRoute('app',init,function(){});


    function init(){



        /** Detect mobile and set a new property in the window object. **/
        function detectMobile(){
            var userAgent = navigator.userAgent;
            return (userAgent.match(/(mobile|android|ios|iphone)/ig)||$(window).width()<=768)
        }
    }


})(jQuery);



