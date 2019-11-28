$(function () {
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
    }).bind('datepicker-change',function(event,obj)	{
		//Включаем кнопку
		$('.js-search-button').prop('disabled', false);
		/* This event will be triggered when second date is selected */
		console.log(obj);
		// obj will be something like this:
		// {
		// 		date1: (Date object of the earlier date),
		// 		date2: (Date object of the later date),
		//	 	value: "2013-06-05 to 2013-06-07"
		// }
	})

    $('.caption th').eq(2).append($('.caption th').eq(0).find('.prev'))
    $('.caption th').eq(0).remove();
    $('.caption th').eq(0).attr('colspan', 6);

	$('#datepicker-range').on('input', function () {
		if ($(this).val() === '') {
			//Выключаем кнопку
			$('.js-search-button').prop('disabled', true);
		}
	})
	$('#key-words').on('input', function () {
		if ($(this).val() === '') {
			//Выключаем кнопку
			$('.js-search-button').prop('disabled', true);
		} else {
			//Включаем кнопку
			$('.js-search-button').prop('disabled', false);
		}
	})
})