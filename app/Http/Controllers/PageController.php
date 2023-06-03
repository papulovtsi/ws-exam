<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    // О нас
    //
    public function index()
    {
        // Новинки компании - 5 последних опубликованных товаров
        $itemsNew = Item::orderByDesc('id')->where("available", ">=", 1)->limit(5)->get();
        $items = ItemResource::collection($itemsNew);
        return view('pages.index', compact('items'));
    }

    //
    // Вход
    //
    public function login()
    {
        return view('pages.login');
    }

    //
    // Регистрация
    //
    public function register()
    {
        return view('pages.register');
    }

    //
    // Каталог
    //
    public function list(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $type = $request->get('type', 'desc');
        $categoryId = $request->get('category_id', null);

        $categories = Category::all();
        $items = Item::orderBy($sort, $type);

        // поиск по айди категории
        if ($categoryId) {
            $items = $items->where('category_id', $categoryId);
        }
        // Пагинация
        $items = ItemResource::collection($items->where('available', '>', 0)->simplePaginate(15));
        return view('pages.list', compact('sort', 'type', 'categoryId', 'categories', 'items'));
    }

    //
    // Карточка с товаром
    //
    public function show(Item $item)
    {
        // передает в компакт данные о товаре по его идентификатору
        return view('pages.show', compact('item'));
    }

    //
    // Где нас найти
    //
    public function location()
    {
        return view('pages.location');
    }
}
