<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index(Document $document)
    {
        $versions = $document->versions()->with('user')->latest()->get();
        return view('versions.index', compact('document', 'versions'));
    }

    public function show(Document $document, Version $version)
    {
        return response()->json([
            'content' => $version->content,
            'user' => $version->user->name,
            'created_at' => $version->created_at,
        ]);
    }

    public function restore(Document $document, Version $version)
    {
        $document->update(['content' => $version->content]);

        Version::create([
            'document_id' => $document->id,
            'user_id' => auth()->id(),
            'content' => $version->content,
            'change_summary' => 'Dikembalikan ke versi sebelumnya oleh ' . auth()->user()->name,
        ]);

         return redirect()->route('documents.edit', $document)
            ->with('success', 'Document restored to previous version');
    }
}