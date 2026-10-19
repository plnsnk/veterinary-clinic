@extends('themeIndex')

@section('title')
    <title>{{ $service->name ?? 'Услуга' }}</title>
@endsection

@section('content')
    <section class="service-detail">
     

        <div class="service-detail-card">
            
            {{-- 🔝 КНОПКА СВЕРХУ --}}
            <div class="top-actions">
                <a href="javascript:history.back()" class="btn-back-service btn-top">
                    ← Вернуться к списку
                </a>
            </div>

            <h3 class="service-title">
                {{ $service->name }} - {{ $service->price }}
                
            </h3>

            @if($service->category)
                <p class="service-category">
                    <span class="category-badge">{{ $service->category->name }}</span>
                </p>
            @endif

            @if($service->description)
                <div class="service-description-box">
                    <p class="service-description">{{ $service->description }}</p>
                </div>
            @endif

            <hr class="service-divider">

            {{-- 🔽 КНОПКА СНИЗУ --}}
            <a href="javascript:history.back()" class="btn-back-service">
                ← Вернуться к списку
            </a>
        </div>
    </section>
@endsection