@extends('layouts.app')

@section('content')
<main>
    <!-- О компании -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-bold mb-4">О КОМПАНИИ "СТРОЙМАСТЕР"</h1>
                        <p class="lead text-muted mb-4">Ваш надёжный партнёр в мире строительных материалов с 2010 года</p>
                        <p class="text-muted mb-3">Мы работаем на рынке строительных материалов более 10 лет и зарекомендовали себя как надёжный поставщик качественных материалов для профессионалов и домашних мастеров.</p>
                        <p class="text-muted mb-4">Наша миссия — предоставлять профессиональные строительные материалы и инструменты по доступным ценам с высоким уровнем сервиса.</p>
                        
                        <div class="row g-4 mt-5 justify-content-center">
                            <div class="col-4 col-md-3">
                                <div class="stat-box text-center p-3">
                                    <h3 class="display-4 fw-bold mb-0" style="color: #9b59b6;">10+</h3>
                                    <p class="mb-0 text-muted small">лет на рынке</p>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-box text-center p-3">
                                    <h3 class="display-4 fw-bold mb-0" style="color: #9b59b6;">5000+</h3>
                                    <p class="mb-0 text-muted small">клиентов</p>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-box text-center p-3">
                                    <h3 class="display-4 fw-bold mb-0" style="color: #9b59b6;">10000+</h3>
                                    <p class="mb-0 text-muted small">товаров</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Наши ценности -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">НАШИ ЦЕННОСТИ</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card text-center p-4 rounded-3 h-100 border">
                        <div class="value-icon mb-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Надёжность</h5>
                        <p class="text-muted">Гарантия качества на всю продукцию. Работаем только с проверенными производителями.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center p-4 rounded-3 h-100 border">
                        <div class="value-icon mb-3">
                            <i class="bi bi-hand-thumbs-up"></i>
                        </div>
                        <h5>Качество</h5>
                        <p class="text-muted">Вся продукция сертифицирована и соответствует ГОСТ и международным стандартам.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center p-4 rounded-3 h-100 border">
                        <div class="value-icon mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5>Забота о клиентах</h5>
                        <p class="text-muted">Индивидуальный подход к каждому клиенту. Профессиональные консультации и поддержка.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">ПОЧЕМУ ВЫБИРАЮТ НАС</h2>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center p-4 bg-white rounded-3">
                        <div class="feature-icon-modern mb-3">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Быстрая доставка</h5>
                        <p class="text-muted small">По всей России 1-3 дня</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center p-4 bg-white rounded-3">
                        <div class="feature-icon-modern mb-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Гарантия 2 года</h5>
                        <p class="text-muted small">На все товары</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center p-4 bg-white rounded-3">
                        <div class="feature-icon-modern mb-3">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <h5>Возврат 30 дней</h5>
                        <p class="text-muted small">Без проблем</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card-modern text-center p-4 bg-white rounded-3">
                        <div class="feature-icon-modern mb-3">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Поддержка 24/7</h5>
                        <p class="text-muted small">Всегда на связи</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Контакты -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">КОНТАКТЫ</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="contact-info-card text-center p-4 bg-white rounded-3">
                        <div class="contact-icon mb-3">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Адрес</h6>
                        <p class="text-muted mb-0">г. Москва, ул. Строителей, 15<br>Технопарк "Строймастер"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card text-center p-4 bg-white rounded-3">
                        <div class="contact-icon mb-3">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Телефон</h6>
                        <p class="text-muted mb-0">+7 (495) 765-43-21</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card text-center p-4 bg-white rounded-3">
                        <div class="contact-icon mb-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Email</h6>
                        <p class="text-muted mb-0">info@stroimaster.ru<br>zakaz@stroimaster.ru</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.stat-box {
    transition: transform 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-5px);
}

.value-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: linear-gradient(135deg, #9b59b6, #5dade2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.value-icon i {
    font-size: 2.5rem;
    color: #fff;
}

.value-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(39, 174, 96, 0.15);
}

.feature-icon-modern {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: linear-gradient(135deg, #9b59b6, #5dade2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon-modern i {
    font-size: 2.5rem;
    color: #fff;
}

.feature-card-modern {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(44, 62, 80, 0.1);
}

.contact-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-icon i {
    font-size: 2rem;
    color: #fff;
}

.contact-info-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(44, 62, 80, 0.1);
}
</style>
@endsection