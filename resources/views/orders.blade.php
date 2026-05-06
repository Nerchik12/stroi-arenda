@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Заголовок -->
    <div class="orders-header mb-5">
        <h1 class="section-title">
            <i class="bi bi-bag me-3"></i>МОИ АРЕНДЫ
        </h1>
        <p class="text-muted">История ваших заявок на аренду</p>
    </div>

    @if($orders->isEmpty())
        <!-- Нет заказов -->
        <div class="empty-orders text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-box display-1 text-muted"></i>
            </div>
            <h3 class="mb-3">ЗАКАЗЫ ОТСУТСТВУЮТ</h3>
            <p class="text-muted mb-4">У вас пока нет оформленных заявок на аренду</p>
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-cart me-2"></i>ПЕРЕЙТИ К АРЕНДЕ
            </a>
        </div>
    @else
        <!-- Список заказов -->
        <div class="orders-list">
            @foreach($orders as $order)
            <div class="order-card mb-4">
                <div class="order-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="order-number">
                                <i class="bi bi-hash me-2"></i>Заказ #{{ $order->id }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="order-date">
                                <i class="bi bi-calendar me-2"></i>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            @if($order->status == 'active')
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle me-2"></i>АКТИВЕН
                                </span>
                            @elseif($order->status == 'completed')
                                <span class="status-badge status-completed">
                                    <i class="bi bi-check-circle me-2"></i>ЗАВЕРШЕН
                                </span>
                            @elseif($order->status == 'pending')
                                <span class="status-badge status-pending">
                                    <i class="bi bi-clock me-2"></i>ОЖИДАЕТ
                                </span>
                            @else
                                <span class="status-badge status-cancelled">
                                    <i class="bi bi-x-circle me-2"></i>{{ strtoupper($order->status) }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="order-total-header">
                                Сумма: <strong>{{ number_format($order->total_amount, 0, '', ' ') }} ₽</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-card-body">
                    <div class="order-items">
                        @if($order->products->isNotEmpty())
                            @foreach($order->products as $product)
                            <div class="order-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="order-item-name">
                                            {{ $product->product_name }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="order-item-quantity">
                                            {{ $product->quantity }} шт. × {{ number_format($product->unit_price, 0, '', ' ') }} ₽/день × {{ max(1, (int)($product->rental_days ?? 1)) }} дн.
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <div class="order-item-total">
                                            {{ number_format($product->item_total, 0, '', ' ') }} ₽
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="order-item">
                                <span class="text-muted">Товары не найдены</span>
                            </div>
                        @endif
                    </div>
                    <div class="order-card-footer">
                        <div class="order-info-text">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Менеджер свяжется с вами для подтверждения заказа</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
