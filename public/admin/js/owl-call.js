  jQuery('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    responsiveClass:true,
    dots:true,
    responsive:{

        0:{

            items:1,
            nav:true
            
        },
        992:{

            items:2,
            nav:true
        },
        1199:{

            items:3,
            nav:true
        },
        1600:{

            items:4,
            nav:true,
            loop:false
        }
    }
})