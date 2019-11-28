$(document).ready(function() {
  if ($(".galleryTy1").length) {	
    $(".galleryTy1").each(function() {
      var _target = $(this);
      setTimeout(function() {
        var galleryTarget1_thumbnail = new Swiper(_target.find(".thumbnail"), {
          slidesPerView: 'auto',
          slidesPerGroup: 4,
          spaceBetween: 0,
          nextButton: _target.find(".btn_next"),
          prevButton: _target.find(".btn_prev"),
          breakpoints: {
            20000: {
              slidesPerView: 'auto',
              slidesPerGroup: 4,
              spaceBetween: 0,
              onProgress: function (swiper) {
                if (swiper.slides.length <= 4) {
                  _target.find(".slideWrap").addClass("hideBtn");
                } else {
                  _target.find(".slideWrap").removeClass("hideBtn");
                }
              }
            },
            740: {
              slidesPerView: 'auto',
              slidesPerGroup: 3,
              spaceBetween: 0,
              onProgress: function (swiper) {
                if(swiper.slides.length <= 3){
                  _target.find(".slideWrap").addClass("hideBtn");
                } else {
                  _target.find(".slideWrap").removeClass("hideBtn");
                }
              }
            }
          }             
        });
        _target.find(".thumbnail .swiper-slide button").on('click', function(e) {
          e.preventDefault();
          _target.find(".thumbnail .swiper-slide button").blur();
          galleryTarget1_big.slideTo($(this).parent().index());
          _target.find(".thumbnail .swiper-slide").removeClass("on");
          $(this).parent().addClass("on");   
        });
        var galleryTarget1_big = new Swiper(_target.find(".bigImg"), {
          effect: "fade",
          nextButton: _target.find(".bigImg").find(".btn_next"),
          prevButton: _target.find(".bigImg").find(".btn_prev"),
          onInit: function(swiper) {
            $(swiper.container).find(".pageNum").html("<strong>1</strong> / " + swiper.slides.length);
            var idx = 0;
            var bottom_tit = $(swiper.container).find(".swiper-slide-active .tit").text();
            var bottom_desc = $(swiper.container).find(".swiper-slide-active .desc").text();
            var legal = $(swiper.container).find(".swiper-slide-active .noticeList").clone();
            if (bottom_tit) {
              _target.find(".bottomDesc .tit").text(bottom_tit).show();
            } else {
              _target.find(".bottomDesc .tit").hide();
            }
            if (bottom_desc) {
              _target.find(".bottomDesc .txt").text(bottom_desc).show();
            } else {
              _target.find(".bottomDesc .txt").hide();
            }
            if (legal) {
              _target.find(".bottomDesc .noticeList").remove();
              _target.find(".bottomDesc").append(legal);
            }				
          },
          onSlideChangeStart: function(swiper) {
            var idx = $(swiper.container).find(".swiper-slide-active").index();
            var bottom_tit = $(swiper.container).find(".swiper-slide-active .tit").text();
            var bottom_desc = $(swiper.container).find(".swiper-slide-active .desc").text();
            var legal = $(swiper.container).find(".swiper-slide-active .noticeList").clone();
            galleryTarget1_thumbnail.slideTo(idx);
            _target.find(".thumbnail .swiper-slide button").eq(idx).click();
        
            if (bottom_tit) {
              _target.find(".bottomDesc .tit").text(bottom_tit).show();                	
            } else {
              _target.find(".bottomDesc .tit").hide();
            }
            if (bottom_desc) {
              _target.find(".bottomDesc .txt").text(bottom_desc).show();                	
            } else {
              _target.find(".bottomDesc .txt").hide();                	
            }
            if (legal) {
              _target.find(".bottomDesc .noticeList").remove();
              _target.find(".bottomDesc").append(legal);
            }      
            $(swiper.container).find(".pageNum").html("<strong>"+(idx+1)+"</strong> / "+swiper.slides.length);
            if (!$(swiper.container).find(".swiper-slide-active").hasClass("colorw")) {
              $(swiper.container).find(".pageNum").addClass("colorbk")
            } else {
              $(swiper.container).find(".pageNum").removeClass("colorbk")
            }
          }
        });
      }, 400)
    });
  }

  if ($(".slideArea1").length > 0) {
    var slideAreaTarget1 = $(".slideArea1");
    slideAreaTarget1.each(function() {
      var _target = $(this);
      if (!_target.hasClass('numbering')) {
        var slideArea1 = new Swiper(_target, {
          nextButton: _target.find(".btn_next"),
          prevButton: _target.find(".btn_prev"),
          pagination:  _target.find(".swiper-pagination"),
          paginationElement : "button",
          paginationClickable : true,
          loop: true,
          onProgress: function(swiper) {                        	
            setTimeout(function() {
              _target.find(swiper.paginationContainer).css("top",_target.find(".swiper-slide-active img").height()-25);
              if (_target.find('.gridRow .grid').length >= 2) {
                _target.find(swiper.paginationContainer).css("top",(_target.find(".swiper-slide-active img").height() *2) -25);
              }
            }, 100);
          }
        });
      }
      else {
        var slideArea1 = new Swiper(_target, {
          nextButton: _target.find(".btn_next"),
          prevButton: _target.find(".btn_prev"),
          pagination: _target.find(".swiper-pagination"),
          paginationElement: "button",
          paginationType: "bullets",
          paginationClickable : true,
          loop : true,
          onProgress : function(swiper){
            setTimeout(function(){
              _target.find(swiper.paginationContainer).css("top",_target.find(".swiper-slide-active img").height()-25);
            }, 100)
          },
          paginationBulletRender: function (swiper, index, className) {
            var prevIdx = index+ 1;
            var idx = (prevIdx < 10 ? '0' : '') + prevIdx
            return '<span class="' + className + ' swiper-number"><em>' + idx + '</em></span>';
          }
        });
      }
    });
  }
});