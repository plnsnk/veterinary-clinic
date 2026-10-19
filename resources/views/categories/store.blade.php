@extends('theme1') {{-- Или theme1, если это часть ЛК --}}

@section('content')
    <div class="body">
        <div class="container">
            <div class="blur">
                <div class="h1_account">
                    <span class="h2" style="margin: 20px">Создание категории</span>

                </div>

                <form action="/categories/store" method="post">
    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Название категории</label>
    <input type="text" name="name">
                    </div>
                    <div class="button" id="button_record">
                        <button type="submit">Отправить</button>
                    </div>

</form>
            </div>
            </div>
            </div>
@endsection
