<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['prefix' => 'pages'], function () {

        // Admin routes
    
        Route::get('/', function () {
            return view('pages/admin/dashboard');
        })->name('pages');
    
        Route::group(['prefix' => 'admin'], function () {
            Route::get('users', 'Admin\UserController@index');
            Route::get('users/create', 'Admin\UserController@create');
            Route::get('users/{id}/edit', 'Admin\UserController@edit');
            Route::get('users/{id}/show', 'Admin\UserController@show');
            // Add other admin routes here
    
            // School routes
            Route::get('school', 'Admin\SchoolController@index');
            Route::get('school/create', 'Admin\SchoolController@create');
            Route::get('school/switch', 'Admin\SchoolController@switch');
    
            // Session routes
            Route::get('school/session', 'Admin\SessionController@index');
            Route::get('school/session/create', 'Admin\SessionController@create');
            Route::get('school/session/switch', 'Admin\SessionController@switch');
    
            //class routes
            Route::get('school/session/class', 'Admin\ClassController@index');
            Route::get('school/session/class/create', 'Admin\ClassController@create');
            Route::get('school/session/class/edit', 'Admin\ClassController@edit');
            
            //subject routes
            Route::get('school/session/subject', 'Admin\SubjectController@index');
            Route::get('school/session/subject/create', 'Admin\SubjectController@create');
            Route::get('school/session/subject/edit', 'Admin\SubjectController@edit');
    
            //exam routes
            Route::get('school/session/exam', 'Admin\ExamController@index');
            Route::get('school/session/exam/create', 'Admin\ExamController@create');
            Route::get('school/session/exam/edit', 'Admin\ExamController@edit');
            
            //result routes
            Route::get('school/session/result', 'Admin\ResultController@index');
            Route::get('school/session/result/create', 'Admin\ResultController@create');
            Route::get('school/session/result/edit', 'Admin\ResultController@edit');
            
            //notice routes
            Route::get('school/session/notice', 'Admin\NoticeController@index');
            Route::get('school/session/notice/create', 'Admin\NoticeController@create');
            Route::get('school/session/notice/edit', 'Admin\NoticeController@edit');
    
        });
    
        // Student routes
        Route::group(['prefix' => 'student'], function () {
            Route::get('profile', 'StudentController@profile');
            Route::get('results', 'StudentController@results');
            Route::get('timetable', 'StudentController@timetable');
            Route::get('messages', 'StudentController@messages');
            Route::get('profile/show', 'StudentController@showProfile');
            // Add other student routes here
        });
    
        // Parent routes
        Route::group(['prefix' => 'parent'], function () {
            Route::get('profile', 'ParentController@profile');
            Route::get('results', 'ParentController@results');
            Route::get('timetable', 'ParentController@timetable');
            Route::get('messages', 'ParentController@messages');
            Route::get('profile/show', 'ParentController@showProfile');
            // Add other parent routes here
        });
    
        // Teacher routes
        Route::group(['prefix' => 'teacher'], function () {
            Route::get('profile', 'TeacherController@profile');
            Route::get('results', 'TeacherController@results');
            Route::get('timetable', 'TeacherController@timetable');
            Route::get('messages', 'TeacherController@messages');
            Route::get('profile/show', 'TeacherController@showProfile');
            // Add other teacher routes here
        });
    });
});

require __DIR__.'/auth.php';


// Authentication routes
// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration routes
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('/register', 'Auth\RegisterController@register');

// Password reset routes
// Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

// Pages routes
