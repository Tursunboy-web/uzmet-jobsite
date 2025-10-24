<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r): View
    {
        $q = Candidate::query();

        if ($r->filled('position')) {
            $q->where('position', 'like', '%' . $r->position . '%');
        }
        if ($r->filled('status')) {
            $q->where('status', $r->status);
        }

        $candidates = $q->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Пример — добавь нужную валидацию и сохранение
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'position'   => 'required|string|max:150',
        ]);

        Candidate::create($validated);

        return redirect()->route('admin.candidates.index')
                         ->with('success', 'Candidate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate): View
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate): View
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $r, Candidate $candidate): RedirectResponse
    {
        $r->validate([
            'status' => 'required|in:new,reviewed,interview,rejected,hired'
        ]);

        $candidate->status = $r->status;
        $candidate->save();

        return back()->with('success', 'Status updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate): RedirectResponse
    {
        $candidate->delete();

        return back()->with('success', 'Candidate deleted');
    }

    /**
     * Export all candidates to CSV.
     */
    public function export()
    {
        $fileName = 'candidates_' . date('Ymd_His') . '.csv';
        $columns = ['id', 'first_name', 'last_name', 'phone', 'email', 'position', 'status', 'created_at'];

        return response()->streamDownload(function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            Candidate::chunk(200, function ($rows) use ($file) {
                foreach ($rows as $r) {
                    fputcsv($file, [
                        $r->id,
                        $r->first_name,
                        $r->last_name,
                        $r->phone,
                        $r->email,
                        $r->position,
                        $r->status,
                        $r->created_at,
                    ]);
                }
            });

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
