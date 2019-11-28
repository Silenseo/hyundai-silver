$(function () {
  //Слайдер
  var slider = {
    currentSlide: null,
    setCurrentSlide: function (slide) {
      if (typeof slide != 'undefined') {
        this.currentSlide = slide;
        $('.js-get-image').css('background-image', 'url(' + this.currentSlide.data('img') + ')');
        $('.js-get-text').text(this.currentSlide.data('text'));
        $('.js-set-slide').removeClass('tec-slider__link--active');
        this.currentSlide.addClass('tec-slider__link--active');
      }
    },
    init: function () {
      this.setCurrentSlide($('.js-set-slide').eq(0));
    }
  }

  slider.init();

  $('.js-set-slide').on('click', function (e) {
    e.preventDefault();
    slider.setCurrentSlide($(this));
  })
})


// Bug fix - Ie Flicker
try { document.execCommand('BackgroundImageCache', false, true); } catch (e) { };

// Safety
// slider
$(function () {
  var _s = $("#safety_slider");
  var _t;
  _s.slider({
    range: "min",
    value: 0,
    min: 0,
    max: 800,
    slide: function (event, ui) {
      _s.attr("current", ui.value);
      exeSlider(ui.value);
      stopSlide();
    }
  });
  _s.attr("current", 0);
  function autoSlide() {
    var _o = $(".pip.contents_safety .scene_wrap");
    _o.find(".controls a.play").hide();
    _o.find(".controls a.stop").show();
    _t = setTimeout(function () {
      if (parseInt(_s.attr("current")) < 1000) {
        _s.slider("value", (parseInt(_s.attr("current")) + 1));
        _s.attr("current", (parseInt(_s.attr("current")) + 1));
        exeSlider((parseInt(_s.attr("current"))));
        autoSlide();
      } else {
        clearTimeout(_t);
      }
    }, 25);
  }
  function stopSlide() {
    var _o = $(".pip.contents_safety .scene_wrap");
    _o.find(".controls a.play").show();
    _o.find(".controls a.stop").hide();
    clearTimeout(_t);
  }
  function nextSlide() {
    stopSlide();
    var a = parseInt(parseInt(_s.attr("current")) / 200); // 0 ~ 3
    if (a < 3) a = a + 1;
    else a = 0;
    _s.slider("value", (a) * 200);
    _s.attr("current", (a) * 200);
    exeSlider((parseInt(_s.attr("current"))));
    autoSlide();
  }
  function exeSlider(va) {
    var _e = parseInt((va - 0) / 200);
    var _o = $(".pip.contents_safety .scene_wrap");
    // slider text color
    var _st = _o.find(".slider_wrap .slider_text");
    _st.find("ul li").each(function () {
      if ($(this).index() == _e && !$(this).hasClass("on")) $(this).addClass("on");
      if ($(this).index() != _e && $(this).hasClass("on")) $(this).removeClass("on");
    });
    if (va == 1000) _st.find("ul li").removeClass("on").eq(4).addClass("on");

    exeMotions(va);
  }
  function exeMotions(va) {
    var _a = parseInt(va / 200);
    var s1 = $(".pip.contents_safety .scene_wrap .scene.scene1");
    var s2 = $(".pip.contents_safety .scene_wrap .scene.scene2");
    var s3 = $(".pip.contents_safety .scene_wrap .scene.scene3");
    var s4 = $(".pip.contents_safety .scene_wrap .scene.scene4");
    var _sTxt = $(".pip.contents_safety .scene_wrap .text_wrap ul li");
    s1.hide(); s2.hide(); s3.hide(); s4.hide();
    _sTxt.hide();
    if (_a == 0) { // 0~199
      s1.show();
      $(".pip.contents_safety .scene_wrap").removeClass("black");
      var n = va - 0;
      if (n < 10) { // show
        var m = n - 0; // 0~9
        _sTxt.hide().eq(0).show();
        s1.css({ opacity: (1 / (10 - m)) });
        s1.find(".bg").eq(0).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 170) { // hide 
        var m = n - 10;
        _sTxt.hide().eq(0).show();
        s1.css({ opacity: 1 });
        var o = Math.floor(m / 10),
          carO = o >= s1.find(".bg").length ? 14 : o
        s1.find(".bg").eq(carO).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 190) {
        _sTxt.hide().eq(0).show();
      } else {
        var m = n - 190;
        s1.css({ opacity: (1 / (m)) });
      }
      return false;
    } else if (_a == 1) { // 200 ~ 299
      s2.show();
      $(".pip.contents_safety .scene_wrap").removeClass("black");
      var n = va - 200;
      _sTxt.hide().eq(1).show();
      if (n < 10) { // show
        var m = n - 0; // 0~9
        _sTxt.hide().eq(1).show();
        s2.css({ opacity: (1 / (10 - m)) });
        s2.find(".bg").eq(0).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 170) { // hide 
        var m = n - 10;
        _sTxt.hide().eq(1).show();
        s2.css({ opacity: 1 });
        var o = Math.floor(m / 10),
          carO = o >= s2.find(".bg").length ? 14 : o
        s2.find(".bg").eq(carO).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 190) {
        _sTxt.hide().eq(1).show();
      } else {
        var m = n - 190;
        s2.css({ opacity: (1 / (m)) });
      }
      return false;
    } else if (_a == 2) {
      s3.show();
      $(".pip.contents_safety .scene_wrap").removeClass("black");
      var n = va - 400;
      if (n < 10) { // show
        var m = n - 0; // 0~9
        _sTxt.hide().eq(2).show();
        s3.css({ opacity: (1 / (10 - m)) });
        s3.find(".bg").eq(0).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 170) { // hide 
        var m = n - 10;
        _sTxt.hide().eq(2).show();
        s3.css({ opacity: 1 });
        var o = Math.floor(m / 10),
          carO = o >= s3.find(".bg").length ? 14 : o
        s3.find(".bg").eq(carO).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 190) {
        _sTxt.hide().eq(2).show();
      } else {
        var m = n - 190;
        s3.css({ opacity: (1 / (m)) });
      }
      return false;
    } else if (_a == 3) {
      s4.show();
      $(".pip.contents_safety .scene_wrap").removeClass("black");
      var n = va - 600;
      if (n < 10) { // show
        var m = n - 0; // 0~9
        _sTxt.hide().eq(3).show();
        s4.css({ opacity: (1 / (10 - m)) });
        s4.find(".bg").eq(0).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 170) { // hide 
        var m = n - 10;
        _sTxt.hide().eq(3).show();
        s4.css({ opacity: 1 });
        var o = Math.floor(m / 10),
          carO = o >= s3.find(".bg").length ? 14 : o
        s4.find(".bg").eq(carO).css("z-index", 2).siblings().css("z-index", 1);
      } else if (n < 190) {
        _sTxt.hide().eq(3).show();
      } else {
        var m = n - 190;
        s4.css({ opacity: (1 / (m)) });
      }
      return false;
    }
    if (va == 800) { // last
      var _o = $(".pip.contents_safety .scene_wrap");
      _o.delay(1).animate({ opacity: 1 }, 1, function () {
        _s.slider("value", 0);
        _s.attr("current", 0);
        // stopSlide();
        exeSlider(0);
      });
      return false;
    }
  }
  var _c = $(".pip.contents_safety .scene_wrap");
  _c.find(".controls a.play").click(function () {
    autoSlide(); return false;
  });
  _c.find(".controls a.stop").click(function () {
    stopSlide(); return false;
  });
  _c.find(".controls a.next").click(function () {
    nextSlide(); return false;
  });

  var swiperSlides = new Swiper('.swiper-slides', {
    slidesPerView: 1,
    spaceBetween: 0,
    speed: 750
  });

  var slideHead = $('.tec-slider--mobile .tec-slider__header'),
      slideLink = $('.tec-slider--mobile .tec-slider__link'),
      sliderMob = $('.tec-slider--mobile');

  if (sliderMob.is(':visible')) {
    slideLink.on('click', function(e) {
      e.preventDefault();
      var slide = $(this).data('slide');
      swiperSlides.slideTo(slide);
      if (slide == 1) {
        $(this).parent().addClass('right');    
      } else {
        $(this).parent().removeClass('right');
      }
    });
  
    swiperSlides.on('slideChange', function() {
      if (swiperSlides.activeIndex == 1) {
        slideHead.addClass('right');
        slideLink.removeClass('tec-slider__link--active');
        sliderMob.find('.tec-slider__link[data-slide="' + swiperSlides.activeIndex + '"]').addClass('tec-slider__link--active');
      } else {
        slideHead.removeClass('right');
        slideLink.removeClass('tec-slider__link--active');
        sliderMob.find('.tec-slider__link[data-slide="' + swiperSlides.activeIndex + '"]').addClass('tec-slider__link--active');
      }
    });
  }

  sliderMob.find('.tec-slider__link').eq(0).addClass('tec-slider__link--active');

  $(window).on('resize', function() {
    if (sliderMob.is(':visible')) {
      swiperSlides.update();
      slideLink.removeClass('tec-slider__link--active');
      sliderMob.find('.tec-slider__link[data-slide="' + swiperSlides.activeIndex + '"]').addClass('tec-slider__link--active');
    }
  });

});

var is_safety_auto = 1;
$(window).scroll(function () {
  if (parseInt($(window).scrollTop()) > parseInt($("#contents_safety").offset().top) - (220) && is_safety_auto == 1) {
    $(".wrap").stop().animate({ "null": 1 }, 200).promise().done(function () { // 2015-05-28
      $(".pip.contents_safety .scene_wrap .controls a.play").trigger("click");
    }); // 2015-05-28
    is_safety_auto = 0;
  }

  var _r = $(".pip.contents_safety .highlight_desc");
  var _rl = _r.find(".list li");
  var _rv = _r.find(".view li");
  _rl.find("a").click(function () {
    var n = $(this).parent().index();
    _rl.removeClass("on").eq(n).addClass("on");
    _rv.removeClass("on").eq(n).addClass("on");
    return false;
  });
  _rv.find(".toggle a").click(function () {
    if ($(this).hasClass("toggle_down")) {
      $(this).parent().removeClass("on");
    } else {
      $(this).parent().addClass("on");
    }
    $(this).parent().parent().parent().find("img").attr("src", $(this).attr("data-img"));
    return false;
  });  

});