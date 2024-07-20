<div>
    @if ($assessments->count())

        <ul class="bg-transparent">

            @foreach ($assessments as $assessment)
                @php
                    $hasSubmittedAttempt = $assessment->hasSubmittedAttempt();
                    $isOpen = $assessment->isOpen();
                @endphp

                <li class="my-5 bg-white shadow-md p-5">
                    <div class="mb-10">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-gray-700 uppercase">
                                    {{ $assessment->name }}
                                </h1>
                            </div>
                            <div>
                                @if ($assessment->attempts->count() < $assessment->number_of_attempts && !$hasSubmittedAttempt && $isOpen)
                                    <a class="w-full bg-blue-800 rounded-xl text-white text-center px-6 py-1 block font-bold text-sm"
                                        href="{{ route('assessment.confirmation', ['slug' => $assessment->slug, 'attemptNumber' => $assessment->getNextAttemptNumber()]) }}">
                                        Start Attempt {{ $assessment->attempts->count() + 1 }}</a>
                                @endif

                                @if ($hasSubmittedAttempt)
                                    <button disabled
                                        class="w-full bg-gray-400 rounded-xl text-white text-center px-6 py-1 block font-bold text-sm cursor-not-allowed flex items-center"
                                        href="#">
                                        <span class="mr-2 text-black">Submitted</span>
                                        <span>
                                            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256"
                                                height="256" viewBox="0 0 256 256" xml:space="preserve">
                                                <defs></defs>
                                                <g style="
                                            stroke: none;
                                            stroke-width: 0;
                                            stroke-dasharray: none;
                                            stroke-linecap: butt;
                                            stroke-linejoin: miter;
                                            stroke-miterlimit: 10;
                                            fill: none;
                                            fill-rule: nonzero;
                                            opacity: 1;
                                        "
                                                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                    <path
                                                        d="M 89.328 2.625 L 89.328 2.625 c -1.701 -2.859 -5.728 -3.151 -7.824 -0.568 L 46.532 45.173 c -0.856 1.055 -2.483 0.997 -3.262 -0.115 l -8.382 -11.97 c -2.852 -4.073 -8.789 -4.335 -11.989 -0.531 l 0 0 c -2.207 2.624 -2.374 6.403 -0.408 9.211 l 17.157 24.502 c 2.088 2.982 6.507 2.977 8.588 -0.011 l 4.925 -7.07 L 89.135 7.813 C 90.214 6.272 90.289 4.242 89.328 2.625 z"
                                                        style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 10;
                                                fill: rgb(0, 0, 0);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 6.072 0 11.967 1.19 17.518 3.538 c 2.034 0.861 2.986 3.208 2.125 5.242 c -0.859 2.035 -3.207 2.987 -5.242 2.126 C 54.842 8.978 49.996 8 45 8 C 24.598 8 8 24.598 8 45 c 0 20.402 16.598 37 37 37 c 20.402 0 37 -16.598 37 -37 c 0 -3.248 -0.42 -6.469 -1.249 -9.573 c -0.57 -2.134 0.698 -4.327 2.832 -4.897 c 2.133 -0.571 4.326 0.698 4.896 2.833 C 89.488 37.14 90 41.055 90 45 C 90 69.813 69.813 90 45 90 z"
                                                        style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 10;
                                                fill: rgb(0, 0, 0);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="flex space-x-5 mt-4 text-sm">
                            <p class="font-sans font-light text-gray-500">
                                {{ $assessment->questions->count() }} Questions
                            </p>
                            <p class="font-sans font-light text-gray-500">
                                {{ $assessment->duration_minutes }} Mins
                            </p>
                            <p class="font-sans font-light text-gray-500">
                                Allowed attempts: {{ $assessment->number_of_attempts }}
                            </p>
                        </div>
                        <div class="flex space-x-4 mt-1 text-xs">
                            <p>
                                Opens: {{ Carbon\Carbon::parse($assessment->validity_start_time)->format('d M Y') }}
                            </p>
                            <p class="font-sans font-light text-gray-500">
                                {{ Carbon\Carbon::parse($assessment->validity_start_time)->format('g:ia') }}
                            </p>
                            <p>to</p>
                            <p class="font-sans font-light text-gray-500">
                                {{ Carbon\Carbon::parse($assessment->validity_end_time)->format('g:ia') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-base font-bold uppercase text-sm">Attempts</h3>
                        <p class="text-xs">Submit your best attempt</p>

                        @if ($assessment->attempts->count() > 0)
                            @foreach ($assessment->attempts as $attempt)
                                <div
                                    class="border border-blue-500 rounded-xl p-3 mt-3 {{ attempt . is_submitted ? 'bg-blue-50' : null }}">
                                    <div class="flex justify-between mb-4 text-xs">
                                        <p>
                                            <span class="font-bold">Score(%)</span> <br />
                                            {{ $attempt->correctly_answered }}/{{ $attempt->total_number_of_questions }}
                                            ({{ $attempt->percentage_score }}%)
                                        </p>
                                        <p>
                                            <span class="font-bold">Date</span> <br />
                                            {{ Carbon\Carbon::parse($attempt->started_at)->format('d M Y') }}
                                        </p>
                                        <p>
                                            <span class="font-bold">Started At</span> <br />
                                            {{ Carbon\Carbon::parse($attempt->started_at)->format('g:ia') }}
                                        </p>
                                        <p>
                                            <span class="font-bold">Ended At</span> <br />
                                            {{ Carbon\Carbon::parse($attempt->ended_at)->format('g:ia') }}
                                        </p>
                                    </div>
                                    @if ($hasSubmittedAttempt)
                                        <a
                                            class="w-full rounded-xl text-center py-1 block font-bold text-sm bg-gray-300 cursor-not-allowed text-white">{{ $attempt->is_submitted ? 'Submitted' : 'Submit' }}</a>
                                    @else
                                        <a data-request="onFinalAttemptSubmission"
                                            data-request-confirm="Before submitting, please ensure that you have attempted the test as many times as desired or allowed. Once submitted, you can no longer take this test. This action is irreversible."
                                            data-request-data="{ assessmentId: {{ $assessment->id }}, attemptId: {{ $attempt->id }} }"
                                            class="w-full rounded-xl text-center py-1 block font-bold text-sm bg-blue-700 text-white"
                                            href="#">Submit</a>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p class="p-5 bg-white text-left text-sm border mt-8">
                                You do not have any attempts
                            </p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="p-5 bg-white text-left mt-12">No assessments at this time</p>

    @endif

</div>
