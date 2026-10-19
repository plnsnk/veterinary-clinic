<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // Базовый запрос - ВСЕГДА получаем все товары
    $query = Product::with('category');
    
    // Поиск по названию (только если есть значение)
    if ($request->filled('search')) {
        $search = trim($request->search);
        $query->where('name', 'like', '%' . $search . '%');
    }
    
    // Фильтр по категории (только если выбрано)
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }
    
    // Сортировка и получение
    $products = $query->orderBy('id', 'desc')->get();
    
    // Получаем все категории для фильтра
    $categories = Category::all();
    
    return view('product.index', [
        'products' => $products,
        'categories' => $categories,
        'search' => $request->search ?? '',
        'selectedCategory' => $request->category ?? '',
    ]);
}

    public function productForm()
    {
        $categories = Category::all();
        return view('product.store', ['categories' => $categories]);
    }

    public function productCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect('/product')->with('success', 'Товар успешно добавлен!');
    }

    public function productEdit(string $id)
    {
        $product = Product::findOrFail($id); 
        $categories = Category::all();

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function productUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect('/product')->with('success', 'Товар обновлен!');
    }

    public function productDestroy(string $id)
    {
        Product::destroy($id);

        return redirect('/product')->with('success', 'Товар удален!');
    }
}