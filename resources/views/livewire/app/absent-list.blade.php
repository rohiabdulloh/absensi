@forelse ($absentStudents as $student)
    <div class="mb-4 p-4 bg-white rounded-md shadow-md hover:shadow-lg transition duration-200">
        <div class="flex flex-row items-center justify-between">
            <p class="text-lg font-semibold text-gray-800">{{ $student->student_name }}</p>
            <p class="text-sm text-gray-500">{{ $student->class_name }}</p>
        </div>
    </div>
@empty
    <div class="text-center text-gray-500 mt-10">
        Semua siswa hadir hari ini.
    </div>
@endforelse