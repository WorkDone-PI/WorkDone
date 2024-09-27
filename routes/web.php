<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjetosController;

Route::get('/', function () {
    return view('index');
})->name('index');

//Rotas de Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Routa da home
Route::get('/home', [ProjetosController::class, 'home'])->name('home')->middleware('auth');


//Rotas de Criação de Usuario
Route::get('/register', [UserController::class, 'showFormRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

//Rotas do perfil
Route::get('/profile', [UserController::class, 'index'])->name('profile')->middleware('auth');
Route::get('/edit', [UserController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/update', [UserController::class, 'update'])->name('update')->middleware('auth');

//Rotas de Projetos
Route::get('/registerProject',[ProjetosController::class, 'show'])->name('registerProject');
Route::get('/registerProject2',[ProjetosController::class, 'shownext'])->name('registerProject2');
Route::post('/registerProject',[ProjetosController::class, 'produto'])->name('produto');
Route::get('/prjs', [ProjetosController::class, 'prjs'])->name('prjs')->middleware('auth');
/*Route::get('/editP', function () {
    return view('editP');
})->name('editP');*/
Route::get('/editP{Id}', [ProjetosController::class, 'search'])->name('editP')->middleware('auth');
//Route::put('/editP{Id}', [ProjetosController::class, 'updateP'])->name('updateP')->middleware('auth');
Route::put('/editP/{Id}', [ProjetosController::class, 'updateP'])->name('updateP')->middleware('auth');
Route::delete('/delete/{Id}', [ProjetosController::class, 'delete'])->name('delete')->middleware('auth');

//Route::middleware('auth')->group(function () {
    //Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile');
    //Route::get('/home', [UserController::class, 'home'])->name('home');
//});   
