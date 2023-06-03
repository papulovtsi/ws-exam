@extends('app')

@section('title', 'Заказы')

@section('content')
	<h2 class="mb-4">Заказы</h2>

	<div class="d-flex flex-wrap gap-4 catalog">
		@forelse($orders as $order)
			<div class="card p-2">
				@foreach($order->items as $orderItem)
					<a href="{{route('show', $orderItem["id"])}}" class="d-flex align-items-center h-100">
						<img src="{{$orderItem['item']['image']}}" class="card-img-top"
							 alt="{{$orderItem['item']['name']}}">
					</a>
					<div class="card-body d-flex flex-column justify-content-end">
						<h5 class="card-title">{{$orderItem['item']['name']}}</h5>
						<p class="card-text">{{$orderItem['price'] * $orderItem['count']}} р.</p>
					</div>
				@endforeach

				<div class="mb-2">Статус: {{$order->status}}</div>
				@if($order->status === 'Новый')
					<a href="{{route('deleteOrder', $order)}}" class="btn btn-danger">Удалить</a>
				@elseif($order->status === 'Отменён')
					<p>Причина отмены заказа: {{$order->description}}</p>
				@endif
			</div>
		@empty
			<div class="alert alert-primary" role="alert">
				Вы еще не сделали ни одного заказа
			</div
		@endforelse
	</div>
@endsection
