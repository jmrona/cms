<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ConnectController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }

    // Login
    public function getLogin(){
        return view('connect.login');
    }

    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)
                         ->with('message', 'An error has occurred')
                         ->with('typealert', 'danger');
        }

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credential, $remember = true)){
            return redirect('/');
        }else{
            return back()->with('message', 'Your credential are not exist or wrong')
                         ->with('typealert', 'danger');
        }


    }

    //Register
    public function getRegister(){
        return view('connect.register');
    }

    public function postRegister( Request $request ){
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];

        $messages = [
            'cpassword.same' => 'Confirm password doesn\'t match'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)
                         ->with('message', 'An error has occurred')
                         ->with('typealert', 'danger');
        }

        $user = new User();
        $user->firstname = e($request->firstname);
        $user->lastname = e($request->lastname);
        $user->email = e($request->email);
        $user->password = Hash::make($request->password);
        $user->save();

        if($user->save()){
            return redirect('/login');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/login');
    }

}
