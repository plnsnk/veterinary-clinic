@extends('theme1')
@section('content')
    <style>
        #logButton {
            color: #809270 !important;
            background-color: white !important;
            border: 2px solid #809270 !important;
            padding: 10px 20px !important;
            border-radius: 20px !important;
            cursor: pointer !important;
        }
        #logButton:hover {
            background-color: #809270 !important;
            color: white !important;
        }
    </style>
<body>
 <div class="body">
  <div class="container">
    <h2 class="h2">Авторизация</h2>
    <form id="loginForm" onsubmit="return validateLoginForm()" action="/auth" method="post">
      <div class="form-group">
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" placeholder="Логин" pattern="[A-Za-z0-9\-]+" required>
        <div class="error-message" id="loginError"></div>
      </div>
      @csrf
      <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" placeholder="Пароль" minlength="" required>
        <div class="error-message" id="passwordError"></div>
      </div>
<!--      <div class="form-group checkbox">-->
<!--        <input type="checkbox" id="rules" name="rules" required>-->
<!--        <div class="left">-->
<!--          <label>-->
<!--  <input type="checkbox" name="personal_data_consent" required>-->
<!--  Я даю согласие на <a href="/privacy" target="_blank">обработку персональных данных</a>-->
<!--</label>-->
<!--        </div>-->
<!--      </div>-->
   <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
      <div>
        <input type="submit" value="Войти" class="logButton">
      </div>
      <div class="text">
        <p style="text-align: center">У вас нет аккаунта? <b> <a class="system"
              href="/register">Зарегистрироваться</a></b></p>
      </div>
    </form>
  </div>
 </div>
  <script src="../js/scriptAvtoriz.js"></script>
</body>
@endsection