@extends('theme1')
@section('content')
    <div class="body">
        <div class="container">
            <div class="blur">
                <h2 class="h2">Вопрос</h2>
                <form id="askForm" onsubmit="return validateForm()" action="/formAsk" method="post">
                    <div class="form-group">
                        <label for="name">Вопрос:</label>
                        <input type="text" id="ask" name="question" placeholder="Вопрос" required>

                    </div>
                    @csrf
                       <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
                    <div class="button">
                        <input type="submit" value="Отправить">
                    </div>
                    <div class="button_cancellation">
                        <button type="button" id="btn-cancel-ask" class="btn-cancel" onclick="goBack()">Отменить</button>
</div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
    window.history.back();
}
    </script>
@endsection