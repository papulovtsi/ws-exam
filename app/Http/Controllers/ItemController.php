<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
	//
	// Создать новую карточку товара
	//
	public function store(Request $request)
	{
		// обработка изображения
		$path = $request->file('image')->store('public');
		$path = str_replace('public', '/storage', $path);
		// собираем необходимые данные о товаре
		$item = new Item($request->except("file"));
		$item->image = $path;
		// создаем запись в бд
		$item->save();

		return redirect()->route('admin.items.index');
	}


	//
	// Обновить товар
	//
	public function update(Item $item, Request $request)
	{
		// Параметры необходимые для обновления
		$params = [
			'name' => $request->name,
			// цена
			'price' => $request->price,
			'available' => $request->available,
			'category_id' => $request->category_id,
			// описание модели
			'model_type' => $request->model_type,
			'model_country' => $request->model_country,
			'model_year' => $request->model_year,
		];

		// обработка изображения
		if ($request->image) {
			$path = $request->file('image')->store('public');
			$params['image'] = str_replace('public', '/storage', $path);
		}

		// обновляем запись в бд
		$item->update($params);

		return redirect()->route('admin.items.index');
	}

	//
	// Удалить товар из каталога навсегда
	//
	public function destroy(Item $item)
	{
		$item->delete();
		return redirect()->route('admin.items.index');
	}
}
