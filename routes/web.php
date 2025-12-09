<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThemeController;

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

Route::middleware(['IsLogout'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginProses'])->name('login.proses');
    Route::get('/register', [UserController::class, 'registerForm'])->name('register');
    Route::post('/register', [UserController::class, 'registerProses'])->name('register.proses');
});
Route::middleware(['IsLogin'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/homee', [UserController::class, 'landingPage'])->name('landing_page');


    
    Route::prefix('/kelola_akun')->name('kelola_akun.')->middleware('isAdmin')->group(function () {
        Route::get('/data', [UserController::class, 'index'])->name('data');
        Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
        Route::post('/tambah/proses', [UserController::class, 'store'])->name('tambah.proses');
        Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');
        Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');
        Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
        Route::get('/kelola-akun/tambah', [UserController::class, 'tambah'])->name('kelola_akun.tambah');
        Route::post('/kelola-akun/simpan', [UserController::class, 'simpan'])->name('kelola_akun.simpan');
    });

    Route::get('/task', [TaskController::class, 'index'])->name('task.index');

    // Form tambah tugas
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');

    // Simpan tugas baru
    Route::post('/task', [TaskController::class, 'store'])->name('task.store');

    // Form edit tugas
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');

    // Simpan perubahan
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update');

    // Hapus tugas
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');

    //update task
    Route::patch('/task/toggle/{id}', [TaskController::class, 'toggle'])->name('task.toggle');

    //route theme
    Route::get('/theme', [ThemeController::class, 'index'])->name('theme.index');
    Route::get('/theme/create', [ThemeController::class, 'create'])->name('theme.create');
    Route::post('/theme', [ThemeController::class, 'store'])->name('theme.store');
    Route::get('/theme/{theme}/edit', [ThemeController::class, 'edit'])->name('theme.edit');
    Route::put('/theme/{theme}', [ThemeController::class, 'update'])->name('theme.update');
    Route::delete('/theme/{theme}', [ThemeController::class, 'destroy'])->name('theme.destroy');
});
