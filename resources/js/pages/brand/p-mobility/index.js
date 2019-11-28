import parallax from '../parallax'
import smoothScroll from '../smoothScroll'
import videoInit from '../videoInit'

$(function() {
	var controller = new ScrollMagic.Controller();

	videoInit();

	$(window).on('load', function() {
		$('body').addClass('loaded');
	})

	//Усреднённые цвета подложек
	const fac = new FastAverageColor();

	$.extend($.lazyLoadXT, {
		edgeY:  500,
		checkDuplicates: false
	});

	$('.js-set-color').on('lazyload', function () {
		const image = new Image();
		var color;

		image.src = this.style.backgroundImage.replace('url("','').replace('")','');

		image.onload = ()=>{
			color = fac.getColor(image);

			$(this).parent().css('background-color', color.hex);
		}
	})

	//Расстановка триггеров для блоков
	$('.scrollmagic').each(function(){
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			//.addIndicators({name: id + " (duration: 0)"})
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});

		if ($(this).find('.df-description').length > 0) {
			var description = this.querySelector('.df-description');

			var scene1 = new ScrollMagic.Scene({triggerElement: description, triggerHook: 1, offset: 100 })
				//.addIndicators({name: "description (duration: 0)"})
				.addTo(controller);

			scene1.on("enter", function (event) {
				$(event.currentTarget.triggerElement()).addClass("active");
			});
		}
	})

	$('.df-slideUp').each(function() {
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});
	})

	//Появление блока Чувсвенная спортивность
	var scene0 = new ScrollMagic.Scene({triggerElement: '.sport', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene0.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	var scene = new ScrollMagic.Scene({triggerElement: '.sport__right', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Появление блока Бренд N
	var scene1 = new ScrollMagic.Scene({triggerElement: '.brand', triggerHook: 0.3 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene1.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Обслуживание клиентов
	var scene2 = new ScrollMagic.Scene({triggerElement: '.service', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene2.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Ценность
	var scene3 = new ScrollMagic.Scene({triggerElement: '.value__composition', triggerHook: 0.95 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene3.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//N-power
	var scene4 = new ScrollMagic.Scene({triggerElement: '.n-power__wrap', triggerHook: 0.8 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene4.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	var scene5 = new ScrollMagic.Scene({triggerElement: '.n-power__main-img', triggerHook: 0.8 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene5.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	var scene6 = new ScrollMagic.Scene({triggerElement: '.n-power__list', triggerHook: 0.8 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene6.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	parallax();
	$(window).on('resize', parallax);

	$('.js-carousel').owlCarousel({
		items: 3,
		loop: false,
		margin: 32,
		dots: false,
		nav: false,
		mouseDrag: false,
		responsive: {
			320: {
				items: 1,
				mouseDrag: true,
				autoWidth: true,
				nav: true,
				navText: ['<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13L4.3698 7.5547C4.14587 7.2188 4.14587 6.7812 4.3698 6.4453L8 1" stroke="#002C5F" stroke-width="2"/></svg>', '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.51758 1L10.1478 6.4453C10.3717 6.7812 10.3717 7.2188 10.1478 7.5547L6.51758 13" stroke="#002C5F" stroke-width="2"/></svg>']
			},
			768: {
				items: 2,
				mouseDrag: true,
				autoWidth: true
			},
			1263: {
				items: 3,
				loop: false,
				margin: 32,
				dots: false,
				nav: false,
				mouseDrag: false
			}
		}
	})

	var owl2 = owl2Init(); 
	
	owl2();

	$(window).on('resize', owl2)

	function owl2Init() {
		var isInit = false;

		return function () {
			if ($(window).outerWidth() > 640) {
				if (!isInit) {
					$('.js-carousel-2').addClass('owl-carousel');
					$('.js-carousel-2').owlCarousel({
						items: 3,
						loop: false,
						margin: 32,
						dots: false,
						nav: false,
						mouseDrag: false,
						responsive: {
							640: {
								items: 2,
								mouseDrag: true,
								autoWidth: true
							},
							1263: {
								items: 3,
								loop: false,
								margin: 32,
								dots: false,
								nav: false,
								mouseDrag: false
							}
						}
					})
	
					isInit = true;
				}
			} else {
				if (isInit) {
					$('.js-carousel-2').removeClass('owl-carousel');
					$('.js-carousel-2').trigger('destroy.owl.carousel');

					isInit = false;
				}
			}
		}
	}
	

	
})