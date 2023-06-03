@extends('admin.index')

@section('title', 'Все товары')

@section('content')
	<a href="{{route('admin.items.createPage')}}" class="btn btn-success">Создать товар</a>

	<h2 class="mt-4">Все товары</h2>

	<div class="d-flex flex-wrap gap-4 catalog">
		@forelse($items as $item)
			<div class="card">
				<a href="{{route('show', $item)}}" class="d-flex align-items-center h-100">
					<img src="{{$item->image}}" class="card-img-top" alt="{{$item->name . " - " . $item->model_type}}">
				</a>
				<div class="card-body d-flex flex-column justify-content-end">
					<h5 class="card-title">{{$item->name . " - " . $item->model_type}}</h5>
					<p class="card-text">{{$item->price}} руб.</p>
					<div class="d-flex flex-column gap-2">
						<a href="{{route('admin.items.updatePage', $item)}}" class="btn btn-primary">Редактировать</a>
						<a href="{{route('admin.items.delete', $item)}}" class="btn btn-danger">Удалить</a>
					</div>
				</div>
			</div>
		@empty
			<div class="alert alert-primary" role="alert">
				Товаров нет
			</div>
		@endforelse
	</div>
@endsection
