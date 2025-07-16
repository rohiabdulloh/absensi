<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\App\DashboardPage;

use App\Livewire\Pages\User\UserProfile;
use App\Livewire\Pages\User\UserPage;
use App\Livewire\Pages\Setting\SettingPage;
use App\Livewire\Pages\Setting\LogoPage;

use App\Livewire\Pages\Student\StudentPage;
use App\Livewire\Pages\Student\StudentClassPage;
use App\Livewire\Pages\Classroom\ClassroomPage;
use App\Livewire\Pages\Period\PeriodPage;
use App\Livewire\Pages\Teacher\TeacherPage;
use App\Livewire\Pages\Teacher\TeacherClassPage;

use App\Livewire\Fronts\ReportPage;
use App\Livewire\Fronts\LeavePage;

Route::group(['middleware'=>'auth'], function(){     
    Route::get('/', DashboardPage::class)->name('home');
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/profil', UserProfile::class)->name('profile');
});


Route::middleware(['auth','role:siswa'])->prefix('/siswa')->group(function(){    
   
});

Route::middleware(['auth','role:superadmin'])->prefix('/admin')->group(function(){    
    Route::get('/user', UserPage::class)->name('user');
    Route::get('/siswa', StudentPage::class)->name('student');
    Route::get('/siswa_kelas', StudentClassPage::class)->name('student_class');
    Route::get('/kelas', ClassroomPage::class)->name('classroom');
    Route::get('/tahun-ajaran', PeriodPage::class)->name('period');
    Route::get('/guru', TeacherPage::class)->name('teacher');
    Route::get('/wali_kelas', TeacherClassPage::class)->name('teacher_class');
    Route::get('/logo', LogoPage::class)->name('logo');
    Route::get('/pengaturan', SettingPage::class)->name('setting');
});


Route::middleware(['auth','role:kepsek'])->prefix('/kepsek')->group(function(){    
    //
});

Route::middleware(['auth','role:kesiswaan'])->prefix('/kesiswaan')->group(function(){    
    //
});

Route::middleware(['auth','role:bk'])->prefix('/bk')->group(function(){    
    //
});

Route::middleware(['auth','role:guru'])->prefix('/guru')->group(function(){    
    //
});

Route::middleware(['auth','role:siswa'])->prefix('/siswa')->group(function(){        
    Route::get('/rekap', ReportPage::class)->name('student.report');
    Route::get('/ijin', LeavePage::class)->name('student.leave');
});


require __DIR__.'/auth.php';
