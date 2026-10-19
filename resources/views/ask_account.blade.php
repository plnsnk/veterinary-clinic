@extends('theme')
@section('content')
          <nav class="nav_personal">
            <a href="/cabinet" class="account_nav">Обзор</a>
            <a href="/animal" class="account_nav">Животное</a>
            <a href="/reviews" class="account_nav">Отзывы</a>
            <a href="/asks" id="actively" class="account_nav">Вопросы</a>
            <a href="/orders" class="account_nav">Заказы</a>
        </nav>
        <div id="faq" class="container">
            <h1 class="h1_visiting">Вопросы <a class="a_button" href="/formAsk">&plus;</a></h1>
            @foreach($asks as $ask)
                <div class="faq-item">
                    <button class="faq-question">{{$ask->question}} <span class="arrow">⇓</span></button>
                    <div class="faq-answer">
                        @if($ask->answer)
                        <p>{{$ask->answer}}</p>
                        @else
                            <p>На этот вопрос нет ответа</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

@endsection