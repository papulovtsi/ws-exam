@extends('app')

@section('title', 'Корзина')

@section('content')
	<h2 class="mb-2">Название товара: {{$item->name . " - " . $item->model_type}}</h2>
	<div class="d-flex flex-row-reverse gap-4">
		<img style="object-fit: cover;" width="400" src="{{$item->image}}"
			 alt="{{$item->name . " - " . $item->model_type}}">
		<div class="d-flex flex-column justify-content-between gap-4">
			<div>
				<p class="mb-1">Цена: {{$item->price}} р.</p>
				<p class="mb-1">Страна производитель: {{$item->model_country}}</p>
				<p class="mb-1">Год выпуска: {{$item->model_year}}</p>
				<p class="mb-1">Модель: {{$item->model_type}}</p>
			</div>
			@auth
				<button data-id="{{$item->id}}" class="btn btn-primary addToCart">В корзину</button>
			@endauth
		</div>
	</div>
@endsection
