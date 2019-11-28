$(function() {
	var controller = new ScrollMagic.Controller();

	$('.js-carousel').owlCarousel({
		items: 1,
		smartSpeed: 1000,
		nav: true,
		dots: true,
		mouseDrag: false,
		autoHeight: true,
		loop: true,
		navText: ['<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 37L1.59055 19.6644C1.25376 19.2855 1.25376 18.7145 1.59055 18.3356L17 1" stroke="black" stroke-width="2"/></svg>', '<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L16.4095 18.3356C16.7462 18.7145 16.7462 19.2855 16.4095 19.6644L1 37" stroke="black" stroke-width="2"/></svg>'],
		onTranslated: function(event) {
			if (event.page.index === 3) {
				$('.mir').addClass('active')
			}
		},
		onTranslate: function(event) {
			if (event.page.index !== 3) {
				$('.mir').removeClass('active')
			}
		}
	})

	//Появление блока Помощь
	var scene = new ScrollMagic.Scene({triggerElement: '.help', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});
})