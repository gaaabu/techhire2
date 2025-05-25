<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ApplicationController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Public job listings
Route::get('/jobs', [JobPostController::class, 'index'])->name('jobs.index');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Job management (employers only) - MOVED BEFORE /jobs/{job}
    Route::middleware('role:employer')->group(function () {
        Route::get('/jobs/create', [JobPostController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobPostController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [JobPostController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobPostController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobPostController::class, 'destroy'])->name('jobs.destroy');
    });
    
    // Applications (job seekers only)
    Route::middleware('role:job_seeker')->group(function () {
        Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    });

    Route::middleware(['auth', 'role:employer'])->get('/test-employer', function () {
        return 'You are logged in as an employer!';
    });

    Route::middleware('auth')->get('/test-user', function () {
        $user = auth()->user();
        return "User ID: {$user->id}, Role: {$user->role}";
    });
});


Route::get('/about', function (){
    return view('about');
});

Route::get('/contact', function (){
    return view('about');
});
// Public job show route - MOVED TO THE END
Route::get('/jobs/{job}', [JobPostController::class, 'show'])->name('jobs.show');