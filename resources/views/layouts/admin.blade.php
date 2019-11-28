<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">

	<title>Admin Panel</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="{{ mix('/css/admin/libs.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/admin/main.css') }}">
	
</head>

<body>
	<header class="header">
		<div class="header__top-line">
			<div class="header__left">
				<a href="/" class="header__logo">
					<svg xmlns="http://www.w3.org/2000/svg" class="hyundai-logo">
						<use xlink:href="#img-hyundai"></use>
					</svg>
				</a>
				<h1 class="header__title">Панель администратора</h1>
			</div>
			@guest
			@else
			<div class="header__right">
				<ul>
					<li>
						<a href="{{ route('logout') }}" class="header__link">
							<span>Выйти</span>
							<div class="header__icon">
								<svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20 8L22.2969 11.4453C22.5208 11.7812 22.5208 12.2188 22.2969 12.5547L20 16" stroke="#002C5F" stroke-width="2" />
									<path d="M17.2746 8.66667C16.0106 5.91263 13.2286 4 9.99996 4C5.58168 4 1.99996 7.58172 1.99996 12C1.99996 16.4183 5.58168 20 9.99996 20C13.2286 20 16.0106 18.0874 17.2746 15.3333M22.6666 12L9.99996 12"
									 stroke="#002C5F" stroke-width="2" />
								</svg>
							</div>
						</a>
					</li>
				</ul>
			</div>
			@endguest
		</div>
		@guest
			@else
		<nav class="menu">
			<ul>
				<li class="menu__item">
					<a href="#" class="menu__link active">
						<span>Основной</span>
					</a>
				</li>
				<li class="menu__item">
					<a href="#" class="menu__link">
						<span>Аксессуары</span>
					</a>
				</li>
				<li class="menu__item">
					<a href="#" class="menu__link">
						<span>Motorstudio</span>
					</a>
				</li>
			</ul>
		</nav>
		@endguest
	</header>
	
	<section class="content">
		<div class="content__center">
			<aside class="sidebar">
				@guest
				@else
				<ul class="sidebar__list">
					<li class="sidebar__item">
						<a href="#" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M19.6829 8.58537C19.6829 12.9868 17.1854 15.7805 14.0488 15.7805C10.9122 15.7805 8.41463 12.9868 8.41463 8.58537C8.41463 6.32931 8.8823 4.4092 9.7984 3.08293C10.6793 1.80766 12.0259 1 14.0488 1C16.0717 1 17.4183 1.80766 18.2992 3.08293C19.2153 4.4092 19.6829 6.32931 19.6829 8.58537Z"
									 stroke="#666666" stroke-width="2" />
									<path d="M9.7561 17.1707C7.80488 19.4412 1.56097 18.6844 1.56097 23.6038V25.8744C1.82114 27.1357 5.30732 29.6585 14.0488 29.6585"
									 stroke="#666666" stroke-width="2" />
									<path d="M18.3415 17.1707C20.2927 19.4412 26.5366 18.6844 26.5366 23.6038V25.8744C26.2764 27.1357 22.7902 29.6585 14.0488 29.6585"
									 stroke="#666666" stroke-width="2" />
								</svg>
							</div>
							<span>Пользователи</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="{{ route('admin.seo.index') }}" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
									<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
									 stroke-width="2" />
									<rect y="25" width="2" height="6" fill="#666666" />
									<rect x="7" y="22" width="2" height="9" fill="#666666" />
									<rect x="14" y="9" width="2" height="22" fill="#666666" />
									<rect x="21" y="16" width="2" height="15" fill="#666666" />
									<rect x="28" y="19" width="2" height="12" fill="#666666" />
								</svg>
							</div>
							<span>SEO-данные</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="{{ route('admin.news.index' )}}" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5 1H20.4056L27 7.42199V31H5V1Z" stroke="#666666" stroke-width="2" />
									<path d="M8 8H16" stroke="#666666" stroke-width="2" />
									<path d="M8 13H24" stroke="#666666" stroke-width="2" />
									<path d="M8 18H24" stroke="#666666" stroke-width="2" />
									<path d="M8 23H19" stroke="#666666" stroke-width="2" />
								</svg>
							</div>
							<span>Новости</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="{{ route('admin.cities.index') }}" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="26" height="32" viewBox="0 0 26 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M24.6 13.193C24.6 17.5575 21.6362 22.0142 18.461 25.4973C16.8972 27.2127 15.3302 28.6402 14.1529 29.6394C13.6009 30.1079 13.1363 30.4808 12.8 30.7436C12.4637 30.4808 11.9991 30.1079 11.4471 29.6394C10.2698 28.6402 8.70279 27.2127 7.13901 25.4973C3.9638 22.0142 1 17.5575 1 13.193C1 6.43026 6.31133 1 12.8 1C19.2887 1 24.6 6.43026 24.6 13.193Z"
									 stroke="#666666" stroke-width="2" />
									<path d="M17.4 12.8C17.4 15.3405 15.3405 17.4 12.8 17.4C10.2595 17.4 8.2 15.3405 8.2 12.8C8.2 10.2595 10.2595 8.20001 12.8 8.20001C15.3405 8.20001 17.4 10.2595 17.4 12.8Z"
									 stroke="#666666" stroke-width="2" />
								</svg>
							</div>
							<span>Регионы</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="{{ route('admin.banners.index') }}" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="1" y="1" width="30" height="17" stroke="#666666" stroke-width="2" />
									<rect x="5" y="5" width="22" height="2" fill="#666666" />
									<rect x="5" y="22" width="22" height="2" fill="#666666" />
									<rect x="5" y="10" width="13" height="2" fill="#666666" />
								</svg>
							</div>
							<span>Баннеры</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="{{ route('admin.cars.index') }}" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="16" cy="16" r="15" stroke="#666666" stroke-width="2" />
									<circle r="4.6" transform="matrix(1 0 0 -1 16 16)" stroke="#666666" stroke-width="2" />
									<circle r="10.2" transform="matrix(1 0 0 -1 16 16)" stroke="#666666" stroke-width="2" />
									<path d="M16 5.59998V11.5" stroke="#666666" stroke-width="2" />
									<path d="M16 20V26.4" stroke="#666666" stroke-width="2" />
									<path d="M26.4 16H20" stroke="#666666" stroke-width="2" />
									<path d="M12 16L6 16" stroke="#666666" stroke-width="2" />
									<path d="M23.3539 8.64606L19 13" stroke="#666666" stroke-width="2" />
									<path d="M13 19L8.64594 23.3539" stroke="#666666" stroke-width="2" />
									<path d="M23.3539 23.3539L19 19" stroke="#666666" stroke-width="2" />
									<path d="M13 13L8.64594 8.64607" stroke="#666666" stroke-width="2" />
								</svg>
							</div>
							<span>Автомобили</span>
						</a>
					</li>
					<li class="sidebar__item">
						<a href="#" class="sidebar__link">
							<div class="sidebar__icon">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="11.2" cy="11.2" r="3" stroke="#666666" stroke-width="2" />
									<circle cx="20.8" cy="20.8" r="3" stroke="#666666" stroke-width="2" />
									<path d="M23.2 8.79999L8.8 23.2" stroke="#666666" stroke-width="2" />
									<circle cx="16" cy="16" r="15" stroke="#666666" stroke-width="2" />
								</svg>
							</div>
							<span>Спецпредложения</span>
						</a>
					</li>
					<li class="sidebar__item">
							<a href="{{ route('admin.placeholders.index') }}" class="sidebar__link">
								<div class="sidebar__icon">
									<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
										<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
										 stroke-width="2" />
										<rect y="25" width="2" height="6" fill="#666666" />
										<rect x="7" y="22" width="2" height="9" fill="#666666" />
										<rect x="14" y="9" width="2" height="22" fill="#666666" />
										<rect x="21" y="16" width="2" height="15" fill="#666666" />
										<rect x="28" y="19" width="2" height="12" fill="#666666" />
									</svg>
								</div>
								<span>Плейсхолдеры</span>
							</a>
						</li>
				</ul>
				@endguest
			</aside>
			
			<div class="content__right">
				@yield('content')
			</div>
		</div>
	</section>

	<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none" aria-hidden="true">
		<symbol id="img-hyundai" viewbox="0 0 512 65.85">
			<title>Hyundai</title>
			<path fill="#003469" d="M478.5,16.74h-21c-3.5.2-4.5,1.1-4.5,5.4v11.8h25.5Zm11.2-9.5v51.3H478.5V43.74H453v14.8H441.8V18.34c0-7.1,2.9-11.1,11.2-11.1Zm-59,11.1v27.8c0,8.8-5,12.5-11.2,12.5H384.3V7.34h35.2C429.1,7.24,430.7,13.34,430.7,18.34Zm-11.2,3.1a4.44,4.44,0,0,0-4.7-4.8H395.6v32.1h19.2c4.4-.2,4.7-2.8,4.7-4.9ZM156.9,7.24h11.2v20.2h25V7.24h11.2v51.3H193V37.64H168v20.9H156.8l.1-51.3Zm66.4,0,14,21,13.8-21h13.6L242.9,40v18.5H231.7V40L209.8,7.24Zm104,0h36c5.1,0,10.1.7,9.9,11.1v40.2H362V21.94c0-4.4-.5-5.4-4-5.4H338.4v41.9H327.2V7.24Zm184.7,0v51.3H500.8V7.24ZM270.3,58.64h36c7.1,0,10.1-2.1,9.9-12.4v-39H305v36.7c0,4.4-.5,4.9-4,4.9H281.4V7.24H270.2v51.4Z"
			 transform="translate(0)" style="fill:#003469" />
			<path fill="#003469" d="M111.6,10.24a89.15,89.15,0,0,0-10-4.4,118.24,118.24,0,0,0-50.8-5c-15.9,2.1-31.3,5.9-43.4,16.9-5.8,5.4-9.2,13.5-6.4,21.2,3.7,9.5,13.5,15.8,22.3,19.4,26,10.5,61.3,10.1,86.4-1.9,8.6-4.3,18.2-11.6,19.4-21.9C130.1,23.34,120.3,15,111.6,10.24Zm-58,4.5c2.2-4.2,6-9.2,11.4-9.3a116,116,0,0,1,32.5,4.5c.6.3,1.4.5,1.7,1.1s-.3,1.1-.7,1.6c-8.5,6.6-18.2,10.3-28.1,13.6-5,1.2-10.1,3.4-15.7,2.2a5,5,0,0,1-3.2-2.5C50.1,22,52,18,53.6,14.74ZM19.1,49.24c-1.3,1.2-2.6-.4-3.8-.9-6-3.9-11.4-10.3-9.8-17.8,2.5-9.8,12.6-15.1,21.1-18.7a80.75,80.75,0,0,1,15.7-4.3c.6,0,1.4-.1,1.6.5l-.2.6C32.9,20.94,25.8,35.14,19.1,49.24Zm55.1,4.7c-2.5,3.8-6.5,7.1-11.4,6.6a117.21,117.21,0,0,1-31.6-4.8,1.55,1.55,0,0,1-1.1-.8,1.44,1.44,0,0,1,.5-1.5c9.1-7.3,19.8-10.7,30.5-14.3,4-1.1,8.2-2.4,12.7-1.8a5.35,5.35,0,0,1,4.3,3.2C79.1,45.64,76.4,49.84,74.2,53.94Zm49.4-18.3c-2.5,10.2-13.6,15.6-22.4,19-4.8,1.6-9.6,3.2-14.9,3.7-.3,0-.9,0-.9-.5l.1-.6c7.5-8.4,13.1-17.8,18.1-27.4,2.3-4.3,4.4-8.7,6.4-13.1a2.36,2.36,0,0,1,.9-.6c1.8.3,3.1,1.7,4.6,2.7C120.6,23,125.2,28.74,123.6,35.64Z" />
		</symbol>
	</svg>
	
	<script src="{{ mix('/js/admin/libs.js') }}"></script>
	<script src="{{ mix('/js/admin/admin.js') }}"></script>

</body>

</html>
