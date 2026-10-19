@extends('themeAdmin')
@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav" id="actively">Вопросы</a>
        <a href=" /admin/orders" class="account_nav">Заказы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav">Услуги</a>
               <a href="/category" class="account_nav">Категории</a>
    </nav>

    <div class="container admin-q-list">
        <h1 class="h1_visiting">Управление вопросами</h1>

        @forelse($questions as $question)
            <div class="q-card" data-question-id="{{ $question->id }}">
                <div class="q-top">
                    <span class="q-id">Вопрос #{{ $question->id }}</span>
                    <span class="q-status" id="status-{{ $question->id }}">
                        {{ $question->status_id == 2 ? 'Одобрен' : ($question->status_id == 5 ? 'Отвечен' : 'На модерации') }}
                    </span>
                </div>
                <p class="q-text">{{ $question->question }}</p>

                @if($question->answer)
                    <div class="q-answer">
                        <strong>Ответ:</strong> {{ $question->answer }}
                    </div>
                @else
                    <a href="{{ route('admin.ask.answer.form', $question->id) }}" class="q-btn">
                        Ответить
                    </a>
                @endif
                @if($question->answer)
                    <button type="button"
                            class="q-btn toggle-status-btn"
                            data-id="{{ $question->id }}"
                            style="margin-top: 10px; background: {{ $question->status_id == 2 ? '#DAEBC0' : '#809270' }}; color: {{ $question->status_id == 2 ? '#1b5e20' : '#fff' }};">
                        {{ $question->status_id == 2 ? 'Скрыть с главной' : 'Показать на главной' }}
                    </button>
                @endif

            </div>
        @empty
            <p style="text-align:center; color:#809270; padding:30px;">Вопросов пока нет</p>
        @endforelse
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-status-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const questionId = this.dataset.id;
                    const statusSpan = document.getElementById(`status-${questionId}`);
                    const originalText = this.textContent;

                    this.disabled = true;
                    this.textContent = 'Загрузка...';

                    fetch(`/admin/question/${questionId}/toggle`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                statusSpan.textContent = data.status_name;
                                this.textContent = data.is_approved ? 'Скрыть с главной' : 'Показать на главной';
                                this.style.background = data.is_approved ? '#DAEBC0' : '#809270';
                                this.style.color = data.is_approved ? '#1b5e20' : '#fff';
                            } else {
                                alert('Ошибка при обновлении статуса');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Произошла ошибка');
                            this.textContent = originalText;
                        })
                        .finally(() => {
                            this.disabled = false;
                        });
                });
            });
        });
    </script>
@endsection