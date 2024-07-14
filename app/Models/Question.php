<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'question_text',
        'category_code',
    ];

    public function assessments(): BelongsToMany {
        return $this->belongsToMany(Assessment::class);
    }

    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }

    public function getCorrectOption() {
        return Option::where([
            'question_id' => $this->id,
            'is_correct' => true,
        ])->first();
    }
}
