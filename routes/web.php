<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\App\DashboardPage;

use App\Livewire\Pages\User\UserProfile;
use App\Livewire\Pages\User\UserPage;

use App\Livewire\Pages\Setting\SettingPage;
use App\Livewire\Pages\Setting\LogoPage;
use App\Livewire\Pages\Classroom\ClassroomPage;
use App\Livewire\Pages\Period\PeriodPage;

use App\Livewire\Pages\Student\StudentPage;
use App\Livewire\Pages\Student\StudentClassPage;

use App\Livewire\Pages\Teacher\TeacherPage;
use App\Livewire\Pages\Teacher\TeacherClassPage;

use App\Livewire\Pages\Attendance\AttendancePage;
use App\Livewire\Pages\Attendance\AbsentPage;
use App\Livewire\Pages\Attendance\LeavePage;

use App\Livewire\Pages\Report\ReportPresentPage;
use App\Livewire\Pages\Report\ReportPresentStudentPage;
use App\Livewire\Pages\Report\ReportAbsentPage;
use App\Livewire\Pages\Report\ReportLatePage;
use App\Livewire\Pages\Report\ReportRecapPage;

use App\Livewire\Fronts\ReportPage;
use App\Livewire\Fronts\FrontLeavePage;

use App\Livewire\Teachers\StudentAttendance;
use App\Livewire\Teachers\ReportAttendance;

Route::group(['middleware'=>'auth'], function(){     
    Route::get('/', DashboardPage::class)->name('home');
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/profil', UserProfile::class)->name('profile');
});

Route::middleware(['auth','role:superadmin'])->prefix('/admin')->group(function(){    
    Route::get('/user', UserPage::class)->name('user');
    Route::get('/kelas', ClassroomPage::class)->name('classroom');
    Route::get('/tahun-ajaran', PeriodPage::class)->name('period');
    Route::get('/logo', LogoPage::class)->name('logo');
    Route::get('/pengaturan', SettingPage::class)->name('setting');

    Route::get('/siswa', StudentPage::class)->name('student');
    Route::get('/siswa_kelas', StudentClassPage::class)->name('student_class');

    Route::get('/guru', TeacherPage::class)->name('teacher');
    Route::get('/wali_kelas', TeacherClassPage::class)->name('teacher_class');

    Route::get('/presensi', AttendancePage::class)->name('attendance');
    Route::get('/presensi/absen', AbsentPage::class)->name('absent');
    Route::get('/presensi/izin', LeavePage::class)->name('leave');

     
    Route::get('/laporan/presensi', ReportPresentPage::class)->name('report.present'); 
    Route::get('/laporan/presensi_siswa', ReportPresentStudentPage::class)->name('report.present_student'); 
    Route::get('/laporan/siswa_absen', ReportAbsentPage::class)->name('report.absent'); 
    Route::get('/laporan/siswa_terlambat', ReportLatePage::class)->name('report.late'); 
    Route::get('/laporan/rekap_presensi', ReportRecapPage::class)->name('report.recap'); 
});

Route::middleware(['auth','role:guru'])->prefix('/guru')->group(function(){    
    
    Route::get('/presensi', StudentAttendance::class)->name('teacher.attendance');
    Route::get('/rekap', ReportAttendance::class)->name('teacher.report');
});

Route::middleware(['auth','role:siswa'])->prefix('/siswa')->group(function(){        
    Route::get('/rekap', ReportPage::class)->name('student.report');
    Route::get('/izin', FrontLeavePage::class)->name('student.leave');
});


require __DIR__.'/auth.php';
