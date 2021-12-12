
    $(document).ready(function() {
        $('.carousel').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            // arrows:true,
            // prevArrow:'<button type="button" class="slick_btn btn_prev"><span class="slick-prev"><i class="fas fa-chevron-left"></i></span></button>',
            // nextArrow:'<button type="button" class="slick_btn btn_next"><span class="slick-next"><i class="fas fa-chevron-right"></i></span></button>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
