@extends('admin.layout')

@section('title', 'Заказы')
@section('page-title', 'Управление заказами')

@section('content')
<div class="admin-table">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">ВСЕ ЗАКАЗЫ ({{ $orders->total() }})</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>№ заказа</th>
                    <th>Пользователь</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <div>{{ $order->user_name ?? 'Неизвестный' }}</div>
                        <small class="text-muted">{{ $order->user_email ?? '' }}</small>
                    </td>
                    <td><strong>{{ number_format($order->total_amount, 0, '', ' ') }} ₽</strong></td>
                    <td>
                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select form-select-sm" style="width: auto; display: inline-block;" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Ожидает</option>
                                <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>Активен</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Завершён</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Отменён</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                    <td>
                        <a href="{{ route('orders') }}" class="btn btn-sm btn-outline-purple" target="_blank">
                            <i class="bi bi-eye"></i> Просмотр
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div class="p-4 border-top">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
