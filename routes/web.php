<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearnerProgressController;

Route::get('/', function () {
    return redirect('/learner-progress');
});

Route::get('/learner-progress', [LearnerProgressController::class, 'index']);
