<?php

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

Route::get('/chromeshot', function () {
    \App\Services\WKHTMLPDfConverter::convertChromeShot(view('welcome')->render(), 'asdf.pdf');
    dd(url('pdf/asdf.pdf'));
    return view('welcome');
});
