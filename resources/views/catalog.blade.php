@extends('layouts.app')

@section('content')
<main>
    <div class="container py-5">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active">Каталог</li>
            </ol>
        </nav>

        <h1 class="section-title mb-4">КАТАЛОГ ТОВАРОВ</h1>

        <!-- Фильтры и сортировка -->
        <div class="filter-card mb-5">
            <form method="GET" action="{{ route('catalog') }}">
                <div class="row g-3">
                    <!-- Поиск -->
                    <div class="col-md-4">
                        <input type="text"
                               class="form-control"
                               name="name"
                               placeholder="Поиск товара..."
                               value="{{ request('name') }}">
                    </div>
                    
                    <!-- Категория -->
                    <div class="col-md-3">
                        <select class="form-select" name="category">
                            <option value="">Все категории</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}"
                                        {{ request('category') == $cat->name ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Сортировка -->
                    <div class="col-md-3">
                        <select class="form-select" name="sort">
                            <option value="id_desc" {{ request('sort') == 'id_desc' || !request('sort') ? 'selected' : '' }}>Сначала новые</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена: по возрастанию</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена: по убыванию</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название: А-Я</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название: Я-А</option>
                            <option value="in_stock_desc" {{ request('sort') == 'in_stock_desc' ? 'selected' : '' }}>По наличию</option>
                        </select>
                    </div>
                    
                    <!-- Кнопка -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> ФИЛЬТР
                        </button>
                    </div>
                </div>
                
                <!-- Дополнительные фильтры -->
                <div class="row g-3 mt-2 pt-3 border-top">
                    <div class="col-md-3">
                        <label class="form-label small">Мин. цена (₽)</label>
                        <input type="number" class="form-control form-control-sm" name="min_price" 
                               placeholder="От" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Макс. цена (₽)</label>
                        <input type="number" class="form-control form-control-sm" name="max_price" 
                               placeholder="До" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">&nbsp;</label>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="in_stock" value="1" 
                                   id="inStockCheck" {{ request('in_stock') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inStockCheck">
                                Только в наличии
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <a href="{{ route('catalog') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-x-circle"></i> СБРОСИТЬ
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Информация о результатах -->
        @if($products->count() > 0)
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Найдено товаров: <strong>{{ $products->count() }}</strong>
                @if(request('category'))
                    <span class="ms-2 badge bg-primary">Категория: {{ request('category') }}</span>
                @endif
                @if(request('name'))
                    <span class="ms-2 badge bg-primary">Поиск: {{ request('name') }}</span>
                @endif
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-muted small">Сортировка:</span>
                <div class="sort-dropdown">
                    <select class="form-select form-select-sm" style="width: 220px;" 
                            onchange="location.href='{{ route('catalog') }}?' + new URLSearchParams({
                                ...Object.fromEntries(new URL(window.location.href).searchParams),
                                sort: this.value
                            })">
                        <option value="id_desc" {{ request('sort') == 'id_desc' || !request('sort') ? 'selected' : '' }}>Сначала новые</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена: по возрастанию</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена: по убыванию</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название: А-Я</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название: Я-А</option>
                        <option value="in_stock_desc" {{ request('sort') == 'in_stock_desc' ? 'selected' : '' }}>По наличию</option>
                    </select>
                    <div class="sort-arrow">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif

       
       

        <!-- Сетка товаров -->
        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card-wrapper">
                        <div class="product-card">
                            @if($product->in_stock > 0)
                                <span class="badge-in-stock">В НАЛИЧИИ</span>
                            @else
                                <span class="badge-out-stock">ПОД ЗАКАЗ</span>
                            @endif

                            <div class="product-image-wrapper">
                                <img src="{{ asset($product->image) }}"
                                     class="product-img"
                                     alt="{{ $product->name }}"
                                     onerror="this.src='https://via.placeholder.com/300x300/f39c12/ffffff?text={{ urlencode($product->name) }}'">
                            </div>

                            <div class="card-body">
                                <div class="category-label">{{ $product->category }}</div>
                                <h5 class="card-title">
                                    <a href="{{ route('product', ['id' => $product->id]) }}" class="product-title-link">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <div class="specs">
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $product->country }}
                                    </small>
                                </div>
                                <div class="price-section mt-3">
                                    <div class="price">{{ number_format($product->price, 0, '', ' ') }} ₽/день</div>
                                    @if($product->in_stock > 0)
                                        <button type="button" class="btn-add-to-cart" 
                                                data-product-id="{{ $product->id }}"
                                                title="Добавить в аренду">
                                            <i class="bi bi-cart-plus"></i>
                                            <span>В аренду</span>
                                        </button>
                                    @else
                                        <button class="btn-not-available" disabled>
                                            <i class="bi bi-x-circle"></i>
                                            <span>Нет в наличии</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Форма добавления в корзину (отдельно от карточки) -->
                        @if($product->in_stock > 0)
                        <form method="POST" action="{{ route('add_buscket') }}" class="add-to-cart-form-hidden" id="form-{{ $product->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="rental_days" value="1">
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h4>Товары не найдены</h4>
                <p class="text-muted">Попробуйте изменить параметры поиска</p>
                <a href="{{ route('catalog') }}" class="btn btn-primary">СБРОСИТЬ ФИЛЬТРЫ</a>
            </div>
        @endif
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка кнопок добавления в корзину через AJAX
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Останавливаем всплытие чтобы не сработал клик по карточке
            
            const productId = this.dataset.productId;
            const form = document.getElementById('form-' + productId);
            const originalContent = this.innerHTML;
            
            // Анимация загрузки - 0.7 секунды
            this.innerHTML = '<i class="bi bi-hourglass-split"></i><span>Добавляем...</span>';
            this.disabled = true;
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Показываем уведомление об успехе
                    showNotification('success', data.message);
                    this.innerHTML = '<i class="bi bi-check-circle"></i><span>Добавлено!</span>';
                    this.style.background = 'linear-gradient(135deg, #9b59b6, #9b59b6)';
                    
                    // Обновляем счётчик в хедере
                    updateCartBadge();
                    
                    // Возврат через 0.7 секунды
                    setTimeout(() => {
                        this.innerHTML = originalContent;
                        this.style.background = '';
                        this.disabled = false;
                    }, 700);
                } else {
                    // Показываем ошибку
                    showNotification('error', data.message);
                    this.innerHTML = originalContent;
                    this.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Произошла ошибка при добавлении в корзину');
                this.innerHTML = originalContent;
                this.disabled = false;
            });
        });
    });
    
    // Клик по карточке - переход на страницу товара
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Если клик не по кнопке добавления в корзину
            if (!e.target.closest('.btn-add-to-cart')) {
                const titleLink = this.querySelector('.product-title-link');
                if (titleLink) {
                    window.location.href = titleLink.href;
                }
            }
        });
    });
    
    // Функция показа уведомлений
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `toast-notification toast-${type}`;
        notification.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        // Анимация появления
        setTimeout(() => notification.classList.add('show'), 10);
        
        // Удаление через 3 секунды
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Обновление счётчика в хедере
    function updateCartBadge() {
        fetch('/api/cart/count')
            .then(response => response.json())
            .then(data => {
                const badge = document.querySelector('.cart-badge');
                if (badge) {
                    badge.textContent = data.count;
                }
            })
            .catch(error => console.error('Error updating cart badge:', error));
    }
});
</script>

@endsection