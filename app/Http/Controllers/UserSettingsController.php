<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserSetting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailOtpMail;
use Illuminate\Support\Facades\Validator;
use PragmaRX\Google2FALaravel\Support\Authenticator;
// use PragmaRX\Google2FA\Google2FA;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserSettingsController extends Controller
{
    public function index() {
        $user =  Auth::user();
        return view('admin.userSettings', compact('user'));
    }

    public function checkboxGet() {
        $user = Auth::user();
        $checkBoxValue = User::where('email', $user->email)->value('twoFA_enable');
        return response()->json([
            'message' => 'Value stored successfully',
            'user' => $user,
            'checkBoxValue' => $checkBoxValue,
        ]);
    }

    public function store(Request $request) {
        $selectedValue = $request->input('selected_value');
        $user = Auth::user();
        if($selectedValue == 'email_enable') {
            if($user->twoFA_enable == 'email_enable') {
                return response()->json([
                    'status' => true,
                    'message' => "alreadyupdated",
                ], 200);
            }
        }
        return response()->json([
            'message' => 'Value stored successfully',
            'user' => $user,
            'selectedValue' => $selectedValue,
        ]);
    }

    public function emailSent(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $email = $request->email;
        $radioButtonValue = $request->radioButtonValue;
        $otp = mt_rand(100000, 999999);
        $user = Auth::user();
        $user->email_otp = $otp;
        $user->save();
        return response()->json([
            'message' => 'Email send Successfully',
            'user' => $user,
            'radioButtonValue' => $radioButtonValue,
            'otp' => $otp,
        ]);
    }

    public function checkEmailOtp(Request $request) {
        $selectedCheckbox = $request->radioButtonSecondValue;
        $otp = implode('', $request->only(['email_otp1', 'email_otp2', 'email_otp3', 'email_otp4', 'email_otp5', 'email_otp6']));
        $user = Auth::user();
        $user->save();
        if($user->email_otp == $otp) {
            $user->twoFA_enable = $selectedCheckbox;
            $user->email_otp = NULL;
            $user->save();

            return response()->json([
                'radioButtonSecondQrValue' => $selectedCheckbox,
                'status' => true,
                'message' => "Success",
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Invalid OTP",
            ], 400);
        }
    }

    public function qrCodeOtpVerify(Request $request) {
        $google2fa_secret_Qr = session('google2fa_secret_Qr');
        $google2faUrl = $google2fa_secret_Qr['google2faUrl'];
        $google2fa_secret = $google2fa_secret_Qr['google2fa_secret'];
        // dd($google2fa_secret_Qr);
        $user = DB::connection('conn_laundry_super')->table('users')->where('user_name', Auth::user()->user_name)->first();
        $google2fa = app(Authenticator::class);
        $otp = implode('', $request->only(['qr_otp1', 'qr_otp2', 'qr_otp3', 'qr_otp4', 'qr_otp5', 'qr_otp6']));
        $valid = $google2fa->verifyKey($user->google2fa_secret, $otp);
        // dd($valid);
        if($valid) {
            $qrCodeFirstOtp = [
                'otp' => $otp,
            ];
            session()->put('qrCodeFirstOtp', $qrCodeFirstOtp);
            return response()->json([
                'radioButtonQrValue' => $request->radioButtonQrValue,
                'status' => true,
                'message' => "Success",
                'google2faUrl' => $google2faUrl,
                'google2fa_secret' => $google2fa_secret,
                'qr_otp1' => $request->qr_otp1,
                'qr_otp2' => $request->qr_otp2,
                'qr_otp3' => $request->qr_otp3,
                'qr_otp4' => $request->qr_otp4,
                'qr_otp5' => $request->qr_otp5,
                'qr_otp6' => $request->qr_otp6,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Invalid OTP",
            ], 400);
        }
    } 
}
