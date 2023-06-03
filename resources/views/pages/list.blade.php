@extends('app')

@section('title', 'Каталог')

@section('content')
	<form class="d-flex flex-column gap-4">
		<div>
			<h4>Сортировка по параметрам</h4>
			<select name="sort" class="form-select" aria-label="Default select example">
				@foreach([
					'id' => 'По новизне',
					'price' => 'По цене',
					'name' => 'По наименованию',
					'model_year' => 'По году производства',
				] as $key => $name)
					<option @if($sort === $key) selected @endif value="{{$key}}">{{$name}}</option>
				@endforeach
			</select>

		</div>
		<div>
			<h4>Сортировка по порядку</h4>
			<select name="type" class="form-select" aria-label="Default select example">
				@foreach([
					'asc' => 'По убыванию (Сначала старые)',
					'desc' => 'По возрастанию (Сначала новые)',
				] as $key => $name)
					<option @if($type === $key) selected @endif value="{{$key}}">{{$name}}</option>
				@endforeach
			</select>
		</div>
		<div>
			<h4>Сортировка по категориям</h4>
			<select name="category_id" class="form-select" aria-label="Default select example">
				<option value="">Все</option>


				@foreach($categories as $category)
					<option @if($category->id === $categoryId)
								selected
							@endif
							value="{{$category->id}}">
						{{$category->name}}
					</option>
				@endforeach
			</select>
		</div>
		<button class="btn btn-success mb-2" type="submit">Поиск</button>
	</form>

	<div class="d-flex flex-wrap gap-4 catalog">
		@forelse($items as $item)
			<div class="card">
				<a href="{{route('show', $item)}}" class="d-flex align-items-center h-100">
					<img src="{{$item->image}}" class="card-img-top" alt="{{$item->name . " - " . $item->model_type}}">
				</a>
				<div class="card-body d-flex flex-column justify-content-end">
					<h5 class="card-title">{{$item->name . " - " . $item->model_type}}</h5>
					<p class="card-text">{{$item->price}} руб.</p>

					@auth
						<button data-id="{{$item->id}}" class="btn btn-primary addToCart">В корзину</button>
					@endauth
				</div>
			</div>
		@empty
			<div class="alert alert-primary" role="alert">
				Товары не найдены
			</div>
		@endforelse
	</div>
@endsection
