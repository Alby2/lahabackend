<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::post("login",[AuthController::class,"login"]);
Route::post("register",[AuthController::class,"register"]);

Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,"logout"]);


Route::middleware(["auth:sanctum","abilities:student"])->group(function ()
{
    //Seul les etudiants auront accès aux routes de cette fonction
       
});

Route::middleware(["auth:sanctum","abilities:admin"])->group(function ()
{
    //Seul les admin auront accès aux routes de cette fonction

});

Route::middleware(["auth:sanctum","abilities:super_admin"])->group(function ()
{
    //Seul le super admin aura acces aux routes de cette fonction
});

//Pour faire l'abilite "Ou" voici un exemple
Route::middleware(["auth:sanctum","ability:super_admin,admin"])->group(function ()
{
    //Seul le super admin ou l'admin auront acces aux routes de cette fonction
});
//Pour faire l'abilite "ET" voici un exemple
Route::middleware(["auth:sanctum","abilities:super_admin,admin"])->group(function ()
{
    //Seul l'users ayant le role de super admin et de admin aura access aux routes
});

//abilities pour faire le "ET"  
//ability pour faire le "OU" 