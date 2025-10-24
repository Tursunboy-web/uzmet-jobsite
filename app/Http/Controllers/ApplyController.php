<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    /**
     * Показывает форму для подачи заявки
     */
    public function show()
    {
        return view('apply.form');
    }

    /**
     * Обрабатывает и сохраняет заявку кандидата
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'birth_year' => 'nullable|digits:4',
            'phone'      => 'required|string|max:50',
            'email'      => 'nullable|email',
            'position'   => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'education'  => 'nullable|string',
            'resume'     => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Если файл есть — сохраняем его в storage/app/public/resumes/
        if ($request->hasFile('resume')) {
            $validated['resume_path'] = $request->file('resume')->store('resumes', 'public');
        }

        // Статус по умолчанию "new"
        $validated['status'] = 'new';

        Candidate::create($validated);

        return redirect()
            ->route('apply.show')
            ->with('success', '✅ Ваша анкета успешно отправлена!');
    }
}
