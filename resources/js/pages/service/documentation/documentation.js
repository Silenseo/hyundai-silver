$(function() {
  var swiperWarranty = new Swiper('.swiper-container', {
    slidesPerView: 5,
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
      1599: {
        slidesPerView: 4
      },
      1024: {
        slidesPerView: 3
      },
      900: {
        slidesPerView: 2
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 0
      }
    }
  });
 
	var $item = $('.swiper-wrapper').find('.swiper-slide').on('click', changeDocuments);
      
  function changeDocuments() {
    var _model = $(this).data('model');
    $item.removeClass('car-active');
    $(this).addClass('car-active');
    $('.swiper-wrapper').find('.swiper-slide[data-model=' + _model + ']').addClass('car-active');
    $('.materials-content').hide().filter('[data-model=' + _model + ']').show();
  }

  function carActiveChange() {
    if ($(window).width() <= '768') {
      swiperWarranty.on('slideChangeTransitionStart', function() {      
        $item.removeClass('car-active');
        $('.swiper-slide-active, .swiper-slide-duplicate-active').addClass('car-active');
        var _model = $('.swiper-slide-active').data('model');
        $('.materials-content').hide().filter('[data-model=' + _model + ']').show();
      });
    }
  }

  $(window).on('load resize', carActiveChange);

});