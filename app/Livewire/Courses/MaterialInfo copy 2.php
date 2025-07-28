<?php

namespace App\Livewire\Courses;

use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserMaterialStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

// class MaterialInfo extends Component
// {
//     public $materialId;
//     public $material;
//     public $quiz;
//     public $quizAttempts;
//     public $message;
//     public $selectedLanguage;
//     public $iframeSrc;

//     protected $languages = [
//         'PHP' => 'https://www.programiz.com/php/online-compiler/',
//         'HTML' => 'https://www.programiz.com/html/online-compiler/',
//         'Java' => 'https://www.programiz.com/java-programming/online-compiler/',
//         'Python' => 'https://www.programiz.com/python-programming/online-compiler/',
//         'C#' => 'https://www.programiz.com/cpp-programming/online-compiler/',
//         'NodeJS' => 'https://www.programiz.com/javascript/online-compiler/',
//         'React' => 'https://onecompiler.com/javascript/3wg6rpqz2',
//         'SQL' => 'https://www.programiz.com/sql/online-compiler/',
//     ];
//     public function mount()
//     {
//         $this->selectedLanguage = array_key_first($this->languages); // Set default language
//         $this->iframeSrc = $this->languages[$this->selectedLanguage];
//         $this->material = null;
//         $this->quiz = null;
//         $this->quizAttempts = [];
//     }

//     public function updatedSelectedLanguage()
//     {
//         $this->iframeSrc = $this->languages[$this->selectedLanguage];
//     }

//     #[On('quizSelected')]
//     #[On('materialSelected')]
//     public function updateMaterial($materialId = null, $quizId = null)
//     {
//         if ($quizId) {
//             // Tampilkan data quiz jika quizId diberikan
//             $quiz = Quiz::find($quizId);
//             if (!$quiz) {
//                 Log::warning('Quiz not found for ID: ' . $quizId);
//                 $this->quiz = null;
//                 $this->message = "Quiz not found.";
//                 return false;
//             }
//             $this->quiz = $quiz;
//             $this->material = null; // Reset material jika menampilkan quiz
//             $this->message = null;

//             // Ambil quiz_attempts untuk user_id saat ini dan quiz_id yang dipilih
//             $userId = Auth::id();
//             $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
//                 ->where('user_id', $userId)
//                 ->get();
//             return true;
//         } else if ($materialId) {
//             // Tampilkan data material jika materialId diberikan
//             $material = Material::find($materialId);
//             if (!$material) {
//                 $this->message = "Materials were not found.";
//                 $this->material = null;
//                 return false;
//             }

//             $userId = Auth::id();

//             // Tangani materi yang bukan di chapter pertama
//             if (!$this->checkCompleted($material)) {
//                 $this->message = "You must finish reading the previous material within the specified duration.";
//                 $this->material = null;
//                 return false;
//             }

//             $status = UserMaterialStatus::firstOrCreate(
//                 ['user_id' => $userId, 'material_id' => $material->id],
//                 ['is_completed' => 0, 'completed_at' => now()->addSeconds($this->convertDurationToSeconds($material->duration))]
//             );

//             if (now()->gt($status->completed_at)) {
//                 $status->update(['is_completed' => 1]);
//             }

//             if ($status->is_completed) {
//                 $this->material = $material;
//                 $this->message = null;
//                 $this->quiz = null; // Reset quiz jika menampilkan material
//                 return true;
//             }
//         }

//         $this->message = "Please select materials or quiz.";
//         return false;
//     }

//     private function checkPreviousQuizScore($chapterId)
//     {
//         $userId = Auth::id();

//         // Temukan chapter pertama dalam course
//         $firstChapter = Material::where('chapter_id', $chapterId)->first();

//         // Cek jika material saat ini berada di chapter pertama
//         if ($chapterId == $firstChapter->chapter_id) {
//             return true;
//         }

//         // Temukan chapter sebelumnya berdasarkan chapter_id
//         $previousChapter = Material::where('chapter_id', '<', $chapterId)
//             ->orderBy('chapter_id', 'desc')
//             ->first();

//         if (!$previousChapter) {
//             // Tidak ada chapter sebelumnya, jadi tidak perlu cek quiz
//             return true;
//         }

//         // Temukan quiz untuk chapter sebelumnya
//         $previousQuiz = Quiz::where('chapter_id', $previousChapter->chapter_id)->first();

//         if (!$previousQuiz) {
//             // Tidak ada quiz untuk chapter sebelumnya, tidak perlu cek quiz
//             return true;
//         }

//         // Cek apakah ada attempt quiz untuk quiz sebelumnya
//         $quizAttempt = QuizAttempt::where('quiz_id', $previousQuiz->id)
//             ->where('user_id', $userId)
//             ->first();

//         if (!$quizAttempt || $quizAttempt->score < 100) {
//             return false;
//         }

//         return true;
//     }

//     public function checkCompleted($material)
//     {
//         if (!$material instanceof Material) {
//             return false;
//         }

//         $userId = Auth::id();
//         $previousOrderNumber = $this->getPreviousOrderNumber($material->order_number, $material->chapter_id);

//         $previousMaterialCompleted = Material::where('chapter_id', $material->chapter_id)
//             ->where('order_number', $previousOrderNumber)
//             ->whereHas('userMaterialStatus', function ($query) use ($userId) {
//                 $query->where('user_id', $userId)
//                     ->where('is_completed', 1);
//             })
//             ->exists();

//         if (!$previousMaterialCompleted || !$this->checkPreviousQuizScore($material->chapter_id)) {
//             return false;
//         }

//         $status = UserMaterialStatus::where('user_id', $userId)
//             ->where('material_id', $material->id)
//             ->first();

//         if (!$status) {
//             $completedAt = now()->addSeconds($this->convertDurationToSeconds($material->duration));
//             UserMaterialStatus::create([
//                 'user_id' => $userId,
//                 'material_id' => $material->id,
//                 'is_completed' => 0,
//                 'completed_at' => $completedAt
//             ]);
//             return false;
//         }

//         if (now()->gt($status->completed_at)) {
//             $status->update(['is_completed' => 1]);
//         }

//         return $status->is_completed == 1;
//     }

//     private function getPreviousOrderNumber($currentOrderNumber, $chapterId)
//     {
//         return Material::where('chapter_id', $chapterId)
//             ->where('order_number', '<', $currentOrderNumber)
//             ->max('order_number');
//     }

//     private function convertDurationToSeconds($duration)
//     {
//         list($hours, $minutes, $seconds) = explode(':', $duration);
//         return ($hours * 3600) + ($minutes * 60) + $seconds;
//     }

//     public function render()
//     {
//         return view('livewire.courses.material-info', [
//             'material' => $this->material,
//             'quiz' => $this->quiz,
//             'languages' => $this->languages,
//             'quizAttempts' => $this->quizAttempts,
//         ]);
//     }

// }
