<?php

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyReportController;
use App\Http\Controllers\SurveyResponseController;

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
Route::get("/", function(){
    return view("layout.app");
 });
Route::resource('surveys', SurveyController::class);
Route::get('survey/{id}', [SurveyResponseController::class, 'show']);
Route::post('survey/{id}/submit', [SurveyResponseController::class, 'submit']);
Route::get('survey/{surveyId}/report', [SurveyReportController::class, 'index']);



