@extends('admin.layout')

@section('title', 'Добавить товар')
@section('page-title', 'Добавление товара')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="admin-table">
            <div class="p-4 border-bottom">
                <h6 class="mb-0 fw-bold">НОВЫЙ ТОВАР</h6>
            </div>
            <div class="p-4">
                <!-- Сообщения -->
                @if(session('msg'))
                    <div class="alert alert-{{ session('msg_type', 'success') }} alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('img') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-4">
                        <!-- Основная информация -->
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">ОСНОВНАЯ ИНФОРМАЦИЯ</h6>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Название товара <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Например: Цемент" required>
                            <div class="invalid-feedback">Введите название товара</div>
                        </div>

                        <div class="col-md-6">
                            <label for="model" class="form-label">Модель <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Например: Клинкер" required>
                            <div class="invalid-feedback">Введите модель товара</div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Описание <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Опишите товар..." required></textarea>
                            <div class="invalid-feedback">Введите описание товара</div>
                        </div>

                        <!-- Цена и изображение -->
                        <div class="col-md-6">
                            <label for="price" class="form-label">Цена аренды (₽/день) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Например: 4999" required>
                                <span class="input-group-text">₽/день</span>
                            </div>
                            <small class="text-muted">Введите сумму вручную</small>
                            <div class="invalid-feedback">Введите корректную цену</div>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Изображение <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                            <small class="text-muted">JPG, PNG, GIF, WEBP (макс. 10 МБ)</small>
                            <div class="invalid-feedback">Выберите изображение товара</div>
                        </div>

                        <!-- Характеристики -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold mb-3">ХАРАКТЕРИСТИКИ</h6>
                        </div>

                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Категория <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Выберите категорию</div>
                        </div>

                        <div class="col-md-4">
                            <label for="year" class="form-label">Год выпуска <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="year" name="year" placeholder="2023" min="2000" max="{{ date('Y') + 1 }}" required>
                            <div class="invalid-feedback">Введите корректный год</div>
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">Страна <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Например: США" required>
                            <div class="invalid-feedback">Введите страну-производителя</div>
                        </div>

                        <!-- Количество -->
                        <div class="col-md-6">
                            <label for="in_stock" class="form-label">Количество на складе <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="in_stock" name="in_stock" placeholder="0" min="0" required>
                            <div class="invalid-feedback">Введите количество</div>
                        </div>

                        <div class="col-md-6">
                            <label for="description_info" class="form-label">Детальное описание</label>
                            <textarea class="form-control" id="description_info" name="description_info" rows="2" placeholder="Дополнительная информация..."></textarea>
                        </div>

                        <!-- Кнопки -->
                        <div class="col-12 mt-4">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn btn-purple btn-lg px-5">
                                    <i class="bi bi-check-circle me-2"></i>ДОБАВИТЬ ТОВАР
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