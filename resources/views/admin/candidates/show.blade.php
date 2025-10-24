<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анкета кандидата #{{ $candidate->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-3">Анкета кандидата</h3>

            <table class="table table-bordered">
                <tr><th>ID</th><td>{{ $candidate->id }}</td></tr>
                <tr><th>Имя</th><td>{{ $candidate->first_name }}</td></tr>
                <tr><th>Фамилия</th><td>{{ $candidate->last_name }}</td></tr>
                <tr><th>Год рождения</th><td>{{ $candidate->birth_year }}</td></tr>
                <tr><th>Телефон</th><td>{{ $candidate->phone }}</td></tr>
                <tr><th>Email</th><td>{{ $candidate->email }}</td></tr>
                <tr><th>Должность</th><td>{{ $candidate->position }}</td></tr>
                <tr><th>Опыт работы</th><td>{{ $candidate->experience }}</td></tr>
                <tr><th>Образование</th><td>{{ $candidate->education }}</td></tr>
                <tr><th>Статус</th><td>{{ ucfirst($candidate->status) }}</td></tr>
                <tr>
                    <th>Резюме</th>
                    <td>
                        @if($candidate->resume_path)
                            <a href="{{ asset('storage/'.$candidate->resume_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                📄 Скачать
                            </a>
                        @else
                            Не загружено
                        @endif
                    </td>
                </tr>
                <tr><th>Дата подачи</th><td>{{ $candidate->created_at->format('d.m.Y H:i') }}</td></tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
