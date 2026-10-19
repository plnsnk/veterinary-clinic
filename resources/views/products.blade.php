@extends('themeIndex')
@section('title')
    <title>Каталог продуктов</title>
@endsection

@section('content')
    <section class="catalog-section">
        <div class="container">
            <h1 class="catalog-title">Продукты</h1>

            {{-- Фильтр и сортировка --}}
            <form class="catalog-filter" method="GET">
                <div class="filter-group">
                    <label for="sort">Сортировка:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>По умолчанию</option>
                        <option value="price1" {{ request('sort') == 'price1' ? 'selected' : '' }}>Сначала дешевые</option>
                        <option value="price2" {{ request('sort') == 'price2' ? 'selected' : '' }}>Сначала дорогие</option>
                        <option value="nm" {{ request('sort') == 'nm' ? 'selected' : '' }}>По алфавиту</option>
                        <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>Сначала новые</option>
                    </select>
                </div>
<div class="filter-group">
        <label for="category_id">Категория:</label>
        <select id="category_id" name="category_id" onchange="this.form.submit()">
            <option value="">Все категории</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
                <div class="filter-group price-range">
                    <label for="price_from">Цена от:</label>
                    <input type="number" id="price_from" name="price_from" value="{{ request('price_from') }}" placeholder="0">
                    <label for="price_to">до:</label>
                    <input type="number" id="price_to" name="price_to" value="{{ request('price_to') }}" placeholder="10000">
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">Применить</button>
                    <a href="{{ url()->current() }}" class="btn-reset">Сбросить</a>
                </div>
            </form>

            {{--  БЛОК ПОИСКА --}}
            <div class="catalog-search-wrapper">
                <form method="get" action="/search" class="search-form-inline">
                    <input type="search" 
                           class="search-input" 
                           placeholder="Найти товар..." 
                           aria-label="Search" 
                           name="search" 
                           value="{{ $query ?? '' }}" 
                           minlength="2">
                    <button type="submit" class="search-btn">
                        Найти
                    </button>
                </form>
            </div>

            {{-- Сетка товаров --}}
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card">
                        <div class="service-icon">
                           <img src="/image/products.svg" alt="иконка товаров">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-price">от {{$product->price}} руб.</p>
                            <div class="product-actions">
                                <a href="{{ url('/view/add/' . $product->id) }}" class="btn-cart" data-product-id="{{ $product->id }}">В корзину</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>Товары не найдены. Попробуйте изменить параметры фильтра или поиска.</p>
                    </div>
                @endforelse
            </div>

            @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="pagination-wrapper">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection