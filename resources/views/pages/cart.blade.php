@extends('app')

@section('title', 'Корзина')

@section('content')
	<h2 class="mb-2">Корзина</h2>

	<div class="d-flex flex-wrap gap-4 catalog">
		@forelse($items as $item)
			<div class="card">
				<a href="{{route('show', $item["id"])}}" class="d-flex align-items-center h-100">
					<img src="{{$item["item"]["image"]}}" class="card-img-top"
						 alt="{{$item["item"]["name"] . " - " . $item["item"]["model_type"]}}">
				</a>
				<div class="card-body d-flex flex-column justify-content-end">
					<h5 class="card-title">{{$item['item']['name']}}</h5>
					<p class="card-text">{{$item['item']['price'] * $item['count']}} р.</p>
					<p class="card-text">{{$item['count']}} шт.</p>
					<div class="d-flex flex-column gap-4">
						<button data-id="{{$item['item']['id']}}" data-count="1" class="btn btn-success editCart">+
						</button>
						<button data-id="{{$item['item']['id']}}" data-count="-1" class="btn btn-danger editCart">-
						</button>
					</div>
				</div>
			</div>
		@empty
			<div class="alert alert-primary" role="alert">
				Ваша корзина пуста
			</div>
		@endforelse
	</div>

	<div class="mt-2 mb-4">
		Финальная цена: {{$final_price}}
	</div>

	<form class="order-form">
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Пароль для подтверждения заказа</label>
			<input required type="password" name="password" class="form-control" id="exampleInputPassword1">
		</div>
		<button type="submit" class="btn btn-success">Оформить заказ</button>
	</form>
@endsection

@push('scripts')
	<script>
		$('.editCart').click(function () {
			const itemId = $(this).data('id')
			const count = Number($(this).data('count'))
			addToCart(itemId, count, true)
		})

		document.querySelector('.order-form').onsubmit = function (e) {
			e.preventDefault();

			$.post('/order/create', $('.order-form').serializeArray(), data => {
				if (data.error) return alert(data.error)
				location.href = '/orders'
			}).fail(err => alert('неизвестная ошибка'))
		}
	</script>
@endpush
