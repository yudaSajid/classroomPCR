<?php

namespace App\Livewire\Courses;

use App\Models\Assignment;
use App\Models\Chapter;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserMaterialStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class MaterialInfo extends Component
{
    public $materialId;
    public $quizId;
    public
    $material;
    public $quiz;
    public $message;
    public $selectedLanguage;
    public $iframeSrc;
    public $quizAttempts;
    public $assignmentId;
    public $assignment;
    public $maxLivesPerDay = 3;
    public $dailyAttempts;
    public $todayLivesRemaining;
    public $canAttemptToday;
    public $hasPerfectScore;
    public $timerDuration;
    public $isMaterialCompleted = false;
    public $showNextButton = false;
    private $currentlyLoadedMaterialId = null;

    protected $languages = [
        'PHP' => 'https://www.programiz.com/php/online-compiler/',
        'HTML' => 'https://www.programiz.com/html/online-compiler/',
        'Java' => 'https://www.programiz.com/java-programming/online-compiler/',
        'Python' => 'https://www.programiz.com/python-programming/online-compiler/',
        'C#' => 'https://www.programiz.com/cpp-programming/online-compiler/',
        'NodeJS' => 'https://www.programiz.com/javascript/online-compiler/',
        'React' => 'https://onecompiler.com/javascript/3wg6rpqz2',
        'SQL' => 'https://www.programiz.com/sql/online-compiler/',
    ];

    // Listener untuk memilih konten dari sidebar
    protected $listeners = [
        'materialSelected' => 'loadContent',
        'quizSelected' => 'loadContent',
        'assignmentSelected' => 'loadContent',
    ];

    public function mount()
    {
        $this->selectedLanguage = array_key_first($this->languages);
        $this->iframeSrc = $this->languages[$this->selectedLanguage];
    }

    public function updatedSelectedLanguage()
    {
        $this->iframeSrc = $this->languages[$this->selectedLanguage];
    }

    public function loadContent($materialId = null, $quizId = null, $assignmentId = null)
    {
        // Reset semua properti konten
        $this->material = null; $this->quiz = null; $this->assignment = null; $this->message = null;
        $this->materialId = null; $this->quizId = null; $this->assignmentId = null;
        
        if ($quizId) {
            $this->quizId = $quizId;
            $this->quiz = Quiz::find($quizId);
            
            if (!$this->quiz || !$this->checkPreviousQuizScore($this->quiz->chapter_id)) {
                $this->message = 'Anda harus mendapatkan skor 100 pada kuis bab sebelumnya untuk dapat mengakses kuis ini.';
                $this->quiz = null;
                return;
            }

            $currentUserId = auth()->id();
            $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
                ->where('user_id', $currentUserId)
                ->orderBy('created_at', 'desc')
                ->get();

            $this->hasPerfectScore = $this->quizAttempts->contains('score', 100);
            
            // Logika perhitungan nyawa yang sederhana dan selalu benar
            $this->dailyAttempts = $this->quizAttempts->filter(fn ($attempt) => $attempt->created_at->isToday())->count();
            $this->todayLivesRemaining = $this->maxLivesPerDay - $this->dailyAttempts;
            $this->canAttemptToday = !$this->hasPerfectScore && $this->todayLivesRemaining > 0;

        } elseif ($materialId) {
            // ... Logika pemuatan materi Anda yang sudah benar ...
            $this->materialId = $materialId;
            $this->material = Material::find($materialId);
        } elseif ($assignmentId) {
            // ... Logika pemuatan tugas Anda yang sudah benar ...
            $this->assignmentId = $assignmentId;
            $this->assignment = Assignment::find($assignmentId);
        } else {
            $this->message = 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.';
        }
    }
    
    /**
     * PERBAIKAN #1: INI ADALAH SATU-SATUNYA LISTENER KUIS YANG DIPERLUKAN
     * Tugasnya hanya me-refresh UI setelah TakeQuiz selesai bekerja.
     */
    #[On('quizAttemptUpdated')]
    public function handleQuizUpdate($quizId)
    {
        // Cukup panggil loadContent untuk me-refresh data nyawa
        $this->loadContent(quizId: $quizId);
        
        // Beri tahu sidebar untuk ikut me-refresh
        $this->dispatch('refreshLessonList');
    }
    
    public function render()
    {
        return view('livewire.courses.material-info', [
            'material' => $this->material,
            'quiz' => $this->quiz,
            'quizAttempts' => $this->quizAttempts,
            'assignment' => $this->assignment,
            'hasPerfectScore' => $this->hasPerfectScore,
            'canAttemptToday' => $this->canAttemptToday,
            'todayLivesRemaining' => $this->todayLivesRemaining,
            'message' => $this->message,
            // ...
        ]);
    }
    
    private function checkPreviousQuizScore($chapterId)
    {
        // ... Kode ini sudah benar ...
        $userId = Auth::id();
        $currentChapter = Chapter::find($chapterId);
        if (!$currentChapter || $currentChapter->chapter_number <= 1) return true;
        
        $previousChapter = Chapter::where('course_id', $currentChapter->course_id)
            ->where('chapter_number', '<', $currentChapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        if (!$previousChapter) return true;
        $previousQuiz = Quiz::where('chapter_id', $previousChapter->id)->first();
        if (!$previousQuiz) return true;

        return QuizAttempt::where('quiz_id', $previousQuiz->id)
            ->where('user_id', $userId)
            ->where('score', 100)
            ->exists();
    }
}