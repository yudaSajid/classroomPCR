<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-pattern {
            background-image: url('../dotted\ pattern.png');
            background-position: 80% center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .slide {
            transition: transform 0.5s ease-in-out;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Logo_Resmi_PCR.png"
                        class="h-12 md:h-16" alt="Logo PCR" />
                </div>

                <div class="hidden space-x-8 md:flex">
                    <a href="#tentang" class="text-gray-600 transition-colors hover:text-fuchsia-500">
                        Tentang E-Learning
                    </a>
                    <a href="#fasilitas" class="text-gray-600 transition-colors hover:text-fuchsia-500">
                        Fitur & Fasilitas
                    </a>
                    <a href="#kelas" class="text-gray-600 transition-colors hover:text-fuchsia-500">
                        Kelas
                    </a>
                </div>

                <button id="loginBtn"
                    class="inline-flex items-center px-6 py-2.5 rounded-full bg-fuchsia-500 text-white font-medium text-sm leading-tight hover:bg-fuchsia-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-fuchsia-500 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Masuk
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 overflow-hidden bg-gradient-to-b from-white to-gray-50">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center max-w-4xl mx-auto text-center">
                <h1 class="mb-8 text-4xl font-bold text-gray-900 md:text-6xl">
                    Empowers You to
                    <span class="text-fuchsia-500">Global Competition</span>
                </h1>
                <p class="mb-12 text-xl text-gray-600">
                    Diakui sebagai institusi pendidikan unggul yang mampu bersaing dalam bidang teknologi,
                    bisnis, dan ilmu terapan di tingkat Asia tahun 2045
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <a href="#kelas"
                        class="px-8 py-4 text-white transition-colors rounded-full bg-fuchsia-500 hover:bg-fuchsia-600">
                        Mulai Belajar
                    </a>
                    <a href="#fasilitas"
                        class="px-8 py-4 transition-colors bg-white border-2 rounded-full text-fuchsia-500 border-fuchsia-500 hover:bg-fuchsia-50">
                        Lihat Fitur
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <div id="fasilitas" class="relative py-20 overflow-hidden bg-gradient-to-br from-fuchsia-50 to-white">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 opacity-10">
            <svg class="w-64 h-64" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FF0066"
                    d="M47.7,-61.1C62.3,-52.8,75.1,-37.7,79.2,-20.2C83.3,-2.7,78.8,17.2,68.9,32.8C59,48.3,43.7,59.5,27.1,65.2C10.5,70.9,-7.4,71.1,-23.6,65.6C-39.8,60.1,-54.3,48.9,-63.3,33.8C-72.3,18.7,-75.8,-0.3,-71.2,-16.9C-66.6,-33.5,-53.9,-47.7,-39.3,-56C-24.7,-64.3,-8.2,-66.8,4.9,-73.1C18,-79.3,33.1,-69.4,47.7,-61.1Z"
                    transform="translate(100 100)" />
            </svg>
        </div>

        <div class="container px-4 mx-auto">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                    Fitur Unggulan E-Learning PCR
                </h2>
                <div class="w-24 h-1 mx-auto mt-4 rounded-full bg-fuchsia-500"></div>
                <p class="mt-6 text-lg text-gray-600">
                    Tingkatkan pengalaman belajar Anda dengan berbagai fitur interaktif dan inovatif
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <!-- Scoring Board -->
                <div class="cursor-pointer group" id="clickableScoring">
                    <div
                        class="relative p-6 transition-all duration-300 bg-white rounded-xl hover:shadow-xl group-hover:transform group-hover:-translate-y-2">
                        <div
                            class="absolute w-20 h-20 transition-all duration-300 -translate-x-1/2 rounded-full -top-10 left-1/2 bg-gradient-to-br from-fuchsia-500 to-pink-500 group-hover:scale-110">
                            <div class="flex items-center justify-center w-full h-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-white">
                                    <path fill="currentColor"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-10 text-center">
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Scoring Board</h3>
                            <p class="mt-2 text-sm text-gray-600">Pantau progres belajar Anda secara real-time</p>
                        </div>
                    </div>
                </div>

                <!-- Certificate -->
                <div class="cursor-pointer group" id="clickableCertificate">
                    <div
                        class="relative p-6 transition-all duration-300 bg-white rounded-xl hover:shadow-xl group-hover:transform group-hover:-translate-y-2">
                        <div
                            class="absolute w-20 h-20 transition-all duration-300 -translate-x-1/2 rounded-full -top-10 left-1/2 bg-gradient-to-br from-fuchsia-500 to-pink-500 group-hover:scale-110">
                            <div class="flex items-center justify-center w-full h-full">
                                <svg viewBox="0 0 48 48" class="w-8 h-8 text-white">
                                    <path fill="currentColor"
                                        d="M46 24a12.9 12.9 0 0 0-4-9.4V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v34a2 2 0 0 0 2 2h22v1.6c0 2 2 3.1 3.3 1.8L33 43l3.7 3.4c1.3 1.3 3.3.2 3.3-1.8V34.9a12.9 12.9 0 0 0 6-10.9z" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-10 text-center">
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Certificate</h3>
                            <p class="mt-2 text-sm text-gray-600">Dapatkan sertifikat resmi setelah menyelesaikan kelas
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Points -->
                <div class="cursor-pointer group" id="clickablePoints">
                    <div
                        class="relative p-6 transition-all duration-300 bg-white rounded-xl hover:shadow-xl group-hover:transform group-hover:-translate-y-2">
                        <div
                            class="absolute w-20 h-20 transition-all duration-300 -translate-x-1/2 rounded-full -top-10 left-1/2 bg-gradient-to-br from-fuchsia-500 to-pink-500 group-hover:scale-110">
                            <div class="flex items-center justify-center w-full h-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-8 h-8 text-white">
                                    <path fill="currentColor"
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-10 text-center">
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Points</h3>
                            <p class="mt-2 text-sm text-gray-600">Kumpulkan poin dan tukarkan dengan rewards menarik
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Achievement History -->
                <div class="cursor-pointer group" id="clickableAchievement">
                    <div
                        class="relative p-6 transition-all duration-300 bg-white rounded-xl hover:shadow-xl group-hover:transform group-hover:-translate-y-2">
                        <div
                            class="absolute w-20 h-20 transition-all duration-300 -translate-x-1/2 rounded-full -top-10 left-1/2 bg-gradient-to-br from-fuchsia-500 to-pink-500 group-hover:scale-110">
                            <div class="flex items-center justify-center w-full h-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-white">
                                    <path fill="currentColor"
                                        d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-10 text-center">
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Achievement History</h3>
                            <p class="mt-2 text-sm text-gray-600">Lacak dan simpan semua pencapaian Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Continue with similar pattern for other features -->
            </div>
        </div>
    </div>

    <div class="pb-5 bg-Slate-300">
        <div class="flex justify-between px-10 mt-5 mb-7 md:ml-5 md:mr-5">
            <div class="mx-auto mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900">Kelas Unggulan</h2>
                <p class="text-lg text-gray-600">Pilih dan pelajari berbagai kelas berkualitas</p>
            </div>

        </div>
        <div class="grid h-auto grid-cols-2 gap-4 px-10 md:grid-cols-4 md:justify-evenly md:px-40 md:h-80">

            @foreach ($courses as $course)
                <div
                    class="flex flex-col w-auto overflow-hidden transform bg-white rounded-lg shadow-lg active:bg-blue-100 motion-safe:hover:scale-105">
                    <div class="relative">
                        <img class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105 hover:opacity-90"
                            src="{{ asset('storage/' . $course->course_photo) }}" alt="{{ $course->course_name }}" />
                        <span
                            class="absolute px-2 py-1 text-xs text-white bg-red-500 rounded top-2 right-2">Baru</span>
                        <p
                            class="absolute flex items-center px-2 py-1 mb-2 text-xs text-blue-900 bg-blue-100 rounded bottom-2 left-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                class="fill-blue-900 size-3 mr-1.5">
                                <g id="Document">
                                    <path
                                        d="M26.869,8a2.99,2.99,0,0,0-.748-1.293L22.293,2.879A2.99,2.99,0,0,0,21,2.131V6a2,2,0,0,0,2,2Z">
                                    </path>
                                    <path
                                        d="M23,10a4,4,0,0,1-4-4V2H10A5,5,0,0,0,5,7V25a5,5,0,0,0,5,5H22a5,5,0,0,0,5-5V10ZM11,10h4a1,1,0,0,1,0,2H11a1,1,0,0,1,0-2Zm8,14H11a1,1,0,0,1,0-2h8a1,1,0,0,1,0,2Zm2-4H11a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Zm0-4H11a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Z">
                                    </path>
                                </g>
                            </svg>
                            6 Materi
                        </p>
                    </div>
                    <div class="flex flex-col justify-between h-full px-6 py-4">
                        <div class="mb-5 text-sm font-bold md:text-base">{{ $course->course_name }}</div>
                        <div class="">
                            <div class="flex items-center text-sm text-gray-500 md:justify-between">
                                <div class="flex">
                                    <div class="flex text-purple-500 ">
                                        <svg class="fill-current size-3 md:size-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="fill-current size-3 md:size-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="fill-current size-3 md:size-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="fill-current size-3 md:size-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="fill-current size-3 md:size-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                    <span class="ml-2 md:text-base text-[10px]">({{ random_int(10, 100) }}
                                        ulasan)</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="ml-1 feather feather-bar-chart size-5 stroke-purple-500 md:size-7 ">
                                    <line x1="12" y1="20" x2="12" y2="10"></line>
                                    <line x1="18" y1="20" x2="18" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="16"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>



    <!-- Footer -->
    <!-- Footer -->
    <footer class="relative py-12 bg-white border-t border-gray-100">
        <div class="container px-4 mx-auto">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 gap-8 mb-8 md:grid-cols-2">
                <!-- Left Side - Credits -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Developed By</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Iqbal Mahatma Putra, S.S.T</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            <span>Sajid Yuda</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            <span>Lucky De Viarpi</span>
                        </li>
                    </ul>
                </div>

                <!-- Right Side - Supervisor -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Supervised By</h3>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-sm text-gray-600">Rika Perdana Sari, S.T., M.Eng.</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="pt-8 border-t border-gray-100">
                <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
                    <div class="flex items-center space-x-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Logo_Resmi_PCR.png"
                            alt="PCR Logo" class="object-contain w-8 h-8" />
                        <span class="text-sm font-medium text-gray-600">&copy; 2024 Politeknik Caltex Riau</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">All Rights Reserved</span>
                        <div class="w-px h-4 bg-gray-300"></div>
                        <span class="text-sm text-gray-500">E-Learning Platform</span>
                    </div>
                </div>
            </div>

            <!-- Decorative Element -->
            <div class="absolute top-0 right-0 w-32 h-32 transform -translate-y-1/2 opacity-5">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FF0066"
                        d="M47.7,-61.1C62.3,-52.8,75.1,-37.7,79.2,-20.2C83.3,-2.7,78.8,17.2,68.9,32.8C59,48.3,43.7,59.5,27.1,65.2C10.5,70.9,-7.4,71.1,-23.6,65.6C-39.8,60.1,-54.3,48.9,-63.3,33.8C-72.3,18.7,-75.8,-0.3,-71.2,-16.9C-66.6,-33.5,-53.9,-47.7,-39.3,-56C-24.7,-64.3,-8.2,-66.8,4.9,-73.1C18,-79.3,33.1,-69.4,47.7,-61.1Z"
                        transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </footer>

    <!-- Pop-up Card -->
    <!-- scoring board -->
    <div id="popupScoring" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg w-80 h-80 bg-fuchsia-100">
            <svg viewBox="0 -1 256 256" xmlns="http://www.w3.org/2000/svg"
                class="absolute transform -translate-x-1/2 size-20 -top-10 left-2/4"
                xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <defs>
                        <style>
                            .cls-3 {
                                fill: #d9e7eb;
                            }

                            .cls-4 {
                                fill: #b6cdd5;
                            }

                            .cls-5 {
                                fill: #ffffff;
                            }

                            .cls-6 {
                                fill: #a74920;
                            }
                        </style>
                    </defs>
                    <g id="scoreboard">
                        <rect id="rect-1" class="cls-3" x="82" y="200" width="92" height="54"></rect>
                        <path
                            d="M16.000,-0.000 C16.000,-0.000 240.000,-0.000 240.000,-0.000 C248.836,-0.000 256.000,7.163 256.000,16.000 C256.000,16.000 256.000,184.000 256.000,184.000 C256.000,192.837 248.836,200.000 240.000,200.000 C240.000,200.000 16.000,200.000 16.000,200.000 C7.163,200.000 -0.000,192.837 -0.000,184.000 C-0.000,184.000 -0.000,16.000 -0.000,16.000 C-0.000,7.163 7.163,-0.000 16.000,-0.000 Z"
                            id="path-1" class="cls-4" fill-rule="evenodd"></path>
                        <path
                            d="M45.000,37.000 C45.000,37.000 211.000,37.000 211.000,37.000 C215.418,37.000 219.000,40.582 219.000,45.000 C219.000,45.000 219.000,155.000 219.000,155.000 C219.000,159.418 215.418,163.000 211.000,163.000 C211.000,163.000 45.000,163.000 45.000,163.000 C40.582,163.000 37.000,159.418 37.000,155.000 C37.000,155.000 37.000,45.000 37.000,45.000 C37.000,40.582 40.582,37.000 45.000,37.000 Z"
                            id="path-2" class="cls-5" fill-rule="evenodd"></path>
                        <path
                            d="M172.000,142.000 C155.984,142.000 143.000,129.016 143.000,113.000 C143.000,113.000 143.000,88.000 143.000,88.000 C143.000,71.984 155.984,59.000 172.000,59.000 C188.016,59.000 201.000,71.984 201.000,88.000 C201.000,88.000 201.000,113.000 201.000,113.000 C201.000,129.016 188.016,142.000 172.000,142.000 ZM182.000,88.000 C182.000,82.477 177.523,78.000 172.000,78.000 C166.477,78.000 162.000,82.477 162.000,88.000 C162.000,88.000 162.000,113.000 162.000,113.000 C162.000,118.523 166.477,123.000 172.000,123.000 C177.523,123.000 182.000,118.523 182.000,113.000 C182.000,113.000 182.000,88.000 182.000,88.000 ZM85.000,142.000 C85.000,142.000 81.000,142.000 81.000,142.000 C76.582,142.000 73.000,138.418 73.000,134.000 C73.000,134.000 73.000,79.000 73.000,79.000 C73.000,79.000 71.000,79.000 71.000,79.000 C66.582,79.000 63.000,75.418 63.000,71.000 C63.000,71.000 63.000,67.000 63.000,67.000 C63.000,62.582 66.582,59.000 71.000,59.000 C71.000,59.000 85.000,59.000 85.000,59.000 C89.418,59.000 93.000,62.582 93.000,67.000 C93.000,67.000 93.000,134.000 93.000,134.000 C93.000,138.418 89.418,142.000 85.000,142.000 Z"
                            id="path-3" class="cls-6" fill-rule="evenodd"></path>
                        <path
                            d="M120.000,91.000 C115.029,91.000 111.000,86.970 111.000,82.000 C111.000,77.029 115.029,73.000 120.000,73.000 C124.970,73.000 129.000,77.029 129.000,82.000 C129.000,86.970 124.970,91.000 120.000,91.000 ZM120.000,109.000 C124.970,109.000 129.000,113.029 129.000,118.000 C129.000,122.970 124.970,127.000 120.000,127.000 C115.029,127.000 111.000,122.970 111.000,118.000 C111.000,113.029 115.029,109.000 120.000,109.000 Z"
                            id="path-4" class="cls-6" fill-rule="evenodd"></path>
                    </g>
                </g>
            </svg>
            <h2 class="text-lg font-bold">Scoring Board</h2>
            <p class="mt-8">Mahasiswa dapat melihat dan melacak skor atau nilai secara langsung di dashboard atau
                profil. Skor atau nilai dapat diperbarui secara real-time saat mahasiswa menyelesaikan latihan atau
                mencapai pencapaian tertentu.</p>
        </div>
    </div>
    <!-- certificate -->
    <div id="popupCertificate" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg w-80 h-80 bg-fuchsia-100">
            <svg height="200px" class="absolute transform -translate-x-1/2 size-24 -top-10 left-1/2" version="1.1"
                id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <g>
                                <path style="fill:#ffe5e5;"
                                    d="M512,88.603v334.793c0,5.692-4.62,10.312-10.312,10.312H10.312C4.62,433.708,0,429.089,0,423.397 V88.603c0-5.692,4.62-10.312,10.312-10.312h491.376C507.38,78.292,512,82.911,512,88.603z">
                                </path>
                                <path style="fill:#EFE2DD;"
                                    d="M512,88.603v334.793c0,5.692-4.62,10.312-10.312,10.312h-23.408 c5.692,0,10.312-4.62,10.312-10.312V88.603c0-5.692-4.62-10.312-10.312-10.312h23.408C507.38,78.292,512,82.911,512,88.603z">
                                </path>
                            </g>
                            <g>
                                <g>
                                    <path style="fill:#FFC26D;"
                                        d="M58.976,160.633c-16.48,0-29.887-13.407-29.887-29.887c0-4.268,3.459-7.726,7.726-7.726 s7.726,3.459,7.726,7.726c0,7.96,6.475,14.435,14.435,14.435s14.435-6.475,14.435-14.435s-6.475-14.436-14.435-14.436 c-4.268,0-7.726-3.459-7.726-7.726c0-4.268,3.459-7.726,7.726-7.726h82.368c4.268,0,7.726,3.459,7.726,7.726 c0,4.268-3.459,7.726-7.726,7.726H85.141c2.371,4.282,3.722,9.204,3.722,14.436C88.863,147.225,75.456,160.633,58.976,160.633z">
                                    </path>
                                    <path style="fill:#FFC26D;"
                                        d="M141.344,411.143H58.976c-4.268,0-7.726-3.459-7.726-7.726s3.459-7.726,7.726-7.726 c7.96,0,14.435-6.476,14.435-14.436c0-7.96-6.475-14.435-14.435-14.435s-14.435,6.475-14.435,14.435 c0,4.268-3.459,7.726-7.726,7.726s-7.726-3.459-7.726-7.726c0-16.48,13.407-29.887,29.887-29.887s29.887,13.407,29.887,29.887 c0,5.231-1.351,10.154-3.722,14.436h56.203c4.268,0,7.726,3.459,7.726,7.726S145.612,411.143,141.344,411.143z">
                                    </path>
                                </g>
                                <g>
                                    <path style="fill:#FFC26D;"
                                        d="M453.024,160.633c-16.48,0-29.887-13.407-29.887-29.887c0-5.231,1.351-10.154,3.722-14.436 h-56.203c-4.268,0-7.726-3.459-7.726-7.726c0-4.268,3.459-7.726,7.726-7.726h82.368c4.268,0,7.726,3.459,7.726,7.726 c0,4.268-3.459,7.726-7.726,7.726c-7.96,0-14.435,6.476-14.435,14.436s6.475,14.435,14.435,14.435 c7.96,0,14.435-6.475,14.435-14.435c0-4.268,3.459-7.726,7.726-7.726s7.726,3.459,7.726,7.726 C482.911,147.225,469.504,160.633,453.024,160.633z">
                                    </path>
                                    <path style="fill:#FFC26D;"
                                        d="M453.024,411.143h-82.368c-4.268,0-7.726-3.459-7.726-7.726s3.459-7.726,7.726-7.726h56.203 c-2.371-4.282-3.722-9.204-3.722-14.436c0-16.48,13.407-29.887,29.887-29.887s29.887,13.407,29.887,29.887 c0,4.268-3.459,7.726-7.726,7.726s-7.726-3.459-7.726-7.726c0-7.96-6.475-14.435-14.435-14.435 c-7.96,0-14.435,6.475-14.435,14.435c0,7.96,6.475,14.436,14.435,14.436c4.268,0,7.726,3.459,7.726,7.726 S457.292,411.143,453.024,411.143z">
                                    </path>
                                </g>
                            </g>
                        </g>
                        <g>
                            <g>
                                <g>
                                    <g>
                                        <g>
                                            <path style="fill:#F37D7E;"
                                                d="M196.035,244.079v94.529c0,8.324-9.272,13.3-16.215,8.705l-25.167-16.689l-25.167,16.689 c-6.943,4.595-16.215-0.381-16.215-8.705v-94.529c0-5.759,4.677-10.436,10.436-10.436h61.883 C191.358,233.643,196.035,238.32,196.035,244.079z">
                                            </path>
                                            <path style="fill:#ED6264;"
                                                d="M196.035,244.079v33.378c-11.662,8.375-25.961,13.31-41.382,13.31s-29.721-4.934-41.382-13.31 v-33.378c0-5.759,4.677-10.436,10.436-10.436h61.883C191.358,233.643,196.035,238.32,196.035,244.079z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <circle style="fill:#FFC26D;" cx="154.652" cy="219.641" r="56.707">
                                        </circle>
                                        <path style="fill:#FFA730;"
                                            d="M211.359,219.645c0,31.315-25.392,56.707-56.707,56.707c-3.632,0-7.191-0.34-10.638-1.001 c26.238-4.973,46.079-28.023,46.079-55.706c0-27.693-19.841-50.733-46.079-55.706c3.446-0.66,7.006-1.001,10.638-1.001 C185.966,162.938,211.359,188.32,211.359,219.645z">
                                        </path>
                                    </g>
                                    <path style="fill:#FFA730;"
                                        d="M167.657,231.421h-3.038v-30.912c0-2.678-1.386-5.165-3.664-6.572 c-2.28-1.407-5.123-1.535-7.518-0.338l-12.533,6.267c-3.816,1.908-5.363,6.549-3.455,10.366 c1.907,3.817,6.548,5.362,10.366,3.455l1.351-0.676v18.411h-3.038c-4.268,0-7.726,3.459-7.726,7.726s3.459,7.726,7.726,7.726 h21.529c4.268,0,7.726-3.459,7.726-7.726S171.925,231.421,167.657,231.421z">
                                    </path>
                                </g>
                            </g>
                            <path style="fill:#65BAFC;"
                                d="M403.754,233.641H267.389c-5.69,0-10.302-4.612-10.302-10.302v-20.125 c0-5.69,4.612-10.302,10.302-10.302h136.365c5.69,0,10.302,4.612,10.302,10.302v20.125 C414.056,229.028,409.443,233.641,403.754,233.641z">
                            </path>
                            <path style="fill:#2EA8FC;"
                                d="M414.061,203.214v20.13c0,5.687-4.615,10.302-10.302,10.302h-17.915 c5.687,0,10.302-4.615,10.302-10.302v-20.13c0-5.687-4.615-10.302-10.302-10.302h17.915 C409.445,192.912,414.061,197.527,414.061,203.214z">
                            </path>
                            <path style="fill:#E0D3CE;"
                                d="M414.055,272.998H257.088c-4.268,0-7.726-3.459-7.726-7.726s3.459-7.726,7.726-7.726h156.968 c4.268,0,7.726,3.459,7.726,7.726S418.323,272.998,414.055,272.998z">
                            </path>
                            <path style="fill:#E0D3CE;"
                                d="M414.055,305.395H257.088c-4.268,0-7.726-3.459-7.726-7.726s3.459-7.726,7.726-7.726h156.968 c4.268,0,7.726,3.459,7.726,7.726S418.323,305.395,414.055,305.395z">
                            </path>
                            <path style="fill:#E0D3CE;"
                                d="M323.237,337.793h-66.15c-4.268,0-7.726-3.459-7.726-7.726s3.459-7.726,7.726-7.726h66.15 c4.268,0,7.726,3.459,7.726,7.726S327.505,337.793,323.237,337.793z">
                            </path>
                        </g>
                    </g>
                </g>
            </svg>
            <h2 class="text-lg font-bold">Certificate</h2>
            <p class="mt-8">Sertifikat diberikan kepada mahasiswa ketika menyelesaikan kelas dengan sukses.
                Sertifikat
                ini
                dapat di generate secara otomatis dan diunduh oleh mahasiswa dari dashboardnya</p>
        </div>
    </div>
    <!-- points -->
    <div id="popupPoints" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-96 w-80 bg-fuchsia-100">
            <svg class="absolute -translate-x-1/2 -top-16 left-1/2 size-24" version="1.1" id="Layer_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                xml:space="preserve" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <polygon style="fill:#FBAC50;"
                        points="256,8.362 297.272,96.117 393.485,108.251 322.778,174.62 340.971,269.875 256,223.137 171.029,269.875 189.222,174.62 118.515,108.251 214.728,96.117 ">
                    </polygon>
                    <polygon style="fill:#F78750;"
                        points="256,8.362 297.272,96.117 393.485,108.251 322.778,174.62 340.971,269.875 256,223.137 ">
                    </polygon>
                    <polygon style="fill:#FF648D;"
                        points="451.298,325.816 458.336,384.895 512,410.585 457.987,435.535 450.137,494.512 409.717,450.853 351.201,461.611 380.233,409.679 351.919,357.352 410.281,368.915 ">
                    </polygon>
                    <polygon style="fill:#FD387E;"
                        points="451.298,325.816 458.336,384.895 512,410.585 457.987,435.535 450.137,494.512 409.717,450.853 ">
                    </polygon>
                    <polygon style="fill:#88DEE0;"
                        points="60.702,325.816 53.664,384.895 0,410.585 54.013,435.535 61.863,494.512 102.283,450.853 160.799,461.611 131.767,409.679 160.081,357.352 101.719,368.915 ">
                    </polygon>
                    <polygon style="fill:#10C7C5;"
                        points="60.702,325.816 102.283,450.853 160.799,461.611 131.767,409.679 160.081,357.352 101.719,368.915 ">
                    </polygon>
                    <polygon style="fill:#FBAC50;"
                        points="297.972,444.971 272.696,444.971 272.696,419.695 239.304,419.695 239.304,444.971 214.028,444.971 214.028,478.363 239.304,478.363 239.304,503.638 272.696,503.638 272.696,478.363 297.972,478.363 ">
                    </polygon>
                    <polygon style="fill:#F78750;"
                        points="297.972,444.971 272.696,444.971 272.696,419.695 256,419.695 256,503.638 272.696,503.638 272.696,478.363 297.972,478.363 ">
                    </polygon>
                    <polygon style="fill:#FF648D;"
                        points="100.638,78.099 75.363,78.099 75.363,52.823 41.972,52.823 41.972,78.099 16.696,78.099 16.696,111.49 41.972,111.49 41.972,136.766 75.363,136.766 75.363,111.49 100.638,111.49 ">
                    </polygon>
                    <polygon style="fill:#FD387E;"
                        points="100.638,78.099 75.363,78.099 75.363,52.823 58.667,52.823 58.667,136.766 75.363,136.766 75.363,111.49 100.638,111.49 ">
                    </polygon>
                    <polygon style="fill:#88DEE0;"
                        points="495.304,183.713 470.028,183.713 470.028,158.437 436.637,158.437 436.637,183.713 411.361,183.713 411.361,217.105 436.637,217.105 436.637,242.381 470.028,242.381 470.028,217.105 495.304,217.105 ">
                    </polygon>
                    <polygon style="fill:#10C7C5;"
                        points="495.304,183.713 470.028,183.713 470.028,158.437 453.009,158.437 453.009,242.381 470.028,242.381 470.028,217.105 495.304,217.105 ">
                    </polygon>
                </g>
            </svg>
            <h2 class="text-lg font-bold">Points</h2>
            <p class="mt-5">Poin dapat diberikan kepada mahasiswa sebagai imbalan setelah mengubah dan melengkapi
                data
                profil, menyelesaikan latihan, mencapai target atau berpartisipasi dalam aktivitas tertentu. Poin dapat
                digunakan untuk mendapatkan manfaat lainnya, seperti akses materi pembelajaran tambahan dan sebagainya.
            </p>
        </div>
    </div>

    <!-- achievement history-->
    <div id="popupAchievement" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-80 w-80 bg-fuchsia-100">
            <svg version="1.1" class="absolute -translate-x-1/2 -top-20 left-1/2 size-24" id="Layer_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 495 495"
                xml:space="preserve" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <rect x="104.54" style="fill:#FFDA44;" width="122.96" height="141.256"></rect>
                        <polygon style="fill:#6E76E5;"
                            points="187.01,369.45 128.39,327.23 0,465.96 0,495 247.49,495 247.49,325.88 "></polygon>
                        <polygon style="fill:#515BE0;"
                            points="366.6,327.23 307.99,369.45 247.49,325.88 247.49,495 495,495 495,465.96 "></polygon>
                        <path style="fill:#99E9EC;" d="M366.6,327.23l-99.117-107.089L366.6,327.23z"></path>
                        <polygon style="fill:#99E9EC;"
                            points="247.49,325.88 247.49,220.141 227.5,220.141 128.39,327.23 187.01,369.45 "></polygon>
                        <polygon style="fill:#99E9EC;"
                            points="247.49,325.88 307.99,369.45 366.6,327.23 307.99,369.45 ">
                        </polygon>
                        <polygon style="fill:#66DDE2;"
                            points="247.49,220.141 247.49,325.88 307.99,369.45 366.6,327.23 267.483,220.141 ">
                        </polygon>
                        <path style="fill:#957856;"
                            d="M267.483,220.141C267.5,220.141,267.5,0,267.5,0h-40v220.141H267.483z"></path>
                    </g>
                </g>
            </svg>
            <h2 class="text-lg font-bold">Achievement History</h2>
            <p class="mt-5">Riwayat pencapaian ditampilkan di profil pengguna, mencakup semua badge yang telah
                diperoleh, sertifikat yang diterima dan prestasi lainnya. Riwayat pencapaian ditampilkan dalam bentuk
                grafik atau diagram yang menunjukkan progres mahasiswa dari semester ke semester.</p>
        </div>
    </div>

    <!-- leaderboard -->
    <div id="popupLeader" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-80 w-80 bg-fuchsia-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 137" id="leaderboard"
                class="absolute -translate-x-1/2 -top-14 left-1/2 size-24">
                <g>
                    <g>
                        <path
                            d="M117.24 71.29c0 29.41-23.41 53.25-52.3 53.25a51.43 51.43 0 0 1-33.59-12.45 53.26 53.26 0 0 1-17.73-30.52 54 54 0 0 1-1-10.28C12.64 41.88 36.05 18 64.94 18a51.56 51.56 0 0 1 28.8 8.8 52.74 52.74 0 0 1 11.43 10.43 53.6 53.6 0 0 1 12.07 34z"
                            fill="#f93052"></path>
                        <path
                            d="m114.5 54.24-66.31 67.51a51.73 51.73 0 0 1-16.85-9.66c.21-.27.43-.51.67-.76l71.31-72.61a9.58 9.58 0 0 1 1.84-1.45 53.57 53.57 0 0 1 9.34 16.97zM93.74 26.84c-.18.21-.35.41-.55.61l-71.32 72.61c-.2.2-.39.38-.6.56a53.36 53.36 0 0 1-7.66-19L75 19a51.37 51.37 0 0 1 18.74 7.84z"
                            fill="#f15a24"></path>
                        <path
                            d="M129.31 62.5a65 65 0 0 1-128.62 0A66.08 66.08 0 0 0 0 72a65 65 0 0 0 130 0 66.08 66.08 0 0 0-.69-9.5z"
                            fill="#ed1c24"></path>
                        <path
                            d="M65 20a45 45 0 1 1-45 45 45.05 45.05 0 0 1 45-45m0-20a65 65 0 1 0 65 65A65 65 0 0 0 65 0z"
                            fill="#f7931e"></path>
                        <path
                            d="M65.5 111c-25.27 0-47.76-9.89-62.11-25.26A65 65 0 0 0 126 87.37C111.64 101.81 89.86 111 65.5 111z"
                            fill="#f15a24"></path>
                        <rect width="60.63" height="30.25" x="35.78" y="60.75" rx="6.5" ry="6.5"
                            fill="#c1272d"></rect>
                        <rect width="30.25" height="30.25" x="52.28" y="38" rx="6.5" ry="6.5"
                            fill="#c1272d"></rect>
                        <rect width="30.25" height="30.25" x="33.72" y="58.69" rx="6.5" ry="6.5"
                            fill="#fff"></rect>
                        <rect width="42.8" height="30.25" x="51.41" y="58.69" rx="6.5" ry="6.5"
                            fill="#fff"></rect>
                        <rect width="30.25" height="30.25" x="48.84" y="36.69" rx="6.5" ry="6.5"
                            fill="#fff"></rect>
                        <path
                            d="M60.79 54.41c.1 0 .35 0 .74.08a2.71 2.71 0 0 0 .43 0q1 0 1.1-1.5.08-.85.08-4.85a1.15 1.15 0 0 0-.25-.84 1.31 1.31 0 0 0-.9-.24H61.15a.9.9 0 0 1-.62-.21.69.69 0 0 1-.24-.54 1 1 0 0 1 .36-.71 3.15 3.15 0 0 1 1-.62 17.14 17.14 0 0 1 6.76-1.35 3.26 3.26 0 0 1 1.42.23.77.77 0 0 1 .44.74.66.66 0 0 1-.15.46 1.78 1.78 0 0 1-.58.35c-.46.2-.73.45-.8.74a31.22 31.22 0 0 0-.16 3.41q.09 3 .1 3.22a4.28 4.28 0 0 0 .09.6 1.21 1.21 0 0 0 .51.82 3 3 0 0 0 1.3.27q1.06 0 1.06.86t-1.49 1.12a24.17 24.17 0 0 1-4.27.37 21 21 0 0 1-2.72-.17 12.72 12.72 0 0 1-2.49-.55q-.86-.31-.86-.94a.76.76 0 0 1 .28-.58 1.06 1.06 0 0 1 .7-.17z"
                            fill="#ed1c24"></path>
                        <path
                            d="M59.79 53.41c.1 0 .35 0 .74.08a2.71 2.71 0 0 0 .43 0q1 0 1.1-1.5.08-.85.08-4.85a1.15 1.15 0 0 0-.25-.84 1.31 1.31 0 0 0-.9-.24H60.15a.9.9 0 0 1-.62-.21.69.69 0 0 1-.24-.54 1 1 0 0 1 .36-.71 3.15 3.15 0 0 1 1-.62 17.14 17.14 0 0 1 6.76-1.35 3.26 3.26 0 0 1 1.42.23.77.77 0 0 1 .44.74.66.66 0 0 1-.15.46 1.78 1.78 0 0 1-.58.35c-.46.2-.73.45-.8.74a31.22 31.22 0 0 0-.16 3.41q.09 3 .1 3.22a4.28 4.28 0 0 0 .09.6 1.21 1.21 0 0 0 .51.82 3 3 0 0 0 1.3.27q1.06 0 1.06.86t-1.49 1.12a24.17 24.17 0 0 1-4.27.37 21 21 0 0 1-2.72-.17 12.72 12.72 0 0 1-2.49-.55q-.86-.31-.86-.94a.76.76 0 0 1 .28-.58 1.06 1.06 0 0 1 .7-.17z"
                            fill="#f15a24"></path>
                        <path
                            d="M81.82 67.72a8.86 8.86 0 0 1 3.85.8 2.63 2.63 0 0 1 1.05.9 2.19 2.19 0 0 1 .39 1.24 2.86 2.86 0 0 1-1.27 2.22q-.36.29-.36.46c0 .22.21.37.64.45q3 .56 3 3.37a4.88 4.88 0 0 1-1.24 3.22 6.82 6.82 0 0 1-3.45 2.07 13 13 0 0 1-3.6.47 10.94 10.94 0 0 1-4-.64q-1-.4-1-1.18a1.07 1.07 0 0 1 .35-.81 1.21 1.21 0 0 1 .86-.33 10.44 10.44 0 0 1 1.52.28 5.05 5.05 0 0 0 1.16.1 3.41 3.41 0 0 0 2.15-.62 1.91 1.91 0 0 0 .84-1.52 1.59 1.59 0 0 0-.65-1.31 2.63 2.63 0 0 0-1.67-.51 4 4 0 0 0-1.15.15 1.67 1.67 0 0 1-.44.09q-.29 0-.6-.59a2.51 2.51 0 0 1-.31-1.16.41.41 0 0 1 .15-.37 6.33 6.33 0 0 1 .93-.36 3.48 3.48 0 0 0 1.36-.9 1.54 1.54 0 0 0 .49-1.09 1.46 1.46 0 0 0-.51-1.11 1.73 1.73 0 0 0-1.21-.47 2.24 2.24 0 0 0-.72.1 9 9 0 0 0-1.1.53.88.88 0 0 1-.37.12q-.28 0-.53-.39a1.51 1.51 0 0 1-.25-.83q0-.76 1.35-1.44a8.67 8.67 0 0 1 2-.69 10.51 10.51 0 0 1 2.34-.25z"
                            fill="#ed1c24"></path>
                        <path
                            d="M80.82 66.72a8.86 8.86 0 0 1 3.85.8 2.63 2.63 0 0 1 1.05.9 2.19 2.19 0 0 1 .39 1.24 2.86 2.86 0 0 1-1.27 2.22q-.36.29-.36.46c0 .22.21.37.64.45q3 .56 3 3.37a4.88 4.88 0 0 1-1.24 3.22 6.82 6.82 0 0 1-3.45 2.07 13 13 0 0 1-3.6.47 10.94 10.94 0 0 1-4-.64q-1-.4-1-1.18a1.07 1.07 0 0 1 .35-.81 1.21 1.21 0 0 1 .86-.33 10.44 10.44 0 0 1 1.52.28 5.05 5.05 0 0 0 1.16.1 3.41 3.41 0 0 0 2.15-.62 1.91 1.91 0 0 0 .84-1.52 1.59 1.59 0 0 0-.65-1.31 2.63 2.63 0 0 0-1.67-.51 4 4 0 0 0-1.15.15 1.67 1.67 0 0 1-.44.09q-.29 0-.6-.59a2.51 2.51 0 0 1-.31-1.16.41.41 0 0 1 .15-.37 6.33 6.33 0 0 1 .93-.36 3.48 3.48 0 0 0 1.36-.9 1.54 1.54 0 0 0 .49-1.09 1.46 1.46 0 0 0-.51-1.11 1.73 1.73 0 0 0-1.21-.47 2.24 2.24 0 0 0-.72.1 9 9 0 0 0-1.1.53.88.88 0 0 1-.37.12q-.28 0-.53-.39a1.51 1.51 0 0 1-.25-.83q0-.76 1.35-1.44a8.67 8.67 0 0 1 2-.69 10.51 10.51 0 0 1 2.34-.25z"
                            fill="#f15a24"></path>
                        <path
                            d="M52.78 80.6h-7.65q-1 0-1-.57a.83.83 0 0 1 .21-.54q.21-.25 1.38-1.35a18.25 18.25 0 0 0 3.21-3.81 3.16 3.16 0 0 0 .54-1.55 1.22 1.22 0 0 0-.33-.89 1.17 1.17 0 0 0-.88-.33 1.74 1.74 0 0 0-.79.14 9.68 9.68 0 0 0-1.19.92 1 1 0 0 1-.65.2 1.4 1.4 0 0 1-1-.41 1.2 1.2 0 0 1-.44-.89 1.76 1.76 0 0 1 .4-1 5 5 0 0 1 1.07-1 9 9 0 0 1 5.38-1.74 7.25 7.25 0 0 1 3.72.86 3.08 3.08 0 0 1 1.47 2.58q0 2-2.72 4.27-1 .81-1 1.21a.65.65 0 0 0 .29.53 1.14 1.14 0 0 0 .71.22 2.44 2.44 0 0 0 1.76-.76 4.31 4.31 0 0 1 .52-.46.68.68 0 0 1 .35-.08q1 0 1 1.69a4.91 4.91 0 0 1-.32 1.71A4.75 4.75 0 0 1 56 81a1.69 1.69 0 0 1-1.28.67.77.77 0 0 1-.45-.12 1.65 1.65 0 0 1-.38-.44 1 1 0 0 0-.4-.4 2 2 0 0 0-.71-.11z"
                            fill="#ed1c24"></path>
                        <path
                            d="M51.78 79.6h-7.65q-1 0-1-.57a.83.83 0 0 1 .21-.54q.21-.25 1.38-1.35a18.25 18.25 0 0 0 3.21-3.81 3.16 3.16 0 0 0 .54-1.55 1.22 1.22 0 0 0-.33-.89 1.17 1.17 0 0 0-.88-.33 1.74 1.74 0 0 0-.79.14 9.68 9.68 0 0 0-1.19.92 1 1 0 0 1-.65.2 1.4 1.4 0 0 1-1-.41 1.2 1.2 0 0 1-.44-.89 1.76 1.76 0 0 1 .4-1 5 5 0 0 1 1.07-1 9 9 0 0 1 5.38-1.74 7.25 7.25 0 0 1 3.72.86 3.08 3.08 0 0 1 1.47 2.58q0 2-2.72 4.27-1 .81-1 1.21a.65.65 0 0 0 .29.53 1.14 1.14 0 0 0 .71.22 2.44 2.44 0 0 0 1.76-.76 4.31 4.31 0 0 1 .52-.46.68.68 0 0 1 .35-.08q1 0 1 1.69a4.91 4.91 0 0 1-.32 1.71A4.75 4.75 0 0 1 55 80a1.69 1.69 0 0 1-1.28.67.77.77 0 0 1-.45-.12 1.65 1.65 0 0 1-.38-.44 1 1 0 0 0-.4-.4 2 2 0 0 0-.71-.11z"
                            fill="#f15a24"></path>
                    </g>
                </g>
            </svg>
            <h2 class="text-lg font-bold">Leaderboard</h2>
            <p class="mt-9">Papan peringkat menunjukkan peringkat mahasiswa berdasarkan skor atau pencapaian
                tertentu.
                Papan peringkat dapat dilihat oleh semua mahasiswa yang terdaftar di kelas.</p>
        </div>
    </div>

    <!-- virtual trophy -->
    <div id="popupVirtual" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-80 w-80 bg-fuchsia-100">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                id="trophy" class="absolute -translate-x-1/2 -top-14 left-1/2 size-20">
                <path fill="#eda900"
                    d="M387 224.8h-13v-20h13c55.1 0 100-44.9 100-100V75H374V55h133v49.8C507 170.9 453.2 224.8 387 224.8zM125 224.8h13v-20h-13c-55.1 0-100-44.9-100-100V75h116V55H5v49.8C5 170.9 58.8 224.8 125 224.8z">
                </path>
                <rect width="326" height="110" x="93" y="397" fill="#1f3f77"></rect>
                <rect width="326" height="20.5" x="93" y="397" fill="#0a2751"></rect>
                <rect width="380" height="30" x="66" y="477" fill="#3179af"></rect>
                <rect width="295.7" height="30" x="66" y="477" fill="#68a1d6"></rect>
                <rect width="128" height="30" x="192" y="367" fill="#e36414"></rect>
                <rect width="91.5" height="30" x="192" y="367" fill="#f8961e"></rect>
                <path fill="#f8d707" d="M115,5v210.8c0,30.5,19.9,57.3,49,66.2h0c29.1,8.9,49,35.8,49,66.2V367h86v-18.8
                  c0-30.5,19.9-57.3,49-66.2h0c29.1-8.9,49-35.8,49-66.2V5H115z"></path>
                <rect width="380" height="10" x="66" y="392" fill="#3179af"></rect>
                <rect width="296" height="10" x="66" y="392" fill="#68a1d6"></rect>
                <rect width="200" height="10" x="156" y="432" fill="#f8d707"></rect>
                <path fill="#eda900"
                    d="M115,5v50h141.8c28.8,0,52.2,23.4,52.2,52.2v129.3c0,18.8-10.1,36.2-26.5,45.5h0
                  c-16.4,9.3-26.5,26.6-26.5,45.5V367h43v-18.8c0-30.5,19.9-57.3,49-66.2h0c29.1-8.9,49-35.8,49-66.2V5H115z"></path>
                <rect width="310" height="30" x="101" y="5" fill="#f8d707"></rect>
                <rect width="40.8" height="30" x="128" y="5" fill="#fffa5a"></rect>
                <rect width="65.8" height="30" x="207.5" y="5" fill="#fffa5a"></rect>
                <path fill="#fffa5a" d="M185,75L185,75c-21.7,0-39.3,17.6-39.3,39.3v32.3c0,21.7,17.6,39.3,39.3,39.3h0
                  c21.7,0,39.3-17.6,39.3-39.3v-32.3C224.3,92.6,206.7,75,185,75z"></path>
                <path fill="#f8d707" d="M56.3,75H5V55h51.3c5.5,0,10,4.5,10,10v0C66.3,70.5,61.9,75,56.3,75z"></path>
                <path fill="#f8d707"
                    d="M15,104.8L15,104.8c-5.5,0-10-4.5-10-10V55h20v39.8C25,100.3,20.5,104.8,15,104.8z"></path>
                <path fill="#f8961e" d="M266,215h-20v-90h-10v-20h20c5.5,0,10,4.5,10,10V215z"></path>
            </svg>

            <h2 class="text-lg font-bold">Virtual Trophy</h2>
            <p class="mt-9">Medali atau trofi virtual diberikan kepada mahasiswa sebagai bentuk penghargaan atas
                pencapaian tertentu. Pengguna dapat melihat medali atau trofi yang diperoleh pada profil, dan dapat
                membagikannya dengan pengguna lain.</p>
        </div>
    </div>

    <!-- final class project -->
    <div id="popupFinal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-80 w-80 bg-fuchsia-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                class="absolute -translate-x-1/2 -top-14 left-1/2 size-20" id="project-management">
                <rect width="11.469" height="3.25" x="10.188" y="25.906" fill="#58565d"></rect>
                <path fill="#58565d" d="M9.49989,26.5H1.5V9.5a2,2,0,0,1,2-2h25a2,2,0,0,1,2,2v17H23.5004"></path>
                <path fill="#4ebaea" d="M28.5,9.5v15H4a.5.5,0,0,1-.5-.5V10A.5.5,0,0,1,4,9.5Z"></path>
                <path fill="#8b8891"
                    d="M20.5,27.5h0a1,1,0,0,1-1,1h-7a1,1,0,0,1-1-1h0a1,1,0,0,0-1-1H.5v2a2,2,0,0,0,2,2h27a2,2,0,0,0,2-2v-2h-10A1,1,0,0,0,20.5,27.5Z">
                </path>
                <path fill="#fff" d="M21.5,15.5H7.5a1,1,0,0,1-1-1v-1a1,1,0,0,1,1-1h10Z"></path>
                <circle cx="24" cy="9" r="7.5" fill="#e5303e"></circle>
                <circle cx="24" cy="9" r="5.5" fill="#fff"></circle>
                <circle cx="24" cy="9" r="1" fill="#e5303e" transform="rotate(-37.84 24 9)"></circle>
                <path
                    d="M31.5,26H31V12.86438A7.99432,7.99432,0,1,0,16.26331,7H3.5A2.50294,2.50294,0,0,0,1,9.5V26H.5a.49971.49971,0,0,0-.5.5v2A2.50294,2.50294,0,0,0,2.5,31h27A2.50294,2.50294,0,0,0,32,28.5v-2A.49971.49971,0,0,0,31.5,26ZM24,2a6.99134,6.99134,0,0,1,4.1532,12.62177l-.00751.00562a6.97977,6.97977,0,0,1-10.29913-2.2926.47312.47312,0,0,0-.0354-.07318,6.9447,6.9447,0,0,1-.78491-2.7439c.00024-.00623.00354-.01141.00354-.0177,0-.0105-.00537-.01929-.006-.0296C17.01337,9.31421,17,9.15875,17,9A7.00786,7.00786,0,0,1,24,2ZM18.72626,15H7.5a.50034.50034,0,0,1-.5-.5v-1a.50034.50034,0,0,1,.5-.5h9.58246A8.04579,8.04579,0,0,0,18.72626,15ZM16.589,12H7.5A1.50164,1.50164,0,0,0,6,13.5v1A1.50164,1.50164,0,0,0,7.5,16H20.13562A7.94888,7.94888,0,0,0,28,15.91754V24H4V10H16.06946A7.93316,7.93316,0,0,0,16.589,12ZM2,9.5A1.50164,1.50164,0,0,1,3.5,8H16.06946A8.00884,8.00884,0,0,0,16,9H3.5a.49971.49971,0,0,0-.5.5v15a.49971.49971,0,0,0,.5.5h25a.49971.49971,0,0,0,.5-.5V15.235a8.06386,8.06386,0,0,0,1-.9613V26H21.5A1.50164,1.50164,0,0,0,20,27.5a.50034.50034,0,0,1-.5.5h-7a.50034.50034,0,0,1-.5-.5A1.50164,1.50164,0,0,0,10.5,26H2Zm29,19A1.50164,1.50164,0,0,1,29.5,30H2.5A1.50164,1.50164,0,0,1,1,28.5V27h9.5a.50034.50034,0,0,1,.5.5A1.50164,1.50164,0,0,0,12.5,29h7A1.50164,1.50164,0,0,0,21,27.5a.50034.50034,0,0,1,.5-.5H31ZM15.5,21h-9a.5.5,0,0,0,0,1h9a.5.5,0,0,0,0-1Zm8.313-10.51172a1.55554,1.55554,0,0,0,.18994.01172,1.49537,1.49537,0,0,0,1.4093-1H26.25a.5.5,0,0,0,0-1h-.84235A1.45249,1.45249,0,0,0,24.5,7.58771V6.25a.5.5,0,0,0-1,0V7.59314a1.496,1.496,0,0,0,.313,2.89514Zm-.11963-1.88281A.494.494,0,0,1,23.999,8.5a.56057.56057,0,0,1,.06348.00391.50082.50082,0,1,1-.36914.10156ZM6.5,19h11a.5.5,0,0,0,0-1H6.5a.5.5,0,0,0,0,1ZM24,15a6,6,0,1,0-6-6A6.00656,6.00656,0,0,0,24,15ZM24,4a5,5,0,1,1-5,5A5.00589,5.00589,0,0,1,24,4Z">
                </path>
            </svg>
            <h2 class="text-lg font-bold">Final Class Project</h2>
            <p class="mt-9">Mahasiswa harus mengerjakan sebuah proyek akhir/ tantangan, sesuai dengan yang diberikan
                oleh dosen pengampu kelas. Setelah berhasil mengerjakan proyek akhir kelas, maka mahasiswa akan
                diberikan badge.</p>
        </div>
    </div>

    <!-- badge -->
    <div id="popupBadge" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-6 rounded-lg h-80 w-80 bg-fuchsia-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" id="badge"
                class="absolute -translate-x-1/2 -top-10 left-1/2 size-20">
                <path fill="#431c10" fill-rule="evenodd"
                    d="M56.721,86.807l-18.476,32a2.057,2.057,0,0,1-3.815-.733h0l-2.2-14.978-14.07,5.58a2.053,2.053,0,0,1-2.512-2.975L33.977,73.943a2.055,2.055,0,0,1,3.236-.425v0a37.854,37.854,0,0,0,8.413,6.4,37.394,37.394,0,0,0,9.8,3.8,2.06,2.06,0,0,1,1.291,3.088M94,74.128l18.387,31.848a2.053,2.053,0,0,1-2.537,2.931h0l-14.07-5.58-2.2,14.978a2.06,2.06,0,0,1-3.871.642L71.132,86.782a2.059,2.059,0,0,1,1.321-3.037h0a37.375,37.375,0,0,0,9.82-3.767A37.807,37.807,0,0,0,90.7,73.6a2.057,2.057,0,0,1,3.3.526Z">
                </path>
                <path fill="#fcb912" fill-rule="evenodd"
                    d="M64,7.932A39.733,39.733,0,1,1,24.267,47.665,39.732,39.732,0,0,1,64,7.932"></path>
                <path fill="#f2a31e" fill-rule="evenodd"
                    d="M64,7.932c-.466,0-.928.019-1.391.035a39.721,39.721,0,0,1,0,79.395c.463.016.924.035,1.391.035A39.733,39.733,0,0,0,64,7.932Z">
                </path>
                <path fill="#f2a31e"
                    d="M85.994,27.493a28.528,28.528,0,1,0,8.355,20.171,28.438,28.438,0,0,0-8.355-20.171M65.823,15.014a32.651,32.651,0,1,1-23.087,9.563A32.549,32.549,0,0,1,65.823,15.014Z">
                </path>
                <path fill="#f2a31e"
                    d="M68.306,31.152l3.052,9.454,9.959-.019a2.6,2.6,0,0,1,1.523,4.7l0,.005-8.065,5.836,3.095,9.463a2.6,2.6,0,0,1-4.16,2.785L65.826,57.62,57.78,63.49a2.594,2.594,0,0,1-3.994-2.9l-.007,0,3.1-9.463L48.809,45.29a2.6,2.6,0,0,1,1.716-4.7l9.77.019,3.057-9.472a2.6,2.6,0,0,1,4.953.018">
                </path>
                <path fill="#fcf8cf"
                    d="M84.172,27.493a28.528,28.528,0,1,0,8.355,20.171,28.439,28.439,0,0,0-8.355-20.171M64,15.014a32.651,32.651,0,1,1-23.087,9.563A32.549,32.549,0,0,1,64,15.014Z">
                </path>
                <path fill="#fcf8cf"
                    d="M66.483,31.152l3.052,9.454,9.959-.019a2.6,2.6,0,0,1,1.523,4.7l0,.005-8.065,5.836,3.1,9.463a2.6,2.6,0,0,1-4.16,2.785L64,57.62l-8.047,5.87a2.594,2.594,0,0,1-3.994-2.9l-.007,0,3.1-9.463L46.986,45.29a2.6,2.6,0,0,1,1.716-4.7l9.77.019,3.057-9.472a2.6,2.6,0,0,1,4.953.018">
                </path>
            </svg>
            <h2 class="text-lg font-bold">Badge</h2>
            <p class="mt-9">Badge merupakan fasilitas yang diberikan kepada mahasiswa secara otomatis setelah mereka
                mencapai pencapaian tertentu, misalnya menyelesaikan kelas atau mendapatkan nilai tertinggi dalam
                latihan.</p>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="relative flex flex-col items-center justify-center p-8 bg-white rounded-lg shadow-xl w-96">
            <!-- Close button with improved hover effect -->
            <button id="closeLoginModal"
                class="absolute text-gray-400 transition-colors duration-200 top-4 right-4 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Title with decorative elements -->
            <h2 class="relative mb-8 text-2xl font-bold text-gray-800">
                Masuk Sebagai
                <div class="absolute bottom-0 left-0 w-1/4 h-1 transform -translate-x-1/2 bg-fuchsia-400"></div>
            </h2>

            <!-- Login options with improved buttons -->
            <div class="flex flex-col w-full gap-4">
                <a href="/teacher/login"
                    class="group relative overflow-hidden w-full px-6 py-3 text-center text-white transition-all duration-300 rounded-lg bg-fuchsia-500 hover:bg-fuchsia-600 transform hover:-translate-y-0.5">
                    <span class="relative z-10 text-lg font-medium">Dosen</span>
                    <div
                        class="absolute inset-0 w-full h-full transition-all duration-300 transform scale-x-0 bg-fuchsia-600 group-hover:scale-x-100">
                    </div>
                </a>

                <a href="/student/login"
                    class="group relative overflow-hidden w-full px-6 py-3 text-center text-white transition-all duration-300 rounded-lg bg-fuchsia-500 hover:bg-fuchsia-600 transform hover:-translate-y-0.5">
                    <span class="relative z-10 text-lg font-medium">Mahasiswa</span>
                    <div
                        class="absolute inset-0 w-full h-full transition-all duration-300 transform scale-x-0 bg-fuchsia-600 group-hover:scale-x-100">
                    </div>
                </a>
            </div>

            <!-- Decorative pattern -->
            <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-1/2 -translate-y-1/2 opacity-10">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FF0066"
                        d="M47.7,-61.1C62.3,-52.8,75.1,-37.7,79.2,-20.2C83.3,-2.7,78.8,17.2,68.9,32.8C59,48.3,43.7,59.5,27.1,65.2C10.5,70.9,-7.4,71.1,-23.6,65.6C-39.8,60.1,-54.3,48.9,-63.3,33.8C-72.3,18.7,-75.8,-0.3,-71.2,-16.9C-66.6,-33.5,-53.9,-47.7,-39.3,-56C-24.7,-64.3,-8.2,-66.8,4.9,-73.1C18,-79.3,33.1,-69.4,47.7,-61.1Z"
                        transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </div>

    <script>
        // Add this after your existing scripts
        const loginBtn = document.getElementById('loginBtn');
        const loginModal = document.getElementById('loginModal');
        const closeLoginModal = document.getElementById('closeLoginModal');

        loginBtn.addEventListener('click', () => {
            loginModal.classList.remove('hidden');
        });

        closeLoginModal.addEventListener('click', () => {
            loginModal.classList.add('hidden');
        });

        loginModal.addEventListener('click', (event) => {
            if (event.target === loginModal) {
                loginModal.classList.add('hidden');
            }
        });

        // Your existing scripts
        const carousel = document.getElementById('carousel');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentIndex = 0;

        // Fungsi untuk memperbarui posisi carousel
        function updateCarousel() {
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        // Event listener untuk tombol Next
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        });

        // Event listener untuk tombol Prev
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        });

        //autoplay
        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }, 5000);
    </script>
    <script>
        const metodeBtn = document.getElementById('metodeBtn');
        const penilaianBtn = document.getElementById('penilaianBtn');
        const metodeContent = document.getElementById('metodeContent');
        const penilaianContent = document.getElementById('penilaianContent');

        // mengaktifkan tab Metode
        function showMetode() {
            // Tampilkan konten Metode dan sembunyikan Penilaian
            metodeContent.classList.remove('hidden');
            penilaianContent.classList.add('hidden');

            // Ubah warna latar belakang tombol
            metodeBtn.classList.remove('bg-fuchsia-200');
            metodeBtn.classList.add('bg-fuchsia-400');

            penilaianBtn.classList.remove('bg-fuchsia-400');
            penilaianBtn.classList.add('bg-fuchsia-200');
        }

        // mengaktifkan tab Penilaian
        function showPenilaian() {
            // Tampilkan konten Penilaian dan sembunyikan Metode
            penilaianContent.classList.remove('hidden');
            metodeContent.classList.add('hidden');

            // Ubah warna latar belakang tombol
            penilaianBtn.classList.remove('bg-fuchsia-200');
            penilaianBtn.classList.add('bg-fuchsia-400');

            metodeBtn.classList.remove('bg-fuchsia-400');
            metodeBtn.classList.add('bg-fuchsia-200');
        }

        // Menambahkan event listener pada tombol
        metodeBtn.addEventListener('click', showMetode);
        penilaianBtn.addEventListener('click', showPenilaian);

        // Menampilkan tab Metode secara default saat halaman dimuat
        window.onload = showMetode;
    </script>
    <script>
        // scoring
        const clickableScoring = document.getElementById('clickableScoring');
        const popupScoring = document.getElementById('popupScoring');

        clickableScoring.addEventListener('click', () => {
            popupScoring.classList.remove('hidden');
        });
        popupScoring.addEventListener('click', (event) => {
            if (event.target === popupScoring) {
                popupScoring.classList.add('hidden');
            }
        });

        // certificate
        const clickableCertificate = document.getElementById('clickableCertificate');
        const popupCertificate = document.getElementById('popupCertificate');

        clickableCertificate.addEventListener('click', () => {
            popupCertificate.classList.remove('hidden');
        });

        popupCertificate.addEventListener('click', (event) => {
            if (event.target === popupCertificate) {
                popupCertificate.classList.add('hidden');
            }
        });

        // points
        const clickablePoints = document.getElementById('clickablePoints');
        const popupPoints = document.getElementById('popupPoints');

        clickablePoints.addEventListener('click', () => {
            popupPoints.classList.remove('hidden');
        });
        popupPoints.addEventListener('click', (event) => {
            if (event.target === popupPoints) {
                popupPoints.classList.add('hidden');
            }
        });

        // achievement
        const clickableAchievement = document.getElementById('clickableAchievement');
        const popupAchievement = document.getElementById('popupAchievement');

        clickableAchievement.addEventListener('click', () => {
            popupAchievement.classList.remove('hidden');
        });

        popupAchievement.addEventListener('click', (event) => {
            if (event.target === popupAchievement) {
                popupAchievement.classList.add('hidden');
            }
        });

        // leaderboard
        const clickableLeader = document.getElementById('clickableLeader');
        const popupLeader = document.getElementById('popupLeader');

        clickableLeader.addEventListener('click', () => {
            popupLeader.classList.remove('hidden');
        });

        popupLeader.addEventListener('click', (event) => {
            if (event.target === popupLeader) {
                popupLeader.classList.add('hidden');
            }
        });

        // virtual
        const clickableVirtual = document.getElementById('clickableVirtual');
        const popupVirtual = document.getElementById('popupVirtual');

        clickableVirtual.addEventListener('click', () => {
            popupVirtual.classList.remove('hidden');
        });

        popupVirtual.addEventListener('click', (event) => {
            if (event.target === popupVirtual) {
                popupVirtual.classList.add('hidden');
            }
        });

        // final
        const clickableFinal = document.getElementById('clickableFinal');
        const popupFinal = document.getElementById('popupFinal');
        clickableFinal.addEventListener('click', () => {
            popupFinal.classList.remove('hidden');
        });

        popupFinal.addEventListener('click', (event) => {
            if (event.target === popupFinal) {
                popupFinal.classList.add('hidden');
            }
        });

        // badge
        const clickableBadge = document.getElementById('clickableBadge');
        const popupBadge = document.getElementById('popupBadge');

        clickableBadge.addEventListener('click', () => {
            popupBadge.classList.remove('hidden');
        });

        popupBadge.addEventListener('click', (event) => {
            if (event.target === popupBadge) {
                popupBadge.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
