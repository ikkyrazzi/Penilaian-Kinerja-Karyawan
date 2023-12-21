<?php

use App\Http\Controllers\Hrd\JabatanController;
use App\Http\Controllers\Hrd\KriteriaController;
use App\Http\Controllers\Hrd\PegawaiController;
use App\Http\Controllers\Hrd\PenilaianController;
use App\Http\Controllers\Manager\PenilaianKaryawanController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Routes for HRD
    Route::prefix('hrd')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Hrd\HomeController::class, 'index'])->name('hrd.dashboard');
        Route::get('/dashboard/data', [App\Http\Controllers\Hrd\HomeController::class, 'chartData'])->name('hrd.dashboard.data');
        Route::get('/dashboard/top_scores', [App\Http\Controllers\Hrd\HomeController::class, 'topScores'])->name('hrd.dashboard.top_scores');
        Route::get('/get-deskripsi', [App\Http\Controllers\Hrd\PegawaiController::class, 'getDeskripsiByJabatan'])->name('get-deskripsi');
    
        Route::prefix('hrd/jabatan')
        ->as('hrd.jabatans.')
        ->controller(JabatanController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/export-jabatan', 'export')->name('export');
            Route::get('/import-jabatan', 'import')->name('import');
            // Route::get('/{id}', 'show')->name('show');
            
            Route::post('/', 'store')->name('store');
            Route::post('/import-jabatan', 'importProcess')->name('importProcess');

            Route::put('/{id}', 'update')->name('update');

            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('hrd/pegawai')
        ->as('hrd.pegawais.')
        ->controller(PegawaiController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/export-jabatan', 'export')->name('export');
            Route::get('/import-jabatan', 'import')->name('import');
            // Route::get('/{id}', 'show')->name('show');
            
            Route::post('/', 'store')->name('store');
            Route::post('/import-jabatan', 'importProcess')->name('importProcess');

            Route::put('/{id}', 'update')->name('update');

            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('hrd/kriteria')
        ->as('hrd.kriterias.')
        ->controller(KriteriaController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');

            // Route::get('/{id}', 'show')->name('show');
            
            Route::post('/', 'store')->name('store');

            Route::put('/{id}', 'update')->name('update');

            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('hrd/penilaian')
        ->as('hrd.penilaians.')
        ->controller(PenilaianController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/penilaian/{id}', 'show')->name('show');
            // Route::get('/{id}', 'show')->name('show');
            
            Route::post('/', 'store')->name('store');

            Route::put('/{id}', 'update')->name('update');

            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    // Routes for Manager
    Route::prefix('manager')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Manager\HomeController::class, 'index'])->name('manager.dashboard');

        Route::prefix('manager/penilaian')
        ->as('manager.penilaians.')
        ->controller(PenilaianKaryawanController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            // Route::get('/{id}', 'show')->name('show');
            
            Route::post('/', 'store')->name('store');

            Route::put('/{id}', 'update')->name('update');

            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    // Default route for other roles or if no role is defined
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Route::middleware(['auth', 'hrd'])->group(function() {
//     Route::get('/dashboard', [App\Http\Controllers\Hrd\HomeController::class, 'index'])->name('hrd.dashboard');
//     Route::prefix('tampilan/app')
//         ->as('tampilan.apps.')
//         ->controller(AppController::class)
//         ->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::get('/create', 'create')->name('create');
//             Route::get('/{id}/edit', 'edit')->name('edit');
            
//             Route::post('/', 'store')->name('store');

//             Route::put('/{id}', 'update')->name('update');

//             Route::delete('/{id}', 'destroy')->name('destroy');
//         });
// });

// Route::middleware(['auth', 'manager'])->group(function() {
//     Route::get('/dashboard', [App\Http\Controllers\Manager\HomeController::class, 'index'])->name('manager.dashboard');
//     Route::prefix('tampilan/app')
//         ->as('tampilan.apps.')
//         ->controller(AppController::class)
//         ->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::get('/create', 'create')->name('create');
//             Route::get('/{id}/edit', 'edit')->name('edit');
            
//             Route::post('/', 'store')->name('store');

//             Route::put('/{id}', 'update')->name('update');

//             Route::delete('/{id}', 'destroy')->name('destroy');
//         });
// });