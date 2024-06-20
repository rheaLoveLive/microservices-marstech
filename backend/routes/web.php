<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddonsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PluginRoutesController;
use App\Http\Controllers\TransactionsController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('user',UserController::class);

Route::resource('addon',AddonsController::class);

Route::resource('trans',TransactionsController::class);

Route::resource('route',PluginRoutesController::class);