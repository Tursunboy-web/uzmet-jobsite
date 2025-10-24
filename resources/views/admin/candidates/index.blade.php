<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ — Кандидаты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Список кандидатов</h2>
        <a href="{{ route('apply.show') }}" class="btn btn-secondary">← На сайт</a>
    </div>

    {{-- Фильтры --}}
    <form method="get" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="position" value="{{ request('position') }}" class="form-control" placeholder="Поиск по должности">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Все статусы</option>
                <option value="new" @selected(request('status')=='new')>Новая</option>
                <option value="reviewed" @selected(request('status')=='reviewed')>Рассмотрена</option>
                <option value="interview" @selected(request('status')=='interview')>Интервью</option>
                <option value="rejected" @selected(request('status')=='rejected')>Отказ</option>
                <option value="hired" @selected(request('status')=='hired')>Принят</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Фильтр</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('admin.candidates.export') }}" class="btn btn-success w-100">⬇️ Экспорт CSV</a>
        </div>
    </form>

    {{-- Таблица кандидатов --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Должность</th>
                    <th>Дата подачи</th>
                    <th>Статус</th>
                    <th>Резюме</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            @forelse($candidates as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->position }}</td>
                    <td>{{ $c->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.candidates.status', $c->id) }}" method="post" class="d-flex">
                            @csrf
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="new" @selected($c->status=='new')>Новая</option>
                                <option value="reviewed" @selected($c->status=='reviewed')>Рассмотрена</option>
                                <option value="interview" @selected($c->status=='interview')>Интервью</option>
                                <option value="rejected" @selected($c->status=='rejected')>Отказ</option>
                                <option value="hired" @selected($c->status=='hired')>Принят</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if($c->resume_path)
                            <a href="{{ asset('storage/'.$c->resume_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">📄</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.candidates.show', $c->id) }}" class="btn btn-sm btn-info">Подробнее</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">Нет кандидатов</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $candidates->links() }}
</div>
</body>
</html>
