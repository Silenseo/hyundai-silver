//Конструктор дней
function Day() {
	this.isNow = false;
	this.isPast = false;
	this.isFuture = false;
	this.isWeekEnd = false;
	this.isMonday = false;
	this.isStartMonth = '';
	this.isStartMonthDays = false;
	this.eventsList = [];
	this.currentDate;
	this.dayNumder;
	this.dayOfWeek;
}
Day.prototype.init = function (day, month, year, currentMonth, currentYear) {
	var now = new Date(),
		currentYear = year;

	this.dayNumder = day;

	this.currentDate = new Date(currentYear, month, day, 0);

	//Этот день сегодня?
	if (this.compareToday(now, this.currentDate)) {
		this.isNow = true;
	} else if ((now - this.currentDate) > 0) {
		//Этот день прошёл?
		this.isPast = true;
	}

	//Этот день сб или вс?
	if (this.currentDate.getDay() == 0 || this.currentDate.getDay() == 6) {
		this.isWeekEnd = true;
	}

	//Это понедельник?
	if (this.currentDate.getDay() == 1) {
		this.isMonday = true;
	}

	//Номер дня недели (1 - понедельник, 7 - воскресенье)
	this.dayOfWeek = this.currentDate.getDay() != 0 ? this.currentDate.getDay() : 7

	//Это первый день в месяце?
	if (day == 1) {
		var monthArr = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];

		if (month < 12) {
			this.isStartMonth = window.lang.monthArr[month] || monthArr[month];
		} else {
			this.isStartMonth = window.lang.monthArr[0] || monthArr[0];
		}

	}
	//Этот день в начале следующего месяца?
	if (this.currentDate.getMonth() > currentMonth || this.currentDate.getFullYear() > currentYear) {
		this.isStartMonthDays = true;
	}
}
Day.prototype.setEvents = function (eventsList) { //Проверка есть ли в текущий день какое-либо событие
	var that = this,
		now = new Date();

	if (!Array.isArray(eventsList)) {
		console.error('Должен быть массив');

		return null;
	}

	eventsList.forEach(function (event) {
		var from = Date.parse(event.from+'T00:00:00.000+03:00'),
			to = Date.parse(event.to+'T00:00:00.000+03:00'),
			_event = {};

		from = new Date(from);
		to = new Date(to);

		// from.setHours(0, 0, 0, 0);
		// to.setHours(0, 0, 0, 0);

		from = +from;
		to = +to;

		if ((that.currentDate.getTime() + 3 * 60 * 60 * 1000 >= from) && that.currentDate <= to) {

			if (event.repair) {
				_event.repair = event.repair;
				that.eventsList.push(_event);

				return null;
			}

			_event.name = event.name;
			_event.calendar_name = event.calendar_name;
			_event.id = event.id;
			_event.available = event.available;
			_event.from = new Date(from);
			_event.to = new Date(to);
			_event.img = event.img;
			_event.altLong = event.altLong;


			//Сколько дней длится событие
			_event.duration = (to - from)/(3600*24*1000) + 1;
			//В какой день недели начинается событие
			if (_event.from.getDay() == 0) {
				_event.startDay = 7;
			} else {
				_event.startDay = _event.from.getDay();
			}

			//В какой день недели заканчивается событие
			if (_event.to.getDay() == 0) {
				_event.endDay = 7;
			} else {
				_event.endDay = _event.to.getDay();
			}

			if ((that.currentDate - from) == 0 && from != to) {
				_event.start = true;
			}
			if ((that.currentDate - to) == 0 && from != to) {
				_event.end = true;
			}
			if (from != to) {
				_event.isLong = true;
			} else {
				_event.isShort = true;
			}

			that.eventsList.push(_event);
		}
	})

	if (this.eventsList.length) {
		return true; //Если в это день есть событие или несколько - возвращаем здесь true
	}
}
Day.prototype.compareToday = function (date1, date2) {
	//Возвращает true, если даты совпадают, время может быть любым
	return ((date1 - date2) >= 0 && (date1 - date2) <= (3600 * 24 * 1000));
}

export { Day }