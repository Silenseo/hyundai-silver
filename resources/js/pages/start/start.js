$(function(){
	//IE11
	// objectFitPolyfill();
	
	// var vid = document.getElementById("video");

	// vid.addEventListener('ended', function() {
	// 	$('.banner').addClass('ended');
	// }, false);

	// //Пропустить видео
	// $('.js-pass').on('click', function(e){
	// 	e.preventDefault();

	// 	$('.banner').addClass('ended');
	// })

	$('.js-go-to-calc').on('click', function(e) {
		e.preventDefault();

		if ($(window).outerWidth() > 1262) {
			$('html, body').animate({ scrollTop: $('#calc').offset().top }, 500)
		} else {
			$('html, body').animate({ scrollTop: $('#calc').offset().top - $('.header-main').outerHeight() }, 500)
		}
	})

	//Карусель about
	$('.js-carousel').owlCarousel({
		items: 3,
		dots: false,
		nav: false,
		margin: 32,
		responsive: {
			0: {
				items: 1,
				stagePadding: 32,
				loop: true,
				margin: 17,
				dots: true
			},
			768: {
				items: 1,
				stagePadding: 192,
				loop: true,
				margin: 64,
				dots: true
			},
			1024: {
				items: 3,
				margin: 32
			}
		}
	})

	//FAQ
	$('.js-open-question').on('click', function(e){
		e.preventDefault();

		$(this).toggleClass('active');
		$(this).next('.question__dropdown').slideToggle();

		var q = $(this).find('span').text();

		dataLayer.push({
			"event": "custom_event",
			"category": "Страница программы start",
			"action": "Вопрос-ответ",
			"label": q
		});
	})

	$('.faq__button').on('click', function() {
		dataLayer.push({
			"event": "custom_event",
			"category": "Страница программы start",
			"action": "Вопрос-ответ",
			"label": "Нажатие кнопки Задать вопрос"
		})
	})

	//Скрыть часть блоков FAQ
	var isShow = false;

	function toggleItems(items) {
		if (items === 'all') {
			$('.faq__item').slideDown();
			$('.js-show-more').text('Скрыть');

			return null;
		}
		$('.faq__item').each(function(i) {
			if (i > items - 1) {
				$(this).slideUp();
			}
		})
		$('.js-show-more').text('Показать еще');
	}

	if ($(window).outerWidth() < 768) {
		toggleItems(4);
	}
	
	$(window).on('resize', function() {
		if ($(window).outerWidth() < 768) {
			toggleItems(4);
		} else {
			toggleItems('all');
		}
	})

	$('.js-show-more').on('click', function(e) {
		e.preventDefault();

		if (isShow) {
			toggleItems(4);
			isShow = false;
		} else {
			toggleItems('all');
			isShow = true;
		}
	})
})