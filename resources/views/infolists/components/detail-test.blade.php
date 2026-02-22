<div {{ $attributes }} class="w-full h-full ">
    {{ $getChildComponentContainer() }}
    <style type="text/css">
        /* Pastikan elemen-elemen ul, ol, dan li memiliki padding dan margin yang benar */
        .rich-content ul,
        .rich-content ol {
            padding-left: 1.5rem;
            /* Adjust as needed */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .rich-content li {
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }

        /* Optionally, you can customize the appearance of the list markers */
        .rich-content ul {
            list-style-type: disc;
            /* or circle, square, etc. */
        }

        .rich-content ol {
            list-style-type: decimal;
            /* or lower-alpha, upper-roman, etc. */
        }
    </style>
    <div class="flex items-center p-6 overflow-hidden bg-white rounded dark:bg-gray-800">
        <img class="object-contain w-48 h-48 rounded" src="{{ asset('storage/' . $getRecord()->course_photo) }}"
            alt="Class Image">
        <div class="flex-grow ml-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white"> {{ $getRecord()->course_name }}</h2>
            <p class="mt-1 text-gray-600 dark:text-white">Last Progress:</p>
            <div class="flex items-center p-4 mt-2 bg-gray-100 rounded dark:bg-gray-600">
                @php
                    $totalMaterialsCompleted = $getRecord()->getTotalMaterialsCompletedByUser(Auth::user()->id);
                    $lastCompleted = $getRecord()->getLastCompletedMaterialByUser(Auth::user()->id);
                @endphp
                <span
                    class=" text-gray-800 text-sm font-medium px-2 py-0.5 rounded dark:text-white">{{ $lastCompleted }}</span>
                <span
                    class="ml-3 text-sm text-gray-600 dark:text-white">{{ $totalMaterialsCompleted }}/{{ $getRecord()->total_materials }}
                    materials</span>
                {{-- <button
                    class="px-4 py-2 ml-auto text-sm font-semibold text-white transition duration-300 rounded-lg bg-fuchsia-600 hover:bg-fuchsia-700">Start
                    Learning</button> --}}
            </div>
            <div class="float-right py-4">
                @if ($totalMaterialsCompleted == $getRecord()->total_materials)
                {{-- <button
                    class="px-4 py-2 text-sm font-semibold transition duration-300 bg-white border rounded-lg text-fuchsia-500 hover:bg-fuchsia-100">Project</button> --}}
                    <x-custom-alert class="mt-4 mb-2" type="info" message="Pastikan anda telah mengisi data pendidikan pada Informations !"
                    class="mt-4" />
                    <a href="{{ route('certificate.download', $getRecord()) }}"
                    class="px-4 py-2 mt-4 float-right text-sm font-semibold text-white transition duration-300 rounded-lg bg-fuchsia-600 hover:bg-fuchsia-700">
                    <i class="fas fa-file-download"></i> Download Certificate
                </a>
                @else
                    <x-custom-alert type="info" message="Selesaikan modul untuk mendownload certificate"
                        class="mt-4" />
                @endif
            </div>
        </div>

    </div>
    <div class="items-center max-w-full p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-fuchsia-500">About this Course</h2>
        <hr class="my-4 border-t-2 border-gray-300" />
        <article class="text-gray-700 rich-content dark:text-white">{!! $getRecord()->course_description !!}</article>
    </div>

</div>
