<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SpecialtyController;
use App\Http\Controllers\Api\SpecialtyController as SpecialtyCtrllr;
use App\Http\Controllers\Api\ScheduleController as ScheduleCtrllr;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\PatientController;
use App\Http\Controllers\doctor\ScheduleController;
use App\Http\Controllers\AppointmentController;

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
    return redirect('/login') /* view('welcome') */;
});

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'admin'])->group(function () {

    //Specialty
    Route::get('/especialidades', [SpecialtyController::class,'index'])->name('especialidades.index');
    Route::get('/especialidades/create', [SpecialtyController::class,'create'])->name('especialidades.create');
    Route::get('/especialidades/edit/{specialty}', [SpecialtyController::class,'edit'])->name('especialidades.edit');
    Route::post('/especialidades', [SpecialtyController::class,'store'])->name('especialidades.store');
    Route::put('/especialidades/{specialty}', [SpecialtyController::class,'update'])->name('especialidades.update');
    Route::delete('/especialidades/{specialty}', [SpecialtyController::class,'destroy'])->name('especialidades.destroy');

    //Doctores
    Route::get('/doctores', [DoctorController::class,'index'])->name('doctores.index');
    Route::get('/doctores/create', [DoctorController::class,'create'])->name('doctores.create');
    Route::get('/doctores/edit/{doctor}', [DoctorController::class,'edit'])->name('doctores.edit');
    Route::post('/doctores', [DoctorController::class,'store'])->name('doctores.store');
    Route::put('/doctores/{doctor}', [DoctorController::class,'update'])->name('doctores.update');
    Route::delete('/doctores/{doctor}', [DoctorController::class,'destroy'])->name('doctores.destroy');

    //Pacientes
    Route::get('/pacientes', [PatientController::class,'index'])->name('pacientes.index');
    Route::get('/pacientes/create', [PatientController::class,'create'])->name('pacientes.create');
    Route::get('/pacientes/edit/{patient}', [PatientController::class,'edit'])->name('pacientes.edit');
    Route::post('/pacientes', [PatientController::class,'store'])->name('pacientes.store');
    Route::put('/pacientes/{patient}', [PatientController::class,'update'])->name('pacientes.update');
    Route::delete('/pacientes/{patient}', [PatientController::class,'destroy'])->name('pacientes.destroy');

});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/calendario', [ScheduleController::class,'edit'])->name('calendario.edit');
    Route::post('/calendario', [ScheduleController::class,'store'])->name('calendario.store');
});

Route::middleware(['auth'])->group(function () {

    Route::get('citas/create', [AppointmentController::class, 'create'])->name('citas.create');
    Route::post('/citas', [AppointmentController::class,'store'])->name('citas.store');
    Route::get('/citas', [AppointmentController::class,'index'])->name('citas.index');
    Route::post('/citas/cancel/{appointment}', [AppointmentController::class,'postCancel'])->name('citas.cancel');
    Route::get('/citas/showcancel/{appointment}', [AppointmentController::class,'showCancel'])->name('citas.showcancel');
    Route::get('/citas/show/{appointment}', [AppointmentController::class,'show'])->name('citas.show');
    Route::post('/citas/confirmar/{appointment}', [AppointmentController::class,'confirmar'])->name('citas.confirmar');


    Route::get('/especialidades/{specialty}/doctor', [SpecialtyCtrllr::class, 'doctors'])->name('especialidades.doctors');
    Route::get('/calendario/hora', [ScheduleCtrllr::class, 'hours'])->name('especialidades.doctors');
});
