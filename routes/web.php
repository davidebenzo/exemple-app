<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;

Route::get('/', [HomeController::class, 'index']); 



