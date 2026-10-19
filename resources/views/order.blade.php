@extends('themeIndex')
@section('title')
    <title>Оформление заказа</title>
@endsection

@section('content')
    <section class="checkout-section">
        <div class="container">
            {{-- Заголовок и навигация --}}
            <div class="checkout-header">
                <h1 class="checkout-title">Оформление заказа</h1>
                <a href="{{ url('/cart') }}" class="btn-back">Вернуться в корзину</a>
            </div>

            <div class="checkout-grid">
                {{-- Левая колонка: форма --}}
                <div class="checkout-form-wrapper">
                    <form method="POST" action="{{ url('/create') }}" class="checkout-form" enctype="multipart/form-data">
                        @csrf

                        {{-- Ошибки валидации --}}
                        @if($errors->any())
                            <div class="form-errors">
                                <p>⚠ Пожалуйста, исправьте ошибки:</p>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Имя --}}
                        <div class="form-group">
                            <label for="name">Имя *</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', Auth::user()->name ?? Auth::user()->login) }}"
                                   placeholder="Ваше имя" required>
                        </div>

                        {{-- Телефон --}}
                        <div class="form-group">
                            <label for="phone">Телефон *</label>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone', Auth::user()->phone) }}"
                                   placeholder="+7 (___) ___-__-__" required>
                        </div>

                        {{-- Адрес --}}
                        <div class="form-group">
                            <label for="address">Адрес доставки *</label>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address') }}"
                                   placeholder="г. Абакан, ул. Примерная, д. 1, кв. 1" required>
                        </div>

                        {{-- Комментарий --}}
                        <div class="form-group">
                            <label for="comment">Комментарий к заказу</label>
                            <textarea id="comment" name="comment" rows="3"
                                      placeholder="Например: позвонить за 10 минут до доставки">{{ old('comment') }}</textarea>
                        </div>

                        {{-- Скрытое поле суммы --}}
                        <input type="hidden" name="sum" value="{{ \App\services\cartService::count()['sum'] }}">
  <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
                        {{-- Кнопка отправки --}}
                        <button type="submit" class="btn-submit">
                            Оформить заказ - {{ number_format(\App\services\cartService::count()['sum'], 0, ',', ' ') }} ₽
                        </button>

                        <!--<p class="form-note">Нажимая кнопку, вы соглашаетесь с <a href="/privacy">условиями обработки данных</a></p>-->
                    </form>
                </div>

                {{-- Правая колонка: состав заказа --}}
                <div class="order-summary">
                    <h2 class="summary-title">Ваш заказ</h2>

                    <div class="summary-items">
                        @if(isset($views) && count($views) > 0)
                            @foreach($views as $item)
                                <div class="summary-item">
                                    <div class="summary-item-info">
                                        <span class="summary-item-name">{{ $item->name }}</span>
                                        <span class="summary-item-qty">× {{ $item->pivot->quantity }} шт</span>
                                    </div>
                                    <span class="summary-item-price">
                                {{ number_format($item->price * $item->pivot->quantity, 0, ',', ' ') }} ₽
                            </span>
                                </div>
                            @endforeach
                        @else
                            <p class="summary-empty">Корзина пуста</p>
                        @endif
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total-row">
                        <span>Итого:</span>
                        <span class="summary-total">{{ number_format(\App\services\cartService::count()['sum'], 0, ',', ' ') }} ₽</span>
                    </div>

                    <div class="summary-delivery">
                        <span>Доставка:</span>
                        <span class="delivery-price">бесплатно</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection