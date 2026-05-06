@extends('layouts.app')

@section('content')
<main>
    <div class="container py-5">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog') }}">Каталог</a></li>
                <li class="breadcrumb-item active">{{ $product[0]->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Галерея -->
            <div class="col-lg-6">
                <div class="product-gallery">
                    <div class="main-image mb-4">
                        <img src="{{ asset($product[0]->image) }}" 
                             class="img-fluid rounded" 
                             alt="{{ $product[0]->name }}"
                             id="mainImage">
                    </div>
                        <div class="col-lg-12">
        <div class="product-description-box">
            <div class="col-12">
                <div class="product-description">
                    <h3 class="mb-4">ОПИСАНИЕ ТОВАРА</h3>
                    <div class="description-content">
                        <p>{{ $product[0]->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>

            <!-- Информация -->
            <div class="col-lg-6">
                <div class="product-info">
                    <!-- Бейджи -->
                    <div class="product-badges mb-3">
                        @if($product[0]->in_stock > 0)
                            <span class="badge bg-success me-2">В НАЛИЧИИ</span>
                        @else
                            <span class="badge bg-danger me-2">ПОД ЗАКАЗ</span>
                        @endif
                        <span class="badge bg-primary">{{ $product[0]->category }}</span>
                    </div>

                    <!-- Название -->
                    <h1 class="product-title mb-3">{{ $product[0]->name }}</h1>
                    
                    <!-- Модель -->
                    <div class="model mb-3">
                        <span class="text-muted">Модель:</span>
                        <strong>{{ $product[0]->model }}</strong>
                    </div>

                    <!-- Цена -->
                    <div class="price-section mb-4">
                        <div class="price">{{ number_format($product[0]->price, 0, '', ' ') }} ₽/день</div>
                    </div>

                    <!-- Характеристики -->
                    <div class="specs-card mb-4">
                        <h5 class="mb-3">ХАРАКТЕРИСТИКИ</h5>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <strong>Страна:</strong> {{ $product[0]->country }}
                            </div>
                            <div class="col-6 mb-2">
                                <strong>Год:</strong> {{ $product[0]->year }}
                            </div>
                            <div class="col-6 mb-2">
                                <strong>В наличии:</strong> {{ $product[0]->in_stock }} шт.
                            </div>
                            <div class="col-6 mb-2">
                                <strong>Категория:</strong> {{ $product[0]->category }}
                            </div>
                        </div>
                    </div>

                    <!-- Добавление в корзину -->
                    <div class="add-to-cart-card">
                        <div class="mb-4">
                            <label class="form-label">КОЛИЧЕСТВО:</label>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" 
                                       class="quantity-input" 
                                       id="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product[0]->in_stock }}">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(1)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <small class="text-muted">Доступно: {{ $product[0]->in_stock }} шт.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">СРОК АРЕНДЫ (ДНЕЙ):</label>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="changeDays(-1)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number"
                                       class="quantity-input"
                                       id="rentalDays"
                                       value="1"
                                       min="1"
                                       step="1">
                                <button type="button" class="quantity-btn" onclick="changeDays(1)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <small class="text-muted">Минимум: 1 день</small>
                        </div>

                        <div class="d-grid gap-3">
                            @if($product[0]->in_stock > 0)
                                <form method="POST" action="{{ route('add_buscket') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product[0]->id }}">
                                    <input type="hidden" name="quantity" id="quantityValue" value="1">
                                    <input type="hidden" name="rental_days" id="rentalDaysValue" value="1">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-calendar2-check me-2"></i>ОФОРМИТЬ АРЕНДУ
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="bi bi-cart-x me-2"></i>НЕТ В НАЛИЧИИ
                                </button>
                            @endif
                            <a href="{{ route('catalog') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>ВЕРНУТЬСЯ В КАТАЛОГ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="row mt-5">
    <div class="col-12">

        
        @if(session('success'))
            <div class="notification-success mb-3">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="notification-error mb-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="col-lg-12">
                <div class="reviews-header-section mb-4">
            <h3 class="reviews-main-title">Отзывы покупателей</h3>
            
            @if($reviews->count() > 0)
                <div class="reviews-summary-box">
                    <span class="reviews-total-count">
                        {{ $reviews->count() }} {{ trans_choice('отзыв|отзыва|отзывов', $reviews->count()) }}
                    </span>
                </div>
            @endif
        </div>
        <div class="reviews-sidebar">
            <!-- Список отзывов -->
            <div class="reviews-list">
                @forelse($reviews as $review)
                    <div class="review-item mb-3">
                        <div class="review-header">
                            <div class="user-avatar-small">
                                {{ mb_strtoupper(mb_substr($review->user_name, 0, 1, 'UTF-8'), 'UTF-8') }}
                            </div>
                            <div class="user-info">
                                <h6 class="user-name-small mb-0">{{ $review->user_name }}</h6>
                                <div class="review-rating-small">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <span class="star-filled-small">★</span>
                                        @else
                                            <span class="star-empty-small">☆</span>
                                        @endif
                                    @endfor
                                    <span class="rating-value-small">{{ $review->rating }}/5</span>
                                </div>
                            </div>
                        </div>
                        <p class="review-text-small mt-2 mb-2">{{ Str::limit($review->review_text, 80) }}</p>
                        <div class="review-footer-small">
                            <span class="review-date-small">{{ $review->created_at }}</span>
                        </div>
                    </div>
                @empty
                    <div class="no-reviews-small">
                        <i class="bi bi-chat-square-text"></i>
                        <p>Пока нет отзывов</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Кнопка и форма отзыва -->
            @auth
                <div class="text-center mt-4">
                    <button type="button" class="open-review-form-btn" id="openReviewFormBtn">
                        <i class="bi bi-pencil-square me-2"></i>Оставить отзыв
                    </button>
                </div>
                
                <!-- Форма отзыва (скрыта) -->
                <div class="review-form-sidebar mt-3" id="reviewFormSidebar" style="display: none;">
                    <form action="{{ route('product.review', $product[0]->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label-sm">Оценка *</label>
                            <div class="stars-sidebar">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" 
                                           name="rating" 
                                           id="sidebarStar{{ $i }}" 
                                           value="{{ $i }}" 
                                           class="star-radio-sidebar"
                                           required>
                                    <label for="sidebarStar{{ $i }}" class="star-label-sidebar">★</label>
                                @endfor
                            </div>
                            <div class="rating-text-sidebar">
                                <span id="sidebarRatingText">Выберите оценку</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="review_text" class="form-label-sm">Текст отзыва *</label>
                            <textarea class="form-control form-control-sm" 
                                      id="review_text_sidebar" 
                                      name="review_text" 
                                      rows="3" 
                                      required
                                      placeholder="Ваш отзыв..."></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="closeReviewFormSidebar">
                                Отмена
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="auth-notice-small mt-3">
                    <a href="{{ route('login') }}" class="login-link-small">Войдите</a>, чтобы оставить отзыв
                </div>
            @endauth
        </div>
    </div>
</div>

    

                    
           

        <!-- Спецификации -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="specifications-card">
                    <h3 class="mb-4">ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>Производитель</strong></td>
                                    <td>{{ $product[0]->country }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Год выпуска</strong></td>
                                    <td>{{ $product[0]->year }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Модель</strong></td>
                                    <td>{{ $product[0]->model }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Вес</strong></td>
                                    <td>Стандартный</td>
                                </tr>
                                <tr>
                                    <td><strong>Материал</strong></td>
                                    <td>Высококачественный</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
function changeQuantity(change) {
    const input = document.getElementById('quantity');
    const max = parseInt(input.max);
    let value = parseInt(input.value);

    value += change;

    if (value < 1) value = 1;
    if (value > max) value = max;

    input.value = value;
    document.getElementById('quantityValue').value = value;
}

function changeDays(change) {
    const input = document.getElementById('rentalDays');
    if (!input) return;
    let value = parseInt(input.value);
    if (isNaN(value)) value = 1;

    value += change;
    if (value < 1) value = 1;

    input.value = value;
    const hidden = document.getElementById('rentalDaysValue');
    if (hidden) hidden.value = value;
}

// Обновляем quantityValue при изменении input
const quantityInput = document.getElementById('quantity');
if (quantityInput) {
    quantityInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        const max = parseInt(this.max);

        if (value < 1) value = 1;
        if (value > max) value = max;

        this.value = value;
        document.getElementById('quantityValue').value = value;
    });

    // Также обновляем при изменении через стрелки
    quantityInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        const max = parseInt(this.max);

        if (value < 1) value = 1;
        if (value > max) value = max;

        this.value = value;
        document.getElementById('quantityValue').value = value;
    });
}

// Обновляем rentalDaysValue при изменении input
const rentalDaysInput = document.getElementById('rentalDays');
if (rentalDaysInput) {
    rentalDaysInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) value = 1;
        this.value = value;
        const hidden = document.getElementById('rentalDaysValue');
        if (hidden) hidden.value = value;
    });

    rentalDaysInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) value = 1;
        this.value = value;
        const hidden = document.getElementById('rentalDaysValue');
        if (hidden) hidden.value = value;
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Открытие/закрытие формы в боковой панели
    const openBtn = document.getElementById('openReviewFormBtn');
    const closeBtn = document.getElementById('closeReviewFormSidebar');
    const reviewForm = document.getElementById('reviewFormSidebar');
    
    if (openBtn && reviewForm) {
        openBtn.addEventListener('click', function() {
            reviewForm.style.display = 'block';
            openBtn.style.display = 'none';
        });
    }
    
    if (closeBtn && reviewForm && openBtn) {
        closeBtn.addEventListener('click', function() {
            reviewForm.style.display = 'none';
            openBtn.style.display = 'block';
        });
    }
    
    // Обработка звезд в боковой панели
    const sidebarStars = document.querySelectorAll('.star-radio-sidebar');
    const sidebarRatingText = document.getElementById('sidebarRatingText');
    
    if (sidebarStars.length > 0 && sidebarRatingText) {
        const ratingTexts = {
            1: "Ужасно",
            2: "Плохо",
            3: "Нормально",
            4: "Хорошо",
            5: "Отлично"
        };
        
        sidebarStars.forEach(star => {
            star.addEventListener('change', function() {
                const rating = this.value;
                sidebarRatingText.textContent = ratingTexts[rating] + ` (${rating}/5)`;
                
                // Сброс всех звезд
                sidebarStars.forEach(s => {
                    const label = s.nextElementSibling;
                    label.style.color = '#ddd';
                });
                
                // Подсветка выбранных звезд
                for (let i = 0; i < rating; i++) {
                    sidebarStars[i].nextElementSibling.style.color = 'var(--primary-color)';
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Меняем цвет выделения на сайте
    const style = document.createElement('style');
    style.textContent = `
        ::selection {
            background: var(--primary-color) !important;
            color: white !important;
        }
        ::-moz-selection {
            background: var(--primary-color) !important;
            color: white !important;
        }
        
        /* Для select элементов */
        select:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2) !important;
            outline: none !important;
        }
        
        /* Изменяем цвет стрелки select */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23ff6b35' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 0.75rem center !important;
            background-size: 16px 12px !important;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection