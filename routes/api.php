<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\PerfumeController;


Route::get('/', function () {
    return response()->json(['message' => 'API de Libros funcionando correctamente.']);
});


Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('perfumes', PerfumeController::class);


Route::get('/categorias/{categoria}/perfumes', [CategoriaController::class, 'perfumes']);
Route::get('categorias', [CategoriaController::class, 'index']);
