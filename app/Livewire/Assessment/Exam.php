<?php

namespace App\Livewire\Assessment;

use Carbon\Carbon;
use App\Models\Attempt;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\UserResponse;

class Exam extends Component
{
   public $assessment;
   public $attempt;
   public $optionsAlphabets;
   public $userResponses;

    public function mount() {

        $user = auth()->user();
        $assessmentSlug = request('slug');
        $attemptNumber = request('attemptNumber');

        $assessment = Assessment::where('slug', $assessmentSlug)
            ->with(['questions' => function ($query) {
                $query->inRandomOrder();
            }])
            ->first();


        $isOpen = $assessment->isOpen();
        if (!$isOpen) {
            // Flash::error('Assessment is closed');
            return redirect('/assessment-attempts');
        }

        $attempt = Attempt::firstOrCreate(
            [
                'user_id' =>  $user->id,
                'assessment_id' =>  $assessment?->id,
                'attempt_number' => $attemptNumber,
            ],
            [
                'started_at' => Carbon::now(),
                'score' => 0,
            ]
        );

        $userResponses = UserResponse::where('attempt_id', $attempt->id)->pluck('option_id')->toArray();

        $this->assessment = $assessment;
        $this->attempt = $attempt;
        $this->optionsAlphabets = $this->getAlphabets();
        $this->userResponses = $userResponses;
    }

    public function getAlphabets() {
      return [
          0 => 'A',
          1 => 'B',
          2 => 'C',
          3 => 'D',
          4 => 'E',
          5 => 'F',
          6 => 'G',
          7 => 'H',
          8 => 'I',
          9 => 'J',
          10 => 'K',
          11 => 'L',
          12 => 'M',
          13 => 'N',
          14 => 'O',
          15 => 'P',
          16 => 'Q',
          17 => 'R',
          18 => 'S',
          19 => 'T',
          20 => 'U',
          21 => 'V',
          22 => 'W',
          23 => 'X',
          24 => 'Y',
          25 => 'Z',
      ];
    }

    public function render()
    {
        return view('livewire.assessment.exam');
    }
}
