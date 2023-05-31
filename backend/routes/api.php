<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LinksController;

Route::post('/links', [LinksController::class, 'create']);
Route::get('/links/{slug}', [LinksController::class, 'retrieve']);
Route::get('/links', [LinksController::class, 'list']);
Route::put('/links/{id}', [LinksController::class, 'edit']);
Route::delete('/links/{id}', [LinksController::class, 'delete']);
