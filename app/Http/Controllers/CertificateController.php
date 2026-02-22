<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use PDF;

class CertificateController extends Controller
{
    /**
     * Menghasilkan dan mengunduh sertifikat PDF.
     * Menggunakan Route Model Binding untuk Course.
     */
    public function download(Course $course)
    {
        // Pastikan relasi 'userEducation.department' dan 'userEducation.program' sudah didefinisikan
        // di models Users.php dan UserEducation.php
        $user = auth()->user()->load('userEducation.department', 'userEducation.program');

        $education = $user->userEducation; // Model UserEducation

        // Cek apakah relasi education ada sebelum mengakses department/program
        if ($education) {
            // Mengambil department_name dari relasi
            $departmentName = optional($education->department)->department_name ?? 'Unknown Department';

            // Mengambil program_name dari relasi. Ini akan menjadi data yang Anda inginkan.
            $programNameFromEducation = optional($education->program)->program_name ?? 'Unknown Program';

            // Menggunakan programName dari education untuk 'major'
            $major = $user->major ?? $programNameFromEducation ?? 'Unknown Major';

            // Mengambil tahun jika ada
            $year = $user->year ?? optional($education)->enrollment_year ?? 'Unknown Year';
        } else {
            // Handle jika user tidak punya data UserEducation
            $departmentName = 'Unknown Department';
            $programNameFromEducation = 'Unknown Program';
            $major = 'Unknown Major';
            $year = 'Unknown Year';
        }

        $courseName = $course->title ?? $course->course_name ?? $course->name ?? 'Unknown Course';
        // Ambil program name dari UserEducation (yang sudah tersimpan di $programNameFromEducation)
        // Bukan dari model Course (kecuali Anda ingin menampilkan program dari Course)
        $programNameForView = $programNameFromEducation;

        $completionDate = now()->format('d F Y');

        $data = [
            'user_name' => $user->name,
            'course_name' => $courseName,
            'program_name' => $programNameForView,
            'department_name' => $departmentName,
            'major' => $major,
            'year' => $year,
            'completion_date' => $completionDate,
        ];

        $pdf = PDF::loadView('certificate', $data);

        // 4b. Atur orientasi ke Landscape
        $pdf->setPaper('a4', 'landscape'); // Menggunakan ukuran kertas A4, orientasi 'landscape'

        // 4c. Unduh file PDF
        // Nama file yang disarankan: 'Sertifikat_[Nama_User]_[Nama_Kursus].pdf'
        $fileName = 'Sertifikat_' . str_replace(' ', '_', $user->name) . '_' . str_replace(' ', '_', $courseName) . '.pdf';

        return $pdf->download($fileName);
        return view('certificate',$data);
    }
}
