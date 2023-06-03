<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
	//
	// Создание категории
	//
	public function store(Request $request)
	{
		// Берем имя категории из запроса
		$name = $request->get('name');
		// Создаем категорию
		Category::create(compact('name'));
		// Обновляем страницу
		return redirect()->route('admin.categories.index');
	}

	//
	// Удаление категории
	//
	public function destroy(Category $category)
	{
		$category->delete();

		// Обновляем страницу
		return redirect()->route('admin.categories.index');
	}
}
