<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TurnTypeController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MultimediaController;

Route::get('/', function () {
    return redireccionarSiEsNecesario();
})->name('home')->middleware('auth');

Route::get('/dashboard', function () {
    return redireccionarSiEsNecesario();
})->name('dashboard')->middleware('auth');

function redireccionarSiEsNecesario() {
    $turnController = new TurnController();
    $company_id = auth()->user()->company_id;
    $turnsCounts = $turnController->obtenerTotalesPorPeriodo($company_id);

    $statusTranslations = [
        'pending' => 'Pendiente',
        'processing' => 'En proceso',
        'completed' => 'Completado',
        'cancelled' => 'Cancelado',
    ];

    $statusIcons = [
        'pending' => 'ni ni-time-alarm',
        'processing' => 'ni ni-user-run',
        'completed' => 'ni ni-check-bold',
        'cancelled' => 'ni ni-fat-delete',
    ];

    return view('pages.dashboard', compact('turnsCounts', 'statusTranslations', 'statusIcons'));
}




Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register-2', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform2');
Route::post('/register', [RegisterController::class, 'user'])->middleware('guest')->name('register.perform');
//Route::get('/tmp', [RegisterController::class, 'userTmp'])->middleware('guest')->name('register.tmp');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
//Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	//Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	//Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	//Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	//Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	//Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	//Route::get('/page/{page}', [PageController::class, 'index'])->name('page');
	Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');



	Route::resource('companies', CompanyController::class);
	Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

	Route::get('/categorias/turnos', [TurnTypeController::class, 'index'])->name('turntype');
	Route::get('/categorias/turnos/crear', [TurnTypeController::class, 'create'])->name('turntype.create');
	Route::post('/categorias/turnos/store', [TurnTypeController::class, 'store'])->name('turntype.store');
	Route::get('/categorias/turnos/editar/{id}', [TurnTypeController::class, 'edit'])->name('turntype.edit');
	Route::post('/categorias/turnos/editar/{id}', [TurnTypeController::class, 'update'])->name('turntype.update');
	Route::get('/categorias/turnos/delete/{id}', [TurnTypeController::class, 'destroy'])->name('turntype.delete');

	Route::get('/categorias/modulos', [ModuleController::class, 'index'])->name('module');
	Route::get('/categorias/modulos/crear', [ModuleController::class, 'create'])->name('module.create');
	Route::post('/categorias/modulos/store', [ModuleController::class, 'store'])->name('module.store');
	Route::get('/categorias/modulos/editar/{id}', [ModuleController::class, 'edit'])->name('module.edit');
	Route::post('/categorias/modulos/editar/{id}', [ModuleController::class, 'update'])->name('module.update');
	Route::get('/categorias/modulos/delete/{id}', [ModuleController::class, 'destroy'])->name('module.delete');


	Route::get('/turnos', [TurnController::class, 'index'])->name('turn');
	Route::get('/turnos/crear', [TurnController::class, 'create'])->name('turn.create');
	Route::get('/turnos/calendario', [TurnController::class, 'calendar'])->name('turn.calendar');
	Route::get('/turnos/calendarioAPI', [TurnController::class, 'calendarAPI'])->name('turn.calendarAPI');
	Route::post('/turnos/store', [TurnController::class, 'store'])->name('turn.store');
	Route::get('/turnos/editar/{id}', [TurnController::class, 'edit'])->name('turn.edit');
	Route::post('/turnos/editar/{id}', [TurnController::class, 'update'])->name('turn.update');
	Route::get('/turnos/delete/{id}', [TurnController::class, 'destroy'])->name('turn.delete');


	Route::get('/multimedia', [MultimediaController::class, 'index'])->name('multimedia');
	Route::get('/multimedia/crear', [MultimediaController::class, 'create'])->name('multimedia.create');
	Route::post('/multimedia/store', [MultimediaController::class, 'store'])->name('multimedia.store');
	Route::get('/multimedia/editar/{id}', [MultimediaController::class, 'edit'])->name('multimedia.edit');
	Route::post('/multimedia/editar/{id}', [MultimediaController::class, 'update'])->name('multimedia.update');
	Route::get('/multimedia/delete/{id}', [MultimediaController::class, 'destroy'])->name('multimedia.delete');


});
