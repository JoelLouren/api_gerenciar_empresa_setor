<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SetorContoller;
use App\Http\Controllers\EmpresaSetorContoller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/empresa', [EmpresaController::class, 'store']);//create
Route::get('/empresa/{id}', [EmpresaController::class, 'edit']);//read
Route::put('/empresa', [EmpresaController::class, 'update']);//update
Route::delete('/empresa/{id}', [EmpresaController::class, 'destroy']);//delete
Route::get('/empresas', [EmpresaController::class, 'index']);//read

Route::post('/setor', [SetorContoller::class, 'store']);//create
Route::get('/setor/{id}', [SetorContoller::class, 'edit']);//read
Route::put('/setor', [SetorContoller::class, 'update']);//update
Route::delete('/setor/{id}', [SetorContoller::class, 'destroy']);//delete
Route::get('/setores', [SetorContoller::class, 'index']);//read

Route::post('/empresa-setor', [EmpresaSetorContoller::class, 'store']);//create
Route::get('/empresa-setor/{empresa_id}/{setor_id}', [EmpresaSetorContoller::class, 'edit']);//read
Route::put('/empresa-setor', [EmpresaSetorContoller::class, 'update']);//update
Route::delete('/empresa-setor', [EmpresaSetorContoller::class, 'destroy']);//delete
Route::get('/empresa-setores', [EmpresaSetorContoller::class, 'index']);//read
Route::get('/empresa-setores/{id}', [EmpresaSetorContoller::class, 'setorNotIn']);//read