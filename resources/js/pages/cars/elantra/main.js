import state from '../../../vue/store-service/s-state'

$(function () {
	//Обновить цены в баннере

	//!!!Установи правильный id тачки для загрузки цены
	var priceCarId = 27;

	$.ajax({
		url: state.API.CAR_LIST,
		success: function(resp) {
			if (resp) {
				if (resp.cars) {
					if (resp.cars[priceCarId]) {
						if (resp.cars[priceCarId].minPrice && resp.cars[priceCarId].payment) {
							$('#price-from').text(resp.cars[priceCarId].minPrice.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' '));
							$('#credit-from').text(resp.cars[priceCarId].payment.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' '));
						}
					} else {
						console.error('wrong car id ' + priceCarId);
					}
				}
			}
			
			$('.banner').addClass('isEntered');
		}
	});

	var controller = new ScrollMagic.Controller();

	if ($(window).outerWidth() >  1262) {
		var controller2 = new ScrollMagic.Controller({ globalSceneOptions: { offset: -48, triggerHook: '0' } });
	} else {
		var controller2 = new ScrollMagic.Controller({ globalSceneOptions: { offset: -104, triggerHook: '0' } });
	}
	

	controller.scrollTo(function (newScrollPos) {
		$("html, body").animate({scrollTop: newScrollPos});
	});

	$('a.scroll').on('click', function(e) {
		e.preventDefault();
		var obj = $(this).attr('href');
		
		if ($(window).outerWidth() > 1262) {
			controller.scrollTo($(obj).offset().top - 47);
		} else {
			controller.scrollTo($(obj).offset().top - 103);
		}
	})

	//Подсветка активного пункта меню
	var scene1 = new ScrollMagic.Scene({ triggerElement: '#design' })
		//.addIndicators()
		.addTo(controller2);

	scene1.on("enter", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#design"]').addClass('active');
		checkNavPos();
	});
	scene1.on("leave", function (event) {
		$('a.scroll').removeClass('active');
		checkNavPos();
	});

	var scene2 = new ScrollMagic.Scene({ triggerElement: '#dynamics' })
		.addTo(controller2);

	scene2.on("enter", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#dynamics"]').addClass('active');
		checkNavPos();
	});
	scene2.on("leave", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#design"]').addClass('active');
		checkNavPos();
	});

	var scene3 = new ScrollMagic.Scene({ triggerElement: '#comfort' })
		.addTo(controller2);

	scene3.on("enter", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#comfort"]').addClass('active');
		checkNavPos();
	});
	scene3.on("leave", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#dynamics"]').addClass('active');
		checkNavPos();
	});

	var scene4 = new ScrollMagic.Scene({ triggerElement: '#safety' })
		.addTo(controller2);

	scene4.on("enter", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#safety"]').addClass('active');
		checkNavPos();
	});
	scene4.on("leave", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#comfort"]').addClass('active');
		checkNavPos();
	});

	var scene5 = new ScrollMagic.Scene({ triggerElement: '#specs' })
		.addTo(controller2);

	scene5.on("enter", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#specs"]').addClass('active');
		checkNavPos();
	});
	scene5.on("leave", function (event) {
		$('a.scroll').removeClass('active');
		$('a.scroll[href="#safety"]').addClass('active');
		checkNavPos();
	});

	function checkNavPos () {
		var obj = $('a.scroll.active'),
			windowWidth = $(window).width(),
			scrollLeft = $('.nav').scrollLeft();

		if (obj.length > 0) {
			//console.log(obj.offset().left, scrollLeft)
			if (obj.offset().left < scrollLeft || obj.offset().left + obj.width() >= windowWidth) {
				$('.nav').animate({ scrollLeft: obj.position().left })
				console.log(obj.position().left)
			}
		}
	}
	

	$.extend($.lazyLoadXT, {
		edgeY:  500
	});

	//Фиксирование меню
	var fixMenu = new ScrollMagic.Scene({ triggerElement: ".nav", duration: '0', triggerHook: '0' })
		//.addIndicators({ name: "nav" })
		.setPin('.nav')
		.addTo(controller);

	$(window).on('resize', function () {
		checkMenuOffset();
	})
	
	checkMenuOffset();

	function checkMenuOffset () {
		if ($(window).outerWidth() < 1263) {
			fixMenu.offset(-56);
		} else {
			fixMenu.offset(0);
		}
	}

	//Parallax
	var rellax;

	$(window).on('resize', function () {
		parallax();
	})

	parallax();

	function parallax () {
		if ($(window).outerWidth() > 1262) {
			if (rellax) {
				rellax.destroy();
			}
			rellax = new Rellax('.s-parallax__list--right', {
				center: true,
				speed: 5
			});

			var obj = $('.s-parallax');

			obj.each(function () {
				$(this).find('.s-parallax__list--right').append($(this).find('.s-parallax__list--right').prev('.s-parallax__list--left').find('.s-parallax__item--right'))
			})
		} else {
			if (rellax) {
				rellax.destroy();
			}

			var obj = $('.s-parallax');

			obj.each(function () {
				$(this).find('.s-parallax__list--left').append($(this).find('.s-parallax__list--left').next('.s-parallax__list--right').find('.s-parallax__item'))
			})
		}

		$('.s-parallax__item').each(function() {
			if ($(this).data('order')) {
				$(this).css('order', $(this).data('order'))
			}
		})
	}

	//Анимация смены изображения КПП
	var animD = new TimelineMax({repeat:-1, yoyo:true, repeatDelay: 5})

	animD
		.staggerFrom('.dynamics .s-parallax__bg', 0.3, {
			opacity: 0
		}, 3)
	
	//Анимация смены изображения дисков
	var animP = new TimelineMax({repeat:-1, yoyo:true, repeatDelay: 1})

	animP
		.staggerFrom('.design .s-parallax__bg', 0.3, {
			opacity: 0
		}, 3)

	//Анимация смены изображения салона
	var animC = new TimelineMax({repeat:-1, yoyo:true, repeatDelay: 1})

	animC
		.staggerFrom('.comfort .s-parallax__bg', 0.3, {
			opacity: 0
		}, 3)


	//Анимация системы слепых зон
	var animS = new TimelineMax({repeat:-1, yoyo:false, repeatDelay: 0})

	animS
			.staggerFrom('.schema__animate', 0.5, {
					visibility: 'hidden'
			}, 0.5)

	//Раздел динамика
	//Счётчики
	var count1 = { 
		score: 0,
		update: function() {
			$('#count1').text(this.score);
		}
	};
	var count2 = { 
		score: 0,
		update: function() {
			$('#count2').text(this.score);
		}
	};

	var count3 = { 
		score: 0,
		update: function() {
			$('#count3').text(this.score);
		}
	};

	var count4 = { 
		score: 0,
		update: function() {
			$('#count4').text(this.score);
		}
	};

	var counterAnim = new TimelineMax({
		paused: true
	})

	var counterAnim2 = new TimelineMax({
		paused: true
	})

	counterAnim
		.add('start')
		.to(count1, 2, { score: "+=128", roundProps: "score", onUpdate: count1.update.bind(count1), ease: Linear.easeNone }, 'start')
		.to(count2, 2, { score: "+=10", roundProps: "score", onUpdate: count2.update.bind(count2), ease: Linear.easeNone }, 'start')

	counterAnim2
		.add('start')
		.to(count3, 2, { score: "+=150", roundProps: "score", onUpdate: count3.update.bind(count3), ease: Linear.easeNone }, 'start')
		.to(count4, 2, { score: "+=8", roundProps: "score", onUpdate: count4.update.bind(count4), ease: Linear.easeNone }, 'start')
	
	$('.js-change-view').on('click', function (e) {
		e.preventDefault();
		var view = $(this).data('view');
	
		$('.js-change-view').each(function () {
			$(this).parents('.dynamics').removeClass($(this).data('view'));
		}).removeClass('active')
	
		$(this).addClass('active');
		$(this).parents('.dynamics').addClass(view);

		if (view === 'view1') {
			counterAnim2.play()
		}
	})
	
	var dynamics1 = new ScrollMagic.Scene({ triggerElement: ".dynamics--1", duration: '0', triggerHook: '0.45' })
	//.addIndicators({ name: "design" })
	.addTo(controller);
	
	dynamics1.on("enter", function (event) {
		$('.dynamics--1').addClass('isEntered');
		dynamics1.destroy();
	});
	
	var dynamics11 = new ScrollMagic.Scene({ triggerElement: ".dynamics--1", duration: $('.dynamics--1').height(), triggerHook: '0.5' })
	//.addIndicators({ name: "v1" })
	.addTo(controller);
	
	dynamics11.on("enter", function (event) {
		$('#d-video1').get(0).play();
		counterAnim.play();
	});
	dynamics11.on("leave", function (event) {
		$('#d-video1').get(0).pause();
		counterAnim.kill();
	});
	
	var dynamics2 = new ScrollMagic.Scene({ triggerElement: ".dynamics--2", duration: $('.dynamics--2').height(), triggerHook: '0.5' })
	//.addIndicators({ name: "v2" })
	.addTo(controller);

	//Safety
	var safety1 = new ScrollMagic.Scene({ triggerElement: ".safety--1", duration: '0', triggerHook: '0.45' })
	//.addIndicators({ name: "design" })
	.addTo(controller);

	safety1.on("enter", function (event) {
		$('.safety--1').addClass('isEntered');
		safety1.destroy();
	});

	var safety2 = new ScrollMagic.Scene({ triggerElement: ".safety--2", duration: '0', triggerHook: '0.45' })
	//.addIndicators({ name: "design" })
	.addTo(controller);

	safety2.on("enter", function (event) {
		$('.safety--2').addClass('isEntered');
		safety1.destroy();
	});

	var safety3 = new ScrollMagic.Scene({ triggerElement: ".safety--3", duration: '0', triggerHook: '0.45' })
	//.addIndicators({ name: "design" })
	.addTo(controller);

	safety3.on("enter", function (event) {
		$('.safety--3').addClass('isEntered');
		safety1.destroy();
	});

	var safety4 = new ScrollMagic.Scene({ triggerElement: ".safety--4", duration: '0', triggerHook: '0.45' })
	//.addIndicators({ name: "design" })
	.addTo(controller);

	safety4.on("enter", function (event) {
		$('.safety--4').addClass('isEntered');
		safety1.destroy();
	});

	//Hint Popup Start
    $('.js-show-df-hint-popup').on('click', function(e){
        e.preventDefault();
        var popup = $(this).parent('.df-help').find('.df-hint-popup');

        if (popup.hasClass('df-hint-popup--left') || popup.hasClass('df-hint-popup--right')) {
            return null;
        }

        popup.addClass('df-hint-popup--right');
    })

    $('.js-close-df-hint-popup').on('click', function (e) {
        e.preventDefault();
        var popup = $(this).parent('.df-hint-popup');

        popup.removeClass('df-hint-popup--right');
    })

    $(window).on('click', function(e){
        if ($(e.target).closest('.df-hint-popup').length === 0 && $(e.target).closest('.js-show-df-hint-popup').length === 0) {
            $('.df-hint-popup').removeClass('df-hint-popup--right');
        }
    })
    //Hint Popup End
})
