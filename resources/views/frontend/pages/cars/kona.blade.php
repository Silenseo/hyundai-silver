@extends('layouts.master')

@section('pageTitle', 'Hyundai KONA')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/cars/kona/libs.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/cars/kona/kona.css') }}">
@endsection

@section('content')

<header class="header section">
	<div class="header__img">
		<img src="/images/cars/kona/main-sm.jpg" alt="" class="header__img-mobile">
		<div class="header__title">
			<h1 class="h1">Новый<br>KONA Electric*</h1>
			<div class="header__text">
					Открывая новый путь.
			</div>
		</div>			
		<div class="header__note">*Данная модель недоступна на территории Российской Федерации.</div>
	</div>
</header>

<section class="main-s section section--white">
  <div class="section__center">
		<h2 class="h2 main-s__title">Главное</h2>
		<h3 class="h3 main-s__subtitle">Первый электрический компактный внедорожник</h3>
		<div class="default-text default-text--850 default-text--center main-text">
			Знакомьтесь&nbsp;&mdash; новый, вызывающий Hyundai KONA Electric, бескомпромиссный новичок с&nbsp;мощью и&nbsp;габаритами внедорожника, соединенными с&nbsp;впечатляющей технологичностью электрокара.
		</div>
		<img src="/images/cars/kona/kona-os-ev-highlights-side-front-rear-view-pc.jpg" alt="" class="main-s__img main-s__img--0">
		
		<h3 class="h3 main-s__subtitle main-s__subtitle--mob">Особая индивидуальность</h3>
		<div class="default-text default-text--850">
			Уникальный стиль выделяет KONA Electric из&nbsp;толпы. Обтекаемая форма решетки радиатора и&nbsp;сдвоенные светодиодные фары головного света создают неповторимое впечатление единственного в&nbsp;своем роде электрического автомобиля. Внушительный снаружи, просторный внутри&nbsp;&mdash; это новый вид внедорожника, это KONA Electric.
		</div>
		<img src="/images/cars/kona/kona-os-ev-highlights-interior-pc.jpg" alt="" class="main-s__img main-s__img--1">

		<h3 class="h3 main-s__subtitle main-s__subtitle--mob">Пространство комфорта</h3>
		<div class="default-text default-text--850">
			Новый KONA Electriс спроектирован, чтобы вместить все, из&nbsp;чего состоит ваша жизнь&nbsp;&mdash; места для пассажиров и&nbsp;вещей хватит с&nbsp;запасом. Но&nbsp;что делает его действительно особенным&nbsp;&mdash; внимание к&nbsp;деталям, воплощенное в&nbsp;исключительном комфорте и&nbsp;уровне эргономики нового порядка.
		</div>

		<div class="gallery">
			<div class="gallery__item">
				<div class="gallery__img" style="background-image: url('/images/cars/kona/kona-os-ev-highlights-twin-headlight-pc.jpg');"></div>
				<div class="gallery__description">Светодиодные фары и ходовые огни</div>
			</div>
			<div class="gallery__item">
				<div class="gallery__img" style="background-image: url('/images/cars/kona/kona-os-ev-highlights-led-rear-lamp-pc.jpg');"></div>
				<div class="gallery__description">Светодиодные задние фонари</div>
			</div>
			<div class="gallery__item">
				<div class="gallery__img" style="background-image: url('/images/cars/kona/kona-os-ev-highlights-17-alloy-wheel-pc.jpg');"></div>
				<div class="gallery__description">17-дюймовые легкосплавные диски</div>
			</div>
		</div>
  </div>
</section>

