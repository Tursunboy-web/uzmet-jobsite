<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход для HR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4b6cb7, #182848);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .login-card {
            background: white;
            color: #333;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 400px;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="text-center mb-4">👔 Вход в HR-панель</h3>
        <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label>Электронная почта</label>
        <input type="email" name="email" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100">Войти</button>
</form>

    </div>
</body>
</html>
