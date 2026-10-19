@extends('theme')
@section('content')


    <nav class="nav_personal">
        <a href="/cabinet" class="account_nav" id="actively">Обзор</a>
        <a href="/animal" class="account_nav">Животное</a>
        <a href="/reviews" class="account_nav">Отзывы</a>
        <a href="/asks" class="account_nav">Вопросы</a>
        <a href="/orders" class="account_nav">Заказы</a>
    </nav>

    <section id="personal_data" class="container">
        <h1 class="h1_account">Мой профиль <a href="/logout" style="color:#809270;text-decoration: none">Выйти</a></h1>

        @if(session('success'))
            <p style="color: #27ae60; background: #e8f5e9; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px;">
                {{ session('success') }}
            </p>
        @endif
        @if($errors->any())
            <p style="color: #e53e3e; background: #fff5f5; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px;">
                 {{ $errors->first() }}
            </p>
        @endif
        <div style="margin-bottom: 25px;">
            <p><strong>ФИО:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Логин:</strong> {{ Auth::user()->login }}</p>
            <p><strong>Телефон:</strong> {{ Auth::user()->phone }}</p>
            <p><strong>Почта:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Мои животные:</strong>
                @forelse($user->animals as $animal)
                    {{ $animal->name }} ({{ $animal->type->name ?? '?' }})@if(!$loop->last), @endif
                @empty
                    Нет животных
                @endforelse
            </p>
        </div>
        <h1 style="color:#809270; font-size: 18px">Изменить фото</h1>
        <div class="photo-wrapper">
            @if(Auth::user()->photo_path)
    <img src="{{ asset(Auth::user()->photo_path) }}" alt="Фото">
@else
    <img src="{{ asset('image/r.webp') }}" alt="Заглушка">
@endif
            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                @csrf
                <input type="file" name="photo" accept="image/*" style="font-size:14px;">
                <button type="submit" class="a_register" style="padding:8px 16px; font-size:14px; height:auto;">Загрузить</button>
                @if(Auth::user()->photo_path)
                    <!--<label style="font-size:14px; cursor:pointer;">-->
                    <!--    <input type="checkbox" name="delete_photo" style="vertical-align:middle;"> Удалить-->
                    <!--</label>-->
                @endif
            </form>
        </div>
        <div class="edit-form">
            <h3 style="margin: 0 0 15px 0; color: #809270;">Изменить данные</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">ФИО:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input type="text" id="login" name="login" value="{{ old('login', Auth::user()->login) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Телефон:</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Почта:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-save">Сохранить изменения</button>
                    <button type="button" class="btn-cancel" onclick="this.closest('form').reset()">Отмена</button>
                </div>
            </form>
        </div>

    </section>
@endsection