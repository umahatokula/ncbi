<?php

namespace App\Livewire\Assessment;

use Livewire\Component;

use App\Models\Question;
use App\Models\Assessment;

class AssessmentQuestions extends Component
{
    public $assessmentId;
    public $questions;
    public $selectedQuestions = [];

    public function mount($assessmentId)
    {
        $this->assessmentId = $assessmentId;
        $this->questions = Question::all();
        $this->selectedQuestions = Assessment::find($assessmentId)->questions->pluck('id')->toArray();
    }

    public function updatedSelectedQuestions()
    {
        $assessment = Assessment::find($this->assessmentId);
        $assessment->questions()->sync($this->selectedQuestions);
    }
    
    public function render()
    {
        return view('livewire.assessment.assessment-questions');
    }
}
