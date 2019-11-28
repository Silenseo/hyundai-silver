$(function(){
	//Дропдаун выбор города
	$('#js-city-select').selectize();

	$(document).on('keydown', function(e) {
		if (e.keyCode === 40 || e.keyCode === 38) {
			$('.focus-button')[0].focus()
		}
	})

	var controller;
	var slider1,
		slider2;

	var f =  _.debounce(function() {
		createController();
		createScene1();
		createScene2();
	}, 300);

	$(window).on('resize', f)

	createController();

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

		$(".js-slider2").trigger('refresh.owl.carousel');
		$(".js-slider").trigger('refresh.owl.carousel');
	}

	function createScene1 () {
		if ($(window).outerWidth() <= 1262) {
			return null;
		}
		if (slider2) {
			slider2.destroy(true);
		}
		var duration2 = $('.sidebar__wrap').outerHeight() - $('.slider--2').outerHeight();
	
		if (duration2 < 0) {
			duration2 = 1;
		}

		slider2 = new ScrollMagic.Scene({ triggerElement: ".slider--2", duration: duration2, triggerHook: '0' })
			.setPin('.slider--2')
			//.addIndicators({ name: "slider2" })
			.addTo(controller);
	}

	function createScene2 () {
		if ($(window).outerWidth() <= 1262) {
			return null;
		}
		if (slider1) {
			slider1.destroy(true);
		}
		var duration1 = $('.sidebar__wrap').outerHeight() - $('.slider--1').outerHeight();
	
		if (duration1 < 0) {
			duration1 = 1;
		}

		slider1 = new ScrollMagic.Scene({ triggerElement: ".slider--1", duration: duration1, triggerHook: '0' })
			.setPin('.slider--1')
			//.addIndicators({ name: "slider1" })
			.addTo(controller);
	}

	//Переключение вкладок
	$('.js-change-tab').on('click', function (e) {
		e.preventDefault();

		var tab = $(this).data('tab');

		$('.js-section').fadeOut();
		$('.js-section[data-section="'+tab+'"]').fadeIn();
		
		$('.js-change-tab').removeClass('active').prop('disabled', false);;
		$(this).addClass('active').prop('disabled', true);;

		if (tab === 'form') {
			window.location.hash = 'junior';
			$('.sidebar__subtitle').fadeIn();
			$(".js-slider2").trigger('to.owl.carousel', 0, 300);
			$(".js-slider2").trigger('refresh.owl.carousel');

			setTimeout(createScene1, 500)
		} else {
			window.location.hash = '';
			$('.sidebar__subtitle').fadeOut();
			$(".js-slider").trigger('to.owl.carousel', 0, 300);
			$(".js-slider").trigger('refresh.owl.carousel');

			setTimeout(createScene2, 500)
		}
	})

	//Если есть хэш с id junior - открываем вкладку с формой

	var hash = window.location.hash.substr(1);

	if (hash !== 'junior') {
		$('.js-change-tab[data-tab="accordion"]').trigger('click');
	} else {
		$('.js-change-tab[data-tab="form"]').trigger('click');
	}


	//Аккордеон
	var Accordion = function (el, multiple) {
		this.el = el || {};
		// more then one submenu open?
		this.multiple = multiple || false;

		var dropdownlink = this.el.find('.js-open-section');
		dropdownlink.on('click',
			{ el: this.el, multiple: this.multiple },
			this.dropdown);
	};

	Accordion.prototype.dropdown = function (e) {
		e.preventDefault();

		var $el = e.data.el,
			$this = $(this),
			//this is the ul.submenuItems
			$next = $this.next();

		$next.slideToggle(createScene2);
		$this.parent().toggleClass('active');

		if (!e.data.multiple) {
			//show only one menu at the same time
			$el.find('.accordion__dropdown').not($next).slideUp().parent().removeClass('active');
		}
	}

	var accordion = new Accordion($('.accordion'), false);

	//Slider
	$(".js-slider").owlCarousel({
        items: 1,
        autoplay: true,
        nav: true,
        loop: true,
        pullDrag: false,
        mouseDrag: false,
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

	$(".js-slider2").owlCarousel({
        items: 1,
        autoplay: true,
        nav: true,
        loop: true,
        pullDrag: false,
        mouseDrag: false,
		autoplayTimeout: 10000,
		lazyLoad: true,
        onChanged: function(event) {
           if (event.page.index < 0) {
                event.page.index = 0
           }
            
            $('.slider__current2').text(formatOutput(event.page.index + 1));
            $('.slider__length2').text(formatOutput(event.item.count));
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
	
	//Выбор файла
	// $(".file-upload:not(.multiple) input[type=file]").change(function () {
	// 	var filename = this.files[0].name;

	// 	if (filename) {
	// 		$(this).next(".file-upload__button").find('span').text(filename);
	// 		$(this).next(".file-upload__button").css('color','#00AAD2');
	// 		$(this).next(".file-upload__button").find('path').css('stroke', '#000');
	// 	} else {
	// 		$(this).next(".file-upload__button").find('span').text('не удалось прикрепить файл');
	// 		$(this).next(".file-upload__button").css('color','#E63312');
	// 		$(this).next(".file-upload__button").find('path').css('stroke', '#E63312');
	// 	}
		
	// 	files = this.files;
	// });
})
