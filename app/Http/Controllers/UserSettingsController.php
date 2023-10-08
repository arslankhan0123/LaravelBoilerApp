<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserSettingsController extends Controller
{
    public function index() {
        $user =  Auth::user();
        return view('admin.userSettings', compact('user'));
    }
}
