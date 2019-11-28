$(function() {
  var swiperAdv = new Swiper('.swiper-advantages', {
    slidesPerView: 6,
    spaceBetween: 48,
    threshold: 2000,
    breakpoints: {
      1200: {
        slidesPerView: 4,
        spaceBetween: 35,
        threshold: 0
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
        threshold: 0
      },
      639: {
        slidesPerView: 2,
        spaceBetween: 30,
        threshold: 0
      },
      480: {
        slidesPerView: 1,
        spaceBetween: 40,
        threshold: 0
      }
    },
    pagination: {
      el: '.swiper-advantages .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.advantages__slider .swiper-button-next',
      prevEl: '.advantages__slider .swiper-button-prev'
    }
  });

  function getSlideIndexByClass(className) {
    var index = 0;
    $.each($('.swiper-wrapper').children(), function(i, item) {
      if ($(item).hasClass(className)) {
        index = i;
        return false;
      }
    });
    return index;
  }

  $(window).on('load', function() {
    $('.compare-pic').twentytwenty();
  });

  // Position of description block pointer

  var itemSlide    = $('.swiper-advantages .swiper-slide'),
      itemActive   = $('.swiper-advantages .item-active'),
      swiperBlock  = $('.advantages__slider'), 
      pointer      = $('.description-block__pointer'),
      pointerWidth = $('.description-block__pointer').outerWidth() / 2;

  pointer.css('left', itemActive.offset().left - swiperBlock.offset().left + (itemSlide.width() / 2) - pointerWidth + 'px');  // initital position pointer

  itemSlide.on('click', function() {
    itemSlide.removeClass('item-active');
    $(this).addClass('item-active');
    var offsetLeft     = $(this).offset().left,
        swiperOffset   = swiperBlock.offset().left,
        slideWidthHalf = $(this).width() / 2;

    pointer.css('left', offsetLeft - swiperOffset + slideWidthHalf - pointerWidth + 'px');  // watch for position of active item

    var _part = $('.item-active').data('part');
    $('.description-block').hide().filter('[data-parts=' + _part + ']').show();
    $('.compare-pic').trigger('resize.twentytwenty'); //bugfix for twentytwenty init
  });

  $(window).on('resize', function() {
    var itemActive = $('.swiper-advantages .item-active');
    pointer.css('left', itemActive.offset().left - swiperBlock.offset().left + (itemSlide.width() / 2) - pointerWidth + 'px');
    
    swiperAdv.slideTo(getSlideIndexByClass('item-active'));   
  });

  swiperAdv.on('slideChangeTransitionEnd', function() {
    var itemActive = $('.swiper-advantages .item-active');
    if (itemActive.offset().left < 0) {
      var position = -9999;
    } else {
      var position = itemActive.offset().left - swiperBlock.offset().left + (itemSlide.width() / 2) - pointerWidth;
    }

    pointer.css('left', position + 'px');
  });

  swiperAdv.on('slideChangeTransitionEnd', function() {
    if ($(window).width() <= '480') {
      itemSlide.removeClass('item-active');
      $('.swiper-advantages .swiper-slide-active').addClass('item-active');

      var _part = $('.item-active').data('part');
      $('.description-block').hide().filter('[data-parts=' + _part + ']').show();
      $('.compare-pic').trigger('resize.twentytwenty'); //bugfix for twentytwenty init
    }
  });

});