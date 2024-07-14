<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assessment extends Model
{
    use HasFactory;

    function casts() {
        return [
            'is_submitted' => 'boolean',
        ];
    }

    public function set(): BelongsTo {
        return $this->belongsTo(Set::class);
    }

    public function questions(): BelongsToMany {
        return $this->belongsToMany(Question::class);
    }

    public function attempts(): HasMany {
        return $this->hasMany(Attempt::class);
    }

    public function getNextAttemptNumber() {

        $user = auth()->user();

        $lastAttempt = Attempt::where([
            'user_id' => $user->id,
            'assessment_id' => $this->id,
        ])
        ->whereNotNull('ended_at')
        ->latest('id')
        ->first();

        return $lastAttempt ? ($lastAttempt?->attempt_number + 1) : 1;
    }


    public function scopeHasSubmittedAttempt($query)
    {
        return $query->whereHas('attempts', function ($query) {
            $query->where('is_submitted', 1);
        });
    }

    public function hasSubmittedAttempt() {

        $user = auth()->user();

        return $this->whereHas('attempts', function ($query) use($user) {
            $query->where([
                'is_submitted' => true,
                'user_id' => $user->id,
            ]);
        })->where([
            'id' => $this->id,
        ])->exists();
    }

    /**
     * Determine if the assessment is valid based on validity start time.
     *
     * @return bool
     */
    public function isOpen()
    {
        $tz = new CarbonTimeZone('Africa/Lagos');

        // Get the current timestamp
        $currentTimestamp = Carbon::now($tz);

        // Convert validity start time to Africa/Lagos timezone
        $validityStartTime = Carbon::parse($this->validity_start_time, $tz );
        $validityEndTime = Carbon::parse($this->validity_end_time, $tz );

        // dd($currentTimestamp, $validityStartTime, $validityEndTime);
        // dd($currentTimestamp->gt($validityStartTime));

        // Perform the comparison
        return ($currentTimestamp->gt($validityStartTime)) && ($currentTimestamp->lt($validityEndTime));
    }
}
