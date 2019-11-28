import parallax from '../parallax'
import smoothScroll from '../smoothScroll'
import videoInit from '../videoInit'

$(function() {
	var controller = new ScrollMagic.Controller();

	videoInit();

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

	$(window).on('load', function() {
		$('body').addClass('loaded');
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

			var scene1 = new ScrollMagic.Scene({triggerElement: description, triggerHook: 1, offset: 150 })
				//.addIndicators({name: id + " description (duration: 0)"})
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

	parallax();
	$(window).on('resize', parallax);

	$('.js-carousel').owlCarousel({
		items: 3,
		loop: false,
		margin: 32,
		dots: false,
		nav: false,
		mouseDrag: false
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

	$('.feel-img-text').on('click', function(){
    	if(!($(this).hasClass('active')))
    	{
            $('.feel-img-pic').toggleClass('feel-img-hidden');
            $('.feel-img-text').toggleClass('active');
            $('.feel-car-img').toggleClass('rotated');
        }
	});

	$('.feel-car-img').on('click', function() {
		$('.feel-car-img').toggleClass('rotated');
		$('.feel-img-text').toggleClass('active');
		$('.feel-img-pic').toggleClass('feel-img-hidden');
	})

})