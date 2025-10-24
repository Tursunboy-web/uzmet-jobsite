<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👑 Панель администратора
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Добро пожаловать, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-6">Вы вошли как <strong>{{ Auth::user()->role ?? 'пользователь' }}</strong>.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-blue-100 rounded-xl text-center">
                        <h4 class="text-lg font-semibold mb-2">Кандидаты</h4>
                        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Candidate::count() }}</p>
                    </div>

                    <div class="p-6 bg-green-100 rounded-xl text-center">
                        <h4 class="text-lg font-semibold mb-2">Новые заявки</h4>
                        <p class="text-3xl font-bold text-green-600">12</p>
                    </div>

                    <div class="p-6 bg-yellow-100 rounded-xl text-center">
                        <h4 class="text-lg font-semibold mb-2">Пользователи</h4>
                        <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ url('/admin') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Перейти в раздел кандидатов
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
