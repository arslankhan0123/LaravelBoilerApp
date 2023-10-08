<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSettingsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/UserSettings', [UserSettingsController::class, 'index'])->name('user.settings');
    Route::get('/user/view', [UserSettingsController::class, 'index'])->name('userView');
    Route::post('/user/view/edit/{user_name}', [UserSettingsController::class, 'getUserProfileViewEdit']);
    Route::get('/checkboxGet', [UserSettingsController::class, 'checkboxGet'])->name('checkbox.get');
    // Route::post('/checkbox/store', [UserSettingsController::class, 'index'])->name('2fa.enable.store');
    Route::post('/store-radio-value', [UserSettingsController::class, 'store']);
    // Route::post('/store-radio-value', 'RadioValueController@storeRadioValue');

    Route::post('/emailSenttOEnable2FA', [UserSettingsController::class, 'emailSent'])->name('email.sent');
    Route::post('/enableEmailOtpVerify', [UserSettingsController::class, 'checkEmailOtp'])->name('enable.email.otp');
    Route::post('/qrCodeOtpVerify', [UserSettingsController::class, 'index'])->name('qrcode.otp.verify');
    Route::post('/qrCodeSecondOtpVerify', [UserSettingsController::class, 'index'])->name('qrcode.second.otp.verify');
    Route::post('/qrCodeOldOtpVerify', [UserSettingsController::class, 'index'])->name('qrcode.old.otp.verify');
    Route::post('/emailCodeOldOtpVerify', [UserSettingsController::class, 'index'])->name('email.old.otp.verify');
    Route::post('/emailCodeOldOtpVerifyForNull', [UserSettingsController::class, 'index'])->name('email.old.otp.verify.for.null');
    Route::post('/qrCodeOldOtpVerifyForNull', [UserSettingsController::class, 'index'])->name('qr.old.otp.verify.for.null');
    Route::get('/emailOtpNull', [UserSettingsController::class, 'index'])->name('email_otp_null');
});

require __DIR__.'/auth.php';
