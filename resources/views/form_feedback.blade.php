@extends('theme1')
@section('content')
    <div class="body">
        <div class="container">
            <div class="blur">
                <h2 class="h2">Написать отзыв</h2>

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 5px 0;">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="/formReview" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Оценка (звёзды) --}}
                    <div class="form-group">
                        <label>Оценка:</label>
                        <input type="number" id="rating-hidden" name="estimation" min="1" max="5" value="5" style="display: none;">
                        <div class="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}">★</span>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text">Комментарий:</label>
                        <textarea id="text" name="text" rows="4" placeholder="Ваш отзыв..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="photo">Фото (необязательно):</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                        <small style="color: #666;">Макс. размер: 5МБ. Форматы: JPG, PNG, WEBP</small>
                    </div>

                    {{-- Предпросмотр фото (только для нового файла) --}}
                    <div class="form-group" id="preview-container" style="display: none;">
                        <label>Предпросмотр:</label>
                        <img id="photo-preview" src="" alt="Предпросмотр" style="max-width: 200px; border-radius: 10px;">
                    </div>
  <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
                    {{-- Кнопки --}}
                    <div class="button" id="button_record">
                        <button type="submit">Отправить</button>
                    </div>
                    <div class="button_cancellation">
                        <button type="button" id="btn-cancel-review" class="btn-cancel" onclick="goBack()">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Предпросмотр выбранного фото
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('photo-preview').src = event.target.result;
                    document.getElementById('preview-container').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Интерактивные звёзды
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                const value = this.dataset.value;
                document.getElementById('rating-hidden').value = value;
                document.querySelectorAll('.star').forEach(s => {
                    s.style.color = s.dataset.value <= value ? '#809270' : '#ccc';
                });
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
@endsection