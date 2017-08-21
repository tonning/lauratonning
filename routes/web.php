<?php

Route::get('/', 'WelcomeController')
    ->name('welcome');

Route::post('download-resume', 'DownloadResumeController')
    ->name('download-resume');

Route::get('sites/{site}', 'SitesController@show')
    ->name('pages::show');
