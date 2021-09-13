require(['jquery','accordion'], function ($) {
   if ($(window).width() < 640) {
      $(".sub-footer-middle").accordion({
         "openedState": "active",
         "collapsible": true,
         "active": [2],
         "multipleCollapsible": true,
         "animate":{
            timing:"ease-out",
            duration:"500",
            delay:"1s"
         }
      });
   }
   $(".sub-short-content").accordion({
      "openedState": "active",
      "collapsible": true,
      "active": [2],
      "multipleCollapsible": true,
      "animate":{
         timing:"ease-out",
         duration:"500",
         delay:"1s"
      }
   });
});

require(['jquery', 'jquery/ui'], function($) { 
   (function($) {
       $.fn.spinner = function() {
          this.each(function() {
            var qty = $(this);  
             
            qty.wrap('<div class="spinner"></div>');    
            qty.before('<span class="qty__sub" title="subtract"><i class="fas fa-minus"></i></span>');
            qty.after('<span class="qty__add" title="add"><i class="fas fa-plus"></i></span>');

            qty.parent().on('click', '.qty__sub', function() {
               if(qty.val() > parseInt(qty.attr('min'))){
                  qty.val( function(i, oldval) { 
                     return --oldval; 
                  });
               }            
             });

            qty.parent().on('click', '.qty__add', function() {
                  qty.val( function(i, oldval) { 
                     return ++oldval; 
               });
            });
         });
      };
   })(jQuery);
       
   $('input[type=number]').spinner();
});





