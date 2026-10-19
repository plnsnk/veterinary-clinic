@extends('themeAdmin')

@section('content')
    <nav class="nav_personal">
        <a href="/admin/feedback" class="account_nav">Отзывы</a>
        <a href="/admin/ask" class="account_nav">Вопросы</a>
        <a href="/admin/orders" class="account_nav active" id="actively">Заказы</a>
        <a href="/product" class="account_nav">Продукты</a>
        <a href="/service" class="account_nav">Услуги</a>
        <a href="/category" class="account_nav">Категории</a>
        
    </nav>

    <div class="h1_account">
        <span>Все заказы</span>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <style>
       
        .status-select {
            padding: 6px 10px;
          
            border-radius: 6px;
            font-size: 13px;
            background: #fff;
            cursor: pointer;
            min-width: 140px;
            transition: all 0.2s;
        }
        .status-select:focus {
            outline: none;
     
        }
    </style>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>Сумма</th>
                    <th>Комментарий</th>
                    <th>Статус</th>
                    <th>Дата заказа</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="status-row-{{ $order->status_id }}">
                        <td><strong>{{ $order->id }}</strong></td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ number_format((float)$order->sum, 0, ',', ' ') }} ₽</td>
                        <td title="{{ $order->comment }}">{{ Str::limit($order->comment, 30) }}</td>
                        <td>
                            
                            <form action="{{ url('/admin/orders/' . $order->id . '/status') }}" 
          method="POST" 
          style="display:inline;">
        @csrf
        @method('POST')
        <select name="status_id" class="status-select" onchange="this.form.submit()">
            <option value="4" {{ $order->status_id == 4 ? 'selected' : '' }}>Новый</option>
            <option value="6" {{ $order->status_id == 6 ? 'selected' : '' }}>Завершен</option>
        </select>
    </form>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding: 30px; color:#6b7280;">
                            Заказов пока нет
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection