<?php

use App\Http\Controllers\FormationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\Presence;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {return view('welcome');})->name('welcome');

Route::fallback(function () {return view('error.error');});

Auth::routes();

//Information
Route::get('/infos/general', [App\Http\Controllers\HomeController::class, 'general'])->name('general.infos');
Route::get('/infos/groups', [App\Http\Controllers\HomeController::class, 'groups'])->name('general.groups');
Route::get('/infos/sessions', [App\Http\Controllers\HomeController::class, 'sessions'])->name('general.sessions');
Route::get('/infos/presentiel', [App\Http\Controllers\HomeController::class, 'presentiel'])->name('general.presentiel');

//USERS
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->name('users.post');

Route::get('/users/list', [UserController::class, 'index'])->name('users.list');
Route::get('/users/{id}',[UserController::class, 'show'])->name('users.show');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

Route::get('/users_edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users_update/{id}', [UserController::class, 'update'])->name('users.update');


//FORMATION
Route::get('/download_student_list/{id}', [FormationController::class, 'download'])->name('formations.download');

Route::get('/formations/create', [FormationController::class, 'create'])->name('formations.create');
Route::post('/formations/create', [FormationController::class, 'store'])->name('formations.post');

Route::get('/formations/list', [FormationController::class, 'index'])->name('formations.list');
Route::get('/formations/{id}',[FormationController::class, 'show'])->name('formations.show');

Route::delete('/formations/{id}', [FormationController::class, 'destroy'])->name('formations.delete');

Route::get('/formations_edit/{id}', [FormationController::class, 'edit'])->name('formations.edit');
Route::post('/formations_update/{id}', [FormationController::class, 'update'])->name('formations.update');


//GROUPS
Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
Route::post('/groups/create', [GroupController::class, 'store'])->name('groups.post');

Route::get('/groups/list', [GroupController::class, 'index'])->name('groups.list');
Route::get('/groups/{id}',[GroupController::class, 'show'])->name('groups.show');

Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.delete');

Route::get('/groups_edit/{id}', [GroupController::class, 'edit'])->name('groups.edit');

Route::post('/groups_update/{id}', [GroupController::class, 'update'])->name('groups.update');


//Subjects
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects/create', [SubjectController::class, 'store'])->name('subjects.post');

Route::get('/subjects/list', [SubjectController::class, 'index'])->name('subjects.list');
Route::get('/subjects/{id}',[SubjectController::class, 'show'])->name('subjects.show');

Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.delete');

Route::get('/subjects_edit/{id}', [SubjectController::class, 'edit'])->name('subjects.edit');

Route::post('/subjects_update/{id}', [SubjectController::class, 'update'])->name('subjects.update');


//Sessions
Route::get('/download_presence/{id}', [SessionController::class, 'download'])->name('sessions.download');

Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions/create', [SessionController::class, 'store'])->name('sessions.post');

Route::get('/sessions/list', [SessionController::class, 'index'])->name('sessions.list');
Route::get('/sessions/{id}',[SessionController::class, 'show'])->name('sessions.show');

Route::delete('/sessions/{id}', [SessionController::class, 'destroy'])->name('sessions.delete');

Route::get('/sessions_edit/{id}', [SessionController::class, 'edit'])->name('sessions.edit');

Route::post('/sessionscc/{id}', [SessionController::class, 'update'])->name('sessions.update');





Route::get('/presentiel_edit/{id}', [PresenceController::class, 'edit'])->name('presence.edit');
Route::get('/presentiel_show/{id}',[PresenceController::class, 'show'])->name('presences.show');

Route::post('/presentiel/{id}', [PresenceController::class, 'store'])->name('presence.post');
Route::post('/presentiel_update/{id}', [PresenceController::class, 'update'])->name('presence.update');
Route::get('/presentiel/{id}', [PresenceController::class, 'create'])->name('presence.create');
