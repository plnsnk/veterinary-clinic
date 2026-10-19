@extends('theme1')

@section('content')

    <div class="body">
        <div class="container">
            <div class="blur">

        <h2 class="h2">Редактирование товара</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="edit-form" style="max-width: 600px;">
        <form action="/product/update/{{ $product->id }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Название товара</label>
                <input type="text"   class="form-control" id="name" name="name" value="{{ $product->name }}"  required>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Цена (₽)</label>
                <input type="number" step="0.01" class="form-control"
                id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Категория</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" disabled>Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
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