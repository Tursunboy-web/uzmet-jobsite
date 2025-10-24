<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex h-screen">

    {{-- Сайдбар --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            🧭 AdminPanel
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800">📊 Аналитика</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">👤 Кандидаты</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">🧱 Пользователи</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">🧩 Роли</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">⚙️ Настройки</a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded hover:bg-gray-800">🚪 Выйти</button>
            </form>
        </div>
    </aside>

    {{-- Контент --}}
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>
