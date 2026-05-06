@extends('layouts.app')

@section('content')
<main>
    <!-- Компактный баннер -->
    <section class="hero-section-compact">
        <div class="container position-relative z-2">
            <div class="row align-items-center py-5">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">СТРОЙМАСТЕР</h1>
                    <p class="lead mb-4">Профессиональные строительные материалы и инструменты</p>
                    <form action="{{ route('catalog') }}" method="GET" class="search-form">
                        <div class="row justify-content-center g-3">
                            <div class="col-lg-6 col-md-8">
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Поиск товаров..." value="{{ request('name') }}">
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-search me-2"></i>НАЙТИ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Все категории с быстрыми фильтрами -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title mb-4">КАТАЛОГ ТОВАРОВ</h2>
            
            <!-- Быстрые фильтры -->
            <div class="quick-filters mb-4">
                <div class="row g-2">
                    <div class="col-auto">
                        <a href="{{ route('catalog') }}" class="btn btn-outline-primary filter-chip {{ !request('category') ? 'active' : '' }}">
                            <i class="bi bi-grid me-1"></i>Все
                        </a>
                    </div>
                    @php
                        $filterCategories = ['Ручной инструмент', 'Электроинструмент', 'Измерительное оборудование', 'Садовая техника', 'Силовое оборудование', 'Строительное оборудование', 'Клининг и уход'];
                    @endphp
                    @foreach($filterCategories as $cat)
                    <div class="col-auto">
                        <a href="{{ route('catalog') }}?category={{ urlencode($cat) }}" class="btn btn-outline-primary filter-chip {{ request('category') == $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Сетка категорий -->
            <div class="categories-grid mb-5">
                <div class="row g-4">
                    @php
                        $allCategories = [
                            ['name' => 'Ручной инструмент', 'icon' => 'bi-hammer', 'color' => '#e74c3c'],
                            ['name' => 'Электроинструмент', 'icon' => 'bi-lightning', 'color' => '#3498db'],
                            ['name' => 'Измерительное оборудование', 'icon' => 'bi-rulers', 'color' => '#9b59b6'],
                            ['name' => 'Садовая техника', 'icon' => 'bi-tree', 'color' => '#9b59b6'],
                            ['name' => 'Силовое оборудование', 'icon' => 'bi-battery-charging', 'color' => '#f39c12'],
                            ['name' => 'Строительное оборудование', 'icon' => 'bi-cone-striped', 'color' => '#e67e22'],
                            ['name' => 'Клининг и уход', 'icon' => 'bi-bucket', 'color' => '#1abc9c'],
                        ];
                    @endphp
                    @foreach($allCategories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route('catalog') }}?category={{ urlencode($cat['name']) }}" class="category-card-modern">
                            <div class="category-card-icon" style="background: linear-gradient(135deg, {{ $cat['color'] }}, {{ $cat['color'] }}dd);">
                                <i class="bi {{ $cat['icon'] }}"></i>
                            </div>
                            <h5 class="category-card-title">{{ $cat['name'] }}</h5>
                            <span class="category-card-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Товары по категориям -->
            @foreach($allCategories as $catData)
                @php
                    $categoryProducts = DB::table('products')
                        ->where('category', $catData['name'])
                        ->where('in_stock', '>', 0)
                        ->orderBy('created_at', 'desc')
                        ->limit(4)
                        ->get();
                @endphp
                @if($categoryProducts->count() > 0)
                <div class="category-products-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="section-subtitle mb-0" style="color: {{ $catData['color'] }};">
                            <i class="bi {{ $catData['icon'] }} me-2"></i>{{ $catData['name'] }}
                        </h3>
                        <a href="{{ route('catalog') }}?category={{ urlencode($catData['name']) }}" class="btn btn-sm btn-outline-primary">
                            Все товары <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="row g-4">
                        @foreach($categoryProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-card" onclick="window.location.href='{{ route('product', $product->id) }}'">
                                <span class="badge-in-stock">В НАЛИЧИИ</span>
                                <div class="product-image-wrapper">
                                    <img src="{{ asset($product->image) }}" class="product-img" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/300x300/{{ substr($catData['color'], 1) }}/ffffff?text={{ urlencode($product->name) }}'">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('product', $product->id) }}" class="product-title-link">
                                            {{ $product->name }}
                                        </a>
                                    </h5>
                                    <div class="price-section">
                                        <div class="price">{{ number_format($product->price, 0, '', ' ') }} ₽/день</div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- Преимущества -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">ПОЧЕМУ МЫ</h2>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center">
                        <div class="feature-icon-modern">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Доставка 1-3 дня</h5>
                        <p class="text-muted small">По всей России</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center">
                        <div class="feature-icon-modern">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Гарантия 2 года</h5>
                        <p class="text-muted small">На все товары</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center">
                        <div class="feature-icon-modern">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <h5>Возврат 30 дней</h5>
                        <p class="text-muted small">Без проблем</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center">
                        <div class="feature-icon-modern">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Поддержка 24/7</h5>
                        <p class="text-muted small">Всегда на связи</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Компактный баннер */
.hero-section-compact {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

.hero-section-compact::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="2"/></svg>');
    opacity: 0.3;
}

.hero-section-compact h1 {
    color: #fff !important;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-section-compact .lead {
    color: rgba(255,255,255,0.9) !important;
}

.search-form .form-control {
    border-radius: 50px;
    border: none;
    padding: 15px 25px;
    font-size: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-form .btn-primary {
    border-radius: 50px;
    padding: 15px 30px;
}

/* Быстрые фильтры */
.filter-chip {
    border-radius: 50px;
    padding: 8px 16px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.filter-chip:hover,
.filter-chip.active {
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-color: #3498db;
    color: #fff;
}

/* Современные карточки категорий */
.category-card-modern {
    display: block;
    padding: 2rem 1.5rem;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.category-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(39, 174, 96, 0.2);
}

.category-card-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.category-card-icon i {
    font-size: 2rem;
    color: #fff;
}

.category-card-title {
    text-align: center;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    font-size: 1rem;
}

.category-card-arrow {
    position: absolute;
    top: 1rem;
    right: 1rem;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
    color: #3498db;
}

.category-card-modern:hover .category-card-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* Секция товаров категории */
.category-products-section {
    padding: 2rem 0;
    border-bottom: 1px solid #e0e0e0;
}

.category-products-section:last-child {
    border-bottom: none;
}

.section-subtitle {
    font-weight: 800;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Преимущества */
.feature-card-modern {
    padding: 2rem 1rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.feature-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.1);
}

.feature-icon-modern {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

.feature-icon-modern i {
    font-size: 2.5rem;
    color: #fff;
}

.feature-card-modern h5 {
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .hero-section-compact {
        padding: 40px 0;
    }
    
    .search-form .btn-primary {
        margin-top: 10px;
    }
    
    .filter-chip {
        font-size: 0.8rem;
        padding: 6px 12px;
    }
}
</style>

@endsection