@include('partials.yandex-metrika')
<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Ветеринарная клиника «Четыре с хвостиком» в Абакане | Лечение, груминг, вакцинация</title>
    
  
    
   <link rel="icon" type="image/webp" href="{{ asset('image/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/logo.webp') }}">
    <link rel="sitemap" type="application/xml" href="/sitemap.xml">
    
    {{-- Мета-теги для поисковых систем --}}
    <meta name="description" content="Профессиональная ветеринарная помощь в Абакане: терапия, хирургия, груминг, вакцинация, выезд врача на дом. Онлайн-запись, доступные цены, забота о ваших питомцах.">
    <meta name="keywords" content="ветеринар Абакан, ветклиника Абакан, груминг Абакан, лечение животных, вакцинация, вызов ветеринара на дом, зоотовары">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Ветеринарный центр «Четыре с хвостиком»">
    
    {{-- Open Graph: разметка для социальных сетей --}}
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Ветеринарная клиника «Четыре с хвостиком» в Абакане">
    <meta property="og:description" content="Полный спектр ветеринарных и грумерских услуг. Выезд на дом, онлайн-запись, зоотовары. Забота и профессионализм для ваших питомцев.">
    <meta property="og:site_name" content="Четыре с хвостиком">
    <meta property="og:image" content="{{ asset('image/dog.webp') }}">
    <meta property="og:image:secure_url" content="{{ asset('image/dog.webp') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    {{-- Twitter Card для мессенджеров --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ветеринарная клиника «Четыре с хвостиком» в Абакане">
    <meta name="twitter:description" content="Профессиональная ветеринарная помощь: терапия, груминг, вакцинация, выезд на дом.">
    <meta name="twitter:image" content="{{ asset('image/dog.webp') }}">
    
    {{-- Карта сайта --}}
    <link rel="sitemap" type="application/xml" href="/sitemap.xml">
    
    {{-- Стили и скрипты --}}
 <link rel="preload" href="{{ asset('css/bootstrap/css/bootstrap.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('css/style2.css?v=' . time()) }}">
    
    {{-- Оптимизация загрузки внешних ресурсов --}}
    <link rel="preconnect" href="https://unpkg.com" crossorigin>
    <link rel="preconnect" href="https://yandex.ru" crossorigin>
    <link rel="dns-prefetch" href="https://vk.com">
    <link rel="dns-prefetch" href="https://max.ru">
    

    
    {{-- Анимация загрузки --}}
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
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
<body> <div id="preloader">
    <div class="loader-content">
        <lottie-player
            src="{{ asset('/assets/animations/Greyhound.json') }}"
            background="transparent"
            speed="1.2"
            style="width: 140px; height: 140px; margin: 0 auto;"
            loop
            autoplay>
        </lottie-player>
        <p class="loader-text">Четыре с хвостиком загружается...</p>
    </div>
</div>
<header class="site-header m-0" >
    <div class="header-container">
        <!-- Левая часть: логотип + телефон -->
        <div class="header-left">
            <a href="/" class="header-logo">
                <img src="/image/logo.webp" alt="Логотип" class="logo_img">
            </a>
            <a href="tel:+79833710005" class="header-phone">
{{--                <span class="phone-icon"></span>--}}
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
                <li><a href="#animal" class="a_nav">Кого лечим?</a></li>
                <li><a href="#price_service" class="a_nav">Цены и услуги</a></li>
                <li><a href="#location" class="a_nav">Где принимаем?</a></li>
                <li><a href="#reviews" class="a_nav">Отзывы</a></li>
                <li><a href="#ask" class="a_nav">Вопросы</a></li>
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
 @include('partials.breadcrumbs')
 
<section id="banner" class="hero-banner">
    <div class="banner-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <div class="container banner-container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 banner-content">
                <div class="banner-badge">
                    <span>Работаем с 2015 года</span>
                </div>
                
                <h1 class="banner-title">
                    Добро пожаловать в <br>
                    <span class="title-highlight">ветеринарную клинику</span><br>
                    "Четыре с хвостиком"!
                </h1>
                
                <p class="banner-subtitle">
                    Мы предлагаем полный спектр ветеринарных и грумерских услуг 
                    для обеспечения благополучия ваших любимых питомцев
                </p>
                
                <!-- Сначала кнопки -->
                <div class="banner-buttons">
                    <a class="btn-banner-primary" id="openRecordModal">
                        <span>Записаться на приём</span>
                    </a>
                    <a href="tel:+79833710005" class="btn-banner-secondary">
                        <span>8 983 371 00 05</span>
                    </a>
                </div>
                
                <!-- Потом преимущества -->
                <div class="banner-features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Опытные врачи</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Современное оборудование</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Выезд на дом</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12 banner-image-wrapper">
                <div class="image-decoration">
                    <div class="decor-circle decor-1"></div>
                    <div class="decor-circle decor-2"></div>
                    <div class="decor-circle decor-3"></div>
                </div>
                <div class="banner-image-container">
                    <img class="image_banner" src="/image/dog.png" alt="собака">
                    <div class="image-overlay"></div>
                </div>
                
                <!-- Плавающие элементы -->
                <div class="floating-card floating-card-1">
                   <span class="card-text">3 филиала</span>
                </div>
                <div class="floating-card floating-card-2">
                   <span class="card-text">4.9 рейтинг</span>
                </div>
            </div>
        </div>
    </div>
