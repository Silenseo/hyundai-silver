$(function(){
	//	Простановка класса на дилерской сборке
	if (process.env.MIX_BUILD === 'dealer') {
		$('body').addClass('isDealerPage')
	}
	//  Обработки для полей
	$(document).on('keyup', '.capitalize', function(){
		$(this).val($(this).val().capitalize());
	});

	$(document).on('keyup', '.non_numeric', function(){
		$(this).val($(this).val().non_numeric());
	});

	$(document).on('keyup', '.numeric', function(){
		$(this).val($(this).val().numeric());
	});

	String.prototype.capitalize = function() {
		return this.charAt(0).toUpperCase() + this.slice(1).replace(/\s/g, '').toLowerCase();
	}
	String.prototype.numeric = function() {
		return this.replace(/[^\d]/,'');
	}
	String.prototype.non_numeric = function() {
		return this.replace(/[\d]/,'');
	}
})