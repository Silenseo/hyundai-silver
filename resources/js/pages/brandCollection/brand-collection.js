$(function () {
	//Установим название активной секции в мобильном меню
	$('.nav__current').html($('.nav__link.active').text());
	
	//Slider New
	if ($(".js-slider").length > 0) {
		$(".js-slider").owlCarousel({
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2,
					margin: 32
				},
				950: {
					items: 3,
					margin: 32
				},
				1263: {
					items: 4,
					margin: 32
				}
			}
		});
	}

	//Фильтры
	var selectedFilters = [];

    function addFilter(val) {
        selectedFilters.push(+val);
    }

    function removeFilter(val) {
        if (selectedFilters.indexOf(+val) >= 0) {
            selectedFilters.splice(selectedFilters.indexOf(+val), 1);
        }
    }


	$('.filters__item input').on('change', function () {
		var val = $(this).attr('value'),
            productsList = $('.products__item');

        if ($(this).prop("checked")) {
            addFilter(val);
        } else {
            removeFilter(val);
        }

		productsList.each(function () {
			if (selectedFilters.length > 0) {
				if (selectedFilters.indexOf($(this).data('tag')) >= 0) {
					$(this).fadeIn();
				} else {
					$(this).fadeOut();
				}
			}
		})

		if (selectedFilters.length === 0) {
			$('.products__item').fadeIn();
			$('.filters__reset').fadeOut();
        } else {
			$('.filters__reset').fadeIn();
		}
		//console.log(selectedFilters)
	})

	//Сбросить фильтры
	$('.js-reset-filters').on('click', function (e) {
		e.preventDefault();

		selectedFilters = [];
		$('.filters__item input').prop("checked", false);
		$('.filters__item input').eq(0).trigger('change')
	})

	var pSlider = $(".js-p-slider");
	
	//Открыть popup
	$('.product').on('click', function (e) {
		e.preventDefault();

		var products = $('.product:visible'),
			productsArr = [],
			artCurrent = $(this).find('.product__art').text(),
			productCurrent = 0,
			id = $(this).data('id');

		products.each(function (i) {
			var product = {};

			product.id = $(this).data('id');
			product.img = $(this).find('img').attr('src');
			product.name = $(this).find('.product__name').text();
			product.art = $(this).find('.product__art').text();
			product.price = $(this).find('.product__price').text();
			product.description = $(this).find('.product__description').text();
			product.material = $(this).find('.product__material').text();
			product.size = $(this).find('.product__size').text();

			productsArr.push(product);

			if (artCurrent === product.art) {
				productCurrent = i;
			}
		})

		//console.log(productsArr);

		var html = _.template(document.getElementById('list-template').innerHTML)({
			products: productsArr
		});

		$('.p-product__list').html(html);

		$('body').addClass('p-product-isOpened');

		pSlider.owlCarousel({
			items: 1,
			nav: true,
			dots: false,
			autoHeight: true,
			onChanged: function (event) {
				var current = event.item.index;

				if (current !== null) {
					window.location.hash = 'id='+productsArr[current].id;
				}
			}
		});

		//переключаем слайд на товар, по которому кликнули
		pSlider.trigger("to.owl.carousel", [productCurrent, 1, true]);

		//Обновим размер карусели, чтобы заполнить всю ширину окна (т.к. убираем скролл бар)
		setTimeout(()=>{
			pSlider.trigger("refresh.owl.carousel");
		}, 100)

		//Добавим признак в адресную строку
        if (id) {
            window.location.hash = 'id='+id;
		}
	})

	//Закрыть popup
	$(document).on('click', '.js-close-p-product', function (e) {
		e.preventDefault();

		$('body').removeClass('p-product-isOpened');
		pSlider.trigger('destroy.owl.carousel');
		window.location.hash = '_';
	})

	//Найти дилера в попап
	$(document).on('click', '.js-p-find-dealer', function (e) {
		e.preventDefault();

        $('body').toggleClass('where-buy-isOpened');

        //Скролл до карты
        setTimeout(function () {
            if ($('body').hasClass('where-buy-isOpened')) {
                $('.p-product').animate({ scrollTop: $('.where-buy').offset().top }, 300);
            } else {
                $('.p-product').animate({ scrollTop: 0 }, 300);
            }
        }, 500);
	})

	//Открытие товара при наличии id товара в адресе
    if (window.location.hash) {
        $('.product').each(function(){
            var id = $(this).data('id')

            if (id == window.location.hash.substr(4, window.location.hash.length - 1)) {
                $(this).trigger('click');
            }
        })
	}
	
	//Открытие/закрытие меню на мобилке
	$('.js-menu-open').on('click', function (e) {
		e.preventDefault();

		$(this).toggleClass('isOpened')
		$('.nav__menu').slideToggle();
	})

	$(document).on('click', function (e) {
		if ($(e.target).closest('.js-menu-open').length === 0 && $(window).outerWidth() < 1263) {
			$('.js-menu-open').removeClass('isOpened');
			$('.nav__menu').slideUp();
		}
	})
})