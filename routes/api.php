<?php

use App\Http\Controllers\UserAuth;
use Illuminate\Http\Request;
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

//    ['group' => 'super-admin', 'model' => 'tests', 'ctrl' => TestController::class],

];

/** --------- Register and Login ----------- */
Route::controller(UserAuth::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

/** ----------- Authenticated Routes ------------ */
Route::middleware('auth:sanctum')->group(function () use ($routes) {

    foreach ($routes as $route) {
        Route::group(array('prefix' => $route['group']), function () use ($route) {
            Route::resourceAndList($route['model'], $route['ctrl']);
        });
    }

    // Users
    Route::post('/logout', [UserAuth::class, 'logout']);
});

/** ----------- Public Routes ------------ */
