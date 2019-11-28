$(function () {
    $(".js-slider-1").owlCarousel({
		nav: true,
		loop: true,
		autoHeight: true,
        navText: ['<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 37L1.59055 19.6644C1.25376 19.2855 1.25376 18.7145 1.59055 18.3356L17 1" stroke="black" stroke-width="2"/></svg>', '<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L16.4095 18.3356C16.7462 18.7145 16.7462 19.2855 16.4095 19.6644L0.999994 37" stroke="black" stroke-width="2"/></svg>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1263: {
                items: 4
            }
        }
    });
})