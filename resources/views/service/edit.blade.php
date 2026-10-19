@extends('theme1')

@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav active" id="actively">Услуги</a>
        <a href="/category" class="account_nav">Категории</a>
    </nav>
    <div class="body">
        <div class="container">
            <div class="blur">
                <div class="h1_account">
                    <span class="h2" style="margin: 20px">Редактирование услуги</span>

                </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="edit-form" style="max-width: 600px;">
        <form action="/service/update/{{ $service->id }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Название услуги</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Цена</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Категория</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $service->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ $service->description }}</textarea>
            </div>

            <div class="button" id="button_record">
                <button type="submit">Отправить</button>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
@endsection
