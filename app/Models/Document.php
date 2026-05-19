<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class)->orderByDesc('created_at');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(EditSession::class);
    }

    public function getFileSizeAttribute() {
    // Format ukuran file dari bytes
    return $this->size ? $this->formatBytes($this->size) : 'N/A';
}

private function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max(0, $bytes);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
}
}