@extends('layouts.master')

@section('pageTitle', 'Вакансии')

@section('styles')
	<link rel="stylesheet" href="{{ mix('/css/vacancy/libs.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/vacancy/vacancy.css') }}">
@endsection

@section('content')

<section class="vacancy">
	<div class="container scroll-section">
		<div class="row">
			<div class="col-lg-7 col-md-12">
				<div class="sidebar__wrap">
					<div class="sidebar">
						<div class="sidebar__top">
							Санкт-Петербург
							<!-- <select class="df-select sidebar__dropdown" name="" id="js-city-select" placeholder="Выбрать">
								<option></option>
								<option value="Москва">Москва</option>
								<option value="Челябинск">Челябинск</option>
								<option value="Орел">Орел</option>
								<option value="Архангельск">Архангельск</option>
								<option value="Барнаул">Барнаул</option>
								<option value="Серпухов">Серпухов</option>
								<option value="Новосибирск">Новосибирск</option>
							</select> -->
						</div>
						<h3 class="sidebar__title">Выберите направление в&nbsp;котором хотели&nbsp;бы развиваться вместе с&nbsp;HYUNDAI</h3>
						<p> Вы можете <a href="#">заполнить Анкету</a>, а также отправить нам свое резюме по электронной почте или по факсу:<br/>
E-mail: rabota@hyundai-motor.ru<br/>
Факс: +7 : (812) 418-01-01<br/>
<a href="#">Показать правила</a><br/><br/> </p>
						<div class="sidebar__subtitle">
							Для студентов московских вузов мы&nbsp;предлагаем программу &laquo;Начни Карьеру в&nbsp;Хендэ!&raquo;&nbsp;&mdash; ежегодные стажировки, которые позволяют студентам применять свои знания на&nbsp;практике и&nbsp;принимать участие в&nbsp;реальных проектах подразделений &laquo;Хендэ Мотор СНГ&raquo;. Стажировки проходят два раза в&nbsp;год: зимой (февраль-март) и&nbsp;летом (июль&nbsp;&mdash; август).
							Если вы&nbsp;хотите подать заявку на&nbsp;участие в&nbsp;стажировке, заполните, пожалуйста, анкету ниже.
						</div>
						<button class="focus-button"></button>
						<ul class="sidebar__controls">
							<li class="sidebar__control">
								<button data-title="Выберите направление, в&nbsp;котором хотели&nbsp;бы развиваться вместе с&nbsp;HYUNDAI" data-tab="accordion" class="js-change-tab df-button" href="#">Соискателям</button>
							</li>
						</ul>

						<div data-section="accordion" class="js-section" style="display: none">
							<ul class="accordion">
								<li class="accordion__item">
									<a href="#" class="accordion__head js-open-section">
										<div class="accordion__icon">
											<img src="/images/vacancy/icons/Paper.svg" alt="">
										</div>
										<h5 class="accordion__title">
											Переводчик синхронный
										</h5>
									</a>
									<ul class="accordion__dropdown">
										<li class="accordion__d-item">
											<div class="accordion__link accordion__link_block">
												<p><b>Обязанности:</b><br/>
    Устный перевод одновременно с речью оратора (корейский, английский, русский языки) во время сопровождения бесед, встреч и других мероприятий.</p>


<p><b>Требования:</b><br/>
    Высшее образование;<br/>
    Владение русским, английским и корейским языками на уровне не ниже upper-intermediate;<br/>
    Знание видов и организации ведения синхронных переводов;<br/>
    Знание лексики, грамматики и стилистики русского, корейского и английского языков;<br/>
    Опыт работы по специальности не менее 3 лет.</p>
<p><b>Условия:</b><br/>
    Вакансия для трудоустройства инвалидов в счет квоты;<br/>
    Работа с персональным компьютером -50% рабочего времени;<br/>
    Оформление в соответствии с трудовым законодательством РФ;<br/>
    Пятидневная рабочая неделя, полный рабочий день (для инвалидов I и II групп – не более 35 часов в неделю);<br/>
    ДМС;<br/>
    Компенсация расходов на питание;<br/>
    Служебная развозка из различных районов города и области.</p>
											</div>
										</li>
									</ul>
								</li>

								<li class="accordion__item">
									<a href="#" class="accordion__head js-open-section">
										<div class="accordion__icon">
											<img src="/images/vacancy/icons/Paper.svg" alt="">
										</div>
										<h5 class="accordion__title">
                                            Переводчик-технической и специальной литературы
										</h5>
									</a>
									<ul class="accordion__dropdown">
										<li class="accordion__d-item">
											<div class="accordion__link accordion__link_block">
												<p><b>Обязанности:</b><br/>
    Письменный перевод (корейский, английский, русский языки):<br/>
    технической и иной специальной литературы, переписки с зарубежными организациями, документов совещаний, семинаров, отчетов, инструкций, распоряжений, презентаций, приказов, положений.
</p>


<p><b>Требования:</b><br/>
    Высшее образование;<br/>
    Владение русским, английским и корейским языками на уровне не ниже upper-intermediate.<br/>
    Знание методик научно-технического перевода, основ литературного редактирования;<br/>
    Опыт работы переводчиком технической литературы не менее 3х лет.
</p>
<p><b>Условия:</b><br/>
    Вакансия для трудоустройства инвалидов в счет квоты;<br/>
    Работа с персональным компьютером -50% рабочего времени;<br/>
    Оформление в соответствии с трудовым законодательством РФ;<br/>
    Пятидневная рабочая неделя, полный рабочий день ( для инвалидов I и II групп – не более 35 часов в неделю);<br/>
    ДМС;<br/>
    Компенсация расходов на питание;<br/>
    Служебная развозка из различных районов города и области.
</p>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</div>

						<div data-section="form" class="js-section" id="vacancy-form">
							<vacancy-form></vacancy-form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Слайдер в разделе вакансии -->
<div data-section="accordion" class="slider js-section">
	<ul class="slider__list js-slider owl-carousel">
		<li class="slider__item" style="background-image: url(/images/vacancy/xmmp/3.png);">
		</li>
		<li class="slider__item" style="background-image: url(/images/vacancy/xmmp/1.png);">
		</li>
		<li class="slider__item" style="background-image: url(/images/vacancy/xmmp/2.png);">
		</li>
	</ul>
	<div class="slider__indicator">
		<div class="slider__current"></div>
		<div class="slider__separator">/</div>
		<div class="slider__length"></div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ mix('/js/vacancy/libs.js') }}"></script>
	<script src="{{ mix('/js/vacancy/vacancy.js') }}"></script>
	<script src="{{ mix('/js/vacancy/vacancy-form.js') }}"></script>
@endsection
