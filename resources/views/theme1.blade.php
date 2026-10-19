@include('partials.yandex-metrika')
<!DOCTYPE html>
<html lang="ru">

<head>
    {{--    <link rel="stylesheet" href="{{asset('css/style.css')}}">--}}
   
    <link rel="stylesheet" href="{{asset('css/register_style.css?v=' . time()) }}">
      <link rel="icon" type="image/webp" href="{{ asset('image/logo.webp') }}">
<link rel="preload" href="{{ asset('css/bootstrap/css/bootstrap.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>

    {{-- 🎨 Стили прелоадера --}}
    <style>
        #preloader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.4s ease, visibility 0.4s ease;
            pointer-events: none;
        }
        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }
        .loader-content {
            text-align: center;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .loader-text {
            margin-top: 16px;
            color: #809270;
            font-size: 15px;
            font-weight: 500;
            animation: pulse 1.4s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        @media (max-width: 480px) {
            .loader-text { font-size: 13px; }
            lottie-player { width: 100px !important; height: 100px !important; }
        }
    </style>
</head>
<main class="container">
     @include('partials.breadcrumbs')
<body>
 @if ($errors->any())
        <div class="alert alert-danger" style="
            background-color: #fee2e2;
            border: 1px solid #ef4444;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 20px 0;
            color: #991b1b;
            font-size: 14px;
        ">
            <strong style="display: block; margin-bottom: 8px; font-size: 16px;">
                ⚠️ Пожалуйста, исправьте следующие ошибки:
            </strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom: 4px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" style="
            background-color: #d1fae5;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 20px 0;
            color: #065f46;
        ">
            {{ session('success') }}
        </div>
    @endif
{{-- 🔄 ПРЕЛОАДЕР --}}
<div id="preloader">
    <div class="loader-content">
        <lottie-player
            src="{{ asset('assets/animations/Greyhound.json') }}"
            background="transparent"
            speed="1.2"
            style="width: 140px; height: 140px; margin: 0 auto;"
            loop
            autoplay>
        </lottie-player>
        <p class="loader-text">Четыре с хвостиком загружается...</p>
    </div>
</div>

<header class="site-header">
    <div class="header-container">
        <!-- Левая часть: логотип + телефон -->
        <div class="header-left">
            <a href="/" class="header-logo">
                <img src="/image/logo.webp" alt="Логотип" class="logo_img">
            </a>
            <a href="tel:+79833710005" class="header-phone">
                <span class="phone-icon"></span>
                <span class="phone-number">8 983 371 00 05</span>
            </a>
        </div>

        <!-- Гамбургер-кнопка (для мобильных) -->
        <button class="burger-btn" id="burgerToggle" aria-label="Меню">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Правая часть: навигация + кнопка -->
        <nav class="header-nav" id="headerNav">
            <ul class="nav-list">
                <li><a href="/#animal" class="a_nav">Кого лечим?</a></li>
                <li><a href="/#price_service" class="a_nav">Цены и услуги</a></li>
                <li><a href="/#location" class="a_nav">Где принимаем?</a></li>
                <li><a href="/#reviews" class="a_nav">Отзывы</a></li>
                <li><a href="/#ask" class="a_nav">Вопросы</a></li>
                <li><a href="/all-services" class="a_nav">Услуги</a></li>
                <li><a href="/products" class="a_nav">Продукты</a></li>
            </ul>

            <div class="header-auth">
                @guest
                    <a class="a_register" id="auth" href="/auth">Войти</a>
                @endguest
                @auth
                    @if(!Auth::user()->admin)
                        <a href="/view" class="a_nav cart-link">
                            &#x1F6D2; <span class="cart-count">{{ \App\services\cartService::count()['count'] }}</span>
                        </a>
                    @endif
                    <a href="/cabinet" class="a_nav">Личный кабинет</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

@yield('content')
<footer class=" site-footer">
    <div class="footer-container">
        <!-- Верхняя часть: логотип + навигация + контакты -->
        <div class="footer-top">
            <div class="footer-brand">
                <a href="/">
                <img src="/image/logo.webp" alt="Логотип" class="footer-logo"></a>
                <p class="footer-slogan">Сделаем всё, чтобы ваши хвостики были довольны</p>
            </div>

            <div class="footer-nav">
                <h4 class="footer-title">Навигация</h4>
                <ul class="footer-links">
                    <li><a href="/#animal">Кого лечим?</a></li>
                    <li><a href="/#price_service">Цены и услуги</a></li>
                    <li><a href="/#location">Где принимаем?</a></li>
                    <li><a href="/#reviews">Отзывы</a></li>
                    <li><a href="/#ask">Вопросы</a></li>
                    <li><a href="/all-services">Все услуги</a></li>
                    <li><a href="/products">Продукты</a></li>
                </ul>
            </div>

            <div class="footer-contacts">
                <h4 class="footer-title">Контакты</h4>
                <ul class="footer-contact-list">
                    <li>
                        <img src="/image/mail.webp" alt="Email" class="contact-icon">
                        <a href="mailto:vip.gruming@mail.ru">vip.gruming@mail.ru</a>
                    </li>
                    <li>
                        {{--                        <span class="contact-icon">📞</span>--}}
                        <a href="tel:+79833710005">8 983 371 00 05</a>
                    </li>
                    <li>
                        {{--                        <span class="contact-icon">📍</span>--}}
                         <span>- г. Абакан, ул. Маршала Жукова, 4 <br>- г. Абакан, ул. Стофато, 16А  <br>-  г. Абакан, ул. Некрасова, 45</span>

                    </li>
                </ul>

                <div class="footer-social">
                    <a href="https://vk.com/grumingvkhakassia" class="social-link vk" target="_blank" aria-label="ВКонтакте">
                        <img src="/image/vk.webp" alt="VK">
                    </a>
                    <a href="https://max.ru/join/wzeM0SS640k4OFI3z9fJh8oyaJlUKr1uPLz_TFcOOvM" class="social-link max" target="_blank" aria-label="MAX">
                        <img src="/image/max.webp" alt="MAX">
                    </a>
                </div>
            </div>
        </div>

        <!-- Нижняя часть: копирайт + политика -->
        <div class="footer-bottom">
            <p class="footer-copyright">© 2026 «Четыре с хвостиком». Все права защищены.</p>
            <a href="/privacy" class="footer-policy">Политика обработки персональных данных</a>
        </div>
    </div>
</footer>
<script src="{{ asset('js/script.js?v=' . time()) }}"></script>

{{-- 📜 Скрипт скрытия прелоадера --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const preloader = document.getElementById('preloader');

        // Скрываем после полной загрузки страницы
        window.addEventListener('load', () => {
            setTimeout(() => {
                preloader.classList.add('hidden');
            }, 300);
        });

        // Fallback: если load не сработал за 5 сек — скрываем принудительно
        setTimeout(() => {
            if (preloader && !preloader.classList.contains('hidden')) {
                preloader.classList.add('hidden');
            }
        }, 5000);
    });
</script>

</body>
</html>