<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('document.{documentId}', function ($user, $documentId) {
    // Check if user has access to this document
    return \App\Models\Document::where('id', $documentId)
        ->where('user_id', $user->id)
        ->exists() || $user->role === 'admin';
});