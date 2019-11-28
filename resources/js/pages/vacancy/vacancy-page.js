$(function() {
	//Slider
	$(".js-slider").owlCarousel({
        items: 1,
        autoplay: true,
        nav: true,
        loop: true,
		autoplayTimeout: 10000,
		lazyLoad: true,
        onChanged: function(event) {
           if (event.page.index < 0) {
                event.page.index = 0
           }
            
            $('.slider__current').text(formatOutput(event.page.index + 1));
            $('.slider__length').text(formatOutput(event.item.count));
        }
	});

	function formatOutput(data) {
		if (typeof data === 'undefined') { return null; }
		data = ''+data;
		if (data.length === 1) {
			return '0'+data;
		} else {
			return data;
		}
	}

	$(document).on('keydown', function(e) {
		if (e.keyCode === 40 || e.keyCode === 38) {
			$('.focus-button')[0].focus()
		}
	})

	//Появление/скрытие строки
	$(window).on('scroll', function() {
		if ($(window).scrollTop() > $('.sidebar__title').offset().top) {
			$('.label').addClass('active');
		} else {
			$('.label').removeClass('active');
		}
	})
	
	//Слайдер преимущества на разрешениях <1263
	$(".advantages-slider").owlCarousel({
		nav: true,
		loop: true,
		responsive : {
			0 : {
				items: 1
			},
			768 : {
				items: 2
			}
		}
	});
	
	var controller;
	var slider1;

	var f =  _.debounce(function() {
		createController();
		createScene1();
	}, 300);

	$(window).on('resize', f)

	createController();
	createScene1();

	function createController () {
		var windowWidth = $(window).outerWidth();

		if (windowWidth <= 1262) {
			if (controller) {
				controller.destroy(true);
				controller = null;
			}
		} else {
			if (!controller) {
				controller = new ScrollMagic.Controller({ globalSceneOptions: { offset: 0 } });
			}
		}

		$(".js-slider").trigger('refresh.owl.carousel');
	}

	function createScene1 () {
		if ($(window).outerWidth() <= 1262) {
			return null;
		}
		if (slider1) {
			slider1.destroy(true);
		}
		var duration1 = $('.vacancy').outerHeight() - $('.slider').outerHeight();
	
		if (duration1 < 0) {
			duration1 = 1;
		}

		slider1 = new ScrollMagic.Scene({ triggerElement: ".slider", duration: duration1, triggerHook: '0' })
			.setPin('.slider')
			//.addIndicators({ name: "slider2" })
			.addTo(controller);
	}
})