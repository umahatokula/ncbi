<?php

namespace App\Livewire\Question;

use App\Models\Option;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImportQuestions extends Component
{
    use WithFileUploads;

    public $file;
    public $isLoading = false;

    protected $rules = [
        'file' => 'required|mimes:csv,txt',
    ];

    public function import()
    {
        $this->validate();

        $this->isLoading = true;

        $path = $this->file->store('csv_files');

        $file = fopen(Storage::path($path), 'r');

        $header = fgetcsv($file); // Skip the header row

        while ($row = fgetcsv($file)) {
            $questionText = $row[0];
            $options = array_slice($row, 1, 4);
            $correctOption = $row[5];

            $optionsLookup = [
                'A' => 0,
                'B' => 1,
                'C' => 2,
                'D' => 3,
            ];
            $correctOption = $optionsLookup[strtoupper($correctOption)];

            $question = Question::create(['question_text' => $questionText]);

            foreach ($options as $index => $optionText) {
                // dd($options, $index, $correctOption);

                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => $index == $correctOption,
                ]);
            }
        }

        fclose($file);

        // session()->flash('message', 'Questions imported successfully.');

        // Optional: Clean up the uploaded file
        Storage::delete($path);

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.question.import-questions');
    }
}
