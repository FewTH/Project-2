<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WheelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RewardController;

Route::get('/', function () {
    return view('welcome');
});

// ส่วนของ Admin 
Route::prefix('admin')->group(function () {
    
    // Dashboard & Profile
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Route::get('/edituser', function () {
    //     return view('admin.edituser');
    // });

    Route::get('/profile', [ProfileController::class, 'adminProfile']);
    Route::post('/profile', [ProfileController::class, 'uploadimg']);

    Route::get('/edit_information', [ProfileController::class, 'adminEditForm']); 
    Route::post('/edit_information', [ProfileController::class, 'editinformation']);

    Route::get('/change_password', [ProfileController::class, 'adminchangePassword']); 
    Route::post('/change_password', [ProfileController::class, 'changePassword']);

    // ระบบจัดการผู้ใช้งาน UserController
    Route::get('/manageuser', [UserController::class, 'index'])->name('admin.manageuser');  // เม็ดตอดนี้ก็ประมาณว่า แสดงหน้าจัดการผู้ใช้เลยใช้เม็ดตอด get
    Route::get('/adduser', [UserController::class, 'create'])->name('admin.adduser'); // อันนี้ก็แสดงฟอร์มเพิ่มผู้ใช้
    Route::post('/manageuser/store', [UserController::class, 'store'])->name('admin.user.store'); // อันนี้จะเป็นการบันทึกข้อมูลลงดาต้าเบสบน myadmin เลยใช้ post และ store
    Route::delete('/manageuser/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy'); // อันนี้ก็ตรงตัวคือลบผู้ใช้
    Route::get('/manageuser/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit'); // อันนี้คือแสดงแบบฟอร์มแก้ไขผู้ใช้
    Route::put('/manageuser/{id}', [UserController::class, 'update'])->name('admin.user.update'); // อันนี้คือการที่ เราบันทึกข้อมูลใหม่ที่แก้ไขทับข้อมูลเก่าเลยใช้ เม็ดตอดput

    // ระบบจัดการของรางวัล
    Route::get('/addreward', [RewardController::class, 'create'])->name('admin.addreward'); // อันนี้แสดงฟอร์มเพิ่มรางวัล
    Route::post('/addreward', [RewardController::class, 'store'])->name('admin.reward.store');
    Route::get('/managereward', [RewardController::class, 'index'])->name('admin.managereward');
    Route::delete('/managereward/{id}', [RewardController::class, 'destroy'])->name('admin.reward.destroy');
    Route::get('/managereward/{id}/edit', [RewardController::class, 'edit'])->name('admin.reward.edit'); 
    Route::put('/managereward/{id}', [RewardController::class, 'update'])->name('admin.reward.update'); 
    // Route::get('/edituser', function () {
    //     return view('admin.edituser');
    // });

    // ระบบจัดการกิจกรรม
    Route::get('/assessment', function () {
        return view('admin.assessment');
    });

    Route::get('/create_activity', function () {
        return view('admin.create_activity');
    });

    // Route::get('/managereward', function () {
    //     return view('admin.managereward');
    // });

    // Route::get('/addreward', function () {
    //     return view('admin.addreward');
    // });

    Route::get('/view_details', function () {
        return view('admin.view_details');
    });

    Route::get('/managespin', [WheelController::class, 'index']);

    Route::get('/spinwhell', function () {
        return view('admin.spinwhell');
    });

    Route::get('/history_random', function () {
        return view('admin.history_random');
    });

     Route::get('/edit_activity', function () {
        return view('admin.edit_activity');
    });

     Route::get('/random_reward', function () {
        return view('admin.random_reward');
    });
});

// ส่วนของ User (ผู้ใช้งานทั่วไป)
Route::prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'userProfile']); 
    Route::post('/profile', [ProfileController::class, 'uploadimg']);

    Route::get('/contact', function () {
        return view('user.contact');
    });

    Route::get('/edit_information', [ProfileController::class, 'userEditForm']);
    Route::post('/edit_information', [ProfileController::class, 'editinformation']);

    Route::get('/change_password', [ProfileController::class, 'userchangePassword']);
    Route::post('/change_password', [ProfileController::class, 'changePassword']);

    Route::get('/home', function () {
        return view('user.home');
    });

    Route::get('/spin', function () {
        return view('user.spin');
    });

    Route::get('/loginuser', function () {
        return view('user.loginuser');
    });
});


//ส่วนของ manager (ผู้จัดการวงล้อสุ่ม)
Route::prefix('manager')->group(function () {
    Route::get('/profile', [ProfileController::class, 'managerProfile']);
    Route::post('/profile', [ProfileController::class, 'uploadimg']);

    Route::get('/edit_information', [ProfileController::class, 'managerEditForm']); 
    Route::post('/edit_information', [ProfileController::class, 'editinformation']);

    Route::get('/change_password', [ProfileController::class, 'managerchangePassword']); 
    Route::post('/change_password', [ProfileController::class, 'changePassword']);
});
