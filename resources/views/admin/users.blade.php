@extends('admin.layout')

@section('title', 'Пользователи')
@section('page-title', 'Управление пользователями')

@section('content')
<div class="admin-table">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">ВСЕ ПОЛЬЗОВАТЕЛИ ({{ $users->total() }})</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><strong>{{ $user->id }}</strong></td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="admin-user-avatar" style="width: 35px; height: 35px; font-size: 0.85rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span>{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge badge-purple">Администратор</span>
                        @else
                            <span class="badge badge-blue">Пользователь</span>
                        @endif
                    </td>
                    <td>{{ date('d.m.Y H:i', strtotime($user->created_at)) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            @if($user->id !== auth()->id())
                                @if($user->role == 'user')
                                    <form action="{{ route('admin.users.make-admin', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-purple" title="Сделать админом">
                                            <i class="bi bi-person-check"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.make-user', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-purple" title="Сделать пользователем">
                                            <i class="bi bi-person"></i>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить пользователя {{ $user->name }}?') ?>">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">Это вы</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="p-4 border-top">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
