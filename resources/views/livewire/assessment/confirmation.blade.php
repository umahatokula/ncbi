<div>

    <div class="grid w-full h-full mt-12">
        <div class="flex flex-col shadow-xl mx-auto p-5 bg-white w-full md:w-96 h-56">
            <p class="my-2 text-base">{{ $assessment->name }}</p>
            <p class="my-2 text-base">Attempt: {{ $assessment->getNextAttemptNumber() }}</p>
            <p class="my-2 text-base">
                Time: <span class="font-bold">{{ $assessment->duration_minutes }} min(s)</span>
            </p>
            <a class="w-full bg-blue-800 rounded-xl text-white text-center px-6 py-2 block font-bold text-sm mt-4"
                href="{{ route('assessment.show', ['slug' => $assessment->slug, 'attemptNumber' => $assessment->getNextAttemptNumber()]) }}">Start
                Exam</a>
        </div>
    </div>
</div>
