<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Attempt;
use Illuminate\Console\Command;
use App\Mail\AssessmentSubmitted;
use Illuminate\Support\Facades\Mail;

class SendAssessmentEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:send-assessment-email {userId} {attemptId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));
        $attempt = Attempt::findOrFail($this->argument('attemptId'));

        Mail::to($user->email)->send(new AssessmentSubmitted($user, $attempt));
    }
}
