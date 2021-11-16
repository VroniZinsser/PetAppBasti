<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\WeightController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('usuarios/profesionales', [UserController::class, 'getProfessionals']);
Route::get('usuarios/crear-profesional', [UserController::class, 'createFormProfessional']);
Route::post('usuarios/crear-profesional', [UserController::class, 'createProfessional']);
Route::get('/mascotas', [PetController::class, 'getOwnerPets']);
Route::get('/mascotas/agregar', [PetController::class, 'addForm']);
Route::post('/mascotas/agregar', [PetController::class, 'addPet']);
Route::patch('/mascotas/{pet}', [PetController::class, 'patchPet']);

Route::get('/medicamentos/formulario-agregar', [MedicineController::class, 'addForm']);
Route::post('/mascotas/{id}/medicamentos', [MedicineController::class, 'add']);

Route::post('/vacunas', [VaccineController::class, 'createVaccine']);
Route::get('/vacunas/{vaccine}', [VaccineController::class, 'findVaccine']);
Route::put('/vacunas/{vaccine}', [VaccineController::class, 'updateVaccine']);
Route::delete('/vacunas/{vaccine}', [VaccineController::class, 'deleteVaccine']);
Route::get('/mascotas/{pet}/vacunas', [VaccineController::class, 'getVaccinesByPet']);

Route::post('/pesos', [WeightController::class, 'createWeight']);
Route::get('/pesos/{weight}', [WeightController::class, 'findWeight']);
Route::put('/pesos/{weight}', [WeightController::class, 'updateWeight']);
Route::delete('/pesos/{weight}', [WeightController::class, 'deleteWeight']);
Route::get('/mascotas/{pet}/pesos', [WeightController::class, 'getWeightsByPet']);