<section class="potential section">
	<div class="section__center">
		<h2 class="h2 potential__title">Впечатляющий потенциал</h2>
		<h3 class="h3 potential__subtitle">Настоящее удовольствие от вождения</h3>
		<div class="default-text default-text--850">
			Кто сказал, что вождение электромобиля это не&nbsp;про драйв? Молниеносный старт благодаря крутящему моменту 395Нм, доступному с&nbsp;самого начала движения, и&nbsp;электрический внедорожник разгоняется от&nbsp;нуля до&nbsp;ста всего за&nbsp;7.6&nbsp;секунды. Выбор из&nbsp;двух электрических силовых установок с различной ёмкостью высоковольтных батарей дарит полную свободу перемещения&nbsp;&mdash; от&nbsp;312&nbsp;км при 39,2 кВт*ч или 482&nbsp;км при 64&nbsp;кВт*ч на&nbsp;одном заряде.
		</div>
		<img src="/images/cars/kona/kona-os-ev-highlights-performance-1150.png" alt="" class="potential__img">
		<img src="/images/cars/kona/potential-md.png" alt="" class="potential__img--md">
		<img src="/images/cars/kona/potential-sm.jpg" alt="" class="potential__img--sm">
		<div class="default-text default-text--850 potential-text">**до 80% заряда батареи при использовании станции заряда постоянным током мощностью 100 кВт.</div>
	</div>
</section>

<section class="tec section section--white">
  <div class="section__center">
    <h2 class="h2 tec__title">Умные технологии</h2>
		<div class="tec-slider">
			<div class="tec-slider__header">
				<a href="#" data-text="Использование энергии для восполнения заряда при торможении помогает KONA Electric поддерживать оптимальный уровень заряда батарей. Уровень подзарядки легко регулируется с помощью подрулевых переключателей." data-img="/images/cars/kona/kona-os-ev-highlights-smart-technology-for-intelligent-driving-pc.jpg" class="tec-slider__link js-set-slide">Регулируемая подзарядка батареи при торможении</a>
				<a href="#" data-text="Интеллектуальная система торможения использует бортовой датчик для автоматического контроля уровня рекуперации. Кроме того, он также определяет, что KONA Electric поднимается или спускается с подъема." data-img="/images/cars/kona/kona-os-ev-highlights-smart-regenerative-braking-pc.jpg" class="tec-slider__link js-set-slide">Система рекуперации торможения</a>
			</div>
			<div class="tec-slider__img js-get-image"></div>
		</div>
		<div class="tec-slider--mobile">
			<div class="tec-slider__header">
				<a href="#" data-text="Использование энергии для восполнения заряда при торможении помогает KONA Electric поддерживать оптимальный уровень заряда батарей. Уровень подзарядки легко регулируется с помощью подрулевых переключателей." data-img="/images/cars/kona/kona-os-ev-highlights-smart-technology-for-intelligent-driving-pc.jpg" data-slide="0" class="tec-slider__link">Регулируемая подзарядка батареи при&nbsp;торможении</a>
				<a href="#" data-text="Интеллектуальная система торможения использует бортовой датчик для автоматического контроля уровня рекуперации. Кроме того, он также определяет, что KONA Electric поднимается или спускается с подъема." data-img="/images/cars/kona/kona-os-ev-highlights-smart-regenerative-braking-pc.jpg" data-slide="1" class="tec-slider__link">Система рекуперации торможения</a>
			</div>
			<div class="swiper-container swiper-slides">
				<div class="swiper-wrapper">
					<div class="swiper-slide"><img src="/images/cars/kona/slider-md1.jpg" alt=""></div>
					<div class="swiper-slide"><img src="/images/cars/kona/slider-md2.jpg" alt=""></div>
				</div>
			</div>
		</div>
		<div class="default-text default-text--850 js-get-text">       
		</div>
	</div>
</section>

