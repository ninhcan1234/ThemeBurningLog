require(['jquery','slick'], function($) {
    $(document).ready(function () {
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
         $(".list-showrooms").slick({
             dots: false,
             infinite: true,
             speed: 300,
             slidesToShow: 1,
             autoplaySpeed :3000,
             arrows: false,
             slidesToScroll: 1
         });
    });
 });
 