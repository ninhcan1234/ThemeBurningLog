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
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
 });
 
 
 