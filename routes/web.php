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

Route::resource('owners', 'OwnersController')->middleware('auth');
Route::resource('medicines', 'MedicinesController')->middleware('auth');
Route::resource('pets', 'PetsController')->middleware('auth');
Route::resource('medical_supplies', 'MedicalSuppliesController')->middleware('auth');
Route::resource('inv_logs', 'InvLogsController')->middleware('auth');
Route::resource('medical_records', 'MedicalRecordsController')->middleware('auth');

Auth::routes(['reset'=>false, 'register'=>false]);
Route::get('/home', 'HomeController@index')->name('home');
