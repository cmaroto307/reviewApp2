<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrationController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function create() {
        return view('admin.create', ['types' => self::getTypes()]);
    }

    public function destroy(Request $request) {
        if($request->iduser != Auth::user()->id) {
            $user = User::where('id', $request->iduser);
            $user->delete();
            $message = 'User has been removed.';
            return redirect('admin')->with(['message' => $message]);
        }
        $message = 'User ' . $user->name . ' has not been removed.';
        return redirect('admin')->withErrors(['message' => $message]);
    }

    public function edit(Request $request) {
        $user = User::where('id', $request->iduser)->first();
        return view('admin.edit', ['user' => $user, 'types' => self::getTypes()]);
    }

    private static function getTypes() {
        return [
            'admin'    => 'Administrator',
            'advanced' => 'Advanced User',
            'user'     => 'User',
        ];
    }

    function index() {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }

    public function store(Request $request) {
        try{
            $user = new User();
            $user->name = $request->name;
            $user->type = $request->type;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::parse(Carbon::now());
            $user->password = Hash::make($request->password);
            $user->save();
            $message = 'User has been created.';
            return redirect('admin')->with('message', $message);
        }catch(\Exception $e) {
            return back()->withErrors(['message' => 'An unexpected error occurred while creating']);
        }
    }

    public function update(Request $request) {
        try{
            $user = User::where('id', $request->iduser)->first();
            $user->name = $request->name;
            $user->type = $request->type;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::parse(Carbon::now());
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $user->update();
            $message = 'User has been updated.';
            return redirect('admin')->with('message', $message);
        }catch(\Exception $e) {
            return back()->withErrors(['message' => 'An unexpected error occurred while updating']);
        }
    }
}