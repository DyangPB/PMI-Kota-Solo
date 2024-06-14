<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RelawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\PengelolaProfilController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route to pdf export
Route::post('users/view-pdf/{id}', [pdfController::class, 'viewPDF'])->name('view-pdf');
Route::post('users/download-pdf', [pdfController::class, 'downloadPDF'])->name('download-pdf');

//test middleware relawan role
Route::group(['middleware' => ['auth', 'role:relawan']], function () {
    Route::get('/relawan/dashboard', [RelawanController::class, 'index'])->name('home-relawan');
    Route::get('/relawan/laporan-kejadian', [RelawanController::class, 'index_laporankejadian'])->name('relawan-laporankejadian');
    Route::get('/relawan/laporan-kejadian/create', [RelawanController::class, 'create_laporankejadian'])->name('create-laporankejadian');
    Route::get('/relawan/laporan-kejadian/edit', [RelawanController::class, 'edit_laporankejadian'])->name('edit-laporankejadian');
    Route::delete('/relawan/laporan-kejadian/delete/{id}', [RelawanController::class, 'delete_laporankejadian'])->name('delete-laporankejadian'); //edit
    Route::get('/relawan/lapsit', [RelawanController::class, 'index_lapsit'])->name('relawan-lapsit');
    Route::get('/relawan/lapsit/create', [RelawanController::class, 'create_lapsit'])->name('create-lapsit');
    Route::get('/relawan/lapsit/{id}/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit'); //edit
    Route::put('/relawan/lapsit/{id}', [RelawanController::class, 'update_lapsit'])->name('edit-lapsit.update'); //edit
    // Route::post('/relawan/lapsit/{id}/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit'); //edit
    Route::get('/relawan/lapsit/detail', [RelawanController::class, 'detail_lapsit'])->name('detail-lapsit');
    Route::get('/relawan/assesment', [RelawanController::class, 'index_assessment'])->name('relawan-assessment');
    Route::get('/relawan/assesment/create', [RelawanController::class, 'create_assessment'])->name('create-assessment');
    Route::post('/relawan/assesment/{id}/edit', [RelawanController::class, 'edit_assessment'])->name('edit-assessment'); //edit
    Route::delete('/relawan/assesment/delete/{id}', [RelawanController::class, 'delete_assessment'])->name('delete-assessment'); //edit
});

//test middleware pengelola profil role
Route::group(['middleware' => ['auth', 'role:pengelola_profil']], function () {
    Route::get('/pengelolaProfil/dashboard', [PengelolaProfilController::class, 'index'])->name('pengelolaProfil-home');
    Route::get('/pengelolaProfil/user_management', [PengelolaProfilController::class, 'user_management'])->name('pengelola-user');
    Route::get('/pengelolaProfil/user_management/{id}/edit', [PengelolaProfilController::class, 'user_management_edit'])->name('pengelola-user.edit');
    Route::get('/pengelolaProfil/relawan_management', [PengelolaProfilController::class, 'relawan_management'])->name('pengelola-relawan');
    Route::get('/pengelolaProfil/admin_management', [PengelolaProfilController::class, 'admin_management'])->name('pengelola-admin');
    //crud relawan
    Route::post('/pengelolaProfil/store-relawan', [PengelolaProfilController::class, 'store_relawan'])->name('pengelola-user-relawan');  
    Route::get('/pengelolaProfil/add-volunteer', [PengelolaProfilController::class, 'create_relawan'])->name('pengelola-addRelawan');
    Route::get('/pengelolaProfil/detail-volunteer/{id}/hapus', [PengelolaProfilController::class, 'destroy_relawan'])->name('pengelola-detailRelawan');
    Route::get('/pengelolaProfil/{id}/editRelawan', [PengelolaProfilController::class, 'edit_relawan'])->name('pengelolaProfiledit_relawan');
    Route::put('/pengelolaProfil/{id}/editRelawan', [PengelolaProfilController::class, 'update_relawan'])->name('pengelolaProfil.update_relawan');
    Route::get('/pengelolaProfil/{id}/relawan',  [PengelolaProfilController::class, 'show_relawan'])->name('pengelolaProfil.show_relawan');
    Route::get('/pengelolaProfil/hapus-relawan/{id}/hapusRelawan', [PengelolaProfilController::class, 'destroy_relawan'])->name('pengelola-user-hapusRelawan');
    //admin CRUD
    Route::post('/pengelolaProfil/store-admin', [PengelolaProfilController::class, 'store_admin'])->name('pengelola-user-admin');  
    Route::get('/pengelolaProfil/add-admin', [PengelolaProfilController::class, 'create_admin'])->name('pengelola-add-admin');//nampilin view 
    Route::get('pengelolaProfil/{id}/edit', [PengelolaProfilController::class, 'edit_admin'])->name('pengelolaProfil.edit_admin');
    Route::put('pengelolaProfil/{id}/edit', [PengelolaProfilController::class, 'update_admin'])->name('pengelolaProfil.update_admin');
    Route::resource('pengelolaProfil', PengelolaProfilController::class);
    Route::get('/pengelolaProfil/hapus-admin/{id}/hapus', [PengelolaProfilController::class, 'destroy_admin'])->name('pengelola-user-hapusAdmin');
    Route::get('pengelolaProfil/{id}',  [PengelolaProfilController::class, 'show_admin'])->name('pengelolaProfil.show_admin');
});
//test middleware admin role
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index_admin'])->name('admin-home');
    Route::get('/admin/kejadian', [AdminController::class, 'kejadian'])->name('admin-kejadian');
    Route::get('/admin/assessment', [AdminController::class, 'index_assessment'])->name('admin-assessment');
    Route::get('/admin/assessment/unverified', [AdminController::class, 'assessment_unverif'])->name('admin-assessment-unverif');
    Route::get('/admin/assessment/verified', [AdminController::class, 'assessment_verif'])->name('admin-assessment-verif');
    Route::get('/admin/lapsit', [AdminController::class, 'lapsit'])->name('admin-lapsit');
    Route::post('/admin/lapsit/{id}/share', [AdminController::class, 'Sharelapsit'])->name('share.lapsit');
    Route::get('/admin/exsum', [AdminController::class, 'index_exsum'])->name('admin-exsum');
});
