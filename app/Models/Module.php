<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'description',
        'order',
        'status',
    ];

    /**
     * Course relacionado ao módulo.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Módulo relacionado as aulas.
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}