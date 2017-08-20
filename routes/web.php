<?php

Route::get('/', 'WelcomeController')
    ->name('welcome');

Route::post('download-resume', 'DownloadResumeController')
    ->name('download-resume');

