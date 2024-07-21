<div>
    @php
    $durationInMinutesFromServer = $assessment->duration_minutes;
    @endphp
    <div class="shadow-md p-5 text-3xl float-right rounded-lg sticky bg-white top-0" id="countdown"></div>

    @foreach (auth()->user()->questionsOrder as $questionOder)
    @php
        $question = $questionOder->question;
    @endphp
    <div class="my-6 bg-white p-5 rounded-lg" wire:key="{{ $question->id }}">
        <p>{{ $loop->index + 1 . '. ' . $question->question_text }}</p>
        <div id="question-{{ $question->id }}">
            @foreach ($question->options as $option)
            <div class="flex items-center gap-x-4" wire:key="{{ $option->id }}">
                <p>{{ $optionsAlphabets[$loop->index] }}</p>
                <a class="{{ in_array($option->id, $userResponses) ? 'font-bold underline bg-blue-100' : null }}" wire:click.prevent="selectOption({{ $question->id }}, {{ $option->id }})"
                    href="#" id="{{ $option->id }}">{{ $option->option_text }}</a>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <button
        wire:click="onSubmit"
        wire:loading.class="opacity-50"
        class="block px-4 py-2 bg-amber-600 text-white"
    >Submit Test</button>
</div>

<script>
(function() {
    // Set the duration in minutes
    const durationInMinutes = {{ $durationInMinutesFromServer }};
    let remainingTime = localStorage.getItem('remainingTime');
    let durationInSeconds;

    if (remainingTime) {
        durationInSeconds = parseInt(remainingTime, 10);
    } else {
        durationInSeconds = durationInMinutes * 60;
    }

    // Get the countdown timer element
    const countdownTimer = document.getElementById('countdown');

    // Function to update the countdown timer
    function updateCountdown() {
        const minutes = Math.floor(durationInSeconds / 60);
        let seconds = durationInSeconds % 60;

        // Add leading zero if seconds is less than 10
        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        // Update the countdown timer
        countdownTimer.textContent = `${minutes}:${seconds}`;

        // Check if the duration has reached zero
        if (durationInSeconds <= 0) {
            // If the duration has reached zero, submit the test
            submitTest();
        } else {
            // If the duration has not reached zero, decrement the time by 1 second
            durationInSeconds--;

            // Store the remaining time in local storage
            localStorage.setItem('remainingTime', durationInSeconds.toString());

            // Call the updateCountdown function again after 1 second
            setTimeout(updateCountdown, 1000);
        }
    }

    function clearTimer() {
        // Clear the remaining time from local storage
        localStorage.removeItem('remainingTime');
    }

    // Function to submit the test
    function submitTest() {
        // Replace this with your logic to submit the test automatically
        console.log('Test submitted automatically.');

        oc.request('#myform', 'onSubmit', {
            data: {
                attemptId: {{ $attempt->id }}
            },
            complete: clearTimer,
        });

        // Clear the remaining time from local storage
        localStorage.removeItem('remainingTime');
    }

    // Start the countdown timer
    updateCountdown();
})();
</script>
