//import $ from 'jquery';
//window.jQuery = $;
//window.$ = $;
//import enquire from 'enquire.js';

/*
 * @file index.js
 * @folder build/js
 */
/*
 -----------------------------------------------
 1) 	create your iffy
 2) 	fetch DOM elements and store them into const variables
 2.1) 	store other values into let variables
 3) 	set up your initialising pattern
 4) 	subscribe handlers to events on elements
 5) 	implement handlers
 -----------------------------------------------
 */

(function () {


    /*const submit = document.getElementsByClassName("submitBtn");*/
    const $divFloorPlan = $('#divFloorPlan');
    const $clickedDivFloorPlan = $('#clickedDivFloorPlan');
    const $clickedDivDetails = $('#clickedDivDetails');
    const $divDetails = $('#divDetails');
    const $menuIcon = $('#openNav');
    
    
    /* FUNCTIONS*/
    
     /**
     * @name mobile
     * @desc code for the changing picture when the tabs are clicked, for the mobile viewport
     */
    function mobile()
    {
        enquire.register("screen and (max-width:360px)", {
            match: function(){
                /*Toggle navigation*/
                $menuIcon.on('click', function () {
                    $('.topNav').slideToggle("fast", "linear");
                    console.log("inside jquery");
                });/*menuIcon.click*/                
            },/*match*/
            unmatch: function(){

            }/*unmatch*/
        });/*enquire.register*/
    }//mobile

    /**
     * @name divFloorPlanClicked
     * @desc Handling clicking of floor plan divs
     */
    function divFloorPlanClicked() {
        $(document).ready(function () {
            $("#divFloorPlan").click(function (e) {
                e.preventDefault();
                $clickedDivFloorPlan.show();
                $clickedDivDetails.hide();
                $divFloorPlan.addClass("clicked");
                $divFloorPlan.removeClass("notClicked");
                $divDetails.addClass("notClicked");
                $divDetails.removeClass("clicked");
            }); //click      
        });//document.ready
    }//divFloorPlanClicked


    /**
     * @name divDetailsClicked
     * @desc Handling clicking of details divs
     */
    function divDetailsClicked() {
        $(document).ready(function () {
            $divDetails.click(function (e) {
                e.preventDefault();
                $clickedDivFloorPlan.hide();
                $clickedDivDetails.show();
                $divDetails.addClass("clicked");
                $divDetails.removeClass("notClicked");
                $divFloorPlan.addClass("notClicked");
                $divFloorPlan.removeClass("clicked");
            }); //click      
        });//document.ready
    }//divDetailsClicked 


    /**
     * @name bindBtns
     * @desc this will bind all the elements to their events
     */
    function bindBtns() {
        /*Initial look of Tabs; Details and Floor Plan*/
        $divDetails.removeClass("notClicked");
        divDetailsClicked();
        divFloorPlanClicked();
        mobile();
    }//bindBtns


    /**
     * @name init
     * @desc calls other functions, controls the flow
     *
     */
    function init() {
        bindBtns();
        
    }//end init

    /**
     * @desc onload initilizer
     * @type {init}
     */
    window.onload = init;
})();/*end iffy*/