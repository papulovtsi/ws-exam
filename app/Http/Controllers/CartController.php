<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
	//
	// Вывести все товары в корзине текущего авторизованного пользователя
	//
	public function index()
	{
		$items = $this->user->carts->toArray();
		$final_price = collect($items)->sum('price');
		return view('pages.cart', compact('items', 'final_price'));
	}

	//
	// Добавить товар в корзину, обновить количество товара
	//
	public function store(Request $request, Item $item)
	{
		$count = $request->get('count', 0);

		// Обращаемся к корзине пользователя и выбираем тот товар по идентификатору
		$cartItem = $this->user->carts()->where('item_id', $item->id)->first();
		if ($cartItem) $count += $cartItem->count;

		$item->available -= $count;
		// проверяем в наличии
		if ($item->available < 0) return ['message' => 'Недостаточное кол-во товара'];

		$cartItem = $this->user->carts()->firstOrCreate(['item_id' => $item->id], ['count' => 0]);
		$cartItem->count = $count;

		// если количество меньше 1 удаляем товар из корзины
		if ($cartItem->count < 1) {
			$cartItem->delete();
			return ['message' => 'Товар удалён из корзины'];
		}

		// обновляем информацию в бд
		$cartItem->save();
		// выводим сообщение на экран
		return ['message' => 'Товар добавлен'];
	}
}
