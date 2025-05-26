<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClinicsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\ClinicsHomeController;
use App\Http\Controllers\DoctorsHomeController;
use App\Http\Controllers\PatientRecordsController;

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

// Route::get('/', function () {
//     return view('/welcome');
// });

Route::redirect('/', '/home');
// Route::redirect('/', 'welcome');

Auth::routes();
Route::group(['middleware' => ['auth', 'permission']], function() {
    Route::resource('home', HomeController::class)->only(['index', 'show']);
    Route::get('myaccount', [HomeController::class, 'myaccount'])->name('home.myaccount');
    Route::resource('clinics_home', ClinicsHomeController::class)->only(['edit', 'update', 'destroy']);
    Route::get('/clinics_home/show/{clinics_home}', [ClinicsHomeController::class, 'show'])->name('clinics_home.show');
    Route::get('/clinics_home/manageDoctor', [ClinicsHomeController::class, 'manageDoctor'])->name('clinics_home.manageDoctor');
    Route::get('/clinics_home/getPatientList/{patient_id?}', [ClinicsHomeController::class, 'getPatientList'])->name('clinics_home.getPatientList');
    Route::get('/clinics_home/getPatientInfo/{patient_id?}', [ClinicsHomeController::class, 'getPatientInfo'])->name('clinics_home.getPatientInfo');
    Route::get('/clinics_home/deleteUploadedFile/{id?}', [ClinicsHomeController::class, 'deleteUploadedFile'])->name('clinics_home.deleteUploadedFile');
    Route::get('/clinics_home/deleteUploadedNurseFile/{id?}', [ClinicsHomeController::class, 'deleteUploadedNurseFile'])->name('clinics_home.deleteUploadedNurseFile');
    Route::post('/clinics_home/book', [ClinicsHomeController::class, 'book'])->name('clinics_home.book');
    Route::patch('/clinics_home/{clinics_home}/updateMyAccount', [ClinicsHomeController::class, 'updateMyAccount'])->name('clinics_home.updateMyAccount');
    Route::post('/clinics_home/storeBook', [ClinicsHomeController::class, 'storeBook'])->name('clinics_home.storeBook');
    Route::post('/clinics_home/storeDoctor', [ClinicsHomeController::class, 'storeDoctor'])->name('clinics_home.storeDoctor');
    Route::get('/clinics_home/{yr?}/{mon?}/{dayNum?}/{booking_type?}/{specialty?}/{doctor_id?}', [ClinicsHomeController::class, 'index'])->name('clinics_home.index');
    Route::resource('doctors_home', DoctorsHomeController::class)->only(['edit', 'update', 'destroy']);
    Route::get('/doctors_home/show/{doctors_home}', [DoctorsHomeController::class, 'show'])->name('doctors_home.show');
    Route::get('/doctors_home/getPrevBookingInfo/{doctors_home?}/{index?}', [DoctorsHomeController::class, 'getPrevBookingInfo'])->name('doctors_home.getPrevBookingInfo');
    Route::patch('/doctors_home/{doctors_home}/updateMyAccount', [DoctorsHomeController::class, 'updateMyAccount'])->name('doctors_home.updateMyAccount');
    Route::post('/doctors_home/storeClinic', [DoctorsHomeController::class, 'storeClinic'])->name('doctors_home.storeClinic');
    Route::post('/doctors_home/storeSchedule', [DoctorsHomeController::class, 'storeSchedule'])->name('doctors_home.storeSchedule');
    Route::get('/doctors_home/manageSchedule', [DoctorsHomeController::class, 'manageSchedule'])->name('doctors_home.manageSchedule');
    Route::get('/doctors_home/manageClinic', [DoctorsHomeController::class, 'manageClinic'])->name('doctors_home.manageClinic');
    Route::get('doctors_home/{doctors_home}/pdfPrescription', [DoctorsHomeController::class, 'pdfPrescription'])->name('doctors_home.pdfPrescription');
    Route::get('doctors_home/{doctors_home}/pdfMedCert', [DoctorsHomeController::class, 'pdfMedCert'])->name('doctors_home.pdfMedCert');
    Route::get('doctors_home/{doctors_home}/pdfAdmitting', [DoctorsHomeController::class, 'pdfAdmitting'])->name('doctors_home.pdfAdmitting');
    Route::get('/doctors_home/{yr?}/{mon?}/{dayNum?}/{specialty?}', [DoctorsHomeController::class, 'index'])->name('doctors_home.index');
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('clinics', ClinicsController::class);
    Route::resource('doctors', DoctorsController::class);
    Route::resource('patient_records', PatientRecordsController::class)->only('index', 'show');
});



