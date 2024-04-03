<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\V1\Hr\EmployeeController;
use App\Http\Controllers\V1\Hr\JobController;
use Illuminate\Support\Facades\Route;

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

/** --------- Register and Login ----------- */
Route::controller(UserAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

/** ----------- Authenticated Routes ------------ */
Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'hr'], function () {

            // Employees
            Route::get('employees/create-view', [EmployeeController::class, 'createView']);
            Route::get('employees/edit-view/{id}', [EmployeeController::class, 'editView']);
            Route::get('employees/show-view/{id}', [EmployeeController::class, 'showView']);
            Route::get('employees/delete-view/{id}', [EmployeeController::class, 'deleteView']);
            Route::get('employees/find-managers', [EmployeeController::class, 'findManagers']);
            Route::get('employees/find-managers-with-salaries', [EmployeeController::class, 'findManagersWithSalaries']);
            Route::get('employees/search', [EmployeeController::class, 'searchEmployees']);
            Route::get('employees/export-csv', [EmployeeController::class, 'exportEmployeesCsv']);
            Route::post('employees/import-csv', [EmployeeController::class, 'importEmployeesCsv']);
            Route::resource('employees', EmployeeController::class);

            // Jobs
            Route::get('jobs/create-view', [JobController::class, 'createView']);
            Route::get('jobs/edit-view/{id}', [JobController::class, 'editView']);
            Route::get('jobs/show-view/{id}', [JobController::class, 'showView']);
            Route::get('jobs/delete-view/{id}', [JobController::class, 'deleteView']);
            Route::resource('jobs', JobController::class);
        });
    });

    // Users
    Route::post('/logout', [UserAuthController::class, 'logout']);
});

/** ----------- Test Route ------------ */
Route::get('/test', function () {
    return response()->json(['message' => 'Test route']);
});

