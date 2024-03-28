<?php

use App\Http\Controllers\UserAuth;
use App\Http\Controllers\V1\Hr\EmployeeController;
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

$routesV1 = [

    ['group' => 'hr', 'model' => 'employees', 'ctrl' => EmployeeController::class],

];

/** --------- Register and Login ----------- */
Route::controller(UserAuth::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

/** ----------- Authenticated Routes ------------ */
Route::middleware('auth:sanctum')->group(function () use ($routesV1) {

    foreach ($routesV1 as $route) {
        Route::group(array('prefix' => 'v1/' . $route['group']), function () use ($route) {
            Route::resourceAndList($route['model'], $route['ctrl']);
        });
    }

    // Users
    Route::post('/logout', [UserAuth::class, 'logout']);
});

/** ----------- Test Route ------------ */
Route::get('/test', function () {
    return response()->json(['message' => 'Test route']);
});

