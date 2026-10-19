@extends('themeIndex')
@section('title')
    <title>Корзина</title>
@endsection

@section('content')
    <section class="cart-section">
        <div class="container">

            <div class="cart-header">
                <h1 class="cart-title">Корзина</h1>
                <a href="{{ url('/products') }}" class="btn-back">← Вернуться к покупкам</a>
            </div>

            @if($views && count($views) > 0)

                <div class="cart-table-wrapper">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($views as $view)
                            <tr class="cart-item" data-product-id="{{ $view->id }}">
                                <td class="item-info">
                                    <div class="item-image">
                                        {{-- Заглушка или реальное фото --}}
                                        @if($view->image)
                                            <img src="{{ asset('storage/' . $view->image) }}" alt="{{ $view->name }}">
                                        @else
                                            <span class="image-placeholder">📦</span>
                                        @endif
                                    </div>
                                    <span class="item-name">{{ $view->name }}</span>
                                </td>
                                <td class="item-price">{{ number_format($view->price, 0, ',', ' ') }} ₽</td>
                                <td class="item-quantity">
                                    <div class="quantity-control">
                                        <form action="{{ route('cart.minus', $view->id) }}" method="POST" class="qty-form">
                                            @csrf
                                            <button type="submit" class="qty-btn qty-minus">−</button>
                                        </form>
                                        <span class="qty-value" id="qty-{{ $view->id }}">{{ $view->pivot->quantity }}</span>
                                        <form action="{{ route('cart.plus', $view->id) }}" method="POST" class="qty-form">
                                            @csrf
                                            <button type="submit" class="qty-btn qty-plus">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="item-total">
                                    {{ number_format($view->price * $view->pivot->quantity, 0, ',', ' ') }} ₽
                                </td>
                                <td class="item-actions">
                                    <form action="{{ route('cart.delete', $view->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        <button type="submit" class="btn-delete" title="Удалить">×</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="cart-cards">
                    @foreach($views as $view)
                        <div class="cart-card" data-product-id="{{ $view->id }}">
                            <div class="cart-card-header">
                                <div class="item-image">
                                    @if($view->image)
                                        <img src="{{ asset('storage/' . $view->image) }}" alt="{{ $view->name }}">
                                    @else
                                        <span class="image-placeholder">📦</span>
                                    @endif
                                </div>
                                <button class="btn-delete-mobile" form="delete-form-{{ $view->id }}">×</button>
                            </div>
                            <div class="cart-card-body">
                                <h3 class="item-name">{{ $view->name }}</h3>
                                <p class="item-price">{{ number_format($view->price, 0, ',', ' ') }} ₽</p>

                                <div class="quantity-control">
                                    <form action="{{ route('cart.minus', $view->id) }}" method="POST" class="qty-form">
                                        @csrf
                                        <button type="submit" class="qty-btn qty-minus">−</button>
                                    </form>
                                    <span class="qty-value">{{ $view->pivot->quantity }}</span>
                                    <form action="{{ route('cart.plus', $view->id) }}" method="POST" class="qty-form">
                                        @csrf
                                        <button type="submit" class="qty-btn qty-plus">+</button>
                                    </form>
                                </div>

                                <p class="item-total">Итого: <strong>{{ number_format($view->price * $view->pivot->quantity, 0, ',', ' ') }} ₽</strong></p>
                            </div>


                            <form id="delete-form-{{ $view->id }}" action="{{ route('cart.delete', $view->id) }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Итого и действия --}}
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Сумма товаров:</span>
                        <span class="summary-total" id="cart-total">{{ number_format(\App\services\cartService::count()['sum'], 0, ',', ' ') }} ₽</span>
                    </div>

                    <div class="summary-actions">
                        <form action="{{ route('cart.clear') }}" method="POST" class="clear-form">
                            @csrf
                            <button type="submit" class="btn-clear" onclick="return confirm('Очистить всю корзину?')">
                                 Очистить корзину
                            </button>
                            
                        </form>
                          <a href="{{ url('/cart/order') }}" class="btn-checkout">
                            Оформить заказ 
                        </a>
                      
                    </div>
                </div>

            @else
                {{-- Пустая корзина --}}
                <div class="empty-cart">
                    <div class="empty-icon"></div>
                    <h3>Ваша корзина пуста</h3>
                    <p>Добавьте товары, чтобы оформить заказ</p>
                    <a href="{{ url('/products') }}" class="btn-back" id="btn-view">Перейти к покупкам</a>
                </div>
            @endif
        </div>
    </section>

    <script src="{{ asset('js/script.js') }}"></script>
@endsection