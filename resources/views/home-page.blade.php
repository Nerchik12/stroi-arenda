@extends('layouts.app')

@section('content')
<main>
    <!-- Главный баннер -->
    <section class="hero-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="banner-content text-center">
                        <span class="banner-badge">🔥 НОВИНКИ 2026</span>
                        <h1 class="banner-title">СТРОИТЕЛЬНЫЕ МАТЕРИАЛЫ И ИНСТРУМЕНТЫ</h1>
                        <p class="banner-text">Профессиональные материалы для строительства и ремонта. Надёжность, доступные цены и проверенное качество.</p>
                        <div class="banner-buttons justify-content-center">
                            <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-grid me-2"></i>В КАТАЛОГ
                            </a>
                            <a href="{{ route('why') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-info-circle me-2"></i>О НАС
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Новые поступления -->
    <section class="py-5">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">НОВЫЕ ПОСТУПЛЕНИЯ</h2>
                <p class="section-subtitle">Последние добавленные товары в нашем каталоге</p>
            </div>
            
            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card" onclick="window.location.href='{{ route('product', $product->id) }}'">
                        @if($product->in_stock > 0)
                        <span class="badge-in-stock">В НАЛИЧИИ</span>
                        @else
                        <span class="badge-out-stock">ПОД ЗАКАЗ</span>
                        @endif
                        
                        <div class="product-image-wrapper">
                            <img src="{{ asset($product->image) }}" class="product-img" alt="{{ $product->name }}" 
                                 onerror="this.src='https://via.placeholder.com/300x300/8e44ad/ffffff?text={{ urlencode($product->name) }}'">
                        </div>
                        
                        <div class="card-body">
                            <div class="category-label">{{ $product->category }}</div>
                            <h5 class="card-title">
                                <a href="{{ route('product', $product->id) }}" class="product-title-link">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div class="product-specs">
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $product->country }}
                                </small>
                            </div>
                            <div class="price-section">
                                <div class="price">{{ number_format($product->price, 0, '', ' ') }} ₽/день</div>
                                @if($product->in_stock > 0)
                                <div class="actions">
                                    <button class="btn btn-cart-sm" onclick="event.stopPropagation(); document.getElementById('cart-form-{{ $product->id }}').submit();">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                    <form id="cart-form-{{ $product->id }}" method="POST" action="{{ route('add_buscket') }}" class="d-none">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="rental_days" value="1">
                                    </form>
                                </div>
                                @else
                                <button class="btn-not-available" disabled>
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('catalog') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-grid me-2"></i>ВСЕ ТОВАРЫ
                </a>
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-box display-1 text-muted mb-3"></i>
                <h4>Товары пока не добавлены</h4>
                <p class="text-muted">Загляните позже!</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Преимущества -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">ПОЧЕМУ МЫ</h2>
                <p class="section-subtitle">Наши преимущества перед конкурентами</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Быстрая доставка</h5>
                        <p class="text-muted">По всей России 1-3 дня</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Гарантия качества</h5>
                        <p class="text-muted">Официальная гарантия 2 года</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <h5>Легкий возврат</h5>
                        <p class="text-muted">Возврат в течение 30 дней</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Поддержка 24/7</h5>
                        <p class="text-muted">Круглосуточная помощь</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Баннер */
.hero-banner {
    background: linear-gradient(135deg, #1b2838 0%, #2a1b38 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.hero-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="2"/></svg>');
    opacity: 0.3;
}

.banner-content {
    position: relative;
    z-index: 2;
    color: #fff;
    max-width: 900px;
    margin: 0 auto;
}

.banner-badge {
    display: inline-block;
    background: #fff;
    color: #2c3e50;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.banner-title {
    font-size: 3rem;
    font-weight: 900;
    color: #fff;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.banner-text {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
}

.banner-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.banner-buttons .btn-primary {
    background: linear-gradient(135deg, #9b59b6, #8e44ad) !important;
    border: 2px solid transparent !important;
    font-weight: 700 !important;
    padding: 1rem 2rem !important;
    color: #fff !important;
}

.banner-buttons .btn-primary:hover {
    background: #fff !important;
    border-color: #fff !important;
    color: #9b59b6 !important;
}

.banner-buttons .btn-outline-light {
    border: 2px solid #fff !important;
    color: #fff !important;
    font-weight: 700 !important;
    padding: 1rem 2rem !important;
    background: transparent !important;
}

.banner-buttons .btn-outline-light:hover {
    background: #fff !important;
    color: #9b59b6 !important;
}

/* Заголовки секций */
.section-header {
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 900;
    color: #1a1a1a;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #666;
    font-size: 1.1rem;
}

/* Карточки товаров */
.product-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 35px rgba(155, 89, 182, 0.2);
}

.product-image-wrapper {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
    background: #f8f9fa;
}

.product-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.badge-in-stock {
    position: absolute;
    top: 10px;
    left: 10px;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    color: #fff;
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.7rem;
    z-index: 10;
    text-transform: uppercase;
}

.badge-out-stock {
    position: absolute;
    top: 10px;
    left: 10px;
    background: linear-gradient(135deg, #95a5a6, #7f8c8d);
    color: #fff;
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.7rem;
    z-index: 10;
    text-transform: uppercase;
}

.card-body {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.category-label {
    font-size: 0.75rem;
    color: #2c3e50;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.product-title-link {
    color: #1a1a1a;
    text-decoration: none;
}

.product-specs {
    margin-bottom: 0.75rem;
}

.price-section {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.75rem;
}

.price {
    font-size: 1.25rem;
    font-weight: 800;
    color: #9b59b6;
}

.btn-cart-sm {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: all 0.3s ease;
}

.btn-cart-sm:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(155, 89, 182, 0.4);
}

.btn-not-available {
    width: 36px;
    height: 36px;
    background: #e0e0e0;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    cursor: not-allowed;
}

/* Преимущества */
.feature-box {
    padding: 2rem 1rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.feature-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 35px rgba(44, 62, 80, 0.1);
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon i {
    font-size: 2.5rem;
    color: #fff;
}

.feature-box h5 {
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .hero-banner {
        padding: 60px 0;
    }
    
    .banner-title {
        font-size: 1.75rem;
    }
    
    .banner-text {
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .banner-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .banner-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>
@endsection
