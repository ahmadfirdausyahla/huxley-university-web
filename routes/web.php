<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventRegistrationController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\CivitasController;
use App\Http\Controllers\Admin\FacilityController;

use App\Models\News;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Utama / Visitor)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// News & Berita
Route::get('/news', function () {
    $news = News::latest()->get();
    return view('news_index', compact('news'));
})->name('news.index');

Route::get('/berita/{news}', function (News $news) {
    return view('news_show', compact('news'));
})->name('news.show');

// Events & Kegiatan
Route::get('/events', function () {
    $events = Event::latest()->get();
    return view('events_index', compact('events'));
})->name('events.index');

Route::get('/events/{event}', function (Event $event) {
    return view('events_show', compact('event'));
})->name('events.show');

// Event Registration Routes
Route::get('/events/{event}/register/public', [EventRegistrationController::class, 'publicForm'])
    ->name('events.register.public');
Route::post('/events/{event}/register/public', [EventRegistrationController::class, 'storePublic'])
    ->name('events.register.public.store');

Route::get('/events/{event}/register/student', [EventRegistrationController::class, 'studentForm'])
    ->name('events.register.student');
Route::post('/events/{event}/register/student', [EventRegistrationController::class, 'storeStudent'])
    ->name('events.register.student.store');

Route::get('/events/{event}/register/mahasiswa', [EventRegistrationController::class, 'studentForm'])
    ->name('events.register.mahasiswa');
Route::post('/events/{event}/register/mahasiswa', [EventRegistrationController::class, 'storeStudent'])
    ->name('events.register.mahasiswa.store');

Route::get('/events/{event}/register', function (Event $event) {
    return $event->isMahasiswaOnly()
        ? redirect()->route('events.register.student', $event)
        : redirect()->route('events.register.public', $event);
})->name('events.register');

// Fasilitas & Program Studi (Public)
Route::get('/facility', function () {
    return view('facility_index');
})->name('facility.index');

Route::get('/programs', function () {
    return view('programs_index');
})->name('programs.index');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Membutuhkan Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin Utama
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Management CRUD
        Route::resource('/news', NewsController::class);
        Route::get('/events/{event}/registrations', [EventController::class, 'registrations'])->name('events.registrations');
        Route::resource('/events', EventController::class);
        Route::resource('/scholarships', ScholarshipController::class);
        Route::resource('/civitas', CivitasController::class);

        // CRUD Fasilitas Kampus (Slot Khusus Anda)
        Route::resource('/facilities', FacilityController::class);
    });