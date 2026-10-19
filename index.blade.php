<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
{{--    <link rel="stylesheet" href="css/register_style.css">--}}
{{--    <link rel="stylesheet" href="css/styleAccount.css">--}}
    <title>Четыре с хвостиком</title>
</head>
<body> <header class="container">

    <nav>
        <a href="#animal" class="a_nav">Кого лечим?</a>
        <a href="#price_service" class="a_nav">Цены и услуги</a>
        <a href="#location" class="a_nav">Где принимаем?</a>
        <a href="#reviews" class="a_nav">Отзывы</a>
        <a href="#ask" class="a_nav">Вопросы</a>
        <a href="/categories" class="a_nav">Категории</a>
        <a href="/products" class="a_nav">Продукты</a>
    </nav>
    <div class="block_right">
        @guest
        <a class="a_register" href="/auth">Войти</a>
        @endguest
            @auth
                @if(!Auth::user()->admin)
               <a href="/view" class="nav-link">Корзина <span class="cart-count"> {{\App\services\cartService::count()['count']}} </span></a>
                @endif
                    <a href="/cabinet" class="nav-link">Личный кабинет</a>
{{--                    <a href="/logout" class="nav-link">Выйти</a>--}}
            @endauth
        <a href="/cabinet"><img src="image/logo.png" alt="логотип" class="logo_img"></a>
    </div>

