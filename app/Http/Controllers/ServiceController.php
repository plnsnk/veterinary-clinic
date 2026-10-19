<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Список услуг с поиском и фильтром
    public function index(Request $request)
    {
        // Базовый запрос
        $query = Service::with('category');
        
        // Поиск по названию (только если поле не пустое)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where('name', 'like', '%' . $search . '%');
        }
        
        // Фильтр по категории (только если выбрана)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Получаем отфильтрованные услуги
        $services = $query->orderBy('id', 'desc')->get();
        
        // Получаем все категории для выпадающего списка
        $categories = Category::all();
        
        return view('service.index', [
            'services' => $services,
            'categories' => $categories,
            'search' => $request->search ?? '',
            'selectedCategory' => $request->category ?? '',
        ]);
    }

    // Форма создания услуги
    public function serviceForm()
    {
        $categories = Category::all();
        return view('service.store', ['categories' => $categories]);
    }

    // Сохранение новой услуги
    public function serviceCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|max:10000',
        ]);

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect('/service')->with('success', 'Услуга успешно добавлена!');
    }

    // Форма редактирования услуги
    public function serviceEdit(string $id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();

        return view('service.edit', [
            'service' => $service,
            'categories' => $categories,
        ]);
    }

    // Обновление услуги
    public function serviceUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|max:10000',
        ]);

        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect('/service')->with('success', 'Услуга обновлена!');
    }

    // Удаление услуги
    public function serviceDestroy(string $id)
    {
        Service::destroy($id);
        return redirect('/service')->with('success', 'Услуга удалена!');
    }
}