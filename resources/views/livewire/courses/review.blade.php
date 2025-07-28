<div>
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
    <h2 class="px-6 py-2 text-2xl font-semibold text-gray-800 dark:text-white">Review Details</h2>

    <livewire:reviews.avg-rate :courseID="$courseID" lazy />
    <livewire:reviews.polling :star_count="5" :courseID="$courseID" lazy />
    <livewire:reviews.polling :star_count="4" :courseID="$courseID" lazy />
    <livewire:reviews.polling :star_count="3" :courseID="$courseID" lazy />
    <livewire:reviews.polling :star_count="2" :courseID="$courseID" lazy />
    <livewire:reviews.polling :star_count="1" :courseID="$courseID" lazy />

    <livewire:reviews.comment-form :courseID="$courseID" />

    <div class="mt-4">
        <livewire:reviews.comment :courseID="$courseID" />
    </div>
</div>
