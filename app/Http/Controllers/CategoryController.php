<?php

namespace App\Http\Controllers;

use App\Models\Category; // 🔑 Важно: Category с большой буквы
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Исправлено на Category
        return view('categories.index', ['categories' => $categories]);
    }

    public function categoryForm()
    {
        return view('categories.store');
    }

    public function category(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/category')->with('success', 'Категория добавлена!');
    }

    public function categoryEdit(string $id)
    {
        // findOrFail вернет 404, если категории нет
        $category = Category::findOrFail($id);

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function categoryUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->save();

        return redirect('/category')->with('success', 'Категория обновлена!');
    }

    public function categoryDestroy(string $id)
    {
        Category::destroy($id);
        return redirect('/category')->with('success', 'Категория удалена!');
    }
}