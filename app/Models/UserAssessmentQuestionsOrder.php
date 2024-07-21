<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAssessmentQuestionsOrder extends Model
{
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo {
        return $this->belongsTo(Assessment::class);
    }

    public function question(): BelongsTo {
        return $this->belongsTo(Question::class);
    }
}
