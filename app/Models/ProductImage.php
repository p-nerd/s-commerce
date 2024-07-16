<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'filename',
        'path',
    ];

    public static function store(UploadedFile $file): self
    {
        $path = $file->store('images', 'public');
        $filename = $file->getClientOriginalName();

        return self::create([
            'filename' => $filename,
            'path' => $path,
        ]);
    }

    public function getUrlAttribute(): string
    {
        if (str()->isUrl($this->path)) {
            return $this->path;
        }

        return Storage::disk('public')->url($this->path);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
