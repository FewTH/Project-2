<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ส่วนของ admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/assessment', function () {
    return view('admin.assessment');
});

Route::get('/admin/profile', function () {
    return view('admin.profile');
});

Route::get('/admin/edit_information', function () {
    return view('admin.edit_information');
});

Route::get('/admin/change_password', function () {
    return view('admin.change_password');
});

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

Route::get('/admin/managespin', function () {
    return view('admin.managespin');
});

Route::get('/admin/spinwhell', function () {
    return view('admin.spinwhell');
});

Route::get('/admin/history_random', function () {
    return view('admin.history_random');
});



// ส่วนของ user
Route::get('/user/profile', function () {
    return view('user.profile');
});

Route::get('/user/contact', function () {
    return view('user.contact');
});

Route::get('/user/edit_information', function () {
    return view('user.edit_information');
});

Route::get('/user/change_password', function () {
    return view('user.change_password');
});


Route::get('/user/home', function () {
    return view('user.home');
});

Route::get('/user/spin', function () {
    return view('user.spin');
});
Route::get('/user/loginuser', function () {
    return view('user.loginuser');
});