yang terbaru

class MaterialInfo extends Component
{
public $materialId;
public $material;
public $quiz;
public $message;
public $selectedLanguage;
public $iframeSrc;
public $quizAttempts;

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
$this->selectedLanguage = array_key_first($this->languages); // Set default language
$this->iframeSrc = $this->languages[$this->selectedLanguage];
}

public function updatedSelectedLanguage()
{
$this->iframeSrc = $this->languages[$this->selectedLanguage];
}
// protected $listeners = ['materialSelected' => 'updateMaterial'];
#[On('quizSelected')]
#[On('materialSelected')]
public function updateMaterial($materialId = null, $quizId = null)
{
if ($quizId) {
// Tampilkan data quiz jika quizId diberikan
$quiz = Quiz::find($quizId);
if (!$quiz) {
Log::warning('Quiz not found for ID: ' . $quizId);
$this->quiz = null;
$this->message = "Quiz not found.";
return false;
}
$this->quiz = $quiz;
$this->material = null; // Reset material jika menampilkan quiz
$this->message = null;

// Ambil quiz_attempts untuk user_id saat ini dan quiz_id yang dipilih
$userId = Auth::id();
$this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
->where('user_id', $userId)
->get();
return true;
} else if ($materialId) {
// Tampilkan data material jika materialId diberikan
$material = Material::find($materialId);
if (!$material) {
$this->message = "Materials were not found.";
$this->material = null;
return false;
}

$userId = Auth::id();
$firstChapterNumber = $material->chapter->course->chapters->min('chapter_number');

// Jika materi berada di chapter pertama dengan chapter_number terkecil
if ($material->chapter->chapter_number == $firstChapterNumber && $material->order_number == 1) {
$status = UserMaterialStatus::firstOrCreate(
['user_id' => $userId, 'material_id' => $material->id],
['is_completed' => 0, 'completed_at' => now()]
);

if (now()->gt($status->completed_at)) {
$status->update(['is_completed' => 1]);
}

if ($status->is_completed) {
$this->material = $material;
$this->message = null;
$this->quiz = null; // Reset quiz jika menampilkan material
return true;
}
} else {

// Tangani materi yang bukan di chapter pertama
if (!$this->checkCompleted($material)) {
$this->message = "You must finish reading the previous material within the specified duration.";
$this->material = null;
return false;
}

$status = UserMaterialStatus::firstOrCreate(
['user_id' => $userId, 'material_id' => $material->id],
['is_completed' => 0, 'completed_at' => now()->addSeconds($this->convertDurationToSeconds($material->duration))]
);

if (now()->gt($status->completed_at)) {
$status->update(['is_completed' => 1]);
}

if ($status->is_completed) {
$this->material = $material;
$this->message = null;
$this->quiz = null; // Reset quiz jika menampilkan material
return true;
}
}
}

$this->message = "Please select materials or quiz.";
return false;
}
private function checkPreviousQuizScore($chapterId)
{
$userId = Auth::id();
// Temukan chapter pertama dalam course
$firstChapter = Material::where('chapter_id', $chapterId)->first();


// Cek jika material saat ini berada di chapter pertama
if ($chapterId == $firstChapter->chapter_id) {
return true;
}
// Temukan chapter sebelumnya berdasarkan chapter_id
$previousChapter = Material::where('chapter_id', '<', $chapterId)
    ->orderBy('chapter_id', 'desc')
    ->first();

    if (!$previousChapter) {
    // Tidak ada chapter sebelumnya, jadi tidak perlu cek quiz
    return true;
    }

    // Temukan quiz untuk chapter sebelumnya
    $previousQuiz = Quiz::where('chapter_id', $previousChapter->chapter_id)->first();

    if (!$previousQuiz) {
    // Tidak ada quiz untuk chapter sebelumnya, tidak perlu cek quiz
    return true;
    }

    // Cek apakah ada attempt quiz untuk quiz sebelumnya
    $quizAttempt = QuizAttempt::where('quiz_id', $previousQuiz->id)
    ->where('user_id', $userId)
    ->first();

    // **Highlight**: Pastikan bahwa ada attempt dan skor adalah 100
    if (!$quizAttempt) {
    // Jika tidak ada attempt quiz, maka return false
    return false;
    }

    if ($quizAttempt->score < 100) {
        // Jika skor kurang dari 100, maka return false
        return false;
        }

        // Jika semua kondisi terpenuhi, return true
        return true;
        }



        public function checkCompleted($material)
        {

        $userId=Auth::id();

        $previousOrderNumber=$this->getPreviousOrderNumber($material->order_number, $material->chapter_id);


        // Periksa apakah material sebelumnya sudah selesai
        // $previousMaterialCompleted = false;

        if ($material->order_number == 1) {
        return true; // Jika material pertama, tidak perlu memeriksa yang sebelumnya.
        } else {
        $previousOrderNumber = $this->getPreviousOrderNumber($material->order_number, $material->chapter_id);

        $previousMaterialCompleted = Material::where('chapter_id', $material->chapter_id)
        ->where('order_number', $previousOrderNumber)
        ->whereHas('userMaterialStatus', function ($query) use ($userId) {
        $query->where('user_id', $userId)
        ->where('is_completed', 1);
        })
        ->exists();
        }

        if (!$previousMaterialCompleted || !$this->checkPreviousQuizScore($material->chapter_id)) {
        return false; // Kembalikan false jika material sebelumnya belum selesai.
        }

        // Ambil status material saat ini
        $status = UserMaterialStatus::where('user_id', $userId)
        ->where('material_id', $material->id)
        ->first();


        if (!$status) {
        // Jika tidak ada rekaman status, buat dengan waktu penyelesaian di masa depan
        $completedAt = now()->addSeconds($this->convertDurationToSeconds($material->duration));
        UserMaterialStatus::create([
        'user_id' => $userId,
        'material_id' => $material->id,
        'is_completed' => 0, // Belum selesai
        'completed_at' => $completedAt // Menggunakan objek Carbon
        ]);
        return true; // Kembalikan false karena material belum selesai
        }

        // Periksa apakah waktu sekarang sudah melewati waktu penyelesaian
        if (now()->gt($status->completed_at)) {
        // Tandai material sebagai selesai jika waktu sekarang telah melewati waktu penyelesaian
        $status->update(['is_completed' => 1]);
        }

        // Kembalikan true jika material sudah selesai, jika tidak kembalikan false
        return $status->is_completed == 1;
        }

        private function getPreviousOrderNumber($currentOrderNumber, $chapterId)
        {
        // Cari order_number sebelumnya yang paling mendekati dan valid di dalam chapter yang sama
        return Material::where('chapter_id', $chapterId)
        ->where('order_number', '<', $currentOrderNumber)
            ->max('order_number');
            }

            private function convertDurationToSeconds($duration)
            {
            list($hours, $minutes, $seconds) = explode(':', $duration);
            return ($hours * 3600) + ($minutes * 60) + $seconds;
            }

            // #[Layout('components.layouts.app')]
            public function render()
            {
            return view('livewire.courses.material-info', [
            'material' => $this->material,
            'quiz' => $this->quiz,
            'languages' => $this->languages,
            'quizAttempts' => $this->quizAttempts,
            ]);
            }

            }



            // class MaterialInfo extends Component
            // {
            // public $materialId;
            // public $material;
            // public $quiz;
            // public $message;
            // public $selectedLanguage;
            // public $iframeSrc;
            // public $quizAttempts;

            // protected $languages = [
            // 'HTML' => 'https://www.w3schools.com/js/tryit.asp?filename=tryjs_intro_inner_html',
            // 'PHP' => 'https://www.w3schools.com/php/phptryit.asp?filename=tryphp_intro',
            // 'Java' => 'https://www.w3schools.com/java/tryjava.asp?filename=demo_helloworld',
            // 'Python' => 'https://www.w3schools.com/python/trypython.asp?filename=demo_default',
            // 'C#' => 'https://www.w3schools.com/cs/trycs.php?filename=demo_helloworld',
            // 'NodeJS' => 'https://www.w3schools.com/nodejs/shownodejs.asp?filename=demo_intro',
            // 'React' => 'https://www.w3schools.com/react/showreact.asp?filename=demo2_react_test',
            // 'SQL' => 'https://www.w3schools.com/sql/trysql.asp?filename=trysql_select_all',
            // ];
            // public function mount()
            // {
            // $this->selectedLanguage = array_key_first($this->languages); // Set default language
            // $this->iframeSrc = $this->languages[$this->selectedLanguage];
            // }

            // public function updatedSelectedLanguage()
            // {
            // $this->iframeSrc = $this->languages[$this->selectedLanguage];
            // }
            // // protected $listeners = ['materialSelected' => 'updateMaterial'];
            // #[On('quizSelected')]
            // #[On('materialSelected')]
            // public function updateMaterial($materialId = null, $quizId = null)
            // {
            // if ($quizId) {
            // // Jika quizId diberikan, tampilkan data quiz
            // $quiz = Quiz::find($quizId);
            // if (!$quiz) {
            // Log::warning('Quiz tidak ditemukan untuk ID: ' . $quizId);
            // $this->quiz = null;
            // $this->message = "Quiz tidak ditemukan.";
            // return false;
            // }
            // $this->quiz = $quiz;
            // $this->material = null; // Reset material jika menampilkan quiz
            // $this->message = null;
            // // Ambil quiz_attempts untuk user_id saat ini dan quiz_id yang dipilih
            // $userId = Auth::id();
            // $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
            // ->where('user_id', $userId)
            // ->get();
            // return true;
            // } else if ($materialId) {
            // // Jika materialId diberikan, tampilkan data material
            // $material = Material::find($materialId);
            // if (!$material) {
            // $this->message = "Material tidak ditemukan.";
            // $this->material = null;
            // return false;
            // }

            // $userId = Auth::id();

            // if ($material->order_number == 1) {
            // $status = UserMaterialStatus::firstOrCreate(
            // ['user_id' => $userId, 'material_id' => $material->id],
            // ['is_completed' => 0, 'completed_at' => now()]
            // );
            // if (now()->gt($status->completed_at)) {
            // $status->update(['is_completed' => 1]);
            // }
            // $this->material = $material;
            // $this->message = null;
            // $this->quiz = null; // Reset quiz jika menampilkan material
            // return true;
            // }

            // if (!$this->cekCompleted($material)) {
            // $this->message = "Anda harus menyelesaikan membaca materi sebelumnya sesuai dengan durasi yang ditentukan.";
            // $this->material = null;
            // return false;
            // }

            // $this->material = $material;
            // $this->message = null;
            // $this->quiz = null; // Reset quiz jika menampilkan material
            // return true;
            // }

            // $this->message = "Silakan pilih material atau quiz.";
            // return false;
            // }


            // public function cekCompleted($material)
            // {
            // if (!$material instanceof Material) {
            // return false; // Jika material tidak valid, kembalikan false.
            // }

            // $userId = Auth::id();
            // $previousOrderNumber = $this->getPreviousOrderNumber($material->order_number, $material->chapter_id);

            // if (is_null($previousOrderNumber)) {
            // return false; // Kembalikan false jika tidak ada material sebelumnya.
            // }

            // // Periksa apakah material sebelumnya sudah selesai
            // $previousMaterialCompleted = Material::where('chapter_id', $material->chapter_id)
            // ->where('order_number', $previousOrderNumber)
            // ->whereHas('userMaterialStatus', function ($query) use ($userId) {
            // $query->where('user_id', $userId)
            // ->where('is_completed', 1);
            // })
            // ->exists();

            // if (!$previousMaterialCompleted) {
            // return false; // Kembalikan false jika material sebelumnya belum selesai.
            // }

            // // Ambil status material saat ini
            // $status = UserMaterialStatus::where('user_id', $userId)
            // ->where('material_id', $material->id)
            // ->first();

            // if (!$status) {
            // // Jika tidak ada rekaman status, buat dengan waktu penyelesaian di masa depan
            // $completedAt = now()->addSeconds($this->convertDurationToSeconds($material->duration));
            // UserMaterialStatus::create([
            // 'user_id' => $userId,
            // 'material_id' => $material->id,
            // 'is_completed' => 0, // Belum selesai
            // 'completed_at' => $completedAt // Menggunakan objek Carbon
            // ]);
            // return false; // Kembalikan false karena material belum selesai
            // }

            // // Periksa apakah waktu sekarang sudah melewati waktu penyelesaian
            // if (now()->gt($status->completed_at)) {
            // // Tandai material sebagai selesai jika waktu sekarang telah melewati waktu penyelesaian
            // $status->update(['is_completed' => 1]);
            // }

            // // Kembalikan true jika material sudah selesai, jika tidak kembalikan false
            // return $status->is_completed == 1;
            // }
            // private function getPreviousOrderNumber($currentOrderNumber, $chapterId)
            // {
            // // Cari order_number sebelumnya yang paling mendekati dan valid di dalam chapter yang sama
            // return Material::where('chapter_id', $chapterId)
            // ->where('order_number', '<', $currentOrderNumber)
                // ->max('order_number');
                // }

                // private function convertDurationToSeconds($duration)
                // {
                // list($hours, $minutes, $seconds) = explode(':', $duration);
                // return ($hours * 3600) + ($minutes * 60) + $seconds;
                // }

                // // #[Layout('components.layouts.app')]
                // public function render()
                // {
                // return view('livewire.courses.material-info', [
                // 'material' => $this->material,
                // 'quiz' => $this->quiz,
                // 'languages' => $this->languages,
                // 'quizAttempts' => $this->quizAttempts,
                // ]);
                // }
                // public function redirectToQuizTake($quizId)
                // {
                // return redirect()->route('quiz.take', $quizId);
                // }
                // public function redirectToTryQuiz($quizId)
                // {
                // return redirect()->route('try.quiz', $quizId);
                // }
                // }

                // class MaterialInfo extends Component
                // {
                // public $materialId;
                // public $material;
                // public $quiz;
                // public $message;
                // public $selectedLanguage;
                // public $iframeSrc;
                // public $quizAttempts;

                // protected $languages = [
                // 'HTML' => 'https://www.w3schools.com/js/tryit.asp?filename=tryjs_intro_inner_html',
                // 'PHP' => 'https://www.w3schools.com/php/phptryit.asp?filename=tryphp_intro',
                // 'Java' => 'https://www.w3schools.com/java/tryjava.asp?filename=demo_helloworld',
                // 'Python' => 'https://www.w3schools.com/python/trypython.asp?filename=demo_default',
                // 'C#' => 'https://www.w3schools.com/cs/trycs.php?filename=demo_helloworld',
                // 'NodeJS' => 'https://www.w3schools.com/nodejs/shownodejs.asp?filename=demo_intro',
                // 'React' => 'https://www.w3schools.com/react/showreact.asp?filename=demo2_react_test',
                // 'SQL' => 'https://www.w3schools.com/sql/trysql.asp?filename=trysql_select_all',
                // ];
                // public function mount()
                // {
                // $this->selectedLanguage = array_key_first($this->languages); // Set default language
                // $this->iframeSrc = $this->languages[$this->selectedLanguage];
                // }

                // public function updatedSelectedLanguage()
                // {
                // $this->iframeSrc = $this->languages[$this->selectedLanguage];
                // }
                // // protected $listeners = ['materialSelected' => 'updateMaterial'];
                // #[On('quizSelected')]
                // #[On('materialSelected')]
                // public function updateMaterial($materialId = null, $quizId = null)
                // {
                // if ($quizId) {
                // // Tampilkan data quiz jika quizId diberikan
                // $quiz = Quiz::find($quizId);
                // if (!$quiz) {
                // Log::warning('Quiz not found for ID: ' . $quizId);
                // $this->quiz = null;
                // $this->message = "Quiz not found.";
                // return false;
                // }
                // $this->quiz = $quiz;
                // $this->material = null; // Reset material jika menampilkan quiz
                // $this->message = null;

                // // Ambil quiz_attempts untuk user_id saat ini dan quiz_id yang dipilih
                // $userId = Auth::id();
                // $this->quizAttempts = QuizAttempt::where('quiz_id', $quizId)
                // ->where('user_id', $userId)
                // ->get();
                // return true;
                // } else if ($materialId) {
                // // Tampilkan data material jika materialId diberikan
                // $material = Material::find($materialId);
                // if (!$material) {
                // $this->message = "Materials were not found.";
                // $this->material = null;
                // return false;
                // }

                // $userId = Auth::id();
                // $firstChapterNumber = $material->chapter->course->chapters->min('chapter_number');

                // // Jika materi berada di chapter pertama dengan chapter_number terkecil
                // if ($material->chapter->chapter_number == $firstChapterNumber && $material->order_number == 1) {
                // $status = UserMaterialStatus::firstOrCreate(
                // ['user_id' => $userId, 'material_id' => $material->id],
                // ['is_completed' => 0, 'completed_at' => now()]
                // );

                // if (now()->gt($status->completed_at)) {
                // $status->update(['is_completed' => 1]);
                // }

                // if ($status->is_completed) {
                // $this->material = $material;
                // $this->message = null;
                // $this->quiz = null; // Reset quiz jika menampilkan material
                // return true;
                // }
                // } else {
                // // Tangani materi yang bukan di chapter pertama
                // if (!$this->cekCompleted($material)) {
                // $this->message = "You must finish reading the previous material within the specified duration.";
                // $this->material = null;
                // return false;
                // }

                // $status = UserMaterialStatus::firstOrCreate(
                // ['user_id' => $userId, 'material_id' => $material->id],
                // ['is_completed' => 0, 'completed_at' => now()->addSeconds($this->convertDurationToSeconds($material->duration))]
                // );

                // if (now()->gt($status->completed_at)) {
                // $status->update(['is_completed' => 1]);
                // }

                // if ($status->is_completed) {
                // $this->material = $material;
                // $this->message = null;
                // $this->quiz = null; // Reset quiz jika menampilkan material
                // return true;
                // }
                // }
                // }

                // $this->message = "Please select materials or quiz.";
                // return false;
                // }

                // // **Highlight: Function to check quiz score**
                // private function checkPreviousQuizScore($chapterId)
                // {
                // $userId = Auth::id();
                // $previousChapter = Material::where('chapter_id', '<', $chapterId)
                    // ->orderBy('chapter_id', 'desc')
                    // ->first();

                    // if (!$previousChapter) {
                    // // No previous chapter found
                    // return true;
                    // }

                    // $previousQuiz = Quiz::where('chapter_id', $previousChapter->chapter_id)->first();

                    // if (!$previousQuiz) {
                    // // No quiz found for the previous chapter
                    // return true;
                    // }

                    // $quizAttempt = QuizAttempt::where('quiz_id', $previousQuiz->id)
                    // ->where('user_id', $userId)
                    // ->first();

                    // if (!$quizAttempt || $quizAttempt->score < 100) {
                        // return false; // If no quiz attempt found or score is less than 100
                        // }

                        // return true; // Quiz score is 100
                        // }

                        // public function cekCompleted($material)
                        // {
                        // $userId=Auth::id();
                        // $previousOrderNumber=$this->getPreviousOrderNumber($material->order_number, $material->chapter_id);

                        // if (is_null($previousOrderNumber)) {
                        // // Jika tidak ada material sebelumnya, anggap sudah selesai
                        // return true;
                        // }

                        // $previousMaterialCompleted = Material::where('chapter_id', $material->chapter_id)
                        // ->where('order_number', $previousOrderNumber)
                        // ->whereHas('userMaterialStatus', function ($query) use ($userId) {
                        // $query->where('user_id', $userId)
                        // ->where('is_completed', 1);
                        // })
                        // ->exists();

                        // if (!$previousMaterialCompleted || !$this->checkPreviousQuizScore($material->chapter_id)) {
                        // return false; // Jika material sebelumnya belum selesai
                        // }

                        // $status = UserMaterialStatus::where('user_id', $userId)
                        // ->where('material_id', $material->id)
                        // ->first();


                        // if (!$status) {
                        // $completedAt = now()->addSeconds($this->convertDurationToSeconds($material->duration));
                        // UserMaterialStatus::create([
                        // 'user_id' => $userId,
                        // 'material_id' => $material->id,
                        // 'is_completed' => 0,
                        // 'completed_at' => $completedAt
                        // ]);
                        // return false;
                        // }

                        // if (now()->gt($status->completed_at)) {
                        // $status->update(['is_completed' => 1]);
                        // }

                        // return $status->is_completed == 1;
                        // }


                        // private function getPreviousOrderNumber($currentOrderNumber, $chapterId)
                        // {
                        // // Cari order_number sebelumnya yang paling mendekati dan valid di dalam chapter yang sama
                        // return Material::where('chapter_id', $chapterId)
                        // ->where('order_number', '<', $currentOrderNumber)
                            // ->max('order_number');
                            // }

                            // private function convertDurationToSeconds($duration)
                            // {
                            // list($hours, $minutes, $seconds) = explode(':', $duration);
                            // return ($hours * 3600) + ($minutes * 60) + $seconds;
                            // }

                            // // #[Layout('components.layouts.app')]
                            // public function render()
                            // {
                            // return view('livewire.courses.material-info', [
                            // 'material' => $this->material,
                            // 'quiz' => $this->quiz,
                            // 'languages' => $this->languages,
                            // 'quizAttempts' => $this->quizAttempts,
                            // ]);
                            // }
                            // public function redirectToQuizTake($quizId)
                            // {
                            // return redirect()->route('quiz.take', $quizId);
                            // }
                            // public function redirectToTryQuiz($quizId)
                            // {
                            // return redirect()->route('try.quiz', $quizId);
                            // }
                            // }