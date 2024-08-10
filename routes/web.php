<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\FetchOrdersFromGoogleSheet;

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
    return view('welcome');
});

// Route to manually dispatch the job for testing
Route::get('/fetch-data', function () {
    FetchOrdersFromGoogleSheet::dispatch(
        '1yLggpdybcL5IN6QgQnVdIyvD5wtFO9khZOmXGkF1BPg',
        '1_hQOQicBfeAOWQGXWUwGznQAA2xQZFO1-FBs-BlE-cM'
    );

    return 'Job dispatched';
});
