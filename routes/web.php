<?php


use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/about', function () {
    return view('about');
})->name('about');
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if ($request->authorize()) {
        $request->fulfill();
        redirect(route($request->user()->role->slug . '.home'));
    } else redirect(route('login'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('verified')->group(function () {
    Route::middleware('access.route:view,admin')->group(function () {
        Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
        Route::get('/admin/home/edit_user_page/{user_id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.edit_user_page');
        Route::post('/admin/home/edit_user/{user_id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.edit_user');
        Route::get('/admin/home/create_user_page', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.create_user_page');
        Route::post('/admin/home/create_user', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.create_user');
        Route::delete('/admin/home/delete_user/{user_id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.delete_user');
        Route::get('/competition/competition_form/{competition_id?}', [App\Http\Controllers\CompetitionsController::class, 'competitionForm'])->name('admin.competition_form');
        Route::get('/competition/competition_description_form/{competition_id}', [App\Http\Controllers\CompetitionsController::class, 'competitionDescriptionForm'])->name('admin.competition_description_form');
        Route::get('/competition/competition_materials_form/{competition_id}', [App\Http\Controllers\CompetitionsController::class, 'competitionMaterialsForm'])->name('admin.competition_materials_form');
        Route::post('/competition/competition_form/{page}/save/{competition_id?}', [App\Http\Controllers\CompetitionsController::class, 'save'])->name('admin.save_competition');
        Route::delete('/competition/delete/{competition_id}', [App\Http\Controllers\CompetitionsController::class, 'delete'])->name('admin.delete_competition');
        Route::get('/competition/holding/{competition_id}', [App\Http\Controllers\CompetitionsController::class, 'holdCompetitionForm'])->name('admin.hold_competition_form');
        Route::post('/competition/{competition_id}/holding/save/{holding_id?}', [App\Http\Controllers\CompetitionsController::class, 'holdCompetition'])->name('admin.hold_competition');
        Route::delete('/competition/holding/delete/{holding_id}', [App\Http\Controllers\CompetitionsController::class, 'deleteHolding'])->name('admin.delete_holding');
        Route::get('/competition/holding/{holding_id}/users', [App\Http\Controllers\CompetitionsController::class, 'holdingUsers'])->name('admin.holding_users');
        Route::get('/competition/holding/{holding_id}/users/{user_id}/download_answer', [App\Http\Controllers\AdminController::class, 'downloadAnswer'])->name('admin.download_answer');
        Route::post('/competition/holding/{holding_id}/users/{user_id}/estimate_answer', [App\Http\Controllers\AdminController::class, 'estimateAnswer'])->name('admin.estimate_answer');

    });

    Route::middleware('access.route:view,user')->group(function () {
        Route::get('/user/home', [App\Http\Controllers\UserController::class, 'index'])
            ->name('user.home');
        // Route::delete('/user/{user_id}/delete', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('user.delete_user');
        Route::post('/user/join/competition/{competition_id}', [App\Http\Controllers\UserController::class, 'joinCompetition'])
            ->name('user.join_competition')->middleware('access.route:join-competition');;
        Route::post('/user/leave/competition/{competition_id}', [App\Http\Controllers\UserController::class, 'leaveCompetition'])
            ->name('user.leave_competition')->middleware('access.route:leave-competition');;
        Route::post('/user/uploadAnswer/{holding_id}', [App\Http\Controllers\UserController::class, 'uploadAnswer'])
            ->name('user.upload_answer')->middleware('access.route:upload-answer');;
    });
    Route::get('/user/{user_id}/edit_page', [App\Http\Controllers\UserController::class, 'editUser'])
        ->name('user.edit_user_page')->middleware('access.route:edit-user');;
    Route::post('/user/{user_id}/edit', [App\Http\Controllers\UserController::class, 'editUser'])
        ->name('user.edit_user')->middleware('access.route:edit-user');;
    Route::get('/user/profile/{user_id}', [App\Http\Controllers\UserController::class, 'profile'])
        ->name('user.profile')->middleware('access.route:view-profile');
    Route::get('/competition/{competition_id}/teaching_materials', [App\Http\Controllers\CompetitionsController::class, 'teachingMaterial'])
        ->name('competition.teaching_materials');


});

Route::get('/competitions', [App\Http\Controllers\CompetitionsController::class, 'index'])->name('competitions');
Route::get('/competition/{competition_id}', [App\Http\Controllers\CompetitionsController::class, 'competition'])->name('competition');
Route::get('/competitions/schedule', [App\Http\Controllers\CompetitionsController::class, 'schedule'])->name('competitions.schedule');


