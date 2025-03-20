<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Middleware\CheckIsAdmin;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('main-page');
    Route::get('/courses', 'courses')->name('courses-page');
    Route::get('/category/{id}', 'category')->name('category-page');
    Route::get('/category-middle/{id}', 'category_middle')->name('category-middle-page');
    Route::get('/login', 'login')->name('login-page');
    Route::get('/attendance/{id}/{sheduleId}', 'attendance')->name('attendance-page');
    Route::get('/add-task/{id}', 'add_task')->name('task-add-page');
    Route::get('/sign-up', 'sign_up')->name('sign-up-page');
    Route::get('/forgot-pass', 'forgot_pass')->name('forgot-pass-page');
    Route::get('/teachers', 'teachers')->name('teachers-page');
    Route::get('/course/{id}', 'course')->name('course-page');
    Route::get('/task/{id}', 'task')->name('task-page');
    Route::get('/categories', 'categories')->name('categories-page');
    Route::get('/schedules/{id}', 'schedules')->name('schedules-page');
    Route::get('/schedules-add/{id}', 'schedule_add')->name('schedule-add-page');
    Route::get('/teacher/{id}', 'teacher')->name('teacher-page');
    Route::get('/profile', 'profile')->middleware('auth')->name('profile-page');
    Route::get('/reset-password',  'reset')->middleware('guest')->name('password.reset');
    Route::get('/profile', 'profile')->name('profile-page');
    Route::get('/edit-profile',  'edit')->middleware('auth')->name('edit-profile');
    Route::get('/all-users',  'all_users')->middleware('auth')->name('all-users-page');
    Route::get('/profile-user/{id}',  'profile_user')->middleware('auth')->name('profile-user-page');
    Route::get('/add-global-category',  'add_global_category')->middleware('auth')->name('add-global-category-page');
    Route::get('/add-sub-category',  'add_sub_category')->middleware('auth')->name('add-sub-category-page');
    Route::get('/add-course',  'add_course')->middleware('auth')->name('add-course-page');
    Route::get('/edit-course/{id}',  'edit_course')->middleware('auth')->name('edit-course-page');
});


Route::controller(UserController::class)->group(function () {
    Route::post('/registration',  'registration')->middleware('guest')->name('reg');
    Route::post('/edit-profile',  'edit')->middleware(['auth', 'verified'])->name('edit');
    Route::get('/logout',  'logout')->middleware('auth')->name('logout');
    Route::post('/authorization',  'authorization')->middleware('guest')->name('auth');
    Route::post('/forgot-password',  'password')->middleware('guest')->name('password');
    Route::post('/reset-password',  'reset')->middleware('guest')->name('password.update');
    Route::delete('/user-delete/{id}',  'user_delete')->middleware('auth')->name('delete-user');
});

Route::controller(CourseController::class)->group(function () {
    Route::post('/add-global-category',  'add_global_category')->name('add-global-category');
    Route::post('/add-sub-category',  'add_sub_category')->name('add-sub-category');
    Route::delete('/delete-global-category/{id}',  'delete_global_category')->name('delete-global-category');
    Route::delete('/delete-sub-category/{id}',  'delete_sub_category')->name('delete-sub-category');
    Route::post('/buy-course/{id}', 'buyCourse')->name('buy-course');
    Route::post('/add-student/{id}/{studentId}',  'add_student')->name('add-student');
    Route::post('/add-task/{id}',  'add_task')->name('add-task');
    Route::post('/add-course',  'add_course')->name('add-course');
    Route::post('/add-schedule/{id}',  'add_schedule')->name('add-schedule');
    Route::post('/edit-course/{id}',  'edit_course')->name('edit-course');
    Route::delete('/delete-course/{id}',  'delete_course')->name('delete-course');
    Route::delete('/delete-schedule/{id}',  'delete_schedule')->name('delete-schedule');
    Route::post('/answers', 'store')->name('answer.store');
    Route::post('/grade/store', 'store_mark')->name('grade.store');

});
