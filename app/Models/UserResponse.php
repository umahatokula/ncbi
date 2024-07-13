<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt_id',
        'question_id',
        'option_id',
    ];

    public function attempt(): BelongsTo {
        return $this->belongsTo(Attempt::class);
    }

    public function question(): BelongsTo {
        return $this->belongsTo(Question::class);
    }

    public function option(): BelongsTo {
        return $this->belongsTo(Option::class);
    }
}
