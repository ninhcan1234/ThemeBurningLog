require(['jquery','slick'], function($) {
   $(document).ready(function () {
       $(".product-items").slick({
           dots: false,
           infinite: true,
           speed: 300,
           autoplay: false,
           autoplaySpeed:2000,
           slidesToShow: 4,
           slidesToScroll: 1,
           responsive: [
               {
                   breakpoint: 1280,
                   settings: 
                   {
                       slidesToShow: 3,
                       slidesToScroll: 3
                   }
               },
               {
                   breakpoint: 768,
                   settings: 
                   {
                       slidesToShow: 2,
                       slidesToScroll: 2
                   }
               },
               {
                   breakpoint: 600,
                   settings: 
                   {
                       slidesToShow: 2,
                       slidesToScroll: 2
                   }
               }
           ]
       });

        $(".list-showrooms").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            autoplaySpeed :3000,
            arrows: false,
            slidesToScroll: 1
        });
  
        $(".list-instagrams").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            autoplaySpeed :3000,
            arrows: false,
            slidesToScroll: 1
        });
  
        $(".list-banners").slick({
            dots: false,
            infinite: true,
            speed: 300,
            autoplay:true,
            slidesToShow: 1,
            autoplaySpeed :3000,
            arrows: false,
            slidesToScroll: 1
        });
   });
});


