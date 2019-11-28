import state from '../../../vue/store-service/s-state'

$(function() {
  var swiperWarranty = new Swiper('.swiper-container', {
    slidesPerView: 4,
    spaceBetween: 16,
    loop: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      1199: {
        slidesPerView: 3
      },
      900: {
        slidesPerView: 2
      },
      800: {
        slidesPerView: 1,
        spaceBetween: 0
      }
    }
  });

  var tabTop = $('.calculate__tab-top'),
      tab    = $('.calculate__tab');

  tabTop.on('click', function() {
    $(this).siblings('.calculate__tab-inner').slideDown(400, function() {
      $(this).parent('.calculate__tab').addClass('opened');
    });
  });

  tab.on('click', function() {
    if ($(this).hasClass('opened')) {
      $(this).removeClass('opened');
      $(this).children('.calculate__tab-inner').slideUp(400);
    }
    $(this).toggleClass('rotate');
  });
 
	var $item = $('.swiper-wrapper').find('.swiper-slide').on('click', changeDocuments);
      
  function changeDocuments() {
    var _model = $(this).data('model');
    $item.removeClass('car-active');
    $(this).addClass('car-active');
    $('.swiper-wrapper').find('.swiper-slide[data-model=' + _model + ']').addClass('car-active');
    $('.calculate__tabs').hide().filter('[data-model=' + _model + ']').show();
  }

  function carActiveChange() {
    swiperWarranty.on('slideChangeTransitionStart', function() {
      if ($(window).width() <= '768') {
        $item.removeClass('car-active');
        $('.swiper-slide-active, .swiper-slide-duplicate-active').addClass('car-active');
        var _model = $('.swiper-slide-active').data('model');
        $('.calculate__tabs').hide().filter('[data-model=' + _model + ']').show();
      }
    });

    if ($('.calculate__slider .swiper-pagination-bullet').length < 2) {
      $('.calculate__slider .swiper-pagination-bullet').hide();
    }
  }  

  $(window).on('load resize', carActiveChange);

  var btnForm = $('.check-vin__btn');

  btnForm.on('click', function(e) {
    e.preventDefault();

    var _this = $(this);

    $.ajax({
      url: state.API.CHECK_VIN,
      type: 'GET',
      data: 'vin=' + $('.check-vin__input').val(),
      dataType: 'json',
      success: function(data) {
        if (data.status == 0) {
          _this.parents('form').find('.check-vin__text').text('Ваш автомобиль не участвует в сервисных кампаниях!').show();
        }
        else if (data.status == 1) {
          _this.parents('form').find('.check-vin__text').text('Ваш автомобиль участвует в сервисной кампании! Просим Вас незамедлительно обратиться в официальный дилерский центр Hyundai или воспользоваться онлайн-записью на сервис').show();
        }
      }
    });
  });
  
  var headLink = $('.head .df-download-img-link');
  
  headLink.on('click', function () {
    var header; 
    $('.header-main').css('position') == ('fixed') ? header = $('header').outerHeight() : header = 0; 
    $('html, body').animate({
      scrollTop: $("#program").offset().top - header
    }, 700);
  });

});