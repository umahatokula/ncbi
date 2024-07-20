<?php

namespace App\Livewire\Assessment;

use Livewire\Component;
use App\Models\Assessment;
use App\Models\User;

class Confirmation extends Component
{
    public Assessment $assessment;
    public User $user;
    public $attemptNumber;

    function mount()
    {

        $this->user = auth()->user();

        $assessmentSlug = request('slug');
        $this->attemptNumber = request('attemptNumber');

        $this->assessment  = Assessment::where('slug', $assessmentSlug)->with('questions')->first();

    }
    public function render()
    {
        return view('livewire.assessment.confirmation');
    }
}
