<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware\IsAdminMiddleware;
use App\Http\Controllers\ApiController\User\UserController;
use App\Http\Controllers\ApiController\Skill\SkillController;

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

Route::post('/register', [UserController::class, 'userRegistration']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::get('/skills', [SkillController::class, 'index']);
Route::post('/setSkills', [SkillController::class, 'setSkillForUserWhoIsDeveloper']);
Route::post('/verifyOtp', [UserController::class, 'verifyOtp']);

Route::middleware(['auth:sanctum', IsAdminMiddleware::class])->prefix('skills')->group(function () {
    Route::post('/', [SkillController::class, 'store']);
    Route::get('/{id}', [SkillController::class, 'show']);
    Route::post('/{id}', [SkillController::class, 'update']);
    Route::delete('/{id}', [SkillController::class, 'remove']);
});

