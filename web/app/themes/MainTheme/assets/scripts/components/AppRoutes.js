'use strict';

/** Singleton object that contains all of the routes.**/
var AppRoutes = (function () {

    var instance;

    function InitializeInstance(){


        /**
         * Create new route.
         * @param page
         * @param initHandler
         * @param finalizeHandler
         */
        function createNewRoute(page,initHandler,finalizeHandler){
            this[page] = {
                init: initHandler,
                finalize: finalizeHandler
            };
        }
        return { createNewRoute: createNewRoute}
    }

    return {
        getInstance: (function () {
            if (!instance) {
                instance = new InitializeInstance();
            }
            return instance;
        })()
    };
})();

