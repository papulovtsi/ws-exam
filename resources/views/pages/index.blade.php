@extends('app')

@section('title', 'О нас')

@section('content')
	<div class="about d-flex flex-column gap-4">
		<h2 class="word">Copy Star - Напечатай мечту</h2>

		<h3 class="word">Новинки компании</h3>

		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
				@foreach($items as $index => $item)
					<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}"
							@if($index === 0) class="active" @endif aria-current="true" aria-label="Slide 1"></button>
				@endforeach
			</div>
			<div class="carousel-inner">
				@forelse($items as $index => $item)

					<div class=" @if($index === 0) active @endif carousel-item">
						<img style="object-fit: cover;" src="{{$item->image}}"
							 class="d-block w-100 carousel-img-copystar"
							 alt="{{$item->name . " - " . $item->model_type}}">
						<div class="carousel-caption d-md-block d-none">
							<h4 class="d-block-important">{{$item->name . " - " . $item->model_type}}</h4>
						</div>
					</div>

				@empty
					Товаров еще нет, приходите позже
				@endforelse
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
					data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
					data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
@endsection
