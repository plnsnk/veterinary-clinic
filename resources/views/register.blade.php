@extends('theme1')
@section('content')
<div class="body">
    <div class="container">
        <div class="blur">
            <h2 class="h2">Регистрация</h2>
            <form id="registrationForm" onsubmit="return validateForm()" action="/register" method="post">
                <div class="form-group">
                    <label for="name">ФИО:</label>
                    <input type="text" id="name" name="name" placeholder="ФИО (кириллица, пробелы и тире)"
                           pattern="[А-яЁёа-яА-ЯёЁ\s\-]+" required>
                    <div class="error-message" id="nameError"></div>
                </div>
                @csrf
                <div class="form-group">
                    <label for="login">Логин:</label>
                    <input type="text" id="login" name="login" placeholder="Логин (латиница цифры и тире)"
                           pattern="[A-Za-z0-9\-]+" required>
                    <div class="error-message" id="loginError"></div>
                </div>
                <div class="form-group">
                    <label for="email">Почта:</label>
                    <input type="email" id="email" name="email" placeholder="Почта"
                           required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Номер телефона:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Номер телефона"
                           required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" placeholder="Пароль (минимум 6 символов)"
                           minlength="6" required>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <div class="form-group">
                    <label for="password_repeat">Повторите пароль:</label>
                    <input type="password" id="password_repeat" name="password_confirmation" placeholder="Повторите пароль"
                           required>
                    <div class="error-message" id="passwordRepeatError"></div>
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
{{--                <input type="checkbox" id="agreeCheckbox" >--}}
                <div class="button">

                    <button type="submit" id="btn" disabled>Зарегистрироваться</button>
                </div>

                <div class="text">
                    <p style="text-align: center">
                        У вас есть учетная запись? <b><a class="system" href="/auth">Войдите в систему</a></b>
                    </p>
                </div>

            </form>
        </div>


        <script>
            const btn = document.querySelector('#btn'),
                checkbox = document.querySelector('#checkbox');
            checkbox.addEventListener('change', () => {
                if ($checkbox.checked) {
                    $btn = false;
                } else {
                    $btn = true;
                }
            });
        </script>
    </div></div>
    <script>const $btn = document.querySelector('#btn'),
            $checkbox = document.querySelector('#input');

        $checkbox.addEventListener('change', () =>
        {
            if ($checkbox.checked)
            {
                $btn.disabled = false;
            }
            else
            {
                $btn.disabled = true;
            }
        });</script>
<script src="../js/scriptRegister.js"></script>


@endsection