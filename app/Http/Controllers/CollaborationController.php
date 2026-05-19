<?php

namespace App\Http\Controllers;

use App\Events\DocumentUpdated;
use App\Events\CursorMoved;
use App\Models\Document;
use App\Models\Version;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function updateContent(Request $request, Document $document)
    {
        $request->validate([
            'content' => 'required|string',
            'change_type' => 'required|in:edit,delete,format',
        ]);

        $oldContent = $document->content;
        $newContent = $request->content;

        // Conflict resolution: last-write-wins
        $document->update(['content' => $newContent]);

        // Simpan version history
        Version::create([
            'document_id' => $document->id,
            'user_id' => auth()->id(),
            'content' => $newContent,
            'change_summary' => 'Diedit oleh ' . auth()->user()->name,
        ]);

        // Broadcast ke user lain
        event(new DocumentUpdated(
            $document->id,
            auth()->id(),
            auth()->user()->name,
            $newContent,
            $request->change_type
        ));

        return response()->json(['message' => 'Content updated']);
    }

    public function updateCursor(Request $request, Document $document)
    {
        $request->validate([
            'position' => 'required|integer',
            'color' => 'required|string',
        ]);

        // Broadcast cursor position
        event(new CursorMoved(
            $document->id,
            auth()->id(),
            auth()->user()->name,
            $request->position,
            $request->color
        ));

        return response()->json(['message' => 'Cursor updated']);
    }
}