<?php

namespace App\Livewire\Assessment;

use Carbon\Carbon;
use App\Models\Attempt;
use Livewire\Component;
use App\Models\Assessment;

class Index extends Component
{
    public $assessments;

    function mount()
    {

        $user = auth()->user();

        $this->assessments = Assessment::with(['attempts' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
            ->orderBy('validity_start_time', 'desc')
            ->whereDate('validity_start_time', '<=', Carbon::now())
            ->whereDate('validity_end_time', '>=', Carbon::now())
            ->get();
    }


    function onFinalAttemptSubmission($attemptId) {
        Attempt::where('id', $attemptId)->update([
            'is_submitted' => true,
        ]);

        session()->flash('success', 'Successful');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.assessment.index');
    }
}
