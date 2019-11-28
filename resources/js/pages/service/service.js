$(function(){
	//Открыть попап из блока Записаться на сервис
	$('.js-sign-up-service').on('click', function (e) {
		e.preventDefault();

		vueStore.dispatch('OPEN_SEND_DEALER', true);
	})
})