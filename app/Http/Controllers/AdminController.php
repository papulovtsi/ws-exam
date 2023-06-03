<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	//
	// Страница панели администратора
	//
	public function index()
	{
		return view('admin.index');
	}

	//
	// Товары админ
	//
	public function items()
	{
		$items = Item::all();
		return view('admin.items.index', compact('items'));
	}

	//
	// Категории админ
	//
	public function categories()
	{
		$categories = Category::all();
		return view('admin.categories.index', compact('categories'));
	}

	//
	// Заказы админ
	//
	public function orders(Request $request)
	{
		// Узнаем параметры фильтрации
		$status = $request->get('status', null);
		// Собираем все заказы чтобы отобразить в админке
		$orders = Order::all();
		// Собираем всех юзеров, чтобы отобразить информацию о них
		$users = User::all();

		if ($status) {
			$orders = $orders->where('status', $status);
		}

		return view('admin.orders.index', compact('orders', 'status', 'users'));
	}

	// Страница создания категории
	public function createCategories()
	{
		return view('admin.categories.create');
	}

	// Страница создания товара
	public function createItems()
	{
		$categories = Category::all();
		return view('admin.items.create', compact('categories'));
	}

	// Страница редактирования товара
	public function updateItems(Item $item)
	{
		$categories = Category::all();
		return view('admin.items.edit', compact('item', 'categories'));
	}
}
