@extends('theme1')

@section('content')

    <div class="body">
        <div class="container">
            <div class="blur">
                <h2 class="h2">Добавить животное</h2>

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 5px 0;">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="/formAnimal" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="type_id">Вид животного:</label>
                        <select name="type_id" id="type_id" required>
                            <option value="" disabled selected>Выберите вид</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Кличка --}}
                    <div class="form-group">
                        <label for="name">Кличка:</label>
                        <input type="text" id="name" name="name"
                               placeholder="Введите кличку"
                               pattern="[А-яЁёa-zA-Z\s\-]+"
                               required>
                    </div>

                    {{-- Вес --}}
                    <div class="form-group">
                        <label for="weight">Вес (кг):</label>
                        <input type="number" id="weight" name="weight"
                               step="0.1" min="0.1" max="200"
                               placeholder="Например: 5.5"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="age">Возраст (год):</label>
                        <input type="number" id="age" name="age"
                               step="1" min="0" max="200"
                               placeholder="Например: 2"
                               required>
                    </div>

                    {{-- Заболевание из БД --}}
                    <div class="form-group">
                        <label for="disease_id">Заболевание:</label>
                        <select name="disease_id" id="disease_id">
                            <option value="">Не указано</option>
                            @foreach($diseases as $disease)
                                <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                            @endforeach
                        </select>
                    </div>
   <div class="form-group checkbox">
                    <input type="checkbox" id="input" name="rules" required>
{{--                    <input type="checkbox" id="rules" name="rules" required>--}}
                    <div class="left">
                        <label for="agreeCheckbox"> Я даю согласие на <a href="/privacy" target="_blank" style="  color: #809270!important;">обработку персональных данных</a></label>
                    </div>
                </div>
                    {{-- Кнопки --}}
                    <div class="button" id="button_record">
                        <input type="submit" value="Сохранить">
                    </div>
                    <div class="button_cancellation">
                        <button type="button" id="btn-cancel-animal" class="btn-cancel" onclick="goBack()">Отменить</button>
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