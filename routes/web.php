<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Manager\MemberController;
use App\Http\Controllers\Manager\TaskController;
use App\Http\Controllers\Manager\TeamController;
use App\Http\Controllers\TeamController as ControllersTeamController;

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

// ------------------------------
// 1つずつのエンドポイントを定義する方式
Route::get('/', function () {
    return view('welcome'); // 動作するロジックをここに直接書くこともできるが、あまり多くは使われない
})->name('home');

// エンドポイントに対応したControllerのメソッドを定義する方式
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ------------------------------
// 階層的に、かつ複数のエンドポイントを定義する方式
Route::middleware(['auth', 'ensureAdmin']) // 適用したいMiddleware名（ app/Http/Kernel.phpで定義 ）
    ->prefix('admin') // URLの接頭辞として使われる（ ex. http://localhost:3000/admin/users ）
    ->name('admin.') // 名前付きrouteでURLを呼び出すときの接頭辞（ ex. route('admin.users.index') ）
    ->group(function () {
        Route::resource('/users', UserController::class); // Admin/UserControllerの決められた名前のメソッドに一気に関連づく
    });

Route::middleware(['auth'])  // managerかどうか判定するミドルウェアまだ
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        // Team関係
        Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
        Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
        Route::post('/teams/store', [TeamController::class, 'store'])->name('teams.store');
        Route::patch('/team/{team}', [TeamController::class, 'update'])->name('teams.update');

        // Task関係
        Route::resource('/teams.tasks', TaskController::class);

        // Member関係
        Route::resource('/teams.members', MemberController::class);
    });

Route::prefix('teams')
    ->group(function () {
        Route::get('/', [ControllersTeamController::class, 'index'])->name('teams.index');
        Route::get('/create', [ControllersTeamController::class, 'create'])->name('teams.create');
        Route::post('/store', [ControllersTeamController::class, 'store'])->name('teams.store');
    });
