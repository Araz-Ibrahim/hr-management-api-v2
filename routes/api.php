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

$routes = [
    'v1' => [
        ['group' => 'hr', 'model' => 'employees', 'ctrl' => EmployeeController::class],
        ['group' => 'hr', 'model' => 'jobs', 'ctrl' => JobController::class],
        // Add more routes for version 1 here if needed
    ],
    'v2' => [
        // Add routes for version 2 here
    ],
    // Add more versions as needed
];

/** --------- Register and Login ----------- */
Route::controller(UserAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

/** ----------- Authenticated Routes ------------ */
Route::middleware('auth:sanctum')->group(function () use ($routes) {
    foreach ($routes as $version => $versionRoutes) {
        foreach ($versionRoutes as $route) {
            Route::group(['prefix' => $version . '/' . $route['group']], function () use ($route) {
                Route::resourceAndList($route['model'], $route['ctrl']);
            });
        }
    }

    // Users
    Route::post('/logout', [UserAuthController::class, 'logout']);
});

/** ----------- Test Route ------------ */
Route::get('/test', function () {
    return response()->json(['message' => 'Test route']);
});