</section>
    <section id="animal">
        <h1 class="h1_animals">Животные, которых мы лечим</h1>
        <div class="animals">
            <a href="/animal/dogs">
                <div class="card_animal">
                    <div class="dog">
                        <img id="dog_animal" loading="lazy" src="image/dog_animal.webp" alt="Собака">
                    </div>
                    <p class="p_animal" id="p_dog">Собак</p>
                </div>
            </a>
            <a href="/animal/cats">
                <div class="card_animal">
                    <div class="cat">
                        <img id="cat_animal" src="image/cat_animal.webp" loading="lazy" alt="Кошка">
                    </div>
                    <p class="p_animal" id="p_cat">Кошек</p>
                </div>
            </a>
            <a href="/animal/rabbit">
                <div class="card_animal">
                    <div class="rabbit">
                        <img id="rabbit_animal" src="image/rabbit_animal.webp" loading="lazy" alt="Кролик">
                    </div>
                    <p class="p_animal" id="p_rabbit">Кроликов</p>
                </div>
            </a>
            <a href="/animal/parrot">
                <div class="card_animal">
                    <div class="parrot">
                        <img id="parrot_animal" src="image/parrot_animal.webp" loading="lazy" alt="Попугай">
                    </div>
                    <p class="p_animal" id="p_parrot">Попугаев</p>
                </div>
            </a>
            <a href="/animal/guinea_pigs">
                <div class="card_animal">
                    <div class="guinea_pigs">
                        <img id="guinea_pigs_animal" loading="lazy" src="image/guinea_pigs_animal.webp" alt="Морская свинка">
                    </div>
                    <p class="p_animal" id="p_guinea_pigs">Морских свинок</p>
                </div>
            </a>
        </div>
    </section>
    <section id="price_service">
        <h1>Услуги</h1>
        <div class="price_service">
            <!-- Карточка 1 -->
            <div class="card_vertically" id="card_one" onclick="location.href='/service/4';" style="cursor: pointer;">
                <p>800 руб</p>
                <p class="name_service">Прием</p>
            </div>

            <!-- Карточка 2 -->
            <div class="card_vertically" id="card_two" onclick="location.href='/service/3';" style="cursor: pointer;">
                <p>900 руб</p>
                <p class="name_service">Вакцинация</p>
            </div>

            <!-- Карточка 3 -->
            <div class="card_vertically" id="card_three" onclick="location.href='/service/1';" style="cursor: pointer;">
                <p>1500 руб</p>
                <p class="name_service">Кастрация</p>
            </div>

            <!-- Карточка 4 -->
            <div class="card_vertically" id="card_four" onclick="location.href='/service/2';" style="cursor: pointer;">
                <p>1500 руб</p>
                <p class="name_service">Стерилизация</p>
            </div>

            <!-- Карточка 5 -->
            <div class="card_horizontally" id="card_five" onclick="location.href='/service/6';" style="cursor: pointer;">
                <p>300 руб</p>
                <p class="name_service">Стрижка ногтей</p>
            </div>

            <!-- Карточка 6 -->
            <div class="card_vertically" id="card_six" onclick="location.href='/service/5';" style="cursor: pointer;">
                <p>1800 руб</p>
                <p class="name_service">Вычес</p>
            </div>

            <!-- Карточка 7 (Все услуги) -->
            <div class="card_vertically" id="card_seven" onclick="location.href='/all-services';" style="cursor: pointer;">
                <p id="p_service">Смотреть все услуги</p>
                <img id="icon" src="image/icon.webp" loading="lazy" alt="стрелочка">
            </div>
        </div>
    </section>



    <section id="location">
        <h1 class="h1_dark_green">Место приема врача</h1>
        <div class="row align-items-start">
            <div class="col-lg-7 col-md-12 mb-4 mb-md-0">
                <div class="map-wrapper">
                   <iframe
                        src="https://yandex.ru/map-widget/v1/?ll=91.432851%2C53.709454&z=13&pt=91.463345%2C53.719729%2Cpm2dgl~91.402358%2C53.699179%2Cpm2dgl~91.414081%2C53.729926%2Cpm2dgl"
                       width="100%" height="500" frameborder="0" allowfullscreen="true"    title="Карта филиалов ветеринарной клиники" loading="lazy" style="border-radius: 20px;">
                    </iframe>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="location-info">
                    <h4 class="h4_location">Наши адреса:</h4>
                    <ul>
                        @foreach($branches as $branch)
                            <li>- {{$branch->address}}</li>
                        @endforeach
                    </ul>
                    <h4 class="h4_location">Выезд врача на дом:</h4>
                    <ul>
                        <li>- По городу Абакан: 1000 рублей</li>
                        <li>- За пределами города: 1500 рублей.</li>
                        <li>По предварительной договоренности возможен выезд в другие населенные пункты</li>
                    </ul>
                    <p class="work-hours">с 10:00 до 20:00</p>
                </div>
            </div>
        </div>
        <p class="p_location">Наши опытные ветеринары всегда готовы оказать квалифицированную помощь вашим питомцам
            в любом удобном для вас месте. Просто свяжитесь с нами, и мы организуем визит специалиста в кратчайшие сроки.</p>
    </section>
