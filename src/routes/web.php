<?php 

use Illuminate\Support\Facades\Route;
use AbdurRahaman\Icon\Http\Controllers\IconController;


Route::get('icon/get',[IconController::class,'get'])->name('icon.get');  



