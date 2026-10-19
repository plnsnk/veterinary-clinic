<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\Branch;

use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\Http\Response;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('category.index', ['categories' => $categories]);
    }
    // public function productShow(Product $product)
    // {
    //     $data['title'] = $product->name;
    //     $data['product'] = $product;
    //     return view('product', $data);
    // }
    public function serviceShow(Service $service)
    {
        $data['title'] = $service->name;
        $data['service'] = $service;
       
        return view('services', $data);
    }
    
    public function privacy()
    {
        return view('privacy');
    }

    public function products(Request $request)
    {
        $data['categories'] = Category::whereNotIn('id', [1, 2])->get();

    $query = Product::query()->whereNotIn('category_id', [1, 2]);

        $query = Product::query();

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->sort == 'price1') {
            $query->orderBy('price');
        }

        if ($request->sort == 'price2') {
            $query->orderByDesc('price');
        }

        if ($request->sort == 'nm') {
            $query->orderBy('name');
        }

        if ($request->sort == 'new') {
            $query->orderByDesc('updated_at');
        }

        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }
         if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
 
        $data['products'] = $query->paginate(8)->withQueryString();
        $data['title'] = "Продукты";

        return view('products', $data);
    }
   
    public function search(Request $request)
    {
        $title = "Поиск";
        $query = $request->search;

        if(strlen($query)>2){
            $result = Product::where('name', 'like', '%' . $query . '%')->get();
            return view('search', ['result' => $result, 'title' => $title, 'query' => $query]);
        }
        else {
            return back();
        }
    }
   public function allServices(Request $request)
{
    $query = Service::with('category');

    
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    } else {
        
        $query->whereIn('category_id', [1, 2]);
    }

    $services = $query->get();
    $categories = Category::whereIn('id', [1, 2])->get();

    return view('all_services', [
        'title' => 'Все услуги',
        'services' => $services,
        'categories' => $categories
    ]);
    
}


}