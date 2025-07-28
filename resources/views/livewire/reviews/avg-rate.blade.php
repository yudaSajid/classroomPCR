<div class="flex items-center px-6 py-2">
    <!-- Menampilkan angka rata-rata rating -->
    <div class="text-4xl font-bold">{{ number_format($averageRating, 1) }}</div>
    <div class="flex flex-col ml-2">

        <!-- Menampilkan bintang sesuai rating -->
        <div class="flex">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($averageRating))
                    <!-- Bintang penuh -->
                    <svg class="w-6 h-6 text-fuchsia-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.513L24 9.753l-6 5.852 1.42 8.284L12 18.126l-7.42 5.763L6 15.605 0 9.753l8.332-1.653L12 .587z"/>
                    </svg>
                @elseif ($i - $averageRating < 1)
                    <!-- Bintang setengah -->
                    <svg class="w-6 h-6 text-fuchsia-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.513L24 9.753l-6 5.852 1.42 8.284L12 18.126l-7.42 5.763L6 15.605 0 9.753l8.332-1.653L12 .587z"/>
                        <path d="M12 .587l3.668 7.513L24 9.753l-6 5.852 1.42 8.284L12 18.126l-7.42 5.763L6 15.605 0 9.753l8.332-1.653L12 .587z" fill="#fff"/>
                    </svg>

                @else
                    <!-- Bintang kosong -->
                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.513L24 9.753l-6 5.852 1.42 8.284L12 18.126l-7.42 5.763L6 15.605 0 9.753l8.332-1.653L12 .587z"/>
                    </svg>
                @endif
            @endfor
        </div>
        <!-- Menampilkan total rating -->
        <div class="text-sm text-gray-500">
            based on {{ number_format($totalRatings) }} ratings
        </div>
    </div>

</div>
