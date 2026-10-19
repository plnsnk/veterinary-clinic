@extends('themeAdmin')

@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
        <a href="/admin/orders" class="account_nav">Заказы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav">Услуги</a>
        <a href="/category" class="account_nav active" id="actively">Категории</a>
    </nav>

    <div class="h1_account">
        <span>Список категорий</span>
        <a href="/categories/store" class="a_button_inline" title="Добавить категорию">+</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Панель поиска --}}
    <div class="search-filter-bar">
        <form method="GET" action="/category" class="search-form">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="Поиск по названию категории..."
                    class="search-input"
                >
                @if(isset($search) && $search !== '')
                    <a href="/category" class="clear-search" title="Очистить поиск">✕</a>
                @endif
            </div>
            
            <button type="submit" class="btn-search">Найти</button>
            
            @if(isset($search) && $search !== '')
                <a href="/category" class="btn-reset">Сбросить</a>
            @endif
        </form>
        
        @if(isset($search) && $search !== '')
            <div class="search-info">
                Найдено категорий: <strong>{{ $categories->count() }}</strong>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        @if($categories->count() > 0)
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название категории</th>
                    <th style="text-align: right;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td class="actions-cell">
                            <a href="/categories/edit/{{ $category->id }}" class="btn-action btn-edit">Изменить</a>

                            <form action="/categories/destroy/{{ $category->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Вы уверены, что хотите удалить эту категорию?');">
                                @csrf
                                {{-- Если у вас маршрут настроен как POST, оставляем так. Если как DELETE, замените на @method('DELETE') --}}
                                <button type="submit" class="btn-action btn-delete">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <p>Категории не найдены</p>
                <a href="/category" class="btn-reset">Показать все категории</a>
            </div>
        @endif
    </div>
@endsection