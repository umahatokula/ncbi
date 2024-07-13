<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_text',
        'is_correct',
    ];

    function casts() {
        return [
            'is_correct' => 'boolean',
        ];
    }

    public function question(): BelongsTo {
        return $this->belongsTo(Question::class);
    }
}
