<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'СТРОЙМАСТЕР') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('public/img/12312.svg') }}" type="image/x-icon">
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
    }

    .sports-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .discount-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--accent-color);
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 900;
        font-size: 0.9rem;
        z-index: 1;
    }

    .counter {
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        color: var(--primary-color);
        font-size: 3rem;
    }

    /* === ФИКС ДЛЯ ХЕДЕРА - перебиваем public/css/style.css === */
        header.site-header {
        background: linear-gradient(135deg, #1b2838 0%, #162032 100%) !important;
        padding: 0.75rem 0 !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2) !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1000 !important;
    }

    header.site-header .header-wrapper {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-wrap: wrap !important;
        gap: 1rem !important;
    }

    header.site-header .logo-link {
        display: flex !important;
        align-items: center !important;
        text-decoration: none !important;
    }

    header.site-header .logo-link:hover {
        text-decoration: none !important;
    }

    header.site-header .logo-icon-box {
        width: 48px !important;
        height: 48px !important;
        background: linear-gradient(135deg, #3498db, #2980b9) !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.5) !important;
        flex-shrink: 0 !important;
    }

    header.site-header .logo-icon-box i,
    header.site-header .logo-icon-box i.bi,
    header.site-header .logo-icon-box i.bi-hammer {
        font-size: 24px !important;
        color: #fff !important;
        line-height: 1 !important;
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
        transform: none !important;
        position: static !important;
        top: auto !important;
        left: auto !important;
        text-shadow: none !important;
        opacity: 1 !important;
    }

    header.site-header .logo-text {
        display: flex !important;
        flex-direction: column !important;
        white-space: nowrap !important;
        line-height: 1 !important;
        margin-left: 12px !important;
    }

    header.site-header .logo-main {
        font-size: 1.4rem !important;
        font-weight: 800 !important;
        color: #fff !important;
        letter-spacing: 0.5px !important;
        line-height: 1.2 !important;
        display: block !important;
        text-shadow: none !important;
        margin: 0 !important;
    }

    header.site-header .logo-tagline {
        font-size: 0.7rem !important;
        color: rgba(255, 255, 255, 0.6) !important;
        font-weight: 400 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        display: block !important;
    }

    header.site-header .main-nav {
        display: flex !important;
        justify-content: center !important;
    }

    header.site-header .nav-list {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    header.site-header .nav-item {
        margin: 0 !important;
    }

    header.site-header .nav-link {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 8px 14px !important;
        color: rgba(255, 255, 255, 0.9) !important;
        border-radius: 6px !important;
        transition: background 0.3s ease, color 0.3s ease !important;
        font-weight: 500 !important;
        font-size: 0.95rem !important;
        white-space: nowrap !important;
        text-decoration: none !important;
        background: transparent !important;
    }

    header.site-header .nav-link:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
    }

    header.site-header .nav-link.active {
        background: linear-gradient(135deg, #9b59b6, #8e44ad) !important;
        color: #fff !important;
    }

    header.site-header .nav-link i {
        font-size: 1rem !important;
    }

    header.site-header .header-actions {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
    }

    header.site-header .cart-btn {
        position: relative !important;
        width: 42px !important;
        height: 42px !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: background 0.3s ease !important;
        text-decoration: none !important;
    }

    header.site-header .cart-btn i {
        font-size: 20px !important;
        color: #fff !important;
    }

    header.site-header .cart-btn:hover {
        background: rgba(255, 255, 255, 0.2) !important;
    }

    header.site-header .cart-badge {
        position: absolute !important;
        top: -5px !important;
        right: -5px !important;
        background: #9b59b6 !important;
        color: #fff !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        padding: 2px 6px !important;
        border-radius: 10px !important;
        min-width: 18px !important;
        text-align: center !important;
    }

    header.site-header .btn-login,
    header.site-header .btn-register {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 8px 16px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        border: none !important;
        cursor: pointer !important;
    }

    header.site-header .btn-login {
        background: transparent !important;
        color: #fff !important;
        border: 2px solid rgba(255, 255, 255, 0.4) !important;
    }

    header.site-header .btn-login:hover {
        border-color: #fff !important;
        background: rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
    }

    header.site-header .btn-register {
        background: linear-gradient(135deg, #9b59b6, #8e44ad) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(155, 89, 182, 0.4) !important;
    }

    header.site-header .btn-register:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 18px rgba(155, 89, 182, 0.5) !important;
        color: #fff !important;
    }

    header.site-header .user-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 8px 14px !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border-radius: 8px !important;
        color: #fff !important;
        text-decoration: none !important;
        transition: background 0.3s ease !important;
        white-space: nowrap !important;
    }

    header.site-header .user-btn:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        color: #fff !important;
    }

    header.site-header .user-btn i {
        font-size: 18px !important;
    }

    header.site-header .mobile-menu-btn {
        display: none !important;
        flex-direction: column !important;
        gap: 5px !important;
        background: transparent !important;
        border: none !important;
        cursor: pointer !important;
        padding: 8px !important;
    }

    header.site-header .hamburger-line {
        width: 22px !important;
        height: 2px !important;
        background: #fff !important;
        border-radius: 2px !important;
    }

    @media (max-width: 991px) {
        header.site-header .main-nav {
            display: none !important;
        }

        header.site-header .mobile-menu-btn {
            display: flex !important;
        }

        header.site-header .btn-login span,
        header.site-header .btn-register span {
            display: none !important;
        }

        header.site-header .logo-tagline {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        header.site-header .header-wrapper {
            gap: 10px !important;
        }

        header.site-header .logo-main {
            font-size: 1.1rem !important;
        }

        header.site-header .btn-register {
            display: none !important;
        }
    }
</style>
</head>
<body>
    <div id="app">
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <!-- Логотип -->
                <a href="{{ route('index') }}" class="logo-link">
                    <div class="logo-icon-box">
                        <i class="bi bi-hammer"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">СТРОЙМАСТЕР</span>
                        <span class="logo-tagline">Строительные материалы</span>
                    </div>
                </a>

                <!-- Навигация -->
                <nav class="main-nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="{{ route('why') }}" class="nav-link {{ request()->routeIs('why') ? 'active' : '' }}">
                                <i class="bi bi-info-circle"></i>
                                <span>О нас</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('catalog') }}" class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}">
                                <i class="bi bi-grid"></i>
                                <span>Каталог</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('map') }}" class="nav-link {{ request()->routeIs('map') ? 'active' : '' }}">
                                <i class="bi bi-geo-alt"></i>
                                <span>Где нас найти</span>
                            </a>
                        </li>

                        <!-- Админ-меню -->
                        @auth
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                    <i class="bi bi-shield-lock"></i>
                                    <span>Админ-панель</span>
                                </a>
                            </li>
                            @endif
                        @endauth
                    </ul>
                </nav>

                <!-- Правая панель -->
                <div class="header-actions">
                    <!-- Корзина -->
                    <a href="{{ route('cart') }}" class="cart-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="cart-badge">{{ $cartCount ?? 0 }}</span>
                    </a>

                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Войти</span>
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-register">
                                <i class="bi bi-person-plus"></i>
                                <span>Регистрация</span>
                            </a>
                        @endif
                    @else
                        <div class="user-dropdown dropdown">
                            <a href="#" class="user-btn dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('home') }}" class="dropdown-item">
                                    <i class="bi bi-person"></i>Личный кабинет
                                </a>
                                <a href="{{ route('orders') }}" class="dropdown-item">
                                    <i class="bi bi-bag"></i>Мои заказы
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>Выйти
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Мобильное меню -->
                    <button class="mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div class="collapse mobile-menu" id="mobileMenu">
            <div class="container">
                <ul class="mobile-nav-list">
                    <li>
                        <a href="{{ route('why') }}" class="mobile-nav-link {{ request()->routeIs('why') ? 'active' : '' }}">
                            <i class="bi bi-info-circle"></i>О нас
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catalog') }}" class="mobile-nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}">
                            <i class="bi bi-grid"></i>Каталог
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('map') }}" class="mobile-nav-link {{ request()->routeIs('map') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt"></i>Где нас найти
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->isAdmin())
                        <li>
                            <a href="{{ route('admin.index') }}" class="mobile-nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                <i class="bi bi-shield-lock"></i>Админ-панель
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </header>
    
    <main class="py-4">
        @yield('content')
    </main>
</div>

        <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="logo-wrapper mb-3">
                    <i class="bi bi-hammer me-2" style="font-size: 2rem;"></i>
                    <div class="logo-text">
                        <span class="logo-main">СТРОЙМАСТЕР</span>
                    </div>
                </div>
                <p>Качественные стройматериалы и инструменты для профессионалов и домашних мастеров. Надёжность, доступные цены и проверенное качество.</p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Контакты</h5>
                <ul class="list-unstyled">
                    <li><a href="https://yandex.ru/maps/-/CPQ5yQL1"><i class="bi bi-geo-alt me-2"></i> г. Москва, ул. Строителей, 15</a></li>
                    <li><a href="tel:84957654321"><i class="bi bi-telephone me-2"></i> +7 (495) 765-43-21</a></li>
                    <li><a href="mailto:info@stroimaster.ru"><i class="bi bi-envelope me-2"></i> info@stroimaster.ru</a></li>
                    <li><a href="mailto:zakaz@stroimaster.ru"><i class="bi bi-envelope me-2"></i> zakaz@stroimaster.ru</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Мы в соцсетях</h5>
                <div class="social-links">
                    <a href="#" class="text-light me-3"><i class="bi bi-chat-dots"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-telegram"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                </div>
                <div class="mt-4">
                    <h5>Режим работы</h5>
                    <p class="mb-1">Пн-Пт: 9:00 - 20:00</p>
                    <p>Сб-Вс: 10:00 - 18:00</p>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p>&copy; 2026 СТРОЙМАСТЕР. Все права защищены.</p>
        </div>
    </div>
</footer>
    </div>
</body>
</html>
