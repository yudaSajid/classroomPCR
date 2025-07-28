<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Point;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Livewire\Component;
use Filament\Notifications\Notification;

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

    // Properti yang diterima dari MaterialInfo (Parent Component)
    public $canAttemptToday;
    public $todayLivesRemaining;
    public $maxLivesPerDay; // Mengganti maxAttempts dengan maxLivesPerDay

    // Properti untuk menyimpan jawaban user sementara selama quiz berlangsung
    public $userAnswers = [];

    // Mengganti nama variable agar sesuai dengan MaterialInfo
    public function mount(Quiz $quiz, $canAttemptToday, $todayLivesRemaining, $maxLivesPerDay)
    {
        $this->quiz = $quiz;
        $this->canAttemptToday = $canAttemptToday;
        $this->todayLivesRemaining = $todayLivesRemaining;
        $this->maxLivesPerDay = $maxLivesPerDay; // Inisialisasi

        $this->currentQuestionIndex = 0;
        $this->selectedAnswer = null;
        $this->score = 0;
        $this->questions = $this->quiz->questions()->inRandomOrder()->limit(10)->get();
        $this->completed = false;
        $this->attempt = null; // Pastikan attempt null di awal setiap mount
        $this->userAnswers = []; // Pastikan ini juga direset

        // Jika tidak bisa attempt hari ini, redirect atau tampilkan pesan langsung
        if (!$this->canAttemptToday && !session('quiz_active_attempt_id')) {
            // Notification::make()
             //     ->title('Tidak Dapat Memulai Kuis!')
             //     ->body('Anda tidak memiliki sisa percobaan hari ini atau sudah mendapatkan skor sempurna.')
             //     ->danger()
             //     ->send();
             // Anda bisa memutuskan untuk tidak mengirimkan notifikasi di sini
             // karena MaterialInfo sudah menanganinya di bagian atas.
        }
    }

    public function render()
    {
        // Jika quiz sudah selesai
        if ($this->completed) {
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => null,
                'answers' => [],
                'score' => $this->score,
                'userAnswers' => $this->getReviewAnswers(),
                'isPerfectScore' => $this->isPerfectScore,
                'canAttemptToday' => $this->canAttemptToday,
                'todayLivesRemaining' => $this->todayLivesRemaining,
                'maxLivesPerDay' => $this->maxLivesPerDay,
            ]);
        }

        // Jika tidak bisa attempt hari ini (dan belum complete), tampilkan halaman dengan pesan
        if (!$this->canAttemptToday && !$this->completed) {
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => null, // Tidak ada pertanyaan untuk dijawab
                'answers' => [],
                'canAttemptToday' => $this->canAttemptToday,
                'todayLivesRemaining' => $this->todayLivesRemaining,
                'maxLivesPerDay' => $this->maxLivesPerDay,
            ]);
        }

        // Jika tidak ada pertanyaan atau sudah melewati batas pertanyaan
        if ($this->questions->isEmpty() || $this->currentQuestionIndex >= $this->questions->count()) {
            // Ini adalah kondisi fallback jika ada masalah dengan pertanyaan.
            // Seharusnya tidak tercapai jika nextQuestion() memanggil completeQuiz() dengan benar.
            return view('livewire.take-quiz', [
                'quiz' => $this->quiz,
                'question' => null,
                'answers' => [],
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

    public function selectAnswer($answerId)
    {
        if ($this->completed || !$this->canAttemptToday) {
            return;
        }
        $this->selectedAnswer = $answerId;
    }

    public function nextQuestion()
    {
        if (!$this->canAttemptToday) {
            Notification::make()
                ->title('Tidak Dapat Melanjutkan!')
                ->body('Anda tidak memiliki sisa percobaan hari ini atau sudah mendapatkan skor sempurna.')
                ->danger()
                ->send();
            return;
        }

        if ($this->selectedAnswer === null) {
            Notification::make()
                ->title('Peringatan!')
                ->body('Anda harus memilih jawaban sebelum melanjutkan ke pertanyaan berikutnya.')
                ->warning()
                ->send();
            return;
        }

        // Buat QuizAttempt hanya saat user menjawab pertanyaan pertama kali
        if ($this->currentQuestionIndex === 0 && !$this->attempt) {
            $this->attempt = User::find(auth()->id())->quizAttempts()->create([
                'quiz_id' => $this->quiz->id,
                'score' => 0,
                'started_at' => now(),
            ]);
            // Setelah attempt dibuat, perbarui sisa attempt hari ini di parent component
            // Ini akan memicu MaterialInfo untuk me-recalculate dan me-render ulang jika perlu.
            // $this->dispatch('quizAttemptStarted'); // Event untuk memberitahu parent MaterialInfo
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $selectedAnswerObject = Answer::find($this->selectedAnswer);

        $this->userAnswers[] = [
            'question_id' => $currentQuestion->id,
            'answer_id' => $this->selectedAnswer,
            'is_correct' => $selectedAnswerObject->is_correct,
        ];

        $this->selectedAnswer = null;
        $this->currentQuestionIndex++;

        if ($this->currentQuestionIndex >= $this->questions->count()) {
            $this->completeQuiz();
        }
    }

    protected function completeQuiz()
    {
        $correctCount = collect($this->userAnswers)->where('is_correct', true)->count();
        $totalQuestions = $this->questions->count();
        $this->score = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100) : 0;

        $this->isPerfectScore = ($this->score == 100);

        if ($this->attempt) {
            $this->attempt->update(['score' => $this->score, 'completed_at' => now()]);
            foreach ($this->userAnswers as $answerData) {
                $this->attempt->userAnswers()->create($answerData);
            }
        }
        
        $this->addPointsAfterQuiz();

        $this->completed = true;

        $this->dispatch('quizCompleted', [
            'quizId' => $this->quiz->id,
            'isPassed' => ($this->score == 100), // Asumsi lulus jika skor 100
            // Atau Anda bisa menggunakan ambang batas kelulusan lain, misal:
            // 'isPassed' => ($this->score >= $this->quiz->passing_score),
        ]);
    }

    protected function addPointsAfterQuiz()
    {
        $userId = auth()->id();
        $quizId = $this->quiz->id;
        $courseId = $this->quiz->course_id;

        // Untuk poin, kita tetap berikan hanya pada attempt pertama untuk quiz ini secara keseluruhan
        // (bukan per hari). Ini sesuai dengan logika Anda sebelumnya.
        $isFirstOverallAttempt = QuizAttempt::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->count() === 1;

        if ($isFirstOverallAttempt) {
            if ($this->score == 100) {
                Point::create([
                    'user_id' => $userId,
                    'points' => 20,
                    'quiz_id' => $quizId,
                    'course_id' => $courseId,
                    'reason' => 'First attempt with perfect score',
                ]);
                Notification::make()
                    ->title('Skor Sempurna!')
                    ->body('Selamat! Anda mendapatkan 20 poin untuk skor sempurna pada percobaan pertama.')
                    ->seconds(5)
                    ->success()
                    ->send();
            } elseif ($this->score >= 80) {
                Point::create([
                    'user_id' => $userId,
                    'points' => 0,// pengaturan poin
                    'quiz_id' => $quizId,
                    'course_id' => $courseId,
                    'reason' => 'First attempt with score above 80',
                ]);
                Notification::make()
                    ->title('Skor Hebat!')
                    ->body('Anda mendapatkan 10 poin karena skor di atas 80 pada percobaan pertama.')
                    ->seconds(5)
                    ->success()
                    ->send();
            } else {
                Point::create([
                    'user_id' => $userId,
                    'points' => 0,// pengaturan poin
                    'quiz_id' => $quizId,
                    'course_id' => $courseId,
                    'reason' => 'First attempt completion',
                ]);
                Notification::make()
                    ->title('Kuis Selesai')
                    ->body('Anda mendapatkan 5 poin karena menyelesaikan kuis pada percobaan pertama.')
                    ->seconds(5)
                    ->success()
                    ->send();
            }
        } else {
            Notification::make()
                ->title('Kuis Selesai')
                ->body('Anda telah menyelesaikan kuis ini. Poin hanya diberikan pada percobaan pertama secara keseluruhan.')
                ->seconds(5)
                ->info()
                ->send();
        }
    }

    public function getReviewAnswers()
    {
        if (!$this->attempt || !$this->attempt->userAnswers) {
            return collect();
        }
        $questionIds = $this->questions->pluck('id')->toArray();
        return $this->attempt->userAnswers()
            ->with(['question', 'answer'])
            ->get()
            ->sortBy(function ($ua) use ($questionIds) {
                return array_search($ua->question_id, $questionIds);
            });
    }

    public function retakeQuiz()
    {
        // Cek kembali kondisi attempt harian dari properti yang diterima dari parent
        if (!$this->canAttemptToday) {
            Notification::make()
                ->title('Batas Percobaan Harian Tercapai!')
                ->body('Anda telah mencapai batas maksimal percobaan hari ini untuk kuis ini.')
                ->danger()
                ->send();
            return;
        }

        $this->currentQuestionIndex = 0;
        $this->selectedAnswer = null;
        $this->score = 0;
        $this->questions = $this->quiz->questions()->inRandomOrder()->limit(10)->get();
        $this->completed = false;
        $this->userAnswers = [];
        $this->attempt = null; // Ini penting agar `nextQuestion()` membuat attempt baru
        $this->isPerfectScore = null;
        
        Notification::make()
            ->title('Kuis Dimulai Ulang!')
            ->body('Anda dapat mencoba kuis ini lagi.')
            ->success()
            ->send();


        $this->dispatch('quizRetakeStarted', [
            'quizId' => $this->quiz->id,
        ]);
    }
}