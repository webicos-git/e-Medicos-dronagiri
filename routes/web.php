<?php

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


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'HomeController@lang');
Route::post('/home', 'HomeController@filter_daily_patients')->name('home.filter_daily_patients');
Route::get('/home/pdf/{date}', 'HomeController@pdf_daily_patients');


//Patients
Route::get('/patient/create', 'PatientController@create')->name('patient.create');
Route::post('/patient/create', 'PatientController@store')->name('patient.store');
Route::get('/patient/all', 'PatientController@all')->name('patient.all');
Route::get('/patient/view/{id}', 'PatientController@view')->where('id', '[0-9]+')->name('patient.view');
Route::get('/patient/edit/{id}', 'PatientController@edit')->where('id', '[0-9]+')->name('patient.edit');
Route::post('/patient/edit', 'PatientController@store_edit')->name('patient.store_edit');

//Appointments
Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create');
Route::post('/appointment/create', 'AppointmentController@store')->name('appointment.store');
Route::get('/appointment/all', 'AppointmentController@all')->name('appointment.all');
Route::get('/appointment/checkslots/{id}', 'AppointmentController@checkslots');
Route::get('/appointment/delete/{id}', 'AppointmentController@destroy')->where('id', '[0-9]+');
Route::post('/appointment/edit', 'AppointmentController@store_edit')->name('appointment.store_edit');

//Doctors
Route::get('/doctor/create', 'DoctorController@create')->name('doctor.create');
Route::post('/doctor/create', 'DoctorController@store')->name('doctor.store');
Route::get('/doctor/all', 'DoctorController@all')->name('doctor.all');
Route::get('/doctor/view/{id}', 'DoctorController@view')->where('id', '[0-9]+')->name('doctor.view');
Route::get('/doctor/delete/{id}', 'DoctorController@destroy');
Route::get('/doctor/edit/{id}', 'DoctorController@edit')->where('id', '[0-9]+')->name('doctor.edit');
Route::post('/doctor/edit', 'DoctorController@store_edit')->name('doctor.store_edit');

//Xrays
Route::get('/xray/create', 'XrayController@create')->name('xray.create');
Route::post('/xray/create', 'XrayController@store')->name('xray.store');
Route::get('/xray/all', 'XrayController@all')->name('xray.all');
Route::get('/xray/delete/{id}', 'XrayController@destroy');
Route::get('/xray/edit/{id}', 'XrayController@edit')->where('id', '[0-9]+')->name('xray.edit');
Route::post('/xray/edit', 'XrayController@store_edit')->name('xray.store_edit');

//Sonography
Route::get('/sonography/create', 'SonographyController@create')->name('sonography.create');
Route::post('/sonography/create', 'SonographyController@store')->name('sonography.store');
Route::get('/sonography/all', 'SonographyController@all')->name('sonography.all');
Route::get('/sonography/delete/{id}', 'SonographyController@destroy');
Route::get('/sonography/edit/{id}', 'SonographyController@edit')->where('id', '[0-9]+')->name('sonography.edit');
Route::post('/sonography/edit', 'SonographyController@store_edit')->name('sonography.store_edit');

//Blood Tests
Route::get('/blood_test/create', 'BloodTestController@create')->name('blood_test.create');
Route::post('/blood_test/create', 'BloodTestController@store')->name('blood_test.store');
Route::get('/blood_test/all', 'BloodTestController@all')->name('blood_test.all');
Route::get('/blood_test/delete/{id}', 'BloodTestController@destroy');
Route::get('/blood_test/edit/{id}', 'BloodTestController@edit')->where('id', '[0-9]+')->name('blood_test.edit');
Route::post('/blood_test/edit', 'BloodTestController@store_edit')->name('blood_test.store_edit');

//Investigations
Route::get('/investigation/create', 'TreatmentController@create')->name('investigation.create');
Route::post('/investigation/create', 'TreatmentController@store')->name('investigation.store');
Route::get('/investigation/all', 'TreatmentController@all')->name('investigation.all');

//Billing
Route::get('/billing/create', 'BillingController@create')->name('billing.create');
Route::post('/billing/create', 'BillingController@store')->name('billing.store');
Route::get('/billing/all', 'BillingController@all')->name('billing.all');
Route::get('/billing/view/{id}', 'BillingController@view')->where('id', '[0-9]+')->name('billing.view');
Route::get('/billing/pdf/{id}', 'BillingController@pdf')->where('id', '[0-9]+');
Route::get('/billing/delete/{id}', 'BillingController@destroy');
Route::get('/billing/edit/{id}', 'BillingController@edit')->where('id', '[0-9]+')->name('billing.edit');
Route::post('/billing/edit', 'BillingController@store_edit')->name('billing.store_edit');

//Report Generation
Route::get('/reports', 'ReportController@all')->name('report.all');
Route::post('/reports', 'ReportController@filter')->name('report.filter');
Route::get('/reports/pdf/{id}', 'ReportController@pdf')->where('id', '[0-9]+');

//Settings
/* Doctorino Settings */
Route::get('/settings/doctorino_settings', 'SettingController@doctorino_settings')->name('doctorino_settings.edit');
Route::post('/settings/doctorino_settings', 'SettingController@doctorino_settings_store')->name('doctorino_settings.store');
/* Prescription Settings */
Route::get('/settings/prescription_settings', 'SettingController@prescription_settings')->name('prescription_settings.edit');
Route::post('/settings/prescription_settings', 'SettingController@prescription_settings_store')->name('prescription_settings.store');
