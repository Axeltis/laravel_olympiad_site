<?php


use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if ($request->authorize()) {
        $request->fulfill();
        if ($request->user()->role->slug == 'user')
            return redirect(route('user.home'));
        elseif ($request->user()->role->slug == 'moderator')
            return redirect(route('moderator.home'));
        elseif ($request->user()->role->slug == 'admin')
            return redirect(route('admin.home'));
        else redirect(route('login'));
    } else redirect(route('login'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('verified')->group(function () {
    Route::middleware(['access.route:admin'])->group(function () {
        Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
        Route::get('/admin/home/edit_user_page/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.edit_user_page');
        Route::post('/admin/home/edit_user/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.edit_user');
        Route::get('/admin/home/create_user_page', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.create_user_page');
        Route::post('/admin/home/create_user', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.create_user');
        Route::delete('/admin/home/delete_user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.delete_user');
        Route::get('/competition/competition_form/{id?}', [App\Http\Controllers\CompetitionsController::class, 'competitionForm'])->name('admin.competition_form');
        Route::post('/competition/competition_form/save/{id?}', [App\Http\Controllers\CompetitionsController::class, 'save'])->name('admin.save_competition');
        Route::delete('/competition/delete/{id}', [App\Http\Controllers\CompetitionsController::class, 'delete'])->name('admin.delete_competition');
        Route::get('/competition/holding/{id}', [App\Http\Controllers\CompetitionsController::class, 'holdCompetitionForm'])->name('admin.hold_competition_form');
        Route::post('/competition/{competition_id}/holding/save/{id?}', [App\Http\Controllers\CompetitionsController::class, 'holdCompetition'])->name('admin.hold_competition');
        Route::delete('/competition/holding/delete/{id}', [App\Http\Controllers\CompetitionsController::class, 'deleteHolding'])->name('admin.delete_holding');

    });
    Route::middleware(['access.route:moderator'])->group(function () {
        Route::get('/moderator/home/', [App\Http\Controllers\ModeratorController::class, 'index'])->name('moderator.home');
        Route::get('/user/profile/{id}', [App\Http\Controllers\ModeratorController::class, 'userProfile'])->name('user.profile');
    });
    Route::middleware(['access.route:user'])->group(function () {
        Route::get('/user/home', [App\Http\Controllers\UserController::class, 'index'])->name('user.home');
        Route::get('/user/profile/{id}/edit_page', [App\Http\Controllers\UserController::class, 'editUser'])->name('user.edit_user_page');
        Route::post('/user/profile/{id}/edit', [App\Http\Controllers\UserController::class, 'editUser'])->name('user.edit_user');
        Route::delete('/user/profile/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('user.delete_user');

    });
    Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('/competitions', [App\Http\Controllers\CompetitionsController::class, 'index'])->name('competitions');
    Route::get('/competition/{id}', [App\Http\Controllers\CompetitionsController::class, 'competition'])->name('competition');

});


