<div class="flex justify-start items-center content-center flex-row px-6 py-2">
    <div class="basis-1/6">
        <div class="flex items-center">
           
            @for ($i = 0; $i < $star_count; $i++) <svg class="w-4 h-4 text-fuchsia-500 ms-1" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                @endfor
                @for ($i = 0; $i < 5 - $star_count; $i++)
                <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
            @endfor
            <p class="text-slate-500 text-sm ml-2">{{round($percentage,1)}}%</p>

        </div>
    </div>
    <div class="basis-5/6">
        <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
            <div class="bg-fuchsia-600 h-2 rounded-full" style="width: {{$percentage}}%"></div>
        </div>
    </div>
</div>