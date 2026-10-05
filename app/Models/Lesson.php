<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
        'description',
        'content',
        'video_url',
        'duration',
        'position',
        'status',
    ];

    protected $casts = [
        'duration' => 'integer',
        'position' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Módulo ao qual a aula pertence.
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}