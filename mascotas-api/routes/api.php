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

Route::get('/profesionales', [UserController::class, 'getProfessionals']);
Route::get('/profesionales/formulario-agregar', [UserController::class, 'createFormProfessional']);
Route::post('/profesionales', [UserController::class, 'createProfessional']);
Route::put('/profesionales/{user_id}', [UserController::class, 'updateProfessional']);

Route::get('/usuarios/{user_id}', [UserController::class, 'findUser']);
Route::delete('/usuarios/{user_id}', [UserController::class, 'deleteUser']);

Route::get('/mascotas/formulario-agregar', [PetController::class, 'addForm']);
Route::get('/mascotas', [PetController::class, 'getOwnerPets']);
Route::post('/mascotas', [PetController::class, 'createPet']);
Route::get('/mascotas/{pet_id}', [PetController::class, 'findPet']);
Route::put('/mascotas/{pet_id}', [PetController::class, 'updatePet']);
Route::delete('/mascotas/{pet_id}', [PetController::class, 'deletePet']);
// RPC route, handles update and elimination of observation
Route::post('/mascotas/{pet_id}/observacion', [PetController::class, 'updateObservation']);

Route::get('/medicamentos/formulario-agregar', [MedicineController::class, 'addForm']);
Route::post('/medicamentos', [MedicineController::class, 'createMedicine']);
Route::get('/medicamentos/{medicine_id}', [MedicineController::class, 'findMedicine']);
Route::put('/medicamentos/{medicine_id}', [MedicineController::class, 'updateMedicine']);
Route::delete('/medicamentos/{medicine_id}', [MedicineController::class, 'deleteMedicine']);

Route::post('/vacunas', [VaccineController::class, 'createVaccine']);
Route::get('/vacunas/{vaccine_id}', [VaccineController::class, 'findVaccine']);
Route::put('/vacunas/{vaccine_id}', [VaccineController::class, 'updateVaccine']);
Route::delete('/vacunas/{vaccine_id}', [VaccineController::class, 'deleteVaccine']);
Route::get('/mascotas/{pet_id}/vacunas', [VaccineController::class, 'getVaccinesByPet']);

Route::post('/pesos', [WeightController::class, 'createWeight']);
Route::get('/pesos/{weight_id}', [WeightController::class, 'findWeight']);
Route::put('/pesos/{weight_id}', [WeightController::class, 'updateWeight']);
Route::delete('/pesos/{weight_id}', [WeightController::class, 'deleteWeight']);
Route::get('/mascotas/{pet_id}/pesos', [WeightController::class, 'getWeightsByPet']);
