@extends('admin.layout')

@section('title', 'Товары')
@section('page-title', 'Управление товарами')

@section('content')
<div class="admin-table">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">ВСЕ ТОВАРЫ ({{ $products->total() }})</h6>
        <a href="{{ route('add_product') }}" class="btn btn-sm btn-purple">
            <i class="bi bi-plus-circle me-2"></i>Добавить товар
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Товар</th>
                    <th>Категория</th>
                    <th>Цена</th>
                    <th>Наличие</th>
                    <th>Страна</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><strong>{{ $product->id }}</strong></td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->model }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->category_name }}</td>
                    <td><strong>{{ number_format($product->price, 0, '', ' ') }} ₽/день</strong></td>
                    <td>
                        @if($product->in_stock > 0)
                            <span class="badge badge-green">{{ $product->in_stock }} шт.</span>
                        @else
                            <span class="badge badge-red">Нет</span>
                        @endif
                    </td>
                    <td>{{ $product->country }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-purple">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('product', $product->id) }}" class="btn btn-sm btn-outline-purple" target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить товар?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div class="p-4 border-top">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
