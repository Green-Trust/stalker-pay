<?php

use Illuminate\Support\Facades\Route;

Route::get('', [App\Http\Controllers\Web\Index\Controller::class, 'run'])->name('web_index');
Route::get('/login', [App\Http\Controllers\Web\Login\Controller::class, 'run'])->name('web_login');
Route::get('/registration', [App\Http\Controllers\Web\Registration\Controller::class, 'run'])->name('web_registration');

Route::group(['prefix' => 'ajax'], function () {
    Route::post('registration', [App\Http\Controllers\WebAjax\Registration\Controller::class, 'run'])->name('web_ajax_registration');
});
