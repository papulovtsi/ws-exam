<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Панель администратора - @yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

</head>
<body class="antialiased">
<div class="m-4 d-flex flex-column gap-4">
    <a href="/" class="btn btn-primary">Вернуться на главную</a>
    <div class="btn-group btn-group-vertical" role="group" aria-label="Basic outlined example">
        <a href="{{route('admin.orders.index')}}" class="btn btn-outline-primary">Заказы</a>
        <a href="{{route('admin.categories.index')}}" class="btn btn-outline-primary">Категории</a>
        <a href="{{route('admin.items.index')}}" class="btn btn-outline-primary">Товары</a>
    </div>

    <div class="mt-2">
        @yield('content')
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@stack('scripts')
</body>
</html>
