@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">👤 Кандидаты из Telegram</h1>

<table class="w-full bg-white shadow rounded-xl">
    <thead class="bg-gray-200 text-left">
        <tr>
            <th class="p-3">Имя</th>
            <th class="p-3">Телефон</th>
            <th class="p-3">Резюме</th>
            <th class="p-3">Дата</th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidates as $candidate)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-3">{{ $candidate->name }}</td>
            <td class="p-3">{{ $candidate->phone }}</td>
            <td class="p-3">
                @if($candidate->resume)
                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank" class="text-blue-600">Скачать</a>
                @else
                    —
                @endif
            </td>
            <td class="p-3">{{ $candidate->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
