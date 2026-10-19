@extends('themeIndex')
@section('title', 'Все услуги')
@section('content')

    <div class="services-page">
        <div class="services-header">
            <h1 class="services-title">Наши услуги</h1>
            <p class="services-subtitle">Профессиональная забота о здоровье ваших питомцев</p>
        </div>

        {{-- Фильтр по категориям --}}
        <form class="catalog-filter" method="GET">
            <div class="filter-group">
                <label for="category_id">Категория:</label>
                <select id="category_id" name="category_id" onchange="this.form.submit()">
                    <option value="">Все услуги</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($services->count() > 0)
            <div class="services-grid">
                @foreach($services as $service)
                    <div class="service-card">
                        {{-- Иконка в зависимости от категории --}}
                        <div class="service-icon">
                            @if($service->category_id == 1)
                                {{-- Ветеринария --}}
                                <img src="{{ asset('image/stethoscope-doctor-svgrepo-com.svg') }}" alt="Ветеринар">
                            @elseif($service->category_id == 2)
                                {{-- Груминг --}}
                                <img src="{{ asset('image/grooming-comb-svgrepo-com.svg') }}" alt="Груминг">
                            @else
                                {{-- Иконка по умолчанию --}}
                                <img src="{{ asset('image/paw.svg') }}" alt="Услуга">
                            @endif
                        </div>
                        
                        <h3 class="service-name">{{ $service->name }}</h3>
                        <p class="service-price">{{ $service->price }} руб.</p>
                        
                    
                        
                        <a href="/service/{{ $service->id }}" class="cs-link">Подробнее</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-services">
                <p>🐾 Услуг в выбранной категории пока нет</p>
            </div>
        @endif
    </div>

@endsection