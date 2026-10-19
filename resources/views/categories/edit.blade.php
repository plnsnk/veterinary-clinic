@extends('theme1') {{-- Или theme1, если это часть ЛК --}}

@section('content')
    <div class="body">
        <div class="container">
            <div class="blur">

    <div class="h1_account">
        <span class="h2" style="margin: 20px">Редактирование категории</span>

    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="edit-form" style="max-width: 600px;">
        <form action="/categories/edit/{{ $category->id }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Название категории</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       value="{{ $category->name }}"
                       required>
            </div>

            <div class="form-actions">
                <div class="button" id="button_record">
                    <button type="submit">Отправить</button>
                </div>
                <!--<div class="button_cancellation">-->
                <!--    <button type="button" id="btn-cancel-review" class="btn-cancel" onclick="goBack()">Отменить</button>-->
                <!--</div>-->
            </div>
        </form>
    </div>
            </div>
            </div>
            </div>
@endsection