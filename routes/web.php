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
use App\Http\Controllers\Admin\AcademicProgramController;

use App\Models\News;
use App\Models\Event;
use App\Models\Facility;
use App\Models\AcademicProgram;
use App\Models\Scholarship;

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

// Fasilitas Kampus (Public)
Route::get('/facility', function (\Illuminate\Http\Request $request) {
    $query = Facility::active();
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
    $facilities = $query->latest()->paginate(9)->withQueryString();
    return view('facility_index', compact('facilities'));
})->name('facility.index');
Route::get('/fasilitas', fn() => redirect()->route('facility.index'));

// Program Studi & Akademik (Public)
Route::get('/programs', function (\Illuminate\Http\Request $request) {
    $query = AcademicProgram::active();
    if ($request->filled('degree')) {
        $query->where('degree', $request->degree);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('faculty', 'like', "%{$search}%");
        });
    }
    $programs = $query->latest()->paginate(9)->withQueryString();
    return view('programs_index', compact('programs'));
})->name('programs.index');
Route::get('/program-studi', fn() => redirect()->route('programs.index'));

// Beasiswa & Grants (Public)
Route::get('/scholarships', function (\Illuminate\Http\Request $request) {
    $query = Scholarship::active();
    if ($request->filled('coverage_type')) {
        $query->where('coverage_type', $request->coverage_type);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('provider', 'like', "%{$search}%");
        });
    }
    $scholarships = $query->latest()->paginate(9)->withQueryString();
    return view('scholarships_index', compact('scholarships'));
})->name('scholarships.index');
Route::get('/beasiswa', fn() => redirect()->route('scholarships.index'));

// Vision & Mission (Public - Statis & Elegan)
Route::get('/about', function () {
    return view('about_vision_mission');
})->name('about.vision-mission');
Route::get('/vision-mission', fn() => redirect()->route('about.vision-mission'));

// Our Campus (Public - Statis & Interaktif)
Route::get('/kampus', function () {
    return view('our_campus');
})->name('campus.index');
Route::get('/our-campus', fn() => redirect()->route('campus.index'));


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

        // Rekap Pendaftar Event
        Route::get('/events/all-registrations', [EventController::class, 'allRegistrations'])->name('events.all-registrations');
        Route::get('/events/{event}/registrations', [EventController::class, 'registrations'])->name('events.registrations');
        Route::resource('/events', EventController::class);

        // CRUD Program Beasiswa
        Route::resource('/scholarships', ScholarshipController::class);

        // CRUD Fasilitas Kampus
        Route::resource('/facilities', FacilityController::class);

        // CRUD Program Studi & Akademik
        Route::resource('/programs', AcademicProgramController::class);

        // CRUD Manajemen Mahasiswa & Staff (Civitas)
        Route::resource('/civitas', CivitasController::class);
    });