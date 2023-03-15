<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('addmeeting',[MeetingController::class,'addAndupdate'])->name('addMeeting');
Route::post('/deleteMeeting',[MeetingController::class,'DeleteMeeting']);
Route::get('/Allmeetings',[MeetingController::class,'fetchMeetings']);
Route::get('/getMeetingEdit',[MeetingController::class,'getMeetingEdit']);
Route::post('/getMeetingUpdate',[MeetingController::class,'MeetingUpdate']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
