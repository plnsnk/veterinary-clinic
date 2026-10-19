@extends('theme')
@section('content')

            <nav class="nav_personal">
                <a href="/cabinet" class="account_nav">Обзор</a>
                <a href="/animal" class="account_nav">Животное</a>
                <a href="/reviews" id="actively" class="account_nav">Отзывы</a>
                <a href="/asks" class="account_nav">Вопросы</a>
                <a href="/orders" class="account_nav">Заказы</a>
            </nav>
        <section id="feedback_account" class="container">
            <h1 class="h1_visiting">
                Кол-во: {{ $reviews->count() }}
                <a class="a_button a_button_inline" href="{{ url('/formReview') }}">&plus;</a>
            </h1>
            @if($reviews->count() > 0)
                <div class="cards">
                    @foreach($reviews as $review)
                        <div class="card-animals">
                            <div class="content">
                                <div class="feedback_text">
                                    <!-- Рейтинг -->
                                    <div class="stars">
                                        <p>
                                            Оценка:
                                            <span>
                                    @for ($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->estimation)
                                                        &#9733;
                                                    @else
                                                        <span style="color:#e5e7eb">&#9733;</span>
                                                    @endif
                                                @endfor
                                </span>
                                        </p>
                                    </div>

                                    <!-- Текст -->
                                    <p class="text_card">{{ $review->text }}</p>

                                    <!-- Автор и дата -->
                                    <div class="review-meta">
                                        Автор: {{ $review->user->login ?? 'Аноним' }} |
                                        {{ $review->created_at->format('d.m.Y') }}
                                    </div>
                                </div>

                                <!-- Фото -->
                                <div class="half" style="display: flex;justify-content: center">
                                    @if($review->photo_path)
                                        <img src="{{ asset($review->photo_path) }}"
                                             alt="Фото отзыва"
                                             class="review-photo"
                                             style="max-width: 150px; border-radius: 10px; ">
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-state-message">У вас пока нет отзывов. Напишите первый! 🐾</p>
            @endif
        </section>
@endsection