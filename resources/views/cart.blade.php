@extends('layouts.app')

@section('content')
<main>
    <div class="container py-5">
        <!-- Заголовок с иконкой -->
        <div class="cart-header mb-5">
            <h1 class="section-title">
                <i class="bi bi-cart3 me-3"></i>КОРЗИНА
            </h1>
            <p class="text-muted">Товары в вашей корзине</p>
        </div>

        @if($cart->count() == 0)
            <!-- Пустая корзина -->
            <div class="empty-cart text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="bi bi-cart-x display-1 text-muted"></i>
                </div>
                <h3 class="mb-3">КОРЗИНА ПУСТА</h3>
                <p class="text-muted mb-4">Добавьте товары из каталога, чтобы сделать заказ</p>
                <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i>ПЕРЕЙТИ В КАТАЛОГ
                </a>
            </div>
        @else
            <div class="row">
                <!-- Товары -->
                <div class="col-xl-8">
                    <div class="cart-items-card mb-4">
                        <div class="cart-items-header p-4">
                            <h5 class="mb-0">ТОВАРЫ В КОРЗИНЕ ({{ $cart->count() }})</h5>
                        </div>
                        <div class="cart-items-body p-0">
                            @foreach($cart as $item)
                            <div class="cart-item-row" data-product-url="{{ route('product', ['id' => $item->product_id]) }}">
                                <div class="row align-items-center">
                                    <!-- Изображение -->
                                    <div class="col-4 col-md-2">
                                        <div class="cart-item-image">
                                            <img src="{{ asset($item->image) }}"
                                                 alt="{{ $item->name }}"
                                                 class="img-fluid rounded">
                                        </div>
                                    </div>

                                    <!-- Информация -->
                                    <div class="col-8 col-md-4">
                                        <h6 class="cart-item-name mb-1">
                                            <a href="{{ route('product', ['id' => $item->product_id]) }}">
                                                {{ $item->name }}
                                            </a>
                                        </h6>
                                        <p class="text-muted small mb-1">{{ $item->model }}</p>
                                        @if($item->in_stock > 0)
                                            <span class="badge badge-in-stock-sm">В наличии</span>
                                        @else
                                            <span class="badge badge-out-stock-sm">Нет в наличии</span>
                                        @endif
                                    </div>

                                    <!-- Количество -->
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <div class="quantity-controls-modern">
                                            @if($item->count > 1)
                                                <form method="POST" action="{{ route('update.quantity') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                    <input type="hidden" name="count" value="{{ $item->count - 1 }}">
                                                    <button type="submit" class="quantity-btn-modern">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('remove') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                    <button type="submit" class="quantity-btn-modern btn-remove-modern" title="Удалить товар">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <span class="quantity-display">{{ $item->count }} шт.</span>

                                            <form method="POST" action="{{ route('update.quantity') }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                <input type="hidden" name="count" value="{{ $item->count + 1 }}">
                                                <button type="submit" class="quantity-btn-modern" {{ $item->count >= $item->in_stock ? 'disabled' : '' }}>
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="mt-2 small text-muted">
                                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                                <span>Срок:</span>
                                                <form method="POST" action="{{ route('update.rental_days') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                    <input type="hidden" name="days" value="{{ max(1, (int)($item->rental_days ?? 1) - 1) }}">
                                                    <button type="submit" class="quantity-btn-modern" {{ (int)($item->rental_days ?? 1) <= 1 ? 'disabled' : '' }}>
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                </form>
                                                <span class="quantity-display">{{ max(1, (int)($item->rental_days ?? 1)) }} дн.</span>
                                                <form method="POST" action="{{ route('update.rental_days') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                    <input type="hidden" name="days" value="{{ max(1, (int)($item->rental_days ?? 1) + 1) }}">
                                                    <button type="submit" class="quantity-btn-modern">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Цена -->
                                    <div class="col-md-3 mt-3 mt-md-0 text-md-end">
                                        <div class="cart-item-total">
                                            <div class="total-price">{{ number_format($item->price * $item->count * max(1, (int)($item->rental_days ?? 1)), 0, '', ' ') }} ₽</div>
                                            @if($item->count > 1)
                                                <small class="text-muted">{{ number_format($item->price, 0, '', ' ') }} ₽/день × {{ $item->count }} шт × {{ max(1, (int)($item->rental_days ?? 1)) }} дн.</small>
                                            @else
                                                <small class="text-muted">{{ number_format($item->price, 0, '', ' ') }} ₽/день × {{ max(1, (int)($item->rental_days ?? 1)) }} дн.</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Действия -->
                    <div class="cart-actions-modern">
                        <a href="{{ route('catalog') }}" class="btn btn-outline-primary-modern">
                            <i class="bi bi-arrow-left me-2"></i>ПРОДОЛЖИТЬ ПОКУПКИ
                        </a>
                        <form method="POST" action="{{ route('remove_add') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger-modern">
                                <i class="bi bi-trash me-2"></i>ОЧИСТИТЬ КОРЗИНУ
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Итоги -->
                <div class="col-xl-4">
                    <div class="order-summary-card-modern">
                        <div class="summary-header">
                            <h5 class="mb-0">ИТОГИ ЗАКАЗА</h5>
                        </div>
                        <div class="summary-body">
                            @php
                                $subtotal = 0;
                                $totalItems = 0;
                                foreach($cart as $item) {
                                    $days = max(1, (int)($item->rental_days ?? 1));
                                    $subtotal += $item->price * $item->count * $days;
                                    $totalItems += $item->count;
                                }
                            @endphp

                            <div class="summary-row">
                                <span>Товары ({{ $totalItems }} шт.)</span>
                                <span>{{ number_format($subtotal, 0, '', ' ') }} ₽</span>
                            </div>

                            <div class="summary-row">
                                <span>Доставка</span>
                                <span class="text-success">БЕСПЛАТНО</span>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-total-row">
                                <span>ИТОГО:</span>
                                <span class="total-amount">{{ number_format($subtotal, 0, '', ' ') }} ₽</span>
                            </div>
                        </div>

                        <!-- Кнопка оформления -->
                        <div class="summary-footer">
                            <a href="{{ route('add_order') }}" class="btn btn-checkout-modern">
                                ОФОРМИТЬ АРЕНДУ
                            </a>
                        </div>

                        <!-- Информация -->
                        <div class="order-info-modern">
                            <div class="info-item-modern">
                                <i class="bi bi-shield-check text-primary"></i>
                                <span>Безопасная оплата</span>
                            </div>
                            <div class="info-item-modern">
                                <i class="bi bi-arrow-counterclockwise text-primary"></i>
                                <span>Возврат в течение 30 дней</span>
                            </div>
                            <div class="info-item-modern">
                                <i class="bi bi-headset text-primary"></i>
                                <span>Поддержка 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
