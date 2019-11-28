/*! Lazy Load XT v1.1.0 2016-01-12
 * http://ressio.github.io/lazy-load-xt
 * (C) 2016 RESS.io
 * add on created by Simon Goetz [twtr:@simonlgoetz, git:@slgoetz]
 * Licensed under MIT */

(function ($) {
    var options = $.lazyLoadXT;
    var reUrl = /^\s*(\S*)/,
        reWidth = /\S\s+(\d+)w/,
        reHeight = /\S\s+(\d+)h/,
        reDpr = /\S\s+([\d\.]+)x/,
        infty = [0, Infinity],
        one = [0, 1],
        bgSrcsetOptions = {
            bgSrcsetAttr: 'data-bg-srcset',
        },
        viewport = {
            w: 0,
            h: 0,
            x: 0
        },
        property,
        limit;


    for (property in bgSrcsetOptions) {
        if (options[property] === undefined) {
            options[property] = bgSrcsetOptions[property];
        }
    }
    options.selector += ',[' + options.bgSrcsetAttr + ']';

    function mathFilter(array, action) {
        return Math[action].apply(null, $.map(array, function (item) {
            return item[property];
        }));
    }

    function compareMax(item) {
        return item[property] >= viewport[property] || item[property] === limit;
    }

    function compareMin(item) {
        return item[property] === limit;
    }

    function parseSrcset($el) {
        var srcset = $el.attr(options.bgSrcsetAttr);

        if (!srcset) {
            // console.log(srcset, options.bgSrcsetAttr);
            return false;
        }

        var list = $.map(srcset.replace(/(\s[\d.]+[whx]),/g, '$1 @,@ ').split(' @,@ '), function (item) {
            return {
                url: reUrl.exec(item)[1],
                w: parseFloat((reWidth.exec(item) || infty)[1]),
                h: parseFloat((reHeight.exec(item) || infty)[1]),
                x: parseFloat((reDpr.exec(item) || one)[1])
            };
        });

        if (!list.length) {
            return false;
        }

        var whx,
            src;

        viewport = {
            w: $el.innerWidth(),
            h: $el.innerHeight(),
            x: window.devicePixelRatio || 1
        };

        // Notice for DOMtastic users: currently $.grep method is not implemented in DOMtastic
        for (whx in viewport) {
            property = whx;
            limit = mathFilter(list, 'max');
            list = $.grep(list, compareMax);
        }

        for (whx in viewport) {
            property = whx;
            limit = mathFilter(list, 'min');
            list = $.grep(list, compareMin);
        }
        // console.log(list);
        src = list[0].url;



        return src;
    }




    $(document).on('lazyshow', function (e) {
        var $this = $(e.target),
            url = parseSrcset($this);
        // console.log($this, url);
        if (!!url) {
            var loader_img = new Image();
            loader_img.src = url;
            $this
                .css('background-image', "url('" + url + "')")
                .removeAttr(options.bgSrcsetAttr);
            $(loader_img).on('load', function(){
                var handler = options['onload'];
                if (handler) {
                    if (handler.addClass) {
                        $this.addClass(handler.addClass);
                    }
                    if (handler.removeClass) {
                        $this.removeClass(handler.removeClass);
                    }
                }
            })

        }
    });

})(window.jQuery || window.Zepto || window.$);