
require(['jquery','accordion'], function ($) {
    if ($(window).width() < 640) {
           $(".sub-footer-middle").accordion({
             "openedState": "active",
             "collapsible": true,
             "active": [1],
             "multipleCollapsible": true,
             "animate":{
                "timing-function":"ease-out",
               duration:"500",
               delay:"1s"
            }
         });
     }
 });
//+- button
 require(['jquery', 'jquery/ui'], function($){ 
    (function($) {
       $.fn.spinner = function() {
          this.each(function() {
             var el = $(this);   
             // substract
             el.parent().on('click', '.sub', function() {
                if (el.val() > parseInt(el.attr('min')))
                el.val( function(i, oldval) { 
                   return --oldval; 
                });
             });
             // increment
             el.parent().on('click', '.add', function() {
                if (el.val() < parseInt(el.attr('max')))
                el.val( function(i, oldval) { 
                   return ++oldval; 
                });
             });
          });
       };
    })(jQuery);
       
    $('input[type=number]').spinner();
 });