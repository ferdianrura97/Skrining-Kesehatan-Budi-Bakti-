<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SkriningController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\LaporanController;

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

$ctrl = "\App\Http\Controllers";

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::group(['middleware' => 'guest'], function(){
    Route::get('staff/login', [StaffAuthController::class, 'login'])->name('staff.login');
    Route::post('staff/login', [StaffAuthController::class, 'handleLogin'])->name('staff.handleLogin');

    Route::get('siswa/login', [SiswaAuthController::class, 'login'])->name('siswa.login');
    Route::post('siswa/login', [SiswaAuthController::class, 'handleLogin'])->name('siswa.handleLogin');
// });

Route::get('staff/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
Route::get('siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

Route::group(['middleware' => ['auth:staff,siswa']], function() use($ctrl){
    Route::get('dashboard/',[DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('level', \App\Http\Controllers\LevelController::class);
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
    Route::resource('siswa', \App\Http\Controllers\SiswaController::class);
    
    // Penyakit Crud
    Route::get('/penyakit','App\Http\Controllers\PenyakitController@index')->name('penyakit.index');
    Route::get('/penyakit/tambah','App\Http\Controllers\PenyakitController@tambah')->name('penyakit.create');
    Route::post('/penyakit/store','App\Http\Controllers\PenyakitController@store')->name('penyakit.store');
    Route::get('/penyakit/edit/{id}','App\Http\Controllers\PenyakitController@edit')->name('penyakit.edit');
    Route::put('/penyakit/update','App\Http\Controllers\PenyakitController@update')->name('penyakit.update');
    Route::delete('/penyakit/hapus/{id}','App\Http\Controllers\PenyakitController@hapus')->name('penyakit.destroy');
    
    // Kelas CRUD
    Route::resource('kelas', KelasController::class);
    Route::resource('unit', UnitController::class);
    
    Route::resource('skrining', SkriningController::class);
    
    // Menu Bantu Pengaturan
    Route::resource('pengaturan', PengaturanController::class);
    
    // prefix Laporan
    Route::group(['prefix' => 'laporan'], function(){
        Route::get('siswa',[LaporanController::class, 'siswa'])->name('laporan.siswa');
        Route::get('staff',[LaporanController::class, 'staff'])->name('laporan.staff');
        Route::get('skrining-siswa',[LaporanController::class, 'skriningSiswa'])->name('laporan.skrining-siswa');
        Route::get('skrining-staff',[LaporanController::class, 'skriningStaff'])->name('laporan.skrining-staff');
    });
    
});