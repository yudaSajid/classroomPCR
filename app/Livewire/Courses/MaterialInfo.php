<?php

namespace App\Livewire\Courses;

use App\Models\Assignment;
use App\Models\Chapter; // Tidak langsung digunakan di sini, tapi mungkin untuk relasi
use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserMaterialStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout; // Ini tidak relevan untuk komponen yang di-embed
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon; // Tambahkan ini untuk bekerja dengan tanggal

class MaterialInfo extends Component
{
    public $materialId;
    public $quizId;
    public $material;
    public $quiz;
    public $message;
    public $selectedLanguage;
    public $iframeSrc;
    public $quizAttempts;
    public $assignmentId;
    public $assignment;

    // Properti untuk Quiz
    public $maxLivesPerDay = 3;
    public $dailyAttempts;
    public $todayLivesRemaining;
    public $canAttemptToday;
    public $hasPerfectScore; // Sudah ada, bagus

    public $timerDuration; // Properti baru untuk durasi timer
    public $isMaterialCompleted = false; // Properti baru untuk status penyelesaian materi
    public $showNextButton = false; // Properti baru untuk menampilkan tombol Next
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

    public function mount()
    {
        $this->selectedLanguage = array_key_first($this->languages);
        $this->iframeSrc = $this->languages[$this->selectedLanguage];
    }

    public function updatedSelectedLanguage()
    {
        $this->iframeSrc = $this->languages[$this->selectedLanguage];
    }

    
    #[On('quizSelected')]
    #[On('assignmentSelected')]
    #[On('materialSelected')]
   // Tambahkan listener ini untuk retake quiz
    public function loadContent($materialId = null, $quizId = null, $assignmentId = null, $isPassed = null)
    {
        // Prevent re-loading the same material if it's already loaded and not yet completed
        if ($materialId && $this->currentlyLoadedMaterialId === $materialId && !$this->isMaterialCompleted) {
            Log::debug('MaterialInfo: Attempted to load same material (' . $materialId . ') that is not yet completed. Aborting.');
            return;
        }

        // --- PENTING: RESET SEMUA PROPERTI TERKAIT KONTEN DI AWAL ---
        $this->material = null;
        $this->currentlyLoadedMaterialId = null; // Reset this as well
        // JANGAN reset $this->quiz atau $this->quizId di sini jika ingin tetap merender kotak quiz
        // $this->quiz = null;
        // $this->quizId = null;    // Reset juga ID quiz
        $this->assignment = null;
        $this->materialId = null; // Reset juga ID material
        $this->assignmentId = null; // <-- BARIS INI PENTING: Reset ID assignment
        $this->message = null;

        // Reset properti quiz-specific juga
        $this->quizAttempts = collect();
        $this->hasPerfectScore = false;
        $this->dailyAttempts = 0;
        $this->todayLivesRemaining = $this->maxLivesPerDay;
        $this->canAttemptToday = false;
        $this->timerDuration = null; // Reset timer duration
        $this->isMaterialCompleted = false; // Reset status penyelesaian materi
        $this->showNextButton = false; // Reset status tombol Next
        // --- AKHIR RESET ---

        try {
            if ($quizId) {
                $this->quizId = $quizId;
                $this->quiz = Quiz::findOrFail($quizId);

                // Pengecekan skor kuis sebelumnya (Kode Anda sudah benar)
                if (!$this->checkPreviousQuizScore($this->quiz->chapter_id)) {
                    $this->message = 'Anda harus mendapatkan skor 100 pada kuis bab sebelumnya untuk dapat mengakses kuis ini.';
                    $this->quiz = null;
                    return;
                }

                // Lanjutkan memuat data attempt jika lolos pengecekan (Kode Anda sudah benar)
                $currentUserId = auth()->id();
                $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
                    ->where('user_id', $currentUserId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $this->hasPerfectScore = $this->quizAttempts->contains('score', 100);

                 // Kalkulasi nyawa yang sederhana dan selalu benar
                $this->dailyAttempts = $this->quizAttempts->filter(fn ($attempt) => $attempt->created_at->isToday())->count();
                $this->todayLivesRemaining = $this->maxLivesPerDay - $this->dailyAttempts;
                $this->canAttemptToday = !$this->hasPerfectScore && $this->todayLivesRemaining > 0;

            } elseif ($materialId) {
                $this->materialId = $materialId;
                $this->material = Material::findOrFail($materialId);
                $this->currentlyLoadedMaterialId = $materialId;

                // Pengecekan skor kuis sebelumnya (Kode Anda sudah benar)
                if (!$this->checkPreviousQuizScore($this->material->chapter_id)) {
                    $this->message = 'Anda harus mendapatkan skor 100 pada kuis bab sebelumnya untuk dapat melihat materi ini.';
                    $this->material = null;
                    return;
                }

                // Lanjutkan memuat status materi dan timer (Kode Anda sudah benar)
                $userId = Auth::id();
                $userMaterialStatus = UserMaterialStatus::where('user_id', $userId)
                    ->where('material_id', $this->material->id)
                    ->first();
                 $materialDurationMinutes = $this->material->duration_in_minutes ?? 0;
                 $materialDurationSeconds = $materialDurationMinutes * 60;

                if ($userMaterialStatus) {
                    if ($userMaterialStatus->is_completed) {
                        $this->isMaterialCompleted = true;
                        $this->timerDuration = 0;
                        $this->dispatch('stopTimer');
                    } else {
                        $remainingSeconds = now()->diffInSeconds($userMaterialStatus->completed_at, false);
                        if ($remainingSeconds <= 0) {
                            $userMaterialStatus->update(['is_completed' => 1, 'completed_at' => now()]);
                            $this->isMaterialCompleted = true;
                            $this->timerDuration = 0;
                            $this->dispatch('stopTimer');
                        } else {
                            $this->isMaterialCompleted = false;
                            $this->timerDuration = ceil($remainingSeconds / 60);
                            $this->dispatch('startTimer', $this->timerDuration);
                        }
                    }
                } else {
                     UserMaterialStatus::create([ 'user_id' => $userId, 'material_id' => $this->material->id, 'is_completed' => 0, 'completed_at' => now()->addSeconds($materialDurationSeconds) ]);
                     $this->isMaterialCompleted = false;
                     $this->timerDuration = $materialDurationMinutes;
                     $this->dispatch('startTimer', $this->timerDuration);
                }
                 $this->showNextButton = $this->isMaterialCompleted;

            } elseif ($assignmentId) {
                 $this->assignmentId = $assignmentId;
                 $this->assignment = Assignment::findOrFail($assignmentId);
                 if (!$this->assignment) { /* handle not found */ }
                 // Tambahkan pengecekan skor kuis sebelumnya jika diperlukan
                 // if (!$this->checkPreviousQuizScore($this->assignment->chapter_id)) { ... }

            } else {
                $this->message = 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.';
            }
        } catch (ModelNotFoundException $e) {
            Log::error("Error loading content: " . $e->getMessage());
            $this->message = 'Konten yang diminta tidak ditemukan.';
            $this->quiz = null; $this->material = null; $this->assignment = null;
        }
    }

    private function getPreviousOrderNumber($currentOrderNumber, $chapterId)
    {
        return Material::where('chapter_id', $chapterId)
            ->where('order_number', '<', $currentOrderNumber)
            ->max('order_number');
    }

    private function getNextOrderNumber($currentOrderNumber, $chapterId)
    {
        return Material::where('chapter_id', $chapterId)
            ->where('order_number', '>', $currentOrderNumber)
            ->min('order_number');
    }

    private function checkPreviousQuizScore($chapterId)
    {
        $userId = Auth::id();
        $currentChapter = Chapter::find($chapterId);

        if (!$currentChapter || $currentChapter->chapter_number <= 1) {
            return true;
        }

        // Cari chapter sebelumnya DI DALAM COURSE YANG SAMA berdasarkan nomor chapter.
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

    
    public function nextMaterial()
    {
        if (!$this->material) {
            $this->message = 'Tidak ada materi yang sedang ditampilkan.';
            return;
        }

        $currentChapter = $this->material->chapter;
        $nextItem = null; // Variabel untuk menampung item berikutnya

        // Cari materi berikutnya di chapter yang sama
        $nextMaterial = Material::where('chapter_id', $currentChapter->id)
            ->where('order_number', '>', $this->material->order_number)
            ->orderBy('order_number', 'asc')
            ->first();
        if ($nextMaterial) {
            $nextItem = $nextMaterial;
        } else {
             // Cari quiz pertama di chapter yang sama (jika ada setelah materi terakhir)
            $nextQuiz = Quiz::where('chapter_id', $currentChapter->id)
                ->orderBy('id', 'asc') // Asumsi quiz hanya ada satu per chapter atau urutan ID relevan
                ->first();
             // Anda mungkin perlu logika order_number jika quiz/assignment punya urutan

            // Jika tidak ada materi/quiz lagi di chapter ini, cari chapter berikutnya
            if (!$nextQuiz) { // Jika tidak ada quiz setelah materi terakhir
                $nextChapter = Chapter::where('course_id', $currentChapter->course_id)
                    ->where('chapter_number', '>', $currentChapter->chapter_number)
                    ->orderBy('chapter_number', 'asc')
                    ->first();

                if ($nextChapter) {
                    // Cari item pertama (materi atau quiz atau assignment) di chapter berikutnya
                    $firstMaterial = Material::where('chapter_id', $nextChapter->id)->orderBy('order_number', 'asc')->first();
                    $firstQuiz = Quiz::where('chapter_id', $nextChapter->id)->orderBy('id', 'asc')->first();
                    $firstAssignment = Assignment::where('chapter_id', $nextChapter->id)->orderBy('id', 'asc')->first(); // Contoh assignment

                    // Tentukan item mana yang paling awal (perlu logika order jika ada)
                    // Logika sederhana: Prioritaskan Materi -> Quiz -> Assignment
                    if ($firstMaterial) {
                        $nextItem = $firstMaterial;
                    } elseif ($firstQuiz) {
                        $nextItem = $firstQuiz;
                    } elseif ($firstAssignment) {
                         $nextItem = $firstAssignment;
                    }
                }
            } else {
                 $nextItem = $nextQuiz; // Jika quiz adalah item berikutnya di chapter yang sama
            }
        }

        // Proses item berikutnya yang ditemukan
        if ($nextItem) {
            if ($nextItem instanceof Material) {
                $this->loadContent(materialId: $nextItem->id);
            } elseif ($nextItem instanceof Quiz) {
                // Langsung panggil loadContent, jangan dispatch event internal
                $this->loadContent(quizId: $nextItem->id);
            } elseif ($nextItem instanceof Assignment) {
                $this->loadContent(assignmentId: $nextItem->id);
            }
            // Setelah konten baru dimuat, beri tahu sidebar untuk refresh
            $this->dispatch('refreshLessonList'); // Kirim sinyal refresh sidebar
        } else {
            $this->message = 'Anda telah menyelesaikan semua materi di kursus ini!';
            $this->material = null;
            $this->showNextButton = false;
            // Beri tahu sidebar untuk refresh meskipun sudah selesai
             $this->dispatch('refreshLessonList');
        }
    }

    public function render()
    {
        return view('livewire.courses.material-info', [
            'material' => $this->material,
            'quiz' => $this->quiz,
            'languages' => $this->languages,
            'quizAttempts' => $this->quizAttempts,
            'assignmentID' => $this->assignmentId, // Sekarang ini akan memiliki nilai yang benar
            'assignment' => $this->assignment,
            'hasPerfectScore' => $this->hasPerfectScore,
            'canAttemptToday' => $this->canAttemptToday,
            'todayLivesRemaining' => $this->todayLivesRemaining,
            'message' => $this->message,
        ]);
    }
    #[On('quizAttemptUpdated')] // Nama event sesuai dengan TakeQuiz
    public function handleQuizUpdate($quizId, $courseId = null)
    {
        // Terima juga courseId (jika dikirim) tetapi fokus tetap untuk memuat ulang quiz
        $this->loadContent(quizId: $quizId);
        $this->dispatch('refreshLessonList');
    }

    #[On('timerFinished')]
    public function markMaterialAsCompleted()
    {
        $userId = Auth::id();
        if ($this->materialId && $userId) {
            $userMaterialStatus = UserMaterialStatus::where('user_id', $userId)
                                                    ->where('material_id', $this->materialId)
                                                    ->first();
            if ($userMaterialStatus) {
                $userMaterialStatus->is_completed = 1;
                $userMaterialStatus->completed_at = now();
                $userMaterialStatus->save();

                // Reload content to update timer display to 00:00
                $this->loadContent($this->materialId);
                $this->showNextButton = true;
                $this->dispatch('materialStatusUpdated');
            }
        }
    }
}