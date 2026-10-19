@extends('theme')
@section('title')
  <title>{{$title}}</title>
@endsection

@section('content')
    <h2>Продукты</h2>
<div class="cardContainer">
    @foreach($products as $product)
        <div class="card" style="width: 18rem;">
{{--            <img src="/" class="card-img-top" alt="...">--}}
            <div class="card-body">
                <h5 class="card-title">{{$product->name}} - {{$product->price}}руб</h5>
                <p><a href="/product/{{$product->id}}" class="btn btn-secondary">Подробнее</a></p>
            </div>
        </div>
    @endforeach
</div>

    <h2>Услуги</h2>
<div class="cardContainer">
    @foreach($services as $service)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                @php
                    $animalType = $service->animalTypes->first();
                    $price = $animalType?->pivot?->price;
                @endphp

                <h5 class="card-title">
                    {{ $service->name }} - {{ $price ?? 'Цена не указана' }} руб
                </h5>
                <p class="card-text"></p>
                <p>
                    <a href="/service/{{ $service->id }}" class="btn btn-secondary">Подробнее</a>
                </p>
            </div>
        </div>
    @endforeach
</div>

<h2>Отзывы</h2>
    @foreach($reviews as $r)
        <p>Имя пользователя: {{$r->user->login}}</p>
        <p>Тест отзыва: {{$r->text}}</p>
        <p>Оценка:
            @for ($i = 1; $i <= $r->estimation; $i++)
                &#9733;
            @endfor
        </p>
        <hr>
    @endforeach
@endsection
