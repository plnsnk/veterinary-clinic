@extends('theme')
@section('title', 'Мои заказы')

@section('content')
    <nav class="nav_personal">
        <a href="/cabinet" class="account_nav">Обзор</a>
        <a href="/animal" class="account_nav">Животное</a>
        <a href="/reviews" class="account_nav">Отзывы</a>
        <a href="/asks" class="account_nav">Вопросы</a>
        <a href="/orders" class="account_nav active" id="actively">Заказы</a>
    </nav>

    <section class="orders-section">
        <div class="container">
            
            <div class="orders-header">
                <h1 class="orders-title">Мои заказы</h1>
                <div class="orders-actions">
                    <a href="{{ url('/products') }}" class="btn-secondary">Продолжить покупки</a>
                    <a href="{{ url('/view') }}" class="btn-primary">Корзина</a>
                </div>
            </div>

            @if(isset($orders) && count($orders) > 0)
                {{-- Таблица заказов — десктоп --}}
                <div class="orders-table-wrapper">
                    <table class="orders-table">
                        <thead>
                        <tr>
                            <th>№ заказа</th>
                            <th>Дата</th>
                            <th>Товары</th>
                            <th>Цена 1 шт</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="order-row">
                                <td class="order-id">{{ $order->id }}</td>
                                <td class="order-date">{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}</td>
                                <td class="order-items">
                                    @if($order->products)
                                        @foreach($order->products->take(2) as $product)
                                            <span class="order-item-name">{{ $product->name }}</span>
                                            @if($loop->remaining > 0)
                                                <span class="order-more">+{{ $loop->remaining }} ещё</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Нет данных</span>
                                    @endif
                                </td>
                                <td class="order-items">
                                    @if($order->products)
                                        @foreach($order->products->take(2) as $product)
                                            <span class="order-item-name">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                                            @if($loop->remaining > 0)
                                                <span class="order-more">+{{ $loop->remaining }} ещё</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Нет данных</span>
                                    @endif
                                </td>
                                <td class="order-total">{{ $order->sum }} руб.</td>
                                <td>
            
                                    <span class="status-badge status-{{ $order->status_id }}">
                                        @if($order->status_id == 4)
                                            Новый
                                        @elseif($order->status_id == 6)
                                            Завершен
                                        @else
                                            {{ $order->status->name ?? 'Статус неизвестен' }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Мобильные карточки --}}
                <div class="orders-cards">
                    @foreach($orders as $order)
                        <div class="order-card">
                            <div class="order-card-header">
                                <span class="order-id">Заказ {{ $order->id }}</span>
                             
                                <span class="status-badge status-{{ $order->status_id }}">
                                    @if($order->status_id == 4)
                                        Новый
                                    @elseif($order->status_id == 6)
                                        Завершен
                                    @else
                                        {{ $order->status->name ?? 'Статус неизвестен' }}
                                    @endif
                                </span>
                            </div>

                            <div class="order-card-body">
                                <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}</p>
                                <p><strong>Товары:</strong></p>
                                <ul class="order-items-list">
                                    @if($order->products)
                                        @foreach($order->products as $product)
                                            <li>{{ $product->name }} — {{ number_format($product->price, 0, ',', ' ') }} ₽</li>
                                        @endforeach
                                    @else
                                        <li class="text-muted">Нет данных</li>
                                    @endif
                                </ul>
                                <p class="order-total-mobile"><strong>Итого:</strong> {{ number_format($order->sum ?? 0, 0, ',', ' ') }} ₽</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Пагинация --}}
                @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="pagination-wrapper">
                        {{ $orders->links() }}
                    </div>
                @endif

            @else
                {{-- Пустой список заказов --}}
                <div class="empty-orders">
                    <h3>У вас пока нет заказов</h3>
                    <p>Оформите первый заказ, и он появится здесь</p>
                    <div class="empty-actions">
                        <a href="{{ url('/products') }}" class="btn-primary">Перейти к покупкам</a>
                        <a href="{{ url('/view') }}" class="btn-secondary">Открыть корзину</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection