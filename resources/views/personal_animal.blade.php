@extends('theme')

@section('content')
  
    <nav class="nav_personal">
        <a href="/cabinet" class="account_nav">Обзор</a>
        <a href="/animal" id="actively" class="account_nav">Животное</a>
        <a href="/reviews" class="account_nav">Отзывы</a>
        <a href="/asks" class="account_nav">Вопросы</a>
        <a href="/orders" class="account_nav">Заказы</a>
    </nav>

    <section id="personal_animal" class="container">
        <h1 class="h1_visiting">
            Кол-во: {{ $user->animals->count() }}
            <a class="a_button a_button_inline" href="{{ url('/formAnimal') }}">&plus;</a>
        </h1>

        @if(session('success'))
            <p style="color: #27ae60; background: #e8f5e9; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px;">
                {{ session('success') }}
            </p>
        @endif

        @if($user->animals->count() > 0)
            <div class="cards">
                @foreach($user->animals as $animal)
                    <div class="card-animal">
                        <h1 class="h1_accounts">{{ $animal->name }}</h1>
                        <div class="card_half">
                            <div class="half" style="width: 100%">
                                <div class="data_animal">
                                    <p>Вид: {{ $animal->type->name ?? 'Не указано' }}</p>
                                    <p>Вес: {{ $animal->weight ?? 0 }} кг.</p>
                                    <p>Возраст: {{ $animal->age  }} </p>
                                    <p>Заболевание: {{ $animal->diseas->name ?? 'Нет' }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: #809270; font-size: 20px; margin-top: 20px;">
                У вас пока нет животных. Добавьте первое!
            </p>
        @endif
    </section>
@endsection