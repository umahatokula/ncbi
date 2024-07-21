<?php

namespace App\Livewire\Assessment;

use App\Events\AssessmentSubmitted;
use Carbon\Carbon;
use App\Models\Attempt;
use Livewire\Component;
use App\Models\Question;
use App\Models\Assessment;
use App\Models\UserResponse;
use App\Models\UserAssessmentQuestionsOrder;

class Exam extends Component
{
    public $assessment;
    public $attempt;
    public $optionsAlphabets;
    public $userResponses;

    public function mount()
    {
        $user = auth()->user();
        $assessmentSlug = request('slug');
        $attemptNumber = request('attemptNumber');

        $assessment = Assessment::where('slug', $assessmentSlug)
            ->with(['questions' => function ($query) {
                $query->inRandomOrder();
            }])
            ->first();

        foreach ($assessment->questions as $question) {
            UserAssessmentQuestionsOrder::firstOrCreate([
                'user_id' =>  $user->id,
                'assessment_id' =>  $assessment->id,
                'question_id' => $question->id,
            ]);
        }

        $isOpen = $assessment->isOpen();
        if (!$isOpen) {
            return redirect('/assessment-attempts');
        }

        $attempt = Attempt::firstOrCreate([
            'user_id' =>  $user->id,
            'assessment_id' =>  $assessment->id,
            'attempt_number' => $attemptNumber,
        ], [
            'started_at' => Carbon::now(),
            'correctly_answered' => 0,
            'percentage_score' => 0,
        ]);

        $userResponses = UserResponse::where('attempt_id', $attempt->id)->pluck('option_id')->toArray();

        $this->assessment = $assessment;
        $this->attempt = $attempt;
        $this->optionsAlphabets = $this->getAlphabets();
        $this->userResponses = $userResponses;
    }

    public function getAlphabets()
    {
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

    public function selectOption($questionId, $optionId)
    {
        UserResponse::updateOrCreate([
            'attempt_id' => $this->attempt->id,
            'question_id' => $questionId,
        ], [
            'option_id' => $optionId,
        ]);

        // Reload user responses after selection
        $this->userResponses = UserResponse::where('attempt_id', $this->attempt->id)->pluck('option_id')->toArray();
    }


    public function onSubmit() {

        $score = $this->attempt->getScore();

        if(!$score) {
            session()->flash('error', 'An error occured. Please contact Admin');
            return redirect('/assessments');
        }

        $this->attempt->correctly_answered = $score['correctlyAnswered'];
        $this->attempt->total_number_of_questions = $score['totalNumberOfQuestions'];
        $this->attempt->percentage_score = $score['percentageScore'];
        $this->attempt->ended_at = Carbon::now();
        $this->attempt->save();

        AssessmentSubmitted::dispatch(auth()->user(), $this->attempt);

        session()->flash('success', 'Submitted');
        return redirect('/assessments');
    }

    public function render()
    {
        return view('livewire.assessment.exam');
    }
}
