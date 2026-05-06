@extends('admin.layout')

@section('title', 'Обзор')
@section('page-title', 'Обзор системы')

@section('content')
<div class="row g-4 mb-4">
    <!-- Пользователи -->
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Пользователей</p>
            </div>
        </div>
    </div>

    <!-- Админы -->
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-person-check"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalAdmins }}</h3>
                <p>Администраторов</p>
            </div>
        </div>
    </div>

    <!-- Заказы -->
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-bag"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalOrders }}</h3>
                <p>Заказов</p>
            </div>
        </div>
    </div>

    <!-- Товары -->
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-box"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalProducts }}</h3>
                <p>Товаров</p>
            </div>
        </div>
    </div>
</div>

<!-- Выручка -->
<div class="row mb-4">
    <div class="col-12">
        <div class="stat-card">
            <div class="stat-icon green" style="width: 80px; height: 80px; font-size: 2rem;">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-info">
                <h3>{{ number_format($totalRevenue, 0, '', ' ') }} ₽</h3>
                <p>Общая выручка</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Последние заказы -->
    <div class="col-lg-8">
        <div class="admin-table">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">ПОСЛЕДНИЕ ЗАКАЗЫ</h6>
                <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-purple">
                    Все заказы <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Пользователь</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td>{{ $order->user_name ?? 'Неизвестный' }}</td>
                            <td>{{ number_format($order->total_amount, 0, '', ' ') }} ₽</td>
                            <td>
                                @if($order->status == 'active')
                                    <span class="badge badge-green">Активен</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge badge-blue">Завершён</span>
                                @elseif($order->status == 'pending')
                                    <span class="badge badge-orange">Ожидает</span>
                                @else
                                    <span class="badge badge-red">Отменён</span>
                                @endif
                            </td>
                            <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Заказов пока нет
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Новые пользователи -->
    <div class="col-lg-4">
        <div class="admin-table">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">НОВЫЕ ПОЛЬЗОВАТЕЛИ</h6>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-purple">
                    Все <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="list-group list-group-flush">
                @forelse($recentUsers as $user)
                <div class="list-group-item d-flex align-items-center gap-3 p-3">
                    <div class="admin-user-avatar" style="width: 40px; height: 40px; font-size: 0.9rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <small class="text-muted">{{ $user->email }}</small>
                    </div>
                    @if($user->role == 'admin')
                        <span class="badge badge-purple">ADM</span>
                    @endif
                </div>
                @empty
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                    Пользователей нет
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Быстрые действия -->
<div class="row mt-4">
    <div class="col-12">
        <div class="admin-table p-4">
            <h6 class="fw-bold mb-3">БЫСТРЫЕ ДЕЙСТВИЯ</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('add_product') }}" class="btn btn-purple">
                    <i class="bi bi-plus-circle me-2"></i>Добавить товар
                </a>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-purple">
                    <i class="bi bi-people me-2"></i>Управление пользователями
                </a>
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-purple">
                    <i class="bi bi-bag me-2"></i>Все заказы
                </a>
                <a href="{{ route('admin.products') }}" class="btn btn-outline-purple">
                    <i class="bi bi-box me-2"></i>Все товары
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
