@extends('admin.layout')

@section('title', 'Редактировать товар')
@section('page-title', 'Редактирование товара')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="admin-table">
            <div class="p-4 border-bottom">
                <h6 class="mb-0 fw-bold">РЕДАКТИРОВАНИЕ ТОВАРА #{{ $product->id }}</h6>
            </div>
            <div class="p-4">
                <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-4">
                        <!-- Основная информация -->
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">ОСНОВНАЯ ИНФОРМАЦИЯ</h6>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Название товара <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            <div class="invalid-feedback">Введите название товара</div>
                        </div>

                        <div class="col-md-6">
                            <label for="model" class="form-label">Модель <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $product->model) }}" required>
                            <div class="invalid-feedback">Введите модель товара</div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Описание <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                            <div class="invalid-feedback">Введите описание товара</div>
                        </div>

                        <!-- Цена и изображение -->
                        <div class="col-md-6">
                            <label for="price" class="form-label">Цена аренды (₽/день) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Например: 4999" required>
                                <span class="input-group-text">₽/день</span>
                            </div>
                            <small class="text-muted">Введите сумму вручную</small>
                            <div class="invalid-feedback">Введите корректную цену</div>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Изображение</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            <small class="text-muted">Оставьте пустым, чтобы не менять изображение</small>
                            @if($product->image)
                                <div class="mt-2">
                                    <img src="{{ asset($product->image) }}" alt="Текущее изображение" style="max-width: 150px; border-radius: 8px;">
                                </div>
                            @endif
                        </div>

                        <!-- Характеристики -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold mb-3">ХАРАКТЕРИСТИКИ</h6>
                        </div>

                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Категория <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" disabled>Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Выберите категорию</div>
                        </div>

                        <div class="col-md-4">
                            <label for="year" class="form-label">Год выпуска <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $product->year) }}" min="2000" max="{{ date('Y') + 1 }}" required>
                            <div class="invalid-feedback">Введите корректный год</div>
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">Страна <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $product->country) }}" required>
                            <div class="invalid-feedback">Введите страну-производителя</div>
                        </div>

                        <!-- Количество -->
                        <div class="col-md-6">
                            <label for="in_stock" class="form-label">Количество на складе <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="in_stock" name="in_stock" value="{{ old('in_stock', $product->in_stock) }}" min="0" required>
                            <div class="invalid-feedback">Введите количество</div>
                        </div>

                        <div class="col-md-6">
                            <label for="category_name" class="form-label">Текущая категория</label>
                            <input type="text" class="form-control" id="category_name" value="{{ $categoryName ?? 'Неизвестно' }}" disabled>
                        </div>

                        <!-- Кнопки -->
                        <div class="col-12 mt-4">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn btn-purple btn-lg px-5">
                                    <i class="bi bi-check-circle me-2"></i>СОХРАНИТЬ ИЗМЕНЕНИЯ
                                </button>
                                <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-x-circle me-2"></i>ОТМЕНА
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Валидация формы
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

// Разрешаем вводить только цифры в поле цены
document.getElementById('price').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
@endsection