<section id="reviews" class="container">
        <h1 class="h1_reviews">Отзывы</h1>
        <div class="card_center">
            <div class="slider">
                <div class="card-container">
                    @foreach($reviews as $review)
    @php
        //  ФОТО АВТОРА (пользователя)
        if ($review->user && $review->user->photo_path) {
            // Путь в БД: storage/app/public/user_photos/filename.jpg
            $authorPhoto = asset($review->user->photo_path);
        } else {
            $authorPhoto = asset('image/r.webp'); // Заглушка
        }
        
        //  ФОТО ПИТОМЦА (из отзыва)
        if ($review->photo_path) {
            // Путь в БД: storage/app/public/reviews/filename.jpg
            $animalPhoto = asset($review->photo_path);
        } else {
            $animalPhoto = asset('image/c.webp'); // Заглушка
        }
    @endphp

    <div class="card">
        <div class="card-left">
            <div class="author-row">
                {{-- Фото автора --}}
                <img class="photo" src="{{ $authorPhoto }}" alt="{{ $review->user->name ?? 'Аноним' }}" loading="lazy">
                
                <div class="name-rating">
                    <span class="name">{{ $review->user->name ?? 'Аноним' }}</span>
                    
                    {{-- Звёзды --}}
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <img loading="lazy" src="{{ asset('/image/star.svg') }}" 
                                 alt="star" 
                                 class="star {{ $i <= $review->estimation ? 'filled' : '' }}">
                        @endfor
                    </div>
                </div>
            </div>
            
            {{-- Текст отзыва --}}
            <p class="text_card">{{ Str::limit($review->text, 200) }}</p>
        </div>
        
        {{-- Фото питомца --}}
        <div class="card-right">
            <img loading="lazy" src="{{ $animalPhoto }}" class="dogs" alt="Фото питомца">
        </div>
    </div>
@endforeach
                </div>


                <!-- Точки будут созданы автоматически через JS -->
            </div>
        </div>
    </section>
    <section id="ask">
        <div class="faq">
            <h1 class="h1_dark_green">Часто задаваемые вопросы</h1>
            @foreach($questions as $question)
                <div class="faq-item">
                    <button class="faq-question" id="button">{{$question->question}}<span class="arrow">⇓</span></button>
                    <div class="faq-answer">
                        <p>{{$question->answer}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
<!-- Модальное окно записи -->
<div id="recordModal" class="modal-overlay" hidden>
    <div class="modal-content">
        <button class="modal-close" id="closeRecordModal" aria-label="Закрыть">&times;</button>
        
        <div class="modal-body">
            <h3 class="modal-title">Записаться на услугу</h3>
            
            <p class="modal-text">
                Вы можете записаться, позвонив нам или написав на почту:
            </p>
            
            <div class="modal-contacts">
                <a href="tel:89833710005" class="contact-link email">
                     8 (983) 371-00-05
                </a>
                <a href="mailto:vip.gruming@mail.ru" class="contact-link email">
                     vip.gruming@mail.ru
                </a>
            </div>
            
            <div class="modal-social1">
                <p class="social-label1">Мы в социальных сетях:</p>
                <div class="footer-social1">
                    <a href="https://vk.com/grumingvkhakassia" class="social-link1 vk" target="_blank" aria-label="ВКонтакте">
                        <img loading="lazy" src="/image/vk.webp" alt="VK">
                    </a>
                    <a href="https://max.ru/join/wzeM0SS640k4OFI3z9fJh8oyaJlUKr1uPLz_TFcOOvM" class="social-link1 max" target="_blank" aria-label="MAX">
                        <img loading="lazy" src="/image/max.webp" alt="MAX">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="site-footer">
    <div class="footer-container">
          <div class="footer-top">
            <div class="footer-brand">
                <a href="/">
                <img src="image/logo.webp"  loading="lazy" alt="Логотип" class="footer-logo"></a>
                <p class="footer-slogan">Сделаем всё, чтобы ваши хвостики были довольны</p>
            </div>

            <div class="footer-nav">
                <h4 class="footer-title">Навигация</h4>
                <ul class="footer-links">
                    <li><a href="#animal">Кого лечим?</a></li>
                    <li><a href="#price_service">Цены и услуги</a></li>
                    <li><a href="#location">Где принимаем?</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                    <li><a href="#ask">Вопросы</a></li>
                    <li><a href="/all-services">Все услуги</a></li>
                    <li><a href="/products">Продукты</a></li>
                </ul>
            </div>

            <div class="footer-contacts">
                <h4 class="footer-title">Контакты</h4>
                <ul class="footer-contact-list">
                    <li>
                        <img loading="lazy" src="/image/mail.webp" alt="Email" class="contact-icon">
                        <a href="mailto:vip.gruming@mail.ru">vip.gruming@mail.ru</a>
                    </li>
                    <li>
{{--                        <span class="contact-icon">📞</span>--}}
                        <a href="tel:+79833710005">8 983 371 00 05</a>
                    </li>
                    <li>

                        <span>- г. Абакан, ул. Маршала Жукова, 4 <br>- г. Абакан, ул. Стофато, 16А  <br>-  г. Абакан, ул. Некрасова, 45</span>

                    </li>
                </ul>

                <div class="footer-social">
                    <a href="https://vk.com/grumingvkhakassia" class="social-link vk" target="_blank" aria-label="ВКонтакте">
                        <img loading="lazy" src="/image/vk.webp" alt="VK">
                    </a>
                    <a href="https://max.ru/join/wzeM0SS640k4OFI3z9fJh8oyaJlUKr1uPLz_TFcOOvM" class="social-link max" target="_blank" aria-label="MAX">
                        <img loading="lazy" src="/image/max.webp" alt="MAX">
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

<div id="cookie-banner" class="cookie-banner" hidden>
    <div class="cookie-content">
        <p class="cookie-text">
            Мы используем файлы cookie для улучшения работы сайта и анализа трафика. 
            Продолжая использовать сайт, вы соглашаетесь с 
            <a href="/privacy" class="cookie-link">Политикой обработки персональных данных</a>.
        </p>
        <button id="cookie-accept" class="cookie-btn">Принять</button>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('paw-cursor');
    if (!container) return;

    // Путь к лапке (укажи свой, если отличается)
    const pawSrc = '/image/star.svg'; 
    
    let lastTime = 0;
    const delay = 120;

    document.addEventListener('mousemove', function(e) {
        const now = Date.now();
        if (now - lastTime < delay) return;
        lastTime = now;

        const img = document.createElement('img');
        img.src = pawSrc;
        img.className = 'paw-print';
        img.style.left = e.clientX + 'px';
        img.style.top = e.clientY + 'px';
        img.style.transform = `translate(-50%, -50%) rotate(${Math.random() * 30 - 15}deg)`;
        
        // Если картинка не загрузилась → скрываем, чтобы не было "битых" иконок
        img.onerror = () => img.remove();
        
        container.appendChild(img);
        setTimeout(() => img.remove(), 900);
    });
});
</script>


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
<script src="{{ asset('js/script.js?v=' . time()) }}" defer></script>
<script>
// ===== FAQ 
document.addEventListener('DOMContentLoaded', function() {
    // Ищем вопросы ТОЛЬКО в секции #ask на главной
    const faqSection = document.getElementById('ask');
    if (!faqSection) return;
    
    const questions = faqSection.querySelectorAll('.faq-question');
    
    questions.forEach(question => {
        // Функция переключения
        const toggle = (e) => {
            e?.preventDefault?.();
            
            question.classList.toggle('active');
            const answer = question.nextElementSibling;
            
            if (question.classList.contains('active')) {
                // Небольшая задержка для гарантии расчёта высоты
                setTimeout(() => {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    answer.style.padding = "15px 20px";
                }, 10);
            } else {
                answer.style.maxHeight = "0";
                answer.style.padding = "0 20px";
            }
        };
        
        // Слушаем и клик, и тач (для надёжности на мобильных)
        question.addEventListener('click', toggle);
        question.addEventListener('touchend', (e) => {
            e.preventDefault();
            toggle(e);
        }, {passive: true});
        
        // Важно для мобильных
        question.style.touchAction = 'manipulation';
        question.style.webkitTapHighlightColor = 'transparent';
    });
});
</script>

</body>

</html>