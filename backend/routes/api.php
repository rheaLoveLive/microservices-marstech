<?php

use App\Http\Controllers\APIAddonCtrl;
use App\Http\Controllers\APIAddonManagerCtrl;
use App\Http\Controllers\APIAuthCtrl;
use App\Http\Controllers\APIPluginIgBioCTRL;
use App\Http\Controllers\APIPluginRouteCtrl;
use App\Http\Controllers\APITransCtrl;
use Illuminate\Support\Facades\Route;


// plugin
Route::post('getalladdon', [APIAddonCtrl::class, 'getAll']);
Route::post('getaddonwithtrans', [APIAddonCtrl::class, 'getAddonWithTrans']); // mengambil addon menurut trans
Route::post('getroutes', [APIPluginRouteCtrl::class, 'getRoutes']); // mengambil route sesuai yang dibeli
// Route::get('getallroutes', [APIPluginRouteCtrl::class, 'getAllRoutes']);  // masih ambigu mau dipakai atau tidak (tidak berpengaruh karena tidak saya gunakan di frontend)
Route::post('updatestat', [APIAddonCtrl::class, 'updateStat']); 
Route::post('posttrans', [APITransCtrl::class, 'store']); 

// auth
Route::post('signin', [APIAuthCtrl::class, 'login']);
Route::post('signup', [APIAuthCtrl::class, 'resgistration']);

// plugin ig
Route::get('getbioig', [APIPluginIgBioCTRL::class, 'index']);
Route::post('editbioig', [APIPluginIgBioCTRL::class, 'edit']);
Route::post('postbioig', [APIPluginIgBioCTRL::class, 'store']);
Route::post('updatebioig', [APIPluginIgBioCTRL::class, 'update']);
Route::post('delbioig', [APIPluginIgBioCTRL::class, 'destroy']);