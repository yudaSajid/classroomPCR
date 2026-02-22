<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Point;
use Livewire\Component;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TakeQuiz extends Component
{
    public $quiz;
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;
    public $score = 0;
    public $questions;
    public $completed = false;
    public $attempt; // Objek QuizAttempt saat ini
    public $isPerfectScore;
    public $canAttemptToday;
    public $todayLivesRemaining;
    public $maxLivesPerDay;
    public $userAnswers = [];

    public function mount(Quiz $quiz, $canAttemptToday, $todayLivesRemaining, $maxLivesPerDay)
    {
        $this->quiz = $quiz;
        $this->canAttemptToday = $canAttemptToday;
        $this->todayLivesRemaining = $todayLivesRemaining;
        $this->maxLivesPerDay = $maxLivesPerDay;

        $this->questions = $this->quiz->questions()->inRandomOrder()->limit(10)->get();
        $this->resetQuizState();
    }

    public function resetQuizState()
    {
        $this->currentQuestionIndex = 0;
        $this->selectedAnswer = null;
        $this->score = 0;
        $this->completed = false;
        $this->userAnswers = [];
        $this->attempt = null; // Selalu kosongkan attempt di awal
    }

    public function selectAnswer($answerId)
    {
        $this->selectedAnswer = $answerId;
    }

    public function nextQuestion()
    {
        if ($this->selectedAnswer === null) {
            Notification::make()->title('Peringatan!')->body('Anda harus memilih jawaban.')->warning()->send();
            return;
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $selectedAnswerObject = Answer::find($this->selectedAnswer);
        $this->userAnswers[] = ['question_id' => $currentQuestion->id, 'answer_id' => $this->selectedAnswer, 'is_correct' => $selectedAnswerObject->is_correct];
        $this->selectedAnswer = null;
        $this->currentQuestionIndex++;

        if ($this->currentQuestionIndex >= $this->questions->count()) {
            $this->completeQuiz();
        }
    }

    /**
     * PERBAIKAN #1: Method ini SEKARANG HANYA MERESET TAMPILAN.
     * Ia tidak menyentuh database sama sekali.
     */
    public function retakeQuiz()
    {
        $this->resetQuizState();
    }

    /**
     * PERBAIKAN #2: INI ADALAH SATU-SATUNYA TEMPAT ATTEMPT DIBUAT.
     * Nyawa (attempt) hanya dihitung setelah kuis selesai.
     */
    protected function completeQuiz()
    {
        $correctCount = collect($this->userAnswers)->where('is_correct', true)->count();
        $totalQuestions = $this->questions->count();
        $this->score = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100) : 0;

        $isPerfectScore = ($this->score == 100);
        $status_complete = false; // Default: belum selesai

        if ($isPerfectScore) {
            $points_to_add = 20;

            // 1. BUAT RECORD BARU DI TABEL `points` (TRANSAKSI POIN)
                Point::create([
                    'user_id' => Auth::id(),
                'points' => $points_to_add, // Nilai poin yang diberikan (20)
                'reason' => 'Quiz completed with perfect score',
                    'quiz_id' => $this->quiz->id,
                    'course_id' => $this->quiz->course_id ?? null,
                // Anda juga bisa menambahkan course_id jika dibutuhkan
            ]);

            $status_complete = true; // Set status selesai karena skor sempurna
        }
        // SELALU BUAT record baru setiap kali kuis selesai.
        // Ini adalah "pembayaran token" Anda.
        $this->attempt = QuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'user_id' => Auth::id(),
            'score' => $this->score,
            'started_at' => now(), // Bisa disesuaikan jika Anda menyimpan waktu mulai
            'completed_at' => now(),
        ]);

        // Simpan detail jawaban ke attempt yang baru saja dibuat.
        foreach ($this->userAnswers as $answerData) {
            $this->attempt->userAnswers()->create($answerData);
        }

        $this->completed = true;
        $this->isPerfectScore = ($this->score == 100);

        // Beri tahu induk bahwa data telah diubah agar UI nyawa & sidebar ter-update.
        // Sertakan juga `courseId` agar parent dapat mengetahui course terkait.
        $this->dispatch('quizAttemptUpdated', quizId: $this->quiz->id, courseId: $this->quiz->course_id ?? null);
    }

    public function getReviewAnswers()
    {
        if (!$this->attempt)
            return collect();
        $this->attempt->load('userAnswers.question', 'userAnswers.answer');
        $questionIds = $this->questions->pluck('id')->toArray();
        return $this->attempt->userAnswers->sortBy(fn($ua) => array_search($ua->question_id, $questionIds));
    }

    public function render()
    {
        $question = null;

        if ($this->completed) {
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => $question,
                'answers' => [],
                'score' => $this->score,
                'userAnswers' => $this->getReviewAnswers(),
                'isPerfectScore' => $this->isPerfectScore,
                'canAttemptToday' => $this->canAttemptToday,
                'todayLivesRemaining' => $this->todayLivesRemaining,
                'maxLivesPerDay' => $this->maxLivesPerDay,
            ]);
        }

        if (!$this->canAttemptToday) {
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => $question,
                'answers' => [],
                'canAttemptToday' => $this->canAttemptToday,
                'todayLivesRemaining' => $this->todayLivesRemaining,
                'maxLivesPerDay' => $this->maxLivesPerDay,
            ]);
        }

        if ($this->questions->isEmpty() || $this->currentQuestionIndex >= $this->questions->count()) {
            if (!$this->completed)
                $this->completeQuiz();
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => $question,
                'answers' => [],
                'score' => $this->score,
                'userAnswers' => $this->getReviewAnswers(),
                'isPerfectScore' => $this->isPerfectScore,
                'canAttemptToday' => $this->canAttemptToday,
                'todayLivesRemaining' => $this->todayLivesRemaining,
                'maxLivesPerDay' => $this->maxLivesPerDay,
            ]);
        }

        $question = $this->questions[$this->currentQuestionIndex];

        return view('livewire.take-quiz', [
            'quiz' => $this->quiz,
            'question' => $question,
            'answers' => $question->answers,
            'canAttemptToday' => $this->canAttemptToday,
            'todayLivesRemaining' => $this->todayLivesRemaining,
            'maxLivesPerDay' => $this->maxLivesPerDay,
        ]);
    }
}