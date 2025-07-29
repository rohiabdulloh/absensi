@forelse ($absentStudents as $student)
    <div class="mb-3 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition duration-200 border border-gray-100">
        <div class="flex items-center space-x-4">
            <!-- Avatar (Inisial Nama) -->
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl">
                {{ strtoupper(substr($student->student_name, 0, 1)) }}
            </div>

            <!-- Info Siswa -->
            <div class="flex-1">
                <p class="text-lg font-semibold text-gray-800">{{ $student->student_name }}</p>
                <span class="inline-block mt-1 text-xs px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full">
                    {{ $student->class_name }}
                </span>
            </div>

            <!-- Status Absen -->
           <div>
                @php
                    $status = $student->attendance_status;
                    $statusLabel = [
                        'A' => 'Alfa',
                        'I' => 'Izin',
                        'S' => 'Sakit',
                    ][$status] ?? 'A';

                    $statusColor = [
                        'A' => 'text-red-500',
                        'I' => 'text-purple-500',
                        'S' => 'text-blue-500',
                    ][$status] ?? 'text-red-500';
                @endphp

                <span class="text-sm font-bold {{ $statusColor }}">
                    {{ $statusLabel }}
                </span>
            </div>
        </div>
    </div>
@empty
    <div class="text-center text-gray-400 mt-10 italic">
        Belum ada siswa absen. Cek di halaman Data Siswa Absen atau Data Pengajuan Ijin untuk memproses siswa yang belum melakukan presensi.
    </div>
@endforelse
