<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitaController;

Route::get('/citas', [CitaController::class, 'index']);
