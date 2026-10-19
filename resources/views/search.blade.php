@extends('themeIndex')
@section('title')

@endsection
@section('content')
    <h1 style="text-align: center; padding: 5px">Поиск: {{$result->count()}}</h1>
    <div class="products-grid">
        @forelse($result as $product)
            <div class="product-card">
                <div class="product-image-placeholder">
                    <span>📦</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-price"> от {{ $product->price}} руб.</p>
                    <div class="product-actions">
                        <a href="{{ url('/view/add/' . $product->id) }}" class="btn-cart" data-product-id="{{ $product->id }}">В корзину</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>Товары не найдены. Попробуйте изменить параметры фильтра.</p>
            </div>
        @endforelse
    </div>
@endsection