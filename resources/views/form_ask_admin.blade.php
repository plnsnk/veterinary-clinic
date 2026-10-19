@extends('theme1') 

@section('content')

<div class="body">
    <div class="container">
        <div class="blur">
            <h2 class="h2">Ответ на вопрос #{{ $question->id }}</h2>

            {{-- Отображаем сам вопрос --}}
            <p style="background: #f8faf8; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; ">
                <strong>Вопрос:</strong> {{ $question->question }}
            </p>

            <form action="{{ route('admin.ask.answer.save', $question->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="answer">Ваш ответ:</label>
                    <textarea class="form-control" id="answer" name="answer" rows="5" required>{{ old('answer', $question->answer) }}</textarea>
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>

                <div class="button" id="button_record">
            <button type="submit">Отправить</button>
        </div>
           
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection