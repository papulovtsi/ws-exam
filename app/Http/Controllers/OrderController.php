<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
	//
	// Все заказы текущего авторизованного пользователя
	//
	public function index()
	{
		$orders = $this->user->orders;
		return view('pages.orders', compact('orders'));
	}


	//
	// Создаем заказ
	//
	public function store(Request $request)
	{
		$password = $request->get('password', '');
		if (!Hash::check($password,$this->user->password)) return ['error' => 'Неверный пароль'];

		$items = $this->user->carts->toArray();
		$final_price = collect($items)->sum('price');

		if ($final_price < 1) return ['error' => 'Добавьте товары в корзину'];

		$order = $this->user->orders()->create([
			'items' => $items,
			'final_price' => $final_price
		]);

		foreach ($this->user->carts as $orderItem) {
			$orderItem->item->available -= $orderItem->count;
			$orderItem->item->save();
		}

		$this->user->carts()->delete();

		return $order;
	}

	//
	// Удалить заказ если его статус новый
	//
	public function destroy(Order $order)
	{
		if ($order->status !== 'Новый') {
			return redirect()->back();
		}

		$order->delete();

		return redirect()->route('orders');
	}

	//
	// Отмена и описание отказа
	//
	public function cancelOrder(Request $request, Order $order)
	{
		$description = $request->get('description');
		$order->status = 'Отменён'; // меняем статус
		$order->description = $description; // причина отказа
		$order->save();

		return redirect()->back();
	}

	//
	// Подтверждение заказа
	//
	public function confirmOrder(Order $order)
	{
		$order->status = 'Подтверждён'; // меняем статус
		$order->save();

		return redirect()->back();
	}
}
