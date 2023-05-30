<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LinkController;

Route::get('/links', [LinkController::class, 'index'])->name('links.index');
