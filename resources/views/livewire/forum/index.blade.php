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
    <livewire:posts.create-post :courseID="$courseID" lazy />

    <div class="mt-4">
        <livewire:posts.list-post :courseID="$courseID" lazy />
    </div>
</div>
