<div>
    <div>
        <h2>Select Questions for Assessment</h2>

        <div class="mb-4">
            @foreach ($questions as $question)
                <div>
                    <label>
                        <input type="checkbox" wire:model="selectedQuestions" value="{{ $question->id }}">
                        {{ $question->question_text }}
                    </label>
                </div>
            @endforeach
        </div>

        <button wire:click="saveSelectedQuestions" class="btn btn-primary">Save</button>
    </div>
</div>
