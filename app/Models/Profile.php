<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    public function center(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

    public function c3(): BelongsTo {
        return $this->belongsTo(C3::class);
    }

    public function serviceTeam(): BelongsTo {
        return $this->belongsTo(ServiceTeam::class);
    }
}
