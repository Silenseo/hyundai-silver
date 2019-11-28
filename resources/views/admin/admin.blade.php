<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('pageTitle')</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="{{ mix('/css/admin/libs.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/admin/main.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/kit/libs.css') }}">

	<!-- Scripts -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
	</script>
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
			<div class="header__right">
				<ul>
					<li>
						<a href="{{ route('admin.cache_clear') }}">Сбросить кэш</a>
					</li>
					<li>
						<form method="post" action="{{ route('logout') }}">
							@csrf
							<a href="javascript:void(0);" class="header__link" onclick="$(this).closest('form').submit();">
									<span>Выйти</span>
									<div class="header__icon">
										<svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20 8L22.2969 11.4453C22.5208 11.7812 22.5208 12.2188 22.2969 12.5547L20 16" stroke="#002C5F" stroke-width="2" />
											<path d="M17.2746 8.66667C16.0106 5.91263 13.2286 4 9.99996 4C5.58168 4 1.99996 7.58172 1.99996 12C1.99996 16.4183 5.58168 20 9.99996 20C13.2286 20 16.0106 18.0874 17.2746 15.3333M22.6666 12L9.99996 12"
											 stroke="#002C5F" stroke-width="2" />
										</svg>
									</div>
								</a>
						</form>
					</li>
				</ul>
			</div>
		</div>
		<nav class="menu">
			<ul>
				<li class="menu__item">
					<a href="/admin" class="menu__link{{ !str_contains(request()->url(), '/accessories') && !str_contains(request()->url(), '/motorstudio') && !str_contains(request()->url(), '/brandcollection')  ? ' active' : '' }}">
						<span>Основной</span>
					</a>
				</li>
			</ul>
		</nav>
	</header>

	<section class="content">
		<div class="content__center">
			@yield('sidebar')

			<div class="content__right">
			@yield('content')
			</div>

		</div>
	</section>

	<script>
		window.onload = function() {
			$('.table thead th[data-sort-name]').on('click', function() {
				let curUrl = window.location.href;
				let tArr = curUrl.split('?');
				let baseUrl = tArr[0];
				let params = tArr[1];
				let targetField = $(this).attr('data-sort-name');
				if(params) {
					let isSameField = false;
					let newParams = params.replace(/sort_field=([^&?]*)/g, function(match, p1) {
						if(p1 == targetField) {
							isSameField = true;
						}
						return 'sort_field=' + targetField;
					});
					newParams = newParams.replace(/sort_order=([^&?]*)/g, function(match, p1) {
						let tOrder = 'asc';
						if(isSameField == true) {
							tOrder = (p1 == 'asc') ? 'desc' : 'asc';
						}
						return 'sort_order=' + tOrder;
					});
					window.location.href = baseUrl + '?' + newParams;
				}
				else {
					window.location.href = baseUrl + '?sort_order=asc&sort_field=' + targetField;
				}
			});

			$('#table_search').on('click', function() {
				let o = $(this);
				let p = o.closest('tr');
				let params = [];
				p.find('input').each(function() {
					let val = $(this).val().trim();
					if(val.length > 0) {
						params.push($(this).attr('name') + '=' + val);
					}
				});

				let curUrl = window.location.href;
				let tArr = curUrl.split('?');
				let baseUrl = tArr[0];

				window.location.href = baseUrl + '?' + params.join("&");
			});
		};
	</script>

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
	<script src="{{ mix('/js/kit/libs.js') }}"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>tinymce.init({
		selector:'textarea',
		plugins: "table code image",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});</script>

</body>

</html>
