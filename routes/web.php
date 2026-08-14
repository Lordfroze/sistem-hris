<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PayrollController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// route untuk task resource
Route::resource('tasks', TaskController::class);
// route untuk mark done task
Route::get('/tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
// route untuk mark pending task
Route::get('/tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');
// Route resource untuk employee resource
Route::resource('/employees', EmployeeController::class);
// route untuk department resource
Route::resource('/departments', DepartmentController::class);
// route untuk role resource
Route::resource('/roles', RoleController::class);
// route untuk presence resource
Route::resource('/presences', PresenceController::class);
// route untuk payroll resource
Route::resource('/payrolls', PayrollController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