</header>

    <main class="container">
        <section id="banner">
            <img class="image_banner" src="image/dog.png" alt="собака">
                <p class="p1_banner">Добро пожаловать в <br> ветеринарную<br> клинику "Четыре с <br> хвостиком"! </p>
                <p class="p2_banner">Мы предлагаем спектр<br> ветеринарных и грумерских <br> услуг для обеспечения<br>
                    благополучия ваших домашних<br>животных</p>
                <a class="a_register" id="record" href="https://n2117070.yclients.com">Записаться на услугу</a>
        </section>

        <section id="animal">
            <h1 class="h1_animals">Животные, которых мы лечим</h1>
            <div class="animals">
                <a href="/animal/dogs">
                    <div class="card_animal">
                        <div class="dog">
                            <img id="dog_animal" src="image/dog_animal.png" alt="Собака">
                        </div>
                        <p class="p_animal" id="p_dog">Собак</p>
                    </div>
                </a>
                <a href="/animal/cats">
                    <div class="card_animal">
                        <div class="cat">
                            <img id="cat_animal" src="image/cat_animal.png" alt="Кошка">
                        </div>
                        <p class="p_animal" id="p_cat">Кошек</p>
                    </div>
                </a>
                <a href="/animal/rabbit">
                    <div class="card_animal">
                        <div class="rabbit">
                            <img id="rabbit_animal" src="image/rabbit_animal.png" alt="Кролик">
                        </div>
                        <p class="p_animal" id="p_rabbit">Кроликов</p>
                    </div>
                </a>
                <a href="/animal/parrot">
                    <div class="card_animal">
                        <div class="parrot">
                            <img id="parrot_animal" src="image/parrot_animal.png" alt="Попугай">
                        </div>
                        <p class="p_animal" id="p_parrot">Попугаев</p>
                    </div>
                </a>
                <a href="/animal/guinea_pigs">
                    <div class="card_animal">
                        <div class="guinea_pigs">
                            <img id="guinea_pigs_animal" src="image/guinea_pigs_animal.png" alt="Морская свинка">
                        </div>
                        <p class="p_animal" id="p_guinea_pigs">Морская свинка</p>
                    </div>
                </a>
            </div>
        </section>

        <section id="price_service">
            <h1>Услуги</h1>
            <div class="price_service">
                <div class="card_vertically" id="card_one">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_vertically" id="card_two">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_vertically" id="card_three">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_vertically" id="card_four">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_horizontally" id="card_five">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_vertically" id="card_six">
                    <p>1500 руб</p>
                    <p class="name_service">Название</p>
                </div>
                <div class="card_vertically" id="card_seven">
                    <p id="p_service">Смотреть все услуги</p>
                    <img id="icon" src="image/icon.png" alt="стрелочка">
                </div>
            </div>
        </section>


        <section id="location">
            <h1 class="h1_dark_green">Место приема врача</h1>
            <div class="line">
                <div class="img_location">
                    <iframe
                        src="https://yandex.ru/map-widget/v1/?ll=91.432851%2C53.709454&mode=search&z=14&pt=91.402358,53.699179,pm2dgl~91.463345,53.719729,pm2dgl"
                        width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;">
                    </iframe>
                </div>
                <div class="half">
                    <h4 class="h4_location">Наши адреса:</h4>
                    <ul>
                        @foreach($branches as $branch)
                            <li>- {{$branch->address}}</li>
                        @endforeach
                    </ul>
                    <h4 class="h4_location">Выезд врача на дом:</h4>
                    <ul>
                        <li>- По городу Абакан: 1000 рублей</li>
                        <li>- За пределами города: 1500 рублей. <br> По предварительной договоренности возможен <br>
                            выезд в другие населенные пункты</li>
                    </ul>
                    <p> с 10:00 до 20:00</p>
                </div>
            </div>
            <p class="p_location">Наши опытные ветеринары всегда готовы оказать квалифицированную помощь вашим питомцам
                в любом
                удобном для вас месте. Просто свяжитесь с нами, и мы организуем визит специалиста в кратчайшие
                сроки.</p>
        </section>

        <section id="reviews">
            <h1 class="h1_reviews">Отзывы</h1>
            <div class="card_center">
                <div class="slider">
                    <div class="card-container">
                        @forelse($reviews as $review)
                            @php

                                $authorPhoto = ($review->user && $review->user->photo_path)
                                    ? 'storage/' . $review->user->photo_path
                                    : 'image/r.webp';

                                $animalPhoto = $review->photo_path
                                    ? $review->photo_path
                                    : 'image/c.webp';
                            @endphp
                            <div class="card">
                                {{-- Левая часть: автор + текст --}}
                                <div class="card-left">
                                    <div class="author-row">
                                        <img class="photo" src="{{ asset($authorPhoto) }}" alt="Фото автора">
                                        <span class="name">{{ $review->user->name ?? 'Аноним' }}</span>
                                    </div>

                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star">{{ $i <= $review->estimation ? '🐶' : '' }}</span>
                                        @endfor
                                    </div>

                                    <p class="text_card">{{ Str::limit($review->text, 150) }}</p>
                                </div>

                                <div class="card-right">
                                    <img src="{{ asset($animalPhoto) }}" class="dogs" alt="Фото питомца">
                                </div>
                            </div>

                        @empty
                            {{-- Заглушка, если одобренных отзывов нет --}}
                            <div class="card">
                                <div class="content">
                                    <div class="info">
                                        <img class="photo" src="image/r.webp" alt="Заглушка">
                                        <div class="rating">
                                            <div class="name">Пока нет отзывов</div>
                                            <div class="stars">
                                                <span class="star">🐶</span>
                                                <span class="star">🐶</span>
                                                <span class="star">🐶</span>
                                                <span class="star">🐶</span>
                                                <span class="star">🐶</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text_card">Будьте первым — оставьте отзыв!</p>
                                </div>
                                <div class="reviewer-avatar">
                                    <img src="image/c.webp" class="dogs" alt="Заглушка">
                                </div>
                            </div>
                        @endforelse

                    </div>
                    <button class="prev-btn">&#8249;</button>
                    <button class="next-btn">&#8250;</button>
                </div>
            </div>
        </section>
        <section id="ask">
            <div class="faq">
                <h1 class="h1_dark_green1">Часто задаваемые вопросы</h1>
                @foreach($questions as $question)
                <div class="faq-item">
                    <button class="faq-question">{{$question->question}}<span class="arrow">⇓</span></button>
                    <div class="faq-answer">
                        <p>{{$question->answer}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer class="container">
        <div class="block_left">
            <img src="image/logo.png" alt="Логотип" class="logo_img_footer">
        </div>
        <div>
            <h4 class="h4_footer">Четыре с хвостиком</h4>
            <p class="p_footer">Кого лечим <br> Цены и услуги<br> Отзывы<br> Частые вопросы FAQ</p>
        </div>
        <div>
            <h4 class="h4_footer">Поддержка</h4>
            <p class="p_footer">Техническая поддержка<br> Цент управления данными<br> Пользовательское соглашение<br>
                Политика обработки персональных данных</p>
        </div>
    </footer>
<script type="text/javascript" src="https://w2117070.yclients.com/widgetJS" charset="UTF-8"></script>

    <script src="../js/script.js"></script>
</body>

</html>