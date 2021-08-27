require([
    'jquery',
    'slick',
    'domReady!'
 ], function ($) {
    $(".my-list").slick({
       dots: true,
       infinite: true,
       speed: 300,
       slidesToShow: 4,
       autoplaySpeed :3000,
       arrows:true,
       slidesToScroll: 1
    });
 });

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

// require([
//    'jquery',
//    'tabs'], function ($) {
//    $("#element").tabs();
// });