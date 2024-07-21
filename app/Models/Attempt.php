<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assessment_id',
        'attempt_number',
        'started_at',
        'ended_at',
        'correctly_answered',
        'total_number_of_questions',
        'percentage_score',
        'is_submitted',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo {
        return $this->belongsTo(Assessment::class);
    }

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }

    public function getScore() {
        // $questions = Question::where('assessment_id', $this->assessment_id)->get();
        $questions = (Assessment::findOrFail($this->assessment_id))?->questions;

        $responses = $this->userResponses;

        $correctlyAnswered = 0;
        foreach ($responses as $response) {
            $question = $questions->where('id', $response->question_id)->first();
            if(!$question) return;
            $correctOption = $question->getCorrectOption();

            // mark as correct if there's no correct option
            if(!$correctOption) {
                $correctlyAnswered = $correctlyAnswered + 1;
            }

            if($response->option_id == $correctOption?->id) {
                $correctlyAnswered = $correctlyAnswered + 1;
            }
        }

        return [
            'correctlyAnswered' => $correctlyAnswered,
            'totalNumberOfQuestions' => $questions->count(),
            'percentageScore' => $correctlyAnswered == 0 || $questions->count() == 0 ? 0 : ($correctlyAnswered / $questions->count()) * 100,
        ];
    }
}
