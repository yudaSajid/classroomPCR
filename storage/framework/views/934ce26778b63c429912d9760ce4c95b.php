    <script>
        document.addEventListener('alpine:init', () => {
            const setStudentSidebarState = () => {
                const path = window.location.pathname;
                const isStudentCoursePage = path.startsWith('/student/course-details/');

                const currentWidth = window.innerWidth;
                const isDesktopOrLarger = currentWidth >= 1024;

                if (window.Alpine && window.Alpine.store('sidebar')) {
                    if (isDesktopOrLarger) {
                        if (isStudentCoursePage) {
                            window.Alpine.store('sidebar').close();
                            console.log('Sidebar: CLOSED (Course page on Desktop/Laptop)');
                        } else {
                            window.Alpine.store('sidebar').open();
                            console.log('Sidebar: OPEN (Non-course page on Desktop/Laptop)');
                        }
                    } else {
                        window.Alpine.store('sidebar').close();
                        console.log('Sidebar: CLOSED (Mobile/Tablet)');
                    }
                } else {
                    console.warn('Alpine or Filament sidebar store not ready yet!');
                }
            };

            setStudentSidebarState();
            document.addEventListener('livewire:navigated', setStudentSidebarState);
            window.addEventListener('resize', setStudentSidebarState);
        });

        // --- START: Livewire Listeners untuk quiz dari MaterialInfo ---
        document.addEventListener('livewire:initialized', () => {
            // Listener untuk event dari TakeQuiz component
            Livewire.on('quizCompleted', (event) => {
                // Panggil loadContent di MaterialInfo untuk re-calculate attempts
                Livewire.getByName('courses.material-info').forEach(component => {
                     component.call('loadContent', null, event.detail.quizId, null, event.detail.isPassed); // Teruskan isPassed
                });
            });

            Livewire.on('quizRetakeStarted', (event) => {
                Livewire.getByName('courses.material-info').forEach(component => {
                    component.call('loadContent', null, event.detail.quizId, null);
                });
            });
        });
        // --- END: Livewire Listeners ---

    </script><?php /**PATH D:\Coding\plisBisa\storage\framework\views/3b134f053458135dc8009051ae98783f.blade.php ENDPATH**/ ?>