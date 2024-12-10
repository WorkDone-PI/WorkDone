<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('index');
})->name('index');

//Rotas de Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

//Rota de Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Routa da home
Route::get('/home', [ProjetosController::class, 'home'])->name('home')->middleware('auth');


//Rotas de Criação de Usuario
Route::get('/register', [UserController::class, 'showFormRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

//Rotas do perfil
Route::get('/edit', [UserController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/update', [UserController::class, 'update'])->name('update')->middleware('auth');
Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile.show');
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');



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
Route::get('/delete-project/{id}', [ProjetosController::class, 'delete'])->name('deleteProject')->middleware('auth');

//Route::middleware('auth')->group(function () {
    //Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile');
    //Route::get('/home', [UserController::class, 'home'])->name('home');
//});   

//Rotas da Categoria 
/*Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index'); // Listar todas as categorias
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create'); // Formulário de cadastro de categoria
    Route::post('/', [CategoryController::class, 'store'])->name('category.store'); // Salvar nova categoria
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show'); // Detalhes de uma categoria específica
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit'); // Formulário de edição de categoria
    Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update'); // Atualizar categoria
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Excluir categoria
});*/

//Rotas de postagem do projeto
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');

Route::get('/projetos/{id}/edit', [ProjetosController::class, 'search'])->name('editProject');
Route::put('/projetos/{id}', [ProjetosController::class, 'updateP'])->name('updateProject');
Route::get('/projeto/{id}', [ProjetosController::class, 'showProject'])->name('project.show');


//Rotas de ChatBot
Route::post('/chatbot', [ChatbotController::class, 'respond']);
Route::get('/chatbot', [ChatbotController::class, 'showChat'])->name('chatbot.show');

//Rota de Favoritar
Route::post('/project/{id}/favorite', [ProjetosController::class, 'favorite'])->name('project.favorite')->middleware('auth');

//Rota de Seguir
Route::post('/follow/{id}', [UserController::class, 'followUser'])->name('followUser');
Route::delete('/unfollow/{id}', [UserController::class, 'unfollowUser'])->name('unfollowUser');

//Rota de Like
Route::post('/project/{id}/like', [ProjetosController::class, 'like'])->name('project.like')->middleware('auth');
