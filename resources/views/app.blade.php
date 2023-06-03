<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	{{--Название вкладки в браузере--}}
	<title>Copy Star - @yield('title')</title>

	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body class="antialiased">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	{{--логотип--}}
	<a class="navbar-brand ml-4" href="{{route('home')}}">
		<img src="/media/images/logo.svg" height="90" alt="">
	</a>
	<div class="d-flex flex-column gap-4">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
				aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<div class="navbar-nav">
				<a class="nav-link" href="{{route('home')}}">О нас</a>
				<a class="nav-link" href="{{route('list')}}">Каталог</a>
				<a class="nav-link" href="{{route('location')}}">Где нас найти?</a>
				@auth
					<a class="nav-link" href="{{route('cart')}}">Корзина</a>
					<a class="nav-link" href="{{route('orders')}}">Мои заказы</a>
					<a class="nav-link" href="{{route('logout')}}">Выход</a>
				@else
					<a class="nav-link" href="{{route('register')}}">Регистрация</a>
					<a class="nav-link" href="{{route('login')}}">Войти</a>
				@endauth
			</div>
		</div>
	</div>
</nav>

<div class="alert alert-primary d-none" role="alert">
	<div class="d-flex">
		<div class="alert-body mr-2"></div>
		<button type="button" class="btn-close closeModal" aria-label="Close"></button>
	</div>
</div>

<div class="m-4">
	@yield('content')
</div>
{{--// Подключение библиотек JavaScript--}}
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@stack('scripts')
<script>
	//ищем навбар с айди navbarTogglerDemo02
	const navbar = document.querySelector("#navbarTogglerDemo02")
	const buttonNavbarToggle = document.querySelector(".navbar-toggler")
	buttonNavbarToggle.addEventListener("click", () => {
		navbar.classList.toggle("collapse")
		navbar.classList.toggle("navbar-collapse")
	})
	// добавить в корзину
	const addToCart = (itemId, count = 1, reload = false) => {
		$.post('/cart/' + itemId, {count}, data => {
			// alert(data.message);
			showModal(data.message)
			if (reload) location.reload();
		}).fail(err => alert('Ошибка при добавлении товара'))
	}
	// Добавить в корзину
	$('.addToCart').click(function () {
		const itemId = $(this).data('id');
		addToCart(itemId)
	})
	// Показать сообщение
	const showModal = (text) => {
		$('.alert').removeClass('d-none').find('.alert-body').text(text)
	}
	// Закрыть сообщение
	$('.closeModal').click(function () {
		$('.alert').addClass('d-none')
	})
</script>
</body>
</html>
