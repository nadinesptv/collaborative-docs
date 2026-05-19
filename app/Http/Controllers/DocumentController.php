<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', auth()->id())->latest()->paginate(10);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $document = Document::create([
            'title' => $request->title,
            'content' => '<p>Mulai mengetik di sini...</p>',
            'user_id' => auth()->id(),
        ]);
          $document = auth()->user()->documents()->create($validated);

        // Simpan versi awal (v1) saat dokumen dibuat
        $document->versions()->create([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? '',
            'version_number' => 1,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('documents.edit', $document);
    }

    public function edit(Document $document)
    {
        // Cek akses
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('documents.edit', compact('document'));
    }

    public function show(Document $document)
    {
        // Cek akses
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('documents.show', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        abort_if($document->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $document->update($validated);

        // PERBAIKAN: Gunakan redirect dengan flash message, bukan response()->json()
        return redirect()->route('documents.edit', $document->id)
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

}