$(function(){
    var slider = document.getElementById('test_range');

    noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        }
    });

    var slider = document.getElementById('test_range2');

    noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        }
    });

    var slider = document.getElementById('test_range3');

    noUiSlider.create(slider, {
        start: [20, 80],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        }
    });

    //Hint Popup Start
    $('.js-show-df-hint-popup').on('click', function(e){
        e.preventDefault();
        var popup = $(this).parent('.df-help').find('.df-hint-popup');

        if (popup.hasClass('df-hint-popup--left') || popup.hasClass('df-hint-popup--right')) {
            return null;
        }

        //Закрыть другие подсказки
        $('.df-hint-popup').removeClass('df-hint-popup--right');
        $('.df-hint-popup').removeClass('df-hint-popup--left');

        if (popup.offset().left < 0){
            popup.removeClass('df-hint-popup--left');
            popup.addClass('df-hint-popup--right');
        } else {
            popup.removeClass('df-hint-popup--right');
            popup.addClass('df-hint-popup--left');
        }
    })

    $('.js-close-df-hint-popup').on('click', function (e) {
        e.preventDefault();
        var popup = $(this).parent('.df-hint-popup');

        popup.removeClass('df-hint-popup--right');
        popup.removeClass('df-hint-popup--left');
    })

    $(window).on('click', function(e){
        if ($(e.target).closest('.df-hint-popup').length === 0 && $(e.target).closest('.js-show-df-hint-popup').length === 0) {
            $('.df-hint-popup').removeClass('df-hint-popup--right');
            $('.df-hint-popup').removeClass('df-hint-popup--left');
        }
    })
    //Hint Popup End

    //Selectize
    $('#js-city-select').selectize();
	
	$('#js-city-select-bordered').selectize();

	$('#js-city-select-bordered-invalid').selectize();

    //Search
    $('#js-search').selectize();

    //Scrollbar
    new PerfectScrollbar('#js-city-select+.selectize-control .selectize-dropdown-content', {
        wheelSpeed: 1,
        minScrollbarLength: 10
    });

    //Scrollbar Search
    new PerfectScrollbar('#js-search+.selectize-control .selectize-dropdown-content', {
        wheelSpeed: 1,
        minScrollbarLength: 10
	});
	
    new PerfectScrollbar('#js-city-select-bordered-invalid+.selectize-control .selectize-dropdown-content', {
        wheelSpeed: 1,
        minScrollbarLength: 10
	});
	
    new PerfectScrollbar('#js-city-select-bordered+.selectize-control .selectize-dropdown-content', {
        wheelSpeed: 1,
        minScrollbarLength: 10
    });

    //Accordion
    var Accordion = function (el, multiple) {
        this.el = el || {};
        // more then one submenu open?
        this.multiple = multiple || false;

        var dropdownlink = this.el.find('.js-open-section');
        dropdownlink.on('click',
            { el: this.el, multiple: this.multiple },
            this.dropdown);
    };

    Accordion.prototype.dropdown = function (e) {
        e.preventDefault();

        var $el = e.data.el,
            $this = $(this),
            //this is the ul.submenuItems
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('active');

        if (!e.data.multiple) {
            //show only one menu at the same time
            $el.find('.df-accordion__dropgown').not($next).slideUp().parent().removeClass('active');
        }
    }

    var accordion = new Accordion($('#accordion-1'), false);

    //Календарь
	$("#datepicker").datepicker({
		inline: true
	});

	//Настройки календаря
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '&#x3c;Пред',
		nextText: 'След&#x3e;',
		currentText: 'Сегодня',
		monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
			'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
			'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
		dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
		dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		weekHeader: 'Нед',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		selectOtherMonths: true,
		showOtherMonths: true
	};
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    
    //Datepicker range
    $('#datepicker-range').dateRangePicker({
        format: 'DD.MM.YYYY',
        separator : ' - ',
        language: 'ru',
        singleMonth: true,
        showShortcuts: false,
        showTopbar: false,
        hoveringTooltip: false,
        startOfWeek: 'monday',
        selectForward: false,
        selectBackward: false,
        customArrowPrevSymbol: '<div class="datePrev"></div>',
        customArrowNextSymbol: '<div class="dateNext"></div>',
    })

    $('.caption th').eq(2).append($('.caption th').eq(0).find('.prev'))
    $('.caption th').eq(0).remove();
    $('.caption th').eq(0).attr('colspan', 6);

    //Вывод иконок из спрайта
    // $('.svg-root svg symbol').each(function(){
    //     var id = $(this).attr('id'),
    //         div = document.createElement('div'),
    //         svg = document.createElementNS("http://www.w3.org/2000/svg", "svg"),
    //         use = document.createElementNS("http://www.w3.org/2000/svg", "use"),
    //         container = $('.kit__icons-line');

    //     $(div).addClass('df-icon');
    //     $(use).attr('xlink:href','#'+id);

    //     $(svg).append(use);
    //     $(div).append(svg);
    //     container.append(div);
    // })
})