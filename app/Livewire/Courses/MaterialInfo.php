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

    protected $listeners = [ // Pastikan ini juga ada jika Anda pakai keduanya
        'materialSelected' => 'loadContent',
        'quizSelected' => 'loadContent',
        'assignmentSelected' => 'loadContent',
    ];
    // Gunakan #[On] di atas metode langsung, bukan di $listeners array
    // $listeners array lebih cocok untuk Livewire 2 atau jika Anda perlu dynamic listeners
    // Untuk Livewire 3, #[On] lebih disarankan.

    public function mount()
    {
        $this->selectedLanguage = array_key_first($this->languages);
        $this->iframeSrc = $this->languages[$this->selectedLanguage];

        // Opsional: Muat konten default saat mount, misal materi pertama
        // if (session('current_material_id')) {
        //     $this->loadMaterial(session('current_material_id'));
        // } else {
        //     $this->message = 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.';
        // }
    }

    public function updatedSelectedLanguage()
    {
        $this->iframeSrc = $this->languages[$this->selectedLanguage];
    }

    #[On('quizSelected')]
    #[On('assignmentSelected')]
    #[On('materialSelected')]
    #[On('quizCompleted')] // Tambahkan listener ini
    #[On('quizRetakeStarted')] // Tambahkan listener ini untuk retake quiz
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

        if (request()->hasHeader('X-Livewire-Event') && (request()->header('X-Livewire-Event') === 'quizCompleted' || request()->header('X-Livewire-Event') === 'quizRetakeStarted')) {
            $eventData = request()->header('X-Livewire-Event-Data');
            $decodedData = json_decode($eventData, true);
            if (isset($decodedData['quizId'])) {
                $quizId = $decodedData['quizId'];
            }
            if (isset($decodedData['isPassed'])) {
                $isPassed = $decodedData['isPassed'];
            }
        }

        if ($quizId) {
            $this->quizId = $quizId; // <-- Set properti ID
            $this->quiz = Quiz::find($quizId);
            if (!$this->quiz) {
                $this->message = 'Quiz not found.';
                return;
            }

            if (!$this->checkPreviousQuizScore($this->quiz->chapter_id)) {
                $this->message = 'You must score 100 on the previous chapter quiz before you can access this quiz.';
                $this->quiz = null;
                $this->quizId = null; // Jika quiz tidak bisa diakses, reset ID dan objeknya
                return;
            }

            $currentUserId = auth()->id();
            $today = Carbon::today();

            $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
                ->where('user_id', $currentUserId)
                ->orderBy('created_at', 'desc')
                ->get();

            $this->hasPerfectScore = $this->quizAttempts->contains('score', 100);

            if (request()->hasHeader('X-Livewire-Event') && request()->header('X-Livewire-Event') === 'quizCompleted') {
                if ($isPassed === false) { // Hanya kurangi attempt jika tidak lulus
                    $this->dailyAttempts = $this->quizAttempts
                        ->filter(function ($attempt) use ($today) {
                            return $attempt->created_at->isSameDay($today);
                        })
                        ->count();
                } else {
                    // Jika lulus, jangan kurangi dailyAttempts lagi, biarkan saja.
                    // dailyAttempts akan di-recalculate berdasarkan DB yang ada.
                    $this->dailyAttempts = $this->quizAttempts
                        ->filter(function ($attempt) use ($today) {
                            return $attempt->created_at->isSameDay($today);
                        })
                        ->count();
                }
            } else { // Jika event bukan quizCompleted, recalculate dailyAttempts seperti biasa (misal dari quizSelected atau materialSelected)
                $this->dailyAttempts = $this->quizAttempts
                    ->filter(function ($attempt) use ($today) {
                        return $attempt->created_at->isSameDay($today);
                    })
                    ->count();
            }

            $this->todayLivesRemaining = $this->maxLivesPerDay - $this->dailyAttempts;
            $this->canAttemptToday = !$this->hasPerfectScore && $this->todayLivesRemaining > 0;
            

        } elseif ($materialId) {
            $this->materialId = $materialId;
            $this->currentlyLoadedMaterialId = $materialId; // Set the currently loaded material ID
            $userId = Auth::id();
            $this->material = Material::find($materialId);
            if (! $this->material) {
                $this->message = 'Material not found.';
                $this->materialId = null;
                $this->currentlyLoadedMaterialId = null;
                return;
            }

            // Check previous chapter quiz score before allowing access to material
            if ($this->material->chapter->chapter_number > 1 && !$this->checkPreviousQuizScore($this->material->chapter_id)) {
                $this->message = 'Anda harus mendapatkan skor 100 pada kuis bab sebelumnya untuk dapat melihat materi ini.';
                $this->material = null;
                $this->materialId = null;
                $this->currentlyLoadedMaterialId = null;
                return;
            }

            // Get the existing UserMaterialStatus
            $userMaterialStatus = UserMaterialStatus::where('user_id', $userId)
                                                    ->where('material_id', $this->material->id)
                                                    ->first();

            $materialDurationSeconds = $this->convertDurationToSeconds($this->material->duration);

            Log::debug('MaterialInfo: Loading material ' . $this->material->id . '. Duration: ' . $this->material->duration . ' (' . $materialDurationSeconds . ' seconds).');

            if ($userMaterialStatus) {
                Log::debug('MaterialInfo: Existing UserMaterialStatus found. is_completed: ' . ($userMaterialStatus->is_completed ? 'true' : 'false') . ', completed_at: ' . $userMaterialStatus->completed_at->toDateTimeString());

                if ($userMaterialStatus->is_completed) {
                    $this->isMaterialCompleted = true;
                    $this->timerDuration = 0;
                    $this->dispatch('stopTimer');
                    Log::debug('MaterialInfo: Material already completed. Timer set to 0.');
                } else {
                    // Calculate remaining time: now() - completed_at (which is in the future)
                    $remainingSeconds = now()->diffInSeconds($userMaterialStatus->completed_at, false);
                    Log::debug('MaterialInfo: Material not completed. Remaining seconds: ' . $remainingSeconds . ', Target completed_at: ' . $userMaterialStatus->completed_at->toDateTimeString());

                    if ($remainingSeconds <= 0) {
                        $userMaterialStatus->is_completed = 1;
                        $userMaterialStatus->completed_at = now();
                        $userMaterialStatus->save();

                        $this->isMaterialCompleted = true;
                        $this->timerDuration = 0;
                        $this->dispatch('stopTimer');
                        Log::debug('MaterialInfo: Remaining time <= 0. Material marked as completed. Timer set to 0.');
                    } else {
                        $this->isMaterialCompleted = false;
                        $this->timerDuration = ceil($remainingSeconds / 60);
                        $this->dispatch('startTimer', $this->timerDuration);
                        Log::debug('MaterialInfo: Time remaining. Timer started with duration: ' . $this->timerDuration . ' minutes.');
                    }
                }
            } else {
                $userMaterialStatus = UserMaterialStatus::create([
                    'user_id' => $userId,
                    'material_id' => $this->material->id,
                    'is_completed' => 0,
                    'completed_at' => now()->addSeconds($materialDurationSeconds),
                ]);
                Log::debug('MaterialInfo: New UserMaterialStatus created. completed_at: ' . $userMaterialStatus->completed_at->toDateTimeString());

                $this->isMaterialCompleted = false;
                $this->timerDuration = $this->material->duration_in_minutes; // Use the full duration for new materials
                $this->dispatch('startTimer', $this->timerDuration);
                Log::debug('MaterialInfo: New material. Timer started with full duration: ' . $this->timerDuration . ' minutes.');
            }

        } elseif ($assignmentId) {
            $this->assignmentId = $assignmentId; // <-- BARIS BARU DAN PENTING! Set properti ID
            $this->assignment = Assignment::find($assignmentId); // Muat objek Assignment
            if (!$this->assignment) {
                $this->message = 'Assignment not found.';
                $this->assignmentId = null; // Jika assignment tidak ditemukan, reset ID dan objeknya
                return;
            }
        } else {
            $this->message = 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.';
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
        $previousChapter = Chapter::where('chapter_number', '<', function ($query) use ($chapterId) {
            $query->select('chapter_number')
                ->from('chapters')
                ->where('id', $chapterId)
                ->limit(1);
        })
            ->orderBy('chapter_number', 'desc')
            ->first();

        if (! $previousChapter) {
            return true; // Tidak ada chapter sebelumnya, jadi tidak perlu cek quiz
        }

        $previousQuiz = Quiz::where('chapter_id', $previousChapter->id)->first();

        if (! $previousQuiz) {
            return true; // Tidak ada quiz untuk chapter sebelumnya, tidak perlu cek quiz
        }

        $quizAttempt = QuizAttempt::where('quiz_id', $previousQuiz->id)
            ->where('user_id', $userId)
            ->where('score', 100)
            ->exists();

        return $quizAttempt; // Mengembalikan true/false langsung
    }

    private function convertDurationToSeconds($duration)
    {
        // Handle cases where duration might be malformed or null
        if (!is_string($duration) || !str_contains($duration, ':')) {
            return 0; // Default to 0 seconds for invalid format
        }
        $parts = explode(':', $duration);
        $hours = (int) ($parts[0] ?? 0);
        $minutes = (int) ($parts[1] ?? 0);
        $seconds = (int) ($parts[2] ?? 0);
        return ($hours * 3600) + ($minutes * 60) + $seconds;
    }
    public function nextMaterial()
    {
        if (!$this->material) {
            $this->message = 'Tidak ada materi yang sedang ditampilkan.';
            return;
        }

        $currentChapter = $this->material->chapter;
        $nextMaterial = Material::where('chapter_id', $currentChapter->id)
            ->where('order_number', '>', $this->material->order_number)
            ->orderBy('order_number', 'asc')
            ->first();

        if ($nextMaterial) {
            $this->loadContent($nextMaterial->id);
        } else {
            // Try to find the next chapter
            $nextChapter = Chapter::where('course_id', $currentChapter->course_id)
                ->where('chapter_number', '>', $currentChapter->chapter_number)
                ->orderBy('chapter_number', 'asc')
                ->first();

            if ($nextChapter) {
                // Check for the first material, quiz, or assignment in the next chapter
                $nextItem = null;

                $firstMaterial = Material::where('chapter_id', $nextChapter->id)
                    ->orderBy('order_number', 'asc')
                    ->first();
                if ($firstMaterial) {
                    $nextItem = $firstMaterial;
                }

                $firstQuiz = Quiz::where('chapter_id', $nextChapter->id)
                    ->orderBy('id', 'asc') // Order by ID as order_number column does not exist
                    ->first();
                if ($firstQuiz && (!$nextItem || $firstQuiz->order_number < $nextItem->order_number)) {
                    $nextItem = $firstQuiz;
                }

                $firstAssignment = Assignment::where('chapter_id', $nextChapter->id)
                    ->orderBy('id', 'asc') // Order by ID as order_number column does not exist
                    ->first();
                if ($firstAssignment && (!$nextItem || $firstAssignment->order_number < $nextItem->order_number)) {
                    $nextItem = $firstAssignment;
                }

                if ($nextItem) {
                    if ($nextItem instanceof Material) {
                        $this->loadContent($nextItem->id);
                    } elseif ($nextItem instanceof Quiz) {
                        $this->dispatch('quizSelected', quizId: $nextItem->id);
                    } elseif ($nextItem instanceof Assignment) {
                        $this->dispatch('assignmentSelected', assignmentId: $nextItem->id);
                    }
                } else {
                    $this->message = 'Tidak ada materi, kuis, atau tugas di bab selanjutnya.';
                }
            } else {
                $this->message = 'Anda telah menyelesaikan semua materi di kursus ini!';
                $this->material = null; // Clear material display
                $this->showNextButton = false; // Hide the button
            }
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
    #[On('quizCompleted')] // Listener untuk event quizCompleted
    #[On('quizRetakeStarted')] // Listener untuk event quizRetakeStarted
    public function updateQuizStatus() // Metode dummy, loadContent yang akan melakukan pekerjaan
    {
        // loadContent akan dipanggil secara otomatis karena #[On] diletakkan di sana.
        // Metode ini hanya untuk menandai bahwa event ini ditangani.
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