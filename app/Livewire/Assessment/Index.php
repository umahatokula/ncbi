<?php

namespace App\Livewire\Assessment;

use Carbon\Carbon;
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
            ->whereDate('validity_start_time', '>=', Carbon::now())
            ->get();

        // $this->page['user'] = $user->load('attempts');
    }

    public function render()
    {
        return view('livewire.assessment.index');
    }
}
