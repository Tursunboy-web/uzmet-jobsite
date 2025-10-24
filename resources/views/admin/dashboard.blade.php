<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { min-height:100vh; display:flex; }
.sidebar { width: 220px; background:#1e1e2f; color:white; padding:15px; }
.sidebar a { color:white; display:block; padding:10px; border-radius:5px; margin-bottom:5px; text-decoration:none; }
.sidebar a:hover { background:#343454; }
.main { flex:1; padding:20px; background:#f4f5f7; }
@media(max-width:768px){ .sidebar { width:100%; position:relative; } }
</style>
</head>
<body>
<div class="sidebar">
    <h4>👑 Admin</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.candidates') }}">Кандидаты</a>
    <a href="{{ route('admin.users') }}">Пользователи</a>
    <a href="{{ route('admin.roles') }}">Роли</a>
    <a href="{{ route('admin.analytics') }}">Аналитика</a>
    <a href="{{ route('admin.settings') }}">Настройки</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger w-100 mt-3">Выход</button>
    </form>
</div>
<div class="main">
    <h2>Добро пожаловать, {{ auth()->user()->name }}!</h2>
    <p>Здесь вы видите информацию по вашей роли.</p>
</div>
</body>
</html>
