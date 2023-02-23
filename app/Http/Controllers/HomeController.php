<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function home() {
        return view('home');
    }
    
    public function update(Request $request) {
        $validatedData = $this->validateInput($request);
        $message = 'User data has been updated.';
        $sendEmail = false;
        $user = Auth::user();
        $user->name = $request->name;
        if($request->password != null && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->input('password'));
        } elseif($request->password != null) {
            return back()->withInput()->withErrors([
                                                'message' => 'User hasn\'t been updated',
                                                'old_password' => 'Old password does not match password.']);
        }
        if($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $sendEmail = true;
        }
        if (!$user->updateUser($sendEmail)) {
            return back()
                     ->withInput()
                     ->withErrors(['message' => 'An unexpected error occurred while updating.']);
        }
        if($sendEmail) {
            $user->sendEmailVerificationNotification();
        }
        return redirect('home')->with('message', $message);
    }

    private function validateInput(Request $request) {
        return $request->validate([
            'email'         => 'required|email',
            'name'          => 'required|min:2|max:100',
            'old_password'  => 'nullable|min:8',
            'password'      => 'nullable|min:8|confirmed',
        ]);
    }
}
