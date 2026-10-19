@extends('themeAdmin')

@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
        <a href="/admin/orders" class="account_nav">Заказы</a>
        <a href="/product" class="account_nav active" id="actively">Продукты</a>
        <a href="/service" class="account_nav">Услуги</a>
        <a href="/category" class="account_nav">Категории</a>
    </nav>

    <div class="h1_account">
        <span>Список товаров</span>
        <a href="/product/store" class="a_button_inline" title="Добавить товар">+</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Форма поиска и фильтра --}}
    <div class="search-filter-bar">
        <form method="GET" action="/product" class="search-form">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder=" Поиск по названию..."
                    class="search-input"
                >
                @if(isset($search) && $search !== '')
                    <a href="/product" class="clear-search" title="Очистить поиск">✕</a>
                @endif
            </div>
            
            <select name="category" class="filter-select">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="btn-search">Найти</button>
            
            @if(isset($search) && $search !== '' || isset($selectedCategory) && $selectedCategory !== '')
                <a href="/product" class="btn-reset">Сбросить</a>
            @endif
        </form>
        
        @if(isset($search) && $search !== '' || isset($selectedCategory) && $selectedCategory !== '')
            <div class="search-info">
                Найдено товаров: <strong>{{ $products->count() }}</strong>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        @if($products->count() > 0)
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th style="text-align: right;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->price }} ₽</td>
                        <td>{{ $product->category->name ?? 'Без категории' }}</td>
                        <td class="actions-cell">
                            <a href="/product/edit/{{ $product->id }}" class="btn-action btn-edit">Изменить</a>

                            <form action="/product/destroy/{{ $product->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?');">
                                @csrf
                                <button type="submit" class="btn-action btn-delete">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <p>Товары не найдены</p>
                <a href="/product" class="btn-reset">Показать все товары</a>
            </div>
        @endif
    </div>
@endsection