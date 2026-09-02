<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WheelController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// ส่วนของ admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


// อันนี้เป็นของหน้าเพิ่มผู้ใช้
use App\Http\Controllers\UserController;
// Route สำหรับรับข้อมูลจากฟอร์มเพิ่มผู้ใช้งาน
Route::post('/admin/manageuser/store', [UserController::class, 'store'])->name('users.store');
// แสดงหน้าฟอร์มเพิ่มผู้ใช้
Route::get('/adduser', [UserController::class, 'create'])->name('admin.adduser');
// รับข้อมูลมาบันทึกลงดาต้าเบส
Route::post('/manageuser/store', [UserController::class, 'store'])->name('admin.user.store');
// ฟังก์ชันที่ลบผู้ใช้งาน 
Route::delete('/deleteuser/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');



Route::get('/admin/adduser', function () {
    return view('admin.adduser');
});

Route::get('/admin/assessment', function () {
    return view('admin.assessment');
});

Route::get('/admin/profile', [ProfileController::class, 'adminProfile']);
Route::post('/admin/profile', [ProfileController::class, 'uploadimg']);

Route::get('/admin/edit_information', [ProfileController::class, 'adminEditForm']); 
Route::post('/admin/edit_information', [ProfileController::class, 'editinformation']);

Route::get('/admin/change_password', [ProfileController::class, 'adminchangePassword']); 
Route::post('/admin/change_password', [ProfileController::class, 'changePassword']);

Route::get('/admin/create_activity', function () {
    return view('admin.create_activity');
});

Route::get('/admin/managereward', function () {
    return view('admin.managereward');
});

Route::get('/admin/addreward', function () {
    return view('admin.addreward');
});

Route::get('/admin/manageuser', function () {
    return view('admin.manageuser');
});

Route::get('/admin/edituser', function () {
    return view('admin.edituser');
});

Route::get('/admin/view_details', function () {
    return view('admin.view_details');
});


// Route::get('/admin/managespin', function () {
//     return view('admin.managespin');
// });

Route::get('/admin/managespin', [WheelController::class, 'index']);

Route::get('/admin/spinwhell', function () {
    return view('admin.spinwhell');
});

Route::get('/admin/history_random', function () {
    return view('admin.history_random');
});



// ส่วนของ user
Route::get('/user/profile', [ProfileController::class, 'userProfile']); 
Route::post('/user/profile', [ProfileController::class, 'uploadimg']);

Route::get('/user/contact', function () {
    return view('user.contact');
});

Route::get('/user/edit_information', [ProfileController::class, 'userEditForm']);
Route::post('/user/edit_information', [ProfileController::class, 'editinformation']);


Route::get('/user/change_password', [ProfileController::class, 'userchangePassword']);
Route::post('/user/change_password', [ProfileController::class, 'changePassword']);



Route::get('/user/home', function () {
    return view('user.home');
});

Route::get('/user/spin', function () {
    return view('user.spin');
});
Route::get('/user/loginuser', function () {
    return view('user.loginuser');
});