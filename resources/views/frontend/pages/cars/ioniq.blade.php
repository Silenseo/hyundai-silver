@extends('layouts.master')

@section('pageTitle', 'Hyundai IONIQ')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/cars/ioniq/libs.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/cars/ioniq/ioniq.css') }}">
@endsection

@section('content')

<div class="contentWrap" id="container">
	<div class="contTop">
		<div class="topVisualArea">
			<div class="topVisual">
				<div class="visual">
					<img class="responsive-image img--lg" src="/images/cars/ioniq/main.jpg"
          alt="White color Ioniq Electric is placed in front of a building with unique design">
          <img class="responsive-image img--md" src="/images/cars/ioniq/md/main.jpg"
          alt="White color Ioniq Electric is placed in front of a building with unique design">
          <img class="responsive-image img--sm" src="/images/cars/ioniq/sm/main.jpg"
					alt="White color Ioniq Electric is placed in front of a building with unique design">
				</div>
				<div class="middle">
					<div class="titWrap">
						<h1 class="df-main-banner__title">IONIQ Electric*</h1>
						<div class="df-main-banner__subtitle">
							Инновации в динамике.
							<br>Заряжен эмоциями.
						</div>
						<div class="disclaimer">
							*Данная модель недоступна на территории Российской Федерации.
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //.topVisualArea -->
	</div>
	<!-- //.contTop -->

	<div class="section">
		<div class="contWrap bgW">
			<div class="contBox full main-title">
				<div class="titArea full">
					<h2 class="topTit">О главном</h2>
					<h3 class="subTit">
						Аэродинамика в&nbsp;дизайне
					</h3>
					<div class="topTxt fwn">
						IONIQ Electric демонстрирует превосходную аэродинамику, задавая новые стандарты в&nbsp;мире электромобилей.
					</div>
				</div>
				<div class="image-feature">
					<div id="image_feature" class="gridWrap n1 imgView1 imgOnly">
						<div class="grid">
							<div class="fullImg">
								<div class="img">
                  <img src="/images/cars/ioniq/slide2.jpg" class="responsive-image img--lg" alt="Side front view of white Ioniq Electric parked outside">
                  <img src="/images/cars/ioniq/md/slide10.jpg" class="responsive-image img--md" alt="Side front view of white Ioniq Electric parked outside">
                  <img src="/images/cars/ioniq/sm/slide10.jpg" class="responsive-image img--sm" alt="Side front view of white Ioniq Electric parked outside">
								</div>
							</div>
						</div>
						<!-- //.grid -->
					</div>
				</div>
				<div class="section">
					<div id="section" class="contWrap bgG">
						<div class="contBox">
							<div class="image-feature">
								<div class="gridWrap n2 imgView2">
									<div class="gridRow">
										<div class="grid grid1">
											<div class="imgArea">
												<img src="/images/cars/ioniq/slide3.jpg"
												  alt="Closer view of side front part of white Ioniq Electric">
											</div>
											<div class="txtArea">
												<h3 class="subTit">Стильный</h3>
												<div class="conArea">Отточенный дизайн исполнен летящими линиями и перетекающими поверхностями корпуса.</div>
											</div>
											<!-- //.txtArea -->
										</div>
										<div class="grid grid2">
											<div class="imgArea">
												<img src="/images/cars/ioniq/slide4.jpg"
												  alt="Sleek design of white Ioniq Electric">
											</div>
											<div class="txtArea">
												<h3 class="subTit">Обтекаемый</h3>
												<div class="conArea">Коэффициент лобового сопротивления всего 0,24 – отражение обтекаемого дизайна и&nbsp;плавности хода IONIQ&nbsp;Electric,<br>сплавленных воедино.
												</div>
											</div>
											<!-- //.txtArea -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="contWrap bgW">
			<div class="contBox future-block">
				<div class="image-feature">
					<div class="gridWrap n1 imgView1">
						<div class="grid">
							<div class="imgArea">
								<img src="/images/cars/ioniq/slide5.jpg"
								  class="responsive-image img--lg"
                  alt="Ioniq Electric getting charged">
                <img src="/images/cars/ioniq/slide5.jpg"
								  class="responsive-image img--md"
                  alt="Ioniq Electric getting charged">
                <img src="/images/cars/ioniq/slide5.jpg"
								  class="responsive-image img--sm"
								  alt="Ioniq Electric getting charged">
							</div>
							<div class="txtArea">
								<h3 class="subTit">Подключение к&nbsp;будущему</h3>
								<div class="conArea">IONIQ Electric обеспечивает отсутствие вредных выбросов и&nbsp;отменную динамику передвижения.</div>
							</div>
							<!-- //.txtArea -->
						</div>
						<!-- //.grid -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="contWrap bgG">
			<div class="contBox section-3">
				<div class="image-feature">
					<div class="gridWrap n1 imgView1">
						<div class="grid">
							<div class="imgArea">
								<img src="/images/cars/ioniq/slide6.jpg"
								  class="responsive-image"
								  alt="Side view of white Ioniq Electric with white background">
							</div>
							<div class="txtArea power-block">
								<h3 class="subTit">Мощный и&nbsp;маневренный
									<br> </h3>
								<div class="conArea">Рассекающий воздушные потоки силуэт производит неизгладимое впечатление и&nbsp;показывает своё превосходство в&nbsp;движении благодаря составу из&nbsp;легкосплавного алюминия и&nbsp;высокопрочной стали.</div>
							</div>
							<!-- //.txtArea -->
						</div>
						<!-- //.grid -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="contWrap bgW">
			<div class="contBox full phz">
				<div class="image-feature">
					<div class="gridWrap n2 imgViewFull">
						<div class="gridRow">
							<div class="grid grid1">
								<div class="imgArea">
									<img src="/images/cars/ioniq/slide7.jpg"
									  alt="8 inches touch screen of Ioniq Electric">
								</div>
								<div class="txtArea">
									<h3 class="subTit">Постоянно на&nbsp;связи</h3>
									<div class="conArea">Эффективность любой поездки повышается благодаря мультимедийной системе с&nbsp;8-дюймовым монитором.
										<!-- <br>
										<br> -->
									</div>
								</div>
							</div>
							<div class="grid grid2">
								<div class="imgArea">
									<img src="/images/cars/ioniq/slide8.jpg"
									  alt="The digital instrument cluster">
								</div>
								<div class="txtArea">
									<h3 class="subTit">Всегда в&nbsp;курсе</h3>
									<div class="conArea">Комплекс цифровых инструментов отражает все важные процессы и&nbsp;показатели расхода энергии.
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="section">
					<div class="contWrap bgG">
						<div class="contBox slider1-block">
							<div class="image-feature">
								<div class="gridWrap n1 imgView1">
									<div class="grid slider-1">
										<div class="slideWrap slideArea1">
											<ul class="slideArea swiper-wrapper">
												<li class="swiper-slide"
												  data-swiper-slide-index="0">
													<img src="/images/cars/ioniq/slide9.jpg"
													  alt="wireless charging system" class="responsive-image">
												</li>
												<li class="swiper-slide" data-swiper-slide-index="1">
													<img src="/images/cars/ioniq/slide15.jpg"
													  alt="Ioniq multimedia connectivity service" class="responsive-image">
												</li>
											</ul>
											<p class="btn_prev">
												<button class="prev">prev</button>
											</p>
											<p class="btn_next">
												<button class="next">next</button>
											</p>
											<div class="swiper-pagination">
											</div>
										</div>
										<!-- //.slideWrap -->
										<div class="txtArea">
											<h3 class="subTit">Мультимедийный информационный<br>
												центр и&nbsp;беспроводная зарядка</h3>
											<div class="conArea">
												Все системы, встроенные в&nbsp;IONIQ&nbsp;Electric, выводят взаимодействие с&nbsp;ним на&nbsp;новый технологический уровень.
											</div>
										</div>
										<!-- //.textArea -->
									</div>
									<!-- //.grid -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="contWrap bgW">
			<div class="contBox gallery-block">
				<div class="titArea">
					<h2 class="topTit">Галерея</h2>
				</div>
				<div class="gallery">
					<div id="gallery" class="galleryTy1">
						<div class="slideWrap bigImg">
							<div class="pageNum">
								<strong>1</strong> / 6
							</div>
							<ul class="slideArea swiper-wrapper">
								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide10.jpg"
									  class="responsive-image" alt="Side front view of white Ioniq electric">
								</li>

								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide5.jpg"
									  class="responsive-image" alt="Side front view of Ioniq electric getting charged">
								</li>

								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide11.jpg"
									  class="responsive-image" alt="Side front view of white Ioniq electric driving in the car park tower">
								</li>

								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide12.jpg"
									  class="responsive-image" alt="Side view of white Ioniq electric and woman standing in front">
								</li>

								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide13.jpg"
									  class="responsive-image" alt="Side rear view of white Ioniq electric with aerodynamic design">
								</li>

								<li class="swiper-slide colorw">
									<img src="/images/cars/ioniq/slide14.jpg"
									  class="responsive-image" alt="Panoramic view of front interior from driver's viewpoint">
								</li>
							</ul>
							<p class="btn_prev">
								<button class="prev">prev</button>
							</p>
							<p class="btn_next">
								<button class="next">next</button>
							</p>
						</div>
						<!-- //slideWrap bigImg -->
						<div class="slideWrap thumbnail">
							<ul class="slideArea swiper-wrapper">
								<li class="swiper-slide on">
									<button>
										<img src="/images/cars/ioniq/slide10.jpg"
										  class="responsive-image" alt="Side front view of white Ioniq electric">
									</button>
								</li>

								<li class="swiper-slide swiper-slide-next">
									<button>
										<img src="/images/cars/ioniq/slide5.jpg"
										  class="responsive-image" alt="Side front view of Ioniq electric getting charged">
									</button>
								</li>

								<li class="swiper-slide">
									<button>
										<img src="/images/cars/ioniq/slide11.jpg"
										  class="responsive-image" alt="Side front view of white Ioniq electric driving in the car park tower">
									</button>
								</li>

								<li class="swiper-slide">
									<button>
										<img src="/images/cars/ioniq/slide12.jpg"
										  class="responsive-image" alt="Side view of white Ioniq electric and woman standing in front">
									</button>
								</li>

								<li class="swiper-slide">
									<button>
										<img src="/images/cars/ioniq/thumb2.jpg"
										  class="responsive-image" alt="Side rear view of white Ioniq electric with aerodynamic design">
									</button>
								</li>

								<li class="swiper-slide">
									<button>
										<img src="/images/cars/ioniq/slide14.jpg"
										  class="responsive-image" alt="Panoramic view of front interior from driver's viewpoint">
									</button>
								</li>
							</ul>
							<p class="btn_prev">
								<button class="prev">prev</button>
							</p>
							<p class="btn_next">
								<button class="next">next</button>
							</p>
						</div>
						<!-- //slideWrap thumbnail -->
					</div>
					<!-- //galleryTy1 -->
				</div>
			</div>
		</div>
  </div>

<div class="foot-nav">
	<div class="foot-nav__center">
		<a href="https://www.hyundai.com/worldwide/en/eco/ioniq-electric/highlights" class="df-forward-link">
			Перейти на английскую версию страницы
			<svg>
				<use xlink:href="#forward-link"></use>
			</svg>
		</a>
	</div>
</div>

@endsection

@section('scripts')
  <script src="{{ mix('/js/cars/ioniq/libs.js') }}"></script>
  <script src="{{ mix('/js/cars/ioniq/ioniq.js') }}"></script>
@endsection
