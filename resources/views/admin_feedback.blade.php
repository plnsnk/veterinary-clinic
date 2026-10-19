@extends('themeAdmin')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav" id="actively">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
    <a href=" /admin/orders" class="account_nav">Заказы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav">Услуги</a>
        <a href="/category" class="account_nav">Категории</a>

    </nav>

    <section id="feedback_account" class="container">
        <h1 class="h1_visiting">Кол-во: {{ $reviews->count() }}</h1>

        <div class="feedback_card">
            @forelse($reviews as $review)
                <div class="card-animals" id="review-card-{{ $review->id }}">
                    <div class="content">
                        <div class="half">
                            <img src="{{ asset($review->photo_path) }}" class="dogs" alt="Фото отзыва">
                        </div>
                        <div class="feedback_text">
                            <div class="stars">
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
                            </div>
                            <p class="text_card">{{ $review->text }}</p>
                            <p class="text_card">Пользователь: {{ $review->user->name }}</p>
                            <p>Статус:
                                <span class="status-badge status-{{ $review->status_id }}" id="status-badge-{{ $review->id }}">
                            {{ $review->status->name ?? 'Неизвестно' }}
                        </span>
                            </p>
                        </div>

                        {{-- Универсальная кнопка с data-атрибутами --}}
                        <button class="a_button feedback-toggle-btn"
                                data-review-id="{{ $review->id }}"
                                data-status="{{ $review->status_id }}"
                                data-text-publish="Добавить на главную страницу"
                                data-text-unpublish=" Убрать с главной">
                            {{ $review->status_id == 2 ? ' Убрать с главной' : 'Добавить на главную страницу' }}
                        </button>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #809270; margin-top: 20px;">Отзывов пока нет.</p>
            @endforelse
        </div>
    </section>

{{--    --}}{{-- Модальное окно --}}
{{--    <div id="actionModal" class="modal">--}}
{{--        <div class="modal-content">--}}
{{--            <span class="close">&times;</span>--}}
{{--            <p id="modalMessage">Готово!</p>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const modal = document.getElementById("actionModal");
        const modalMessage = document.getElementById("modalMessage");
        const closeBtn = document.querySelector(".modal .close");
        const toggleButtons = document.querySelectorAll(".feedback-toggle-btn");

        toggleButtons.forEach(btn => {
            btn.addEventListener('click', async function() {
                const reviewId = this.dataset.reviewId;
                const currentStatus = parseInt(this.dataset.status);
                const textPublish = this.dataset.textPublish;
                const textUnpublish = this.dataset.textUnpublish;

                // Блокируем кнопку на время запроса
                this.disabled = true;
                const originalText = this.textContent;
                this.textContent = ' Обработка...';

                try {
                    const response = await fetch(`/admin/review/${reviewId}/toggle`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const newStatus = result.new_status;
                        const statusName = result.status_name;

                        //  Обновляем текст кнопки
                        this.textContent = newStatus == 2 ? textUnpublish : textPublish;
                        this.dataset.status = newStatus;

                        //  Обновляем бейдж статуса
                        const badge = document.getElementById(`status-badge-${reviewId}`);
                        if (badge) {
                            badge.textContent = statusName;
                            badge.className = `status-badge status-${newStatus}`;
                        }

                        //  Показываем сообщение
                        modalMessage.textContent = newStatus == 2
                            ? ' Отзыв опубликован на главной'
                            : ' Отзыв снят с главной (статус: на модерации)';
                        modal.style.display = "block";

                    } else {
                        throw new Error(result.message || 'Ошибка сервера');
                    }

                } catch (error) {
                    console.error('Ошибка:', error);
                    modalMessage.textContent = ' Ошибка: ' + (error.message || 'Не удалось изменить статус');
                    modal.style.display = "block";
                } finally {
                    // Разблокируем кнопку
                    this.disabled = false;
                    if (!modalMessage.textContent.includes('Ошибка')) {
                        // Если всё ок — не возвращаем старый текст, он уже обновлён
                    } else {
                        // Если ошибка — возвращаем исходный текст
                        this.textContent = originalText;
                    }
                }
            });
        });

        // Закрытие модального окна
        closeBtn.onclick = () => modal.style.display = "none";
        window.onclick = (event) => {
            if (event.target == modal) modal.style.display = "none";
        }
    </script>
@endsection