@extends('theme1') 

@section('content')
    <div class="body">
        <div class="container">
            <div class="blur">
                <div class="h1_account">
                    <span class="h2" style="margin: 20px">Создание товара</span>

                </div>

    <form action="/product/store" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Название</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="form-group">
            <label class="form-label">Цена</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Категория</label>
            <select name="category_id" class="form-select" required id="category_id">
                <option value="" disabled selected>Выберите...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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

@endsection