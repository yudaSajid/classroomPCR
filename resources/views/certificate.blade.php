<!DOCTYPE html>
<html>
<head>
    <title>Sertifikat {{ $course_name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* 1. Pengaturan Kertas dan Margin */
        @page {
            size: A4 landscape;
            margin: 0; /* Hilangkan margin bawaan kertas */
            padding: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* 2. Dimensi Container Fisik (Dibuat lebih kecil untuk Border) */
        .certificate-container {
        /* A4 Landscape: 297mm x 210mm.
           Kita kurangi tinggi dari 190mm menjadi 180mm */
        width: 280mm;  /* 28cm (Tetap sama) */
        height: 180mm; /* 18cm (Mengurangi 1cm lagi untuk aman) */

        /* Margin vertikal yang lebih besar untuk mendorong ke tengah secara visual */
        margin: 15mm auto;

        /* Border tetap 10px (~3.7mm) */
        border: none;

        /* Kurangi padding menjadi 10mm */
        padding: 10mm;
        background-color: white;
        box-shadow: none;

        box-sizing: border-box;
        position: relative;
        overflow: hidden;
    }

    /* 3. Penyesuaian Konten agar Muat Vertikal */
    .recipient-name {
        font-size: 2.8em; /* Sedikit dikecilkan lagi */
        margin: 10px 0;
        /* ... */
    }
    .footer-info {
        margin-top: 30px; /* Kurangi margin ini */
        /* ... */
    }

        /* 3. Penyesuaian Style (Dibuat sedikit lebih ringkas) */
        h1 {
            color: #1E40AF;
            font-size: 2em;
            margin-bottom: 5px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
        h2 {
            color: #FBBF24;
            font-size: 1.5em;
            margin-top: 10px;
        }
        .recipient-name {
            font-size: 3em;
            color: #059669;
            margin: 15px 0;
            text-transform: uppercase;
        }
        .detail {
            font-size: 1.1em;
            margin: 5px 0;
        }
        .detail p {
            margin: 3px 0;
        }
        .course-title {
            color: #1E40AF;
            font-size: 1.8em;
            margin: 10px 0 20px 0; /* Margin bawah yang lebih besar */
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <h1>SERTIFIKAT PENCAPAIAN</h1>
        <h2>COURSE COMPLETION</h2>

        <p class="detail" style="margin-top: 30px;">Dengan ini menyatakan bahwa</p>

        <div class="recipient-name">
            {{ $user_name }}
        </div>

        <p class="detail">Telah berhasil menyelesaikan dan lulus dalam kursus</p>

        <h3 class="course-title">"{{ $course_name }}"</h3>

        <hr style="width: 50%; border-color: #ccc; margin: 20px auto;">

        <div class="detail">
            <p>Pada Program Studi: <strong>{{ $major }}</strong></p>
            <p>Di Departemen: <strong>{{ $department_name }}</strong></p>
            <p>Angkatan Tahun: <strong>{{ $year }}</strong></p>
        </div>

        <div class="footer-info">
            Dikeluarkan pada tanggal: <strong>{{ $completion_date }}</strong>
        </div>

    </div>
</body>
</html>
