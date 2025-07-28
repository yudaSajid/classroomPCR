<div>
    @foreach ($assignments as $courseData)
        <h2 class="mt-4 mb-2 text-lg font-semibold">{{ $courseData['course_name'] }}</h2> <!-- Tampilkan nama course -->
        <table class="min-w-full mb-4 rounded table-auto">
            <thead>
                <tr class="text-white bg-rose-500">
                    <th class="px-4 py-2 text-sm font-medium">No</th>
                    <th class="px-4 py-2 text-sm">Name</th>
                    @foreach($courseData['assignments'] as $index => $assignment)
                        <th class="px-4 py-2 text-sm font-medium text-center">Assignment {{ $index + 1 }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                    <tr class="text-center">
                        <td class="px-4 py-2 text-sm font-light border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm font-light border">{{ $student->name }}</td>

                        @foreach($courseData['assignments'] as $assignment)
                        @php
                            // Cari status assignment dari user
                            $status = $student->userAssignmentStatuses->where('assignment_id', $assignment->id)->first();
                        @endphp

                        <td class="px-4 py-2 text-center border">
                            @if ($status && $status->is_completed == 1)
                            <svg class="w-4 h-4 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed321" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                            @else
                                <span class="block w-4 h-4 mx-auto bg-gray-400 rounded"></span>
                            @endif
                        </td>
                    @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 2 + count($courseData['assignments']) }}" class="py-4 text-center">Tidak ada siswa di kelas ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</div>
