(function($) {
  var methods = {
    init: function(element, _opt) {
      $e = $(element);
      $("body").data("nAnimate", o.activated);
      if($e.data("elementType") == "trigger") {
        $e.find("[data-element-type='target']").each(function(i) {
          if($(this).data("style")) $(this).attr("style", $(this).data("style"));
          $(this).addClass(o.activated);
        });
      }else {
        if(_opt.style) $e.attr("style", _opt.style);
      };
      $e.addClass(o.activated);
      methods.bind($e, _opt);
    },
    easing: function(type) {
      var val = null;
      switch(type){
        case "easeInSine": val = "cubic-bezier(0.47, 0, 0.745, 0.715)";
        break;
        case "easeOutSine": val = "cubic-bezier(0.39, 0.575, 0.565, 1)";
        break;
        case "easeInOutSine": val = "cubic-bezier(0.445, 0.05, 0.55, 0.95)";
        break;
        case "easeInQuad": val = "cubic-bezier(0.55, 0.085, 0.68, 0.53)";
        break;
        case "easeOutQuad": val = "cubic-bezier(0.25, 0.46, 0.45, 0.94)";
        break;
        case "easeInOutQuad": val = "cubic-bezier(0.455, 0.03, 0.515, 0.955)";
        break;
        case "easeInCubic": val = "cubic-bezier(0.55, 0.055, 0.675, 0.19)";
        break;
        case "easeOutCubic": val = "cubic-bezier(0.215, 0.61, 0.355, 1)";
        break;
        case "easeInOutCubic": val = "cubic-bezier(0.645, 0.045, 0.355, 1)";
        break;
        case "easeInQuart": val = "cubic-bezier(0.895, 0.03, 0.685, 0.22)";
        break;
        case "easeOutQuart": val = "cubic-bezier(0.165, 0.84, 0.44, 1)";
        break;
        case "easeInOutQuart": val = "cubic-bezier(0.77, 0, 0.175, 1)";
        break;
        case "easeInQuint": val = "cubic-bezier(0.755, 0.05, 0.855, 0.06)";
        break;
        case "easeOutQuint": val = "cubic-bezier(0.23, 1, 0.32, 1)";
        break;
        case "easeInOutQuint": val = "cubic-bezier(0.86, 0, 0.07, 1)";
        break;
        case "easeInExpo": val = "cubic-bezier(0.95, 0.05, 0.795, 0.035)";
        break;
        case "easeOutExpo": val = "cubic-bezier(0.19, 1, 0.22, 1)";
        break;
        case "easeInOutExpo": val = "cubic-bezier(1, 0, 0, 1)";
        break;
        case "easeInCirc": val = "cubic-bezier(0.6, 0.04, 0.98, 0.335)";
        break;
        case "easeOutCirc": val = "cubic-bezier(0.075, 0.82, 0.165, 1)";
        break;
        case "easeInOutCirc": val = "cubic-bezier(0.785, 0.135, 0.15, 0.86)";
        break;
        case "easeInBack": val = "cubic-bezier(0.6, -0.28, 0.735, 0.045)";
        break;
        case "easeOutBack": val = "cubic-bezier(0.175, 0.885, 0.32, 1.275)";
        break;
        case "easeInOutBack": val = "cubic-bezier(0.68, -0.55, 0.265, 1.55)";
        break;
        default: val = "cubic-bezier(0,0,0,0)";
        break;
      }

      return val;
    },
    destroy: function() {
      if($e.data("elementType") == "trigger") {
        $e.find("[data-element-type='target']").each(function(i) {
          $(this).removeAttr("style");
          $(this).removeClass(o.animated);
          $(this).removeClass(o.activated);
        })
      }
      $(this).removeAttr("style");
      $(this).removeClass(o.animated);
      $(this).removeClass(o.activated);
      $("body").data("nAnimate", "inactivated");
    },
    bind: function($e, _opt) {
      $(window).on({
        scroll: function(){
          if ($("body").data("nAnimate") == o.activated) {
            var browserTop = $(window).scrollTop(),
            browserHeight = $(window).height(),
            browserBottom = (browserTop + browserHeight);

            var elementTop = $e.offset().top;
            var elementBottom = $e.offset().top + $e.outerHeight();
            var topTrigger = browserTop < elementTop && elementTop < browserBottom;
            var bottomTrigger = browserTop < elementBottom && elementBottom < browserBottom;

            var trigger1 = topTrigger || bottomTrigger;
            var trigger2 = browserTop > elementTop && elementBottom > browserBottom;
            if (trigger1 || trigger2) {
              if ($e.data("elementType") == "trigger") {
                $e.find("[data-element-type='target']").each(function(i) {
                  var _tOpt = $.extend({
                    duration: 1,
                    delay: 0,
                    initialDisplay: "none",
                    animated: "animated",
                    activated: "activated",
                    easeing: "none"
                  }, $(this).data());
                  methods.animate($(this), _tOpt);
                });
              } else {
                methods.animate($e, _opt);
              }
            }
          }
        }
      })
    },
    animate: function($e, _opt) {
      if(!$e.hasClass(o.animated)) {
        if(methods.detectTransition() == undefined) methods.forNotSupportTransition($e, _opt);
        else {
          $e.removeAttr("style"); 
          var engagedAnimation = $.parseJSON(_opt.engagedAnimation.replace(/'/g, '"'));
          $e.css({
            transition: "all "+_opt.duration+"s "+_opt.delay+"s "+methods.easing(_opt.easing),
            '-webkit-transition': "all "+_opt.duration+"s "+_opt.delay+"s "+methods.easing(_opt.easing)
          });
          $e.css(engagedAnimation);
          $e.addClass(o.animated);
        }
      }
    },
    detectTransition: function() {
      var t,
        el = document.createElement("fakeelement");
      var transitions = {
        "transition": "transitionend",
        "OTransition": "oTransitionEnd",
        "MozTransition": "transitionend",
        "WebkitTransition": "webkitTransitionEnd"
      }
      for (t in transitions){
        if (el.style[t] !== undefined){
          return transitions[t];
        }
      }
    },
    forNotSupportTransition: function($e, _opt) {
      if(_opt.engagedIeAnimation === undefined){
        engagedAnimation = $.parseJSON(_opt.engagedAnimation.replace(/'/g, '"')); 
      }else {
        engagedAnimation = $.parseJSON(_opt.engagedIeAnimation.replace(/'/g, '"')); 
      }
      var duration = _opt.duration * 1000;
      var delay = _opt.delay * 1000;
      $e.stop().delay(delay).animate(engagedAnimation, duration, _opt.easing, function() {
        $e.addClass(o.animated);
      });
    }
  };

  jQuery.fn.nAnimation = function(options) {
    if (methods[options]) {
      return methods[options].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else {
      o = $.extend({
        duration: 1,
        delay: 0,
        initialDisplay: "none",
        animated: "animated",
        activated: "activated",
        easeing: "none"
      }, options, $(this).data());

      return this.each(function(){
        var c1 = $("body").data("nAnimate") != o.activated || !$(this).hasClass(o.activated),
          c2 = $(this).data("elementType") == "target";

        if(c2) return false;
        if(c1){
          methods.init(this, o);
        }
      });
    }
  };
})(jQuery);

var device;
var f = function() {
  $(window).on({
    resize: function() {
      device = $("body").hasClass("mobile") ? "mobile" : "desktop";
      if (device == "desktop") {
        $("[data-element-type]").each(function() {
          $(this).nAnimation();
        });
      } else if ($("body").data("nAnimate")) {
        $("[data-element-type]").each(function() {
          $(this).nAnimation("destroy");
        });
      }
    }
  });
  $(window).trigger("resize");
  $(window).trigger("scroll");
}

$(document).ready(function() {
  f();
});