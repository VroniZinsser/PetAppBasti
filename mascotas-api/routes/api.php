<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('profesionales', [UserController::class, 'getProfessionals']);
    Route::get('profesionales/tipos', [UserController::class, 'getProfessionalUserTypes']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/profesionales/formulario-agregar', [UserController::class, 'getProfessionalUserTypes']);
    Route::post('/profesionales', [UserController::class, 'createProfessional']);
    Route::post('usuarios/amo', [UserController::class, 'createOwner']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios/{user_id}', [UserController::class, 'findUser']);
    Route::delete('/usuarios/{user_id}', [UserController::class, 'deleteUser']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mascotas/formulario-agregar', [PetController::class, 'addForm']);
    Route::get('/mascotas', [PetController::class, 'getOwnerPets']);
    Route::post('/mascotas', [PetController::class, 'createPet']);
    Route::get('/mascotas/{pet_id}', [PetController::class, 'findPet']);
    Route::get('/mascotas/{pet_id}/observacion', [PetController::class, 'getObservation']);
    Route::put('/mascotas/{pet_id}', [PetController::class, 'updatePet']);
    Route::delete('/mascotas/{pet_id}', [PetController::class, 'deletePet']);
});

// RPC route, handles update and elimination of observation
Route::post('mascotas/{pet}/observacion', [PetController::class, 'updateObservation'])->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::get('/medicamentos/formulario-agregar', [MedicineController::class, 'addForm']);
    Route::post('/medicamentos', [MedicineController::class, 'createMedicine']);
    Route::get('/medicamentos/{medicine_id}', [MedicineController::class, 'findMedicine']);
    Route::put('/medicamentos/{medicine_id}', [MedicineController::class, 'updateMedicine']);
    Route::delete('/medicamentos/{medicine_id}', [MedicineController::class, 'deleteMedicine']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/vacunas', [VaccineController::class, 'createVaccine']);
    Route::get('/vacunas/{vaccine_id}', [VaccineController::class, 'findVaccine']);
    Route::put('/vacunas/{vaccine_id}', [VaccineController::class, 'updateVaccine']);
    Route::delete('/vacunas/{vaccine_id}', [VaccineController::class, 'deleteVaccine']);
    Route::get('/mascotas/{pet_id}/vacunas', [VaccineController::class, 'getVaccinesByPet']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/pesos', [WeightController::class, 'createWeight']);
    Route::get('/pesos/{weight_id}', [WeightController::class, 'findWeight']);
    Route::put('/pesos/{weight_id}', [WeightController::class, 'updateWeight']);
    Route::delete('/pesos/{weight_id}', [WeightController::class, 'deleteWeight']);
    Route::get('/mascotas/{pet_id}/pesos', [WeightController::class, 'getWeightsByPet']);
});

Route::prefix('/autenticacion')->group(function () {
    Route::get("/", [AuthController::class, 'me'])->middleware(['auth']);
    Route::post("/", [AuthController::class, 'login'])->middleware(['guest']);
    Route::delete("/", [AuthController::class, 'logout'])->middleware(['auth']);
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/peticiones')->group(function () {
        Route::get("/creadas", [ContactController::class, 'getOwnerSharedPets']);
        Route::get("/aceptadas", [ContactController::class, 'getProfessionalSharedPets']);
        Route::get("/{request_id}/aceptar", [ContactController::class, 'generateAcceptSharedPetRequest']);
        Route::put("/{request_id}", [ContactController::class, 'updateSharedPetRequest']);
        Route::put("/{request_id}/aceptar", [ContactController::class, 'acceptSharedPetRequest']);
        Route::post("/", [ContactController::class, 'createSharedPetRequest']);
        Route::delete("/{request_id}", [ContactController::class, 'deleteSharedPetRequest']);
    });
});