<section class="safety section">
	<div class="section__center">
		<div class="rich-text-script">
			<div class="contWrap bgBeige2 bgB2">
				<div class="contBox">
					<div class="contents_safety pip" id="contents_safety">
						<div class="pip_cont bg_color2">
							<div class="text_play">
								<h2 class="h2 safety__title">
									Система<br>
									<span>Hyundai <span>SmartSense</span></span>
								</h2>
								<div class="default-text default-text--850 default-text--center main-text">
									Передовой комплекс систем помощи водителю обеспечивает Kona Electric лидерство в&nbsp;сегменте по&nbsp;системам активной безопасности.
								</div>
							</div>
							<div class="scene_wrap">
								<div class="scene scene1" style="display: none; opacity: 0.111111;">
									<div class="bg bg1" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg2" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg3" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg4" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg5" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg6" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg7" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg8" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg9" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg10" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg11" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg12" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg13" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg14" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg15" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg16" style="z-index: 2;">&nbsp;</div>
								</div>
								<div class="scene scene2" style="display: block; opacity: 1;">
									<div class="bg bg1" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg2" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg3" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg4" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg5" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg6" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg7" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg8" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg9" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg10" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg11" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg12" style="z-index: 2;">&nbsp;</div>
									<div class="bg bg13" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg14" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg15" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg16" style="z-index: 1;">&nbsp;</div>
								</div>
								<div class="scene scene3" style="display: none;">
									<div class="bg bg1">&nbsp;</div>
									<div class="bg bg2">&nbsp;</div>
									<div class="bg bg3">&nbsp;</div>
									<div class="bg bg4">&nbsp;</div>
									<div class="bg bg5">&nbsp;</div>
									<div class="bg bg6">&nbsp;</div>
									<div class="bg bg7">&nbsp;</div>
									<div class="bg bg8">&nbsp;</div>
									<div class="bg bg9">&nbsp;</div>
									<div class="bg bg10">&nbsp;</div>
									<div class="bg bg11">&nbsp;</div>
									<div class="bg bg12">&nbsp;</div>
									<div class="bg bg13">&nbsp;</div>
									<div class="bg bg14">&nbsp;</div>
									<div class="bg bg15">&nbsp;</div>
									<div class="bg bg16">&nbsp;</div>
								</div>
								<div class="scene scene4" style="display: none; opacity: 0.111111;">
									<div class="bg bg1" style="z-index: 2;">&nbsp;</div>
									<div class="bg bg2" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg3" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg4" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg5" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg6" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg7" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg8" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg9" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg10" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg11" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg12" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg13" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg14" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg15" style="z-index: 1;">&nbsp;</div>
									<div class="bg bg16" style="z-index: 1;">&nbsp;</div>
								</div>
								<div class="text_wrap">
									<ul>
										<li class="text1 bgBeige1" style="display: none;">
											<strong>Система предупреждения столкновений Forward Collision-Avoidance Assist (FCA) с&nbsp;функцией обнаружения пешеходов.</strong>
											<div>
												<p>Система использует фронтальную камеру и радар для отслеживания движения перед автомобилем. При риске столкновения она предупредит водителя, а затем автоматически замедлит или остановит автомобиль.</p>
											</div>
											<div class="img"><img src="/images/cars/kona/animation/safety_mobile_1.jpg" alt="Forward Collision-avoidance Assist (FCA) image"></div>
										</li>
										<li class="text2 bgBeige3" style="display: list-item;">
										<strong>Система предупреждения столкновений в «слепой зоне» Blind Spot Collision Warning (BSCW) с функцией помощи водителю Lane Change Assist (LCA).</strong>
										<div>
											<p>Система визуально предупреждает о движении в «слепой зоне», в случае возникновения потенциальной опасности.</p>
										</div>
										<div class="img"><img alt="Blind-spot Collision Warning (BCW) image" src="/images/cars/kona/animation/safety_mobile_2.jpg"></div>
										</li>
										<li class="text3 bgBeige1" style="display: none;">
										<strong>Система предупреждения столкновений при движении назад Rear-Cross Traffic Collision Warning (RCCW).</strong>
										<div>
											<p>Снижает риск столкновения при движении назад, предупреждая водителя о приближающемся в поперечном направлении транспорте.</p>
										</div>
										<div class="img"><img src="/images/cars/kona/animation/safety_mobile_3.jpg" alt="Rear-Cross Traffic Collision Warning (RCCW) image"></div>
										</li>
										<li class="text4 bgBeige3" style="display: none;">
										<strong>Система удержания в полосе Lane Keeping Assist (LKA).</strong>
										<div>
											<p>В случае непреднамеренного выезда из своей полосы система предупредит водителя, и может помочь в подруливании для направления автомобиля обратно в полосу движения.</p>
										</div>
										<div class="img"><img src="/images/cars/kona/animation/safety_mobile_4.jpg" alt="Anti-lock Brake System (ABS) image"></div>
										</li>
									</ul>
								</div>
								<div class="controls"><a class="play" href="#" style="display: block;">Play</a> <a class="stop" href="#" style="display: none;">Stop</a> <a class="next" href="#">Next</a></div>
								<div class="slider_wrap">
									<div class="slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" id="safety_slider" current="320">&nbsp;<div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min"></div>
										<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
									</div>
									<div class="slider_text">
										<ul>
											<li class="">FCA</li>
											<li class="">BCW</li>
											<li>RCCW</li>
											<li class="">LKA</li>
											<li>END</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="touch section">
	<h2 class="h2 touch__title">Прикосновение к&nbsp;технологиям</h2>
	<img src="/images/cars/kona/kona-os-ev-highlights-electronic-gear-shift-button-pc.jpg" alt="" class="touch__img">
	<img src="/images/cars/kona/tech-md.jpg" alt="" class="touch__img--md">
	<div class="default-text default-text--850">
		Управление на&nbsp;кончиках пальцев&nbsp;&mdash; переключение режимов движения кнопками, удобно расположенными на&nbsp;центральной консоли, там&nbsp;же где и&nbsp;электронный стояночный тормоз.
	</div>
