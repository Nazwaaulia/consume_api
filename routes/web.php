<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class,'index']);
Route::get('/add',[StudentController::class,'create'])->name('add');
Route::post('/add/send',[StudentController::class,'store'])->name('send');
Route::get('/edit/{id}',[StudentController::class, 'edit'])->name('edit');
Route::patch('/update/{id}',[StudentController::class, 'update'])->name('update');
Route::delete('/delete/{id}',[StudentController::class, 'destroy'])->name('delete');
Route::get('trash',[StudentController::class, 'trash'])->name('trash');
//restore
Route::get('/trash/restore/{id}', [StudentController::class, 'restore'])->name('restore');
//hapus permanent
Route::get('/trash/delete/permanent/{id}', [StudentController::class, 'permanent'])->name('permanent');