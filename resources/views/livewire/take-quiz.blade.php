<div class="flex items-start justify-center w-full mb-5 bg-white shadow-xl rounded-2xl dark:bg-gray-800 dark:shadow-3xl"> {{-- Add dark mode for outer background --}}
    <div class="w-full max-w-2xl p-6 rounded-2xl">
        @if ($question)
            <div class="mb-8">
                @if ($question->question_image)
                    <div class="relative mt-8 group">
                        <div
                            class="absolute inset-0 transition-all duration-300 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl blur opacity-60 group-hover:opacity-100
                            dark:from-indigo-900/30 dark:to-blue-900/30"> {{-- Add dark mode for image overlay --}}
                        </div>
                        <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image"
                            class="relative object-cover w-full h-64 mx-auto transition-all duration-500 rounded-2xl shadow-lg group-hover:shadow-xl group-hover:scale-[1.02]">
                    </div>
                @endif
                <div class="relative">
                    <h1 class="m-3 text-2xl font-semibold text-gray-800 dark:text-gray-100"> {{-- Add dark mode for question text --}}
                        {{ $question->question_text }}
                    </h1>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($answers as $answer)
                    <div wire:click="selectAnswer({{ $answer->id }})"
                        class="relative flex items-center w-full p-5 transition-all duration-300 rounded-xl cursor-pointer
                               bg-white border-2 hover:shadow-lg
                               {{ $selectedAnswer === $answer->id
                                   ? 'border-indigo-500 shadow-indigo-100'
                                   : 'border-slate-100 hover:border-indigo-200' }}

                               dark:bg-gray-700 dark:border-gray-600 dark:hover:shadow-xl {{-- Adjusted for dark mode --}}
                               {{ $selectedAnswer === $answer->id
                                   ? 'dark:border-indigo-500 dark:shadow-indigo-900'
                                   : 'dark:border-gray-600 dark:hover:border-indigo-700' }}">

                        <div
                            class="absolute inset-0 transition-opacity opacity-0 rounded-xl
                                   bg-gradient-to-r from-indigo-50 to-blue-50
                                   dark:from-indigo-900/30 dark:to-blue-900/30
                                   {{ $selectedAnswer === $answer->id ? 'opacity-100' : '' }}">
                        </div>

                        <input type="radio" name="answer" value="{{ $answer->id }}" wire:model="selectedAnswer"
                            id="answer-{{ $answer->id }}" aria-labelledby="label-answer-{{ $answer->id }}"
                            class="relative z-10 w-5 h-5 mr-4 transition-all duration-300 border-2 rounded-full
                                   text-indigo-500 border-slate-300 focus:ring-indigo-400 focus:ring-offset-2
                                   dark:text-indigo-400 dark:border-gray-500 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-700"> {{-- Adjusted for dark mode --}}

                        <label for="answer-{{ $answer->id }}" id="label-answer-{{ $answer->id }}"
                            class="relative z-10 text-lg font-medium tracking-wide cursor-pointer select-none
                                   text-slate-700 dark:text-gray-200"> {{-- Adjusted for dark mode --}}
                            {{ $answer->text }}
                        </label>
                    </div>
                @endforeach
            </div>

            {{-- Next Question Button --}}
            <button wire:click="nextQuestion" wire:loading.attr="disabled"
                class="float-right px-6 py-2.5 mt-6 text-sm font-medium text-white transition-all duration-300 rounded-lg shadow-md
                       bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:transform active:scale-95 disabled:opacity-50
                       dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:shadow-xl dark:focus:ring-offset-gray-800"> {{-- Add dark mode for button --}}
                <div class="flex items-center space-x-2">
                    <span>Next Question</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </button>
        @else
            {{-- Quiz Completed Section --}}
            @if ($completed)
                <div class="text-center">
                    <p class="mb-4 text-2xl font-bold text-indigo-600 dark:text-indigo-400">Quiz Completed!</p> {{-- Add dark mode --}}
                    <p class="mb-6 text-xl text-slate-700 dark:text-gray-200"> {{-- Add dark mode --}}
                        Your score:
                        <span
                            class="font-bold
                            {{ $score === 100 ? 'text-green-600 dark:text-green-400' : ($score >= 70 ? 'text-indigo-600 dark:text-indigo-400' : 'text-amber-600 dark:text-amber-400') }}"> {{-- Add dark mode for score colors --}}
                            {{ $score }}%
                        </span>
                    </p>

                    {{-- Score Animation --}}
                    <div class="flex justify-center mt-8 mb-12">
                        @if ($isPerfectScore)
                            <img src="{{ asset('storage/assets/gif/happy.gif') }}" alt="Perfect Score"
                                class="w-40 h-40 rounded-full shadow-lg">
                        @else
                            <img src="{{ asset('storage/assets/gif/sad.gif') }}" alt="Try Again"
                                class="w-40 h-40 rounded-full shadow-lg">
                        @endif
                    </div>

                    {{-- Answer Review Section --}}
                    <div class="mt-12 space-y-6">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-gray-100">Review Your Answers</h3> {{-- Add dark mode --}}
                        @foreach ($this->getReviewAnswers() as $userAnswer)
                            <div
                                class="overflow-hidden transition-all duration-300 rounded-xl hover:shadow-md
                                       bg-white border shadow-sm border-slate-100
                                       dark:bg-gray-800 dark:border-gray-700 dark:shadow-lg"> {{-- Add dark mode for review card --}}
                                <div class="p-6 border-b border-slate-100 dark:border-gray-700"> {{-- Add dark mode for border --}}
                                    <h2 class="text-lg font-semibold text-slate-800 dark:text-gray-100"> {{-- Add dark mode --}}
                                        {{ $userAnswer->question->question_text }}
                                    </h2>
                                </div>

                                <div class="p-6 space-y-4">
                                    <div class="relative">
                                        <div
                                            class="p-4 rounded-lg border
                                            {{ $userAnswer->is_correct ? 'bg-green-50 border-green-100 dark:bg-green-900/50 dark:border-green-800' : 'bg-red-50 border-red-100 dark:bg-red-900/50 dark:border-red-800' }}"> {{-- Add dark mode for correct/incorrect box --}}
                                            <div class="flex items-center">
                                                @if ($userAnswer->is_correct)
                                                    <svg class="w-5 h-5 mr-3 text-green-500 dark:text-green-300" fill="none" {{-- Add dark mode --}}
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 mr-3 text-red-500 dark:text-red-300" fill="none" {{-- Add dark mode --}}
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                @endif
                                                <p
                                                    class="text-base font-medium
                                                    {{ $userAnswer->is_correct ? 'text-green-700 dark:text-green-200' : 'text-red-700 dark:text-red-200' }}"> {{-- Add dark mode for text color --}}
                                                    {{ $userAnswer->answer->text ?? 'No answer provided' }}
                                                </p>
                                            </div>
                                        </div>

                                        @if (!$userAnswer->is_correct)
                                            <div class="p-4 mt-3 border rounded-lg
                                                        bg-emerald-50 border-emerald-100
                                                        dark:bg-emerald-900/50 dark:border-emerald-800"> {{-- Add dark mode for correct answer info box --}}
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-3 text-emerald-500 dark:text-emerald-300" fill="none" {{-- Add dark mode --}}
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <p class="text-base font-medium text-emerald-700 dark:text-emerald-200"> {{-- Add dark mode --}}
                                                        Correct Answer:
                                                        {{ $userAnswer->question->correctAnswer->text ?? 'No correct answer available' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Tombol Kerjakan Ulang Quiz --}}
                    <div class="flex justify-center mt-8">
                        <button wire:click="retakeQuiz" wire:loading.attr="disabled"
                            {{-- INI KONDISI UTAMA UNTUK MENONAKTIFKAN/MENYEMBUNYIKAN --}}
                            {{-- Jika userAttemptsCount sudah >= maxLivesPerDay, tombol akan disabled --}}
                            {{-- Namun, tombol tetap muncul jika completed == true --}}
                            {{ $todayLivesRemaining <= 0 && !$isPerfectScore ? 'disabled' : '' }} {{-- Disabling logic --}}
                            class="px-6 py-2.5 text-sm font-medium text-white transition-all duration-300 rounded-lg shadow-md
                                   bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:transform active:scale-95
                                   dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:shadow-xl dark:focus:ring-offset-gray-800
                                   {{ $todayLivesRemaining <= 0 && !$isPerfectScore ? 'opacity-50 cursor-not-allowed' : '' }}">
                            <div class="flex items-center space-x-2">
                                <span>Kerjakan Ulang Quiz</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004 12v1m7 4h2.025c.595 0 1.169-.228 1.604-.636m-1.604.636l-1.604 1.604m-1.604-1.604l1.604-1.604M12 20h2.025c.595 0 1.169-.228 1.604-.636m-1.604.636l-1.604 1.604m-1.604-1.604l1.604-1.604M12 4h2.025c.595 0 1.169-.228 1.604-.636m-1.604.636l-1.604 1.604m-1.604-1.604l1.604-1.604" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>