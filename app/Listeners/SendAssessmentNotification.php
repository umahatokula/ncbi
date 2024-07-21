<?php

namespace App\Listeners;

use App\Events\AssessmentSubmitted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAssessmentNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AssessmentSubmitted $event): void
    {
        Artisan::call('assessment:send-assessment-email', [
            'userId' => $event->user->id,
            'attemptId' => $event->attempt->id
        ]);
    }
}
