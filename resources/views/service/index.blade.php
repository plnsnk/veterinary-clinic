@extends('themeAdmin')

@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
        <a href="/admin/orders" class="account_nav">Заказы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav active" id="actively">Услуги</a>
        <a href="/category" class="account_nav">Категории</a>
    </nav>

    <div class="h1_account">
        <span>Список услуг</span>
        <a href="/service/store" class="a_button_inline" title="Добавить услугу">+</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Форма поиска и фильтрации --}}
    <div class="search-filter-bar">
        <form method="GET" action="/service" class="search-form">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="Поиск по названию услуги..."
                    class="search-input"
                >
                @if(isset($search) && $search !== '')
                    <a href="/service" class="clear-search" title="Очистить поиск">✕</a>
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
            
            @if((isset($search) && $search !== '') || (isset($selectedCategory) && $selectedCategory !== ''))
                <a href="/service" class="btn-reset">Сбросить</a>
            @endif
        </form>
        
        @if((isset($search) && $search !== '') || (isset($selectedCategory) && $selectedCategory !== ''))
            <div class="search-info">
                Найдено услуг: <strong>{{ $services->count() }}</strong>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        @if($services->count() > 0)
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
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td><strong>{{ $service->name }}</strong></td>
                        <td>{{$service->price }}руб</td>
                        <td>{{ $service->category->name ?? 'Без категории' }}</td>
                        <td class="actions-cell">
                            <a href="/service/edit/{{ $service->id }}" class="btn-action btn-edit">Изменить</a>

                            <form action="/service/destroy/{{ $service->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Вы уверены, что хотите удалить эту услугу?');">
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
                <p>Услуги не найдены</p>
                <a href="/service" class="btn-reset">Показать все услуги</a>
            </div>
        @endif
    </div>
@endsection