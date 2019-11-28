function Slider() {
	this.string = '';
	this.obj = null;
	this.$items = null;
	this.itemWidth = 0;
	this.objWidth = 0;
	this.itemMargin = 0;
	this.length = 0;
	this.currentSlide = 0;
	this.startSlide = 0;
}

Slider.prototype.init = function(obj, startSlide) {
	var that = this;
	var oldWindowWidth2 = 0;

	this.string = obj;
	this.obj = $(obj);

	this.$items = this.obj.find('li');
	this.itemWidth = this.$items.eq(0).outerWidth();
	this.itemMargin = parseInt(this.$items.eq(0).css('margin-right'));

	this.$items = this.obj.find('li');
	this.length = this.obj.find('li').length;

	this.$items.each(function(i){
		var obj = $(this);

		obj.data('index', i);
	})

	this.$items.on('click', function() {
		var obj = $(this),
			index = +obj.data('index');

		that.setSlide(index);
	})

	if (typeof startSlide !== 'undefined') {
		this.startSlide = startSlide;
		this.setSlide(this.startSlide);
	} else {
		this.setSlide(this.startSlide);
	}

	this.swipe();

	$(window).on('resize', ()=>{
		var windowWidth = $(window).outerWidth();
		
		//Для iOs
		if (oldWindowWidth2 === windowWidth) {
			return null;
		}

		oldWindowWidth2 = windowWidth;
		this.itemWidth = this.$items.eq(0).outerWidth();
		this.itemMargin = parseInt(this.$items.eq(0).css('margin-right'));
		this.setSlide(this.currentSlide);
	})
}

Slider.prototype.swipe = function() {
	//swipe
	var Swipe = new Hammer.Swipe();

	var manager = new Hammer.Manager(document.querySelector(this.string), {touchAction: 'pan-y'});

	manager.add(Swipe);
	manager.on('swipe', (e)=>{
		var direction = e.offsetDirection;

		if (direction === 4) {
			this.prevSlide()
		} else if (direction === 2) {
			this.nextSlide()
		}
	});
}

Slider.prototype.setSlide = function(number) {
	if (number >=0 && number <= this.length - 1) {
		var that = this;

		this.anim = new TimelineLite({
			onComplete: function() {
				this.kill();
				that.currentSlide = number;

				that.$items.removeClass('active');
				that.$items.eq(that.currentSlide).addClass('active');
				that.setInfo(that.$items.eq(that.currentSlide));
				$('.team').removeClass('animation');
			},
			onReverseComplete: function() {
				this.kill();
				that.currentSlide = number;

				that.$items.removeClass('active');
				that.$items.eq(that.currentSlide).addClass('active');
				that.setInfo(that.$items.eq(that.currentSlide));
				$('.team').removeClass('animation');
			}
		});

		$('.team').addClass('animation');

		if (number > this.currentSlide) {
			this.anim
				.staggerTo(this.$items, 0.3, {
					x: -((this.itemWidth + this.itemMargin) * number)
				}, 0.1)
		} else {
			let arr = [];

			this.$items.each(function(){
				arr.push($(this));
			})

			arr.reverse();

			this.anim
				.staggerTo(arr, 0.3, {
					x: -((this.itemWidth + this.itemMargin) * number)
				}, 0.1)
		}
	}
}

Slider.prototype.setInfo = function(obj) {
	var name = obj.data('name') || '',
		birthday = obj.data('birthday') || '',
		place = obj.data('place') || '',
		nationality = obj.data('nationality') || '',
		interests = obj.data('interests') || '',
		text = obj.data('text') || '',
		signature = obj.data('signature') || '';

	$('#pilot-name').text(name);
	$('#pilot-birthday').text(birthday);
	$('#pilot-place').text(place);
	$('#pilot-nationality').text(nationality);
	$('#pilot-interests').text(interests);
	$('#pilot-text').text(text);
	$('#pilot-signature').attr('src', signature);
}

Slider.prototype.nextSlide = function() {
	if (this.currentSlide < this.length - 1) {
		this.setSlide(this.currentSlide + 1);
	}
}

Slider.prototype.prevSlide = function() {
	if (this.currentSlide > 0) {
		this.setSlide(this.currentSlide - 1);
	}
}

export {
	Slider
}