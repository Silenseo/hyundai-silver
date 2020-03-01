@extends('admin.admin')

@section('pageTitle', 'Дилеры')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Дилер создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.dealers.store') }}">
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('address', $item->address, ['placeholder' => 'Введите адрес', 'publicName' => 'Адрес']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('phone', $item->phone, ['placeholder' => 'Введите телефон', 'publicName' => 'Телефон']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('email', $item->email, ['placeholder' => 'Введите email', 'publicName' => 'Email']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('code', $item->code, ['placeholder' => 'Введите SAP-Код', 'publicName' => 'SAP-Код']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('rc_code', $item->rc_code, ['placeholder' => 'Введите RC-Код', 'publicName' => 'RC-Код']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('site', $item->site, ['placeholder' => 'Введите значение', 'publicName' => 'Ссылка на сайт дилера']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('longitude', $item->longitude, ['placeholder' => 'Введите значение', 'publicName' => 'Долгота']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('latitude', $item->latitude, ['placeholder' => 'Введите значение', 'publicName' => 'Широта']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('zyngaya', $item->zyngaya, ['placeholder' => 'Введите значение', 'publicName' => 'Телефон (Zyngaya)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('city_id', $item->city_id, ['values' => $cities, 'publicName' => 'Город']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('credit_id', $item->credit_id, ['placeholder' => 'Введите значение', 'publicName' => 'Кредитный id']) }}
		</div>
		<div class="content__line">
			<fieldset>
				<label class="label">Тип дилера</label>
				{{ Form::adminCheckbox('special', $item->special, ['id' => 'special', 'publicName' => 'Дилер GDSI']) }}
			</fieldset>
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('wa', $item->wa, ['id' => 'wa', 'publicName' => 'Дилер WA']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('rating', $item->rating, ['id' => 'rating', 'publicName' => 'Рейтинговый дилер']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('prohibition_requests', $item->prohibition_requests, ['id' => 'prohibition_requests', 'publicName' => 'Запрет отправки заявок']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('i30n', $item->i30n, ['id' => 'i30n', 'publicName' => 'Дилер с i30n']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('token', $item->token, ['placeholder' => 'Введите значение', 'publicName' => 'Токен']) }}
			<button id="dealer-create-token" class="button button--large button--grey">Сгенерировать токен</button>
		</div>
		<div class="content__line">
			{{ Form::adminInput('legal_name', $item->legal_name, ['placeholder' => 'Введите значение', 'publicName' => 'Юридическое название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('legal_address', $item->legal_address, ['placeholder' => 'Введите значение', 'publicName' => 'Юридический адрес']) }}
		</div>
		<div class="content__line">
			<fieldset>
				<label class="label">Настройки показа</label>
				{{ Form::adminCheckbox('visible', $item->visible, ['id' => 'visible', 'publicName' => 'Показывается на сайте']) }}
			</fieldset>
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>

<script>
document.getElementById("dealer-create-token").onclick = function(e) {
	e.preventDefault()
	let f = function() {
		return Math.random(0).toString(36).substr(2);
	};
	let t = (f() + f()).substr(0, 16);
	this.closest('.content__line').querySelector('input').value = t;
}
</script>
@endsection