</section>

<section class="covenience section section--white">
  <div class="section__center">
    <img src="/images/cars/kona/kona-os-ev-highlights-7-display-audio-pc.jpg" alt="" class="covenience__img">
    <h3 class="h3 covenience__title">Наглядное превосходство</h3>
		<div class="default-text default-text--850">
			На&nbsp;широком дисплее высокого разрешения&nbsp;7&Prime; отлично отображается видеосигнал с&nbsp;задней камеры и&nbsp;обеспечивается интеграция со&nbsp;смартфонами через Apple CarPlay&trade; и&nbsp;Android Auto&trade;.
		</div>

    <div class="covenience__list">
			<div class="covenience__item">
				<div class="covenience__pic" style="background-image: url(/images/cars/kona/kona-os-ev-highlights-7-instrument-cluster-pc.jpg)"></div>
				<div class="h3 covenience__description">
					Заметная эффективность
				</div>
				<div class="default-text">
					Абсолютно новая система отслеживания показателей автомобиля ясно отображает текущий режим движения, выводит данные о запасах и расходе энергии. Одного взгляда достаточно – и вы в курсе эффективности вождения.
				</div>
			</div>
			<div class="covenience__item">
				<div class="covenience__pic" style="background-image: url(/images/cars/kona/kona-os-ev-highlights-head-up-display-pc.jpg)"></div>
				<div class="h3 covenience__description">
					Информативность – на высоте
				</div>
				<div class="default-text">
					Уровень оснащения салона - не уступает в инновациях силовой установке и дизайну. Вся важная информация всегда перед вашими глазами на проекционном дисплее.
				</div>
			</div>
			<div class="covenience__item">
				<div class="covenience__pic" style="background-image: url(/images/cars/kona/kona-os-ev-highlights-premium-sound-system-from-krell-pc.jpg)"></div>
				<div class="h3 covenience__description">
					Поверьте своим ушам
				</div>
				<div class="default-text">
					Премиальная аудиосистема от Krell обеспечивает глубокий и реалистичный звук на любом сиденье автомобиля.
				</div>
			</div>
			<div class="covenience__item">
				<div class="covenience__pic" style="background-image: url(/images/cars/kona/kona-os-ev-highlights-wireless-phone-charging-pc.jpg)"></div>
				<div class="h3 covenience__description">
					Новые стандарты класса
				</div>
				<div class="default-text">
					В этом электрическом кроссовере каждая деталь пронизана духом доступной инновационности – от общей эргономики до беспроводного зарядого устройства для смартфонов.
				</div>
			</div>
		</div>
	</div>
</section>

<div class="naviJumpWrap">
	<div class="naviJump">
		<div class="next">
			<a href="https://www.hyundai.com/worldwide/en/eco/kona-electric/highlights" class="version__link">Перейти на английскую версию страницы</a>
		</div>
	</div>
</div>

@endsection

@section('scripts')
  <script src="{{ mix('/js/cars/kona/libs.js') }}"></script>
  <script src="{{ mix('/js/cars/kona/kona.js') }}"></script>
@endsection
