<?php

use Illuminate\Support\Facades\Route;

Route::get('', [App\Http\Controllers\Web\Index\Controller::class, 'run'])
    ->name('web_index');
Route::get('/login', [App\Http\Controllers\Web\Login\Controller::class, 'run'])
    ->middleware('guest')
    ->name('login');
Route::get('/registration', [App\Http\Controllers\Web\Registration\Controller::class, 'run'])
    ->middleware('guest')
    ->name('web_registration');
Route::get('/profile', [App\Http\Controllers\Web\Profile\Controller::class, 'run'])
    ->middleware('auth')
    ->name('web_profile');
Route::get('/logout', [App\Http\Controllers\Web\Logout\Controller::class, 'run'])
    ->middleware('auth')
    ->name('web_logout');
Route::get('/lot/silver/{silverLotId}', [App\Http\Controllers\Web\Lot\Silver\View\Controller::class, 'run'])
    ->where('silverLotId', '\d+')
    ->name('web_silver_lot');

Route::group(['prefix' => 'ajax'], function () {
    Route::post('login', [App\Http\Controllers\WebAjax\Login\Controller::class, 'run'])->name('web_ajax_login');
    Route::post('registration', [App\Http\Controllers\WebAjax\Registration\Controller::class, 'run'])->name('web_ajax_registration');
    Route::get('form-info', [App\Http\Controllers\WebAjax\Lot\FormInfo\Controller::class, 'run'])->name('web_ajax_form_info');

    Route::group(['prefix' => 'lot'], function () {
        Route::group(['prefix' => 'silver'], function () {
            Route::post('create', [App\Http\Controllers\WebAjax\Lot\Silver\Create\Controller::class, 'run'])
                ->name('web_ajax_silver_create')
                ->middleware('auth');
            Route::get('show', [App\Http\Controllers\WebAjax\Lot\Silver\Show\Controller::class, 'run'])
                ->name('web_ajax_silver_show');
        });
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin.access.checker']], function () {
    Route::get('', [\App\Http\Controllers\Admin\Index\Controller::class, 'run'])->name('admin_index');
    Route::get('user', [\App\Http\Controllers\Admin\User\Show\Controller::class, 'run'])->name('admin_user_show');
});

Route::group(['prefix' => 'admin-ajax', 'middleware' => ['admin.access.checker']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('{userId}/change-status/active', [\App\Http\Controllers\AdminAjax\User\ChangeStatus\Active\Controller::class, 'run'])
            ->where('userId', '\d+')
            ->name('admin_ajax_user_active');
        Route::post('{userId}/change-status/ban', [\App\Http\Controllers\AdminAjax\User\ChangeStatus\Ban\Controller::class, 'run'])
            ->where('userId', '\d+')
            ->name('admin_ajax_user_ban');
    });
});
