<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\SettingPage;

use App\Livewire\Pages\User\UserProfile;
use App\Livewire\Pages\User\UserPage;

use App\Livewire\Pages\Student\StudentPage;
use App\Livewire\Pages\Classroom\ClassroomPage;

Route::group(['middleware'=>'auth'], function(){     
    Route::get('/', DashboardPage::class)->name('home');
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/profil', UserProfile::class)->name('profile');
    Route::get('/logo', SettingPage::class)->name('logo');
});


Route::middleware(['auth','role:superadmin'])->prefix('/admin')->group(function(){    
    Route::get('/user', UserPage::class)->name('user');
    Route::get('/student', StudentPage::class)->name('student');
    Route::get('/classroom', ClassroomPage::class)->name('classroom');
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
    //
});


require __DIR__.'/auth.php';
