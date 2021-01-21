<?php

namespace App\Http\Controllers;

use App\Mail\UserSendNewPassword;
use App\Mail\UserSendRecover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


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
            if(Auth::user()->status == '100'){
                return redirect('/logout');
            }

            if(Auth::user()->role == '1'){
                return redirect('/admin');
            }

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
            return redirect('/');
        }
    }

    public function getLogout(){
        if(Auth::user()->status == '100'){
            Auth::logout();
            return redirect('/login')->with('message', 'Access prohibited, please contact the administrator')
                     ->with('typealert', 'danger');
        }

        Auth::logout();
        return redirect('/login');
    }

    public function recoverPassword(){
        return view('connect.recover');
    }

    public function postRecoverPassword(Request $request){
        $rules = [
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)
                         ->with('message', 'An error has occurred')
                         ->with('typealert', 'danger');
        }

        $user = User::where('email', trim(($request->email)))->first();

        if(!$user){
            return back()->withErrors($validator)
                         ->with('message', 'An error has occurred, please contact the administrator')
                         ->with('typealert', 'danger');
        }

        $code = rand(100000, 999999);
        $data = [
            'name' => $user->firstname,
            'email' => $user->email,
            'code' => $code,
        ];

        $user->password_code = $code;
        if($user->save()){
            Mail::to($user->email)->send(new UserSendRecover($data));

            return redirect('/reset?email='.$user->email)->with('message', 'We sent an email to recover your password, please check it')
            ->with('typealert', 'info');
        }

    }

    public function resetPassword(Request $request){
        $data = ['email' => $request->get('email')];

        return view('connect.reset', $data);
    }

    public function postResetPassword(Request $request){
        $rules = [
            'email' => 'required|email',
            'code' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)
                         ->with('message', 'An error has occurred')
                         ->with('typealert', 'danger');
        }

        $user = User::where('email', $request->email)->where('password_code', $request->code)->first();

        if(!$user){
            return back()->with('message', 'We didn\'t find an user with this email or the recovery code doesn\'t match')
                        ->with('typealert', 'danger');
        }

        $new_password = Str::random(8);
        $user->password = Hash::make($new_password);
        $user->password_code = null;

        if($user->save()){
            $data = [
                'name' => $user->firstname,
                'new_password' => $new_password,
            ];
            Mail::to($user->email)->send(new UserSendNewPassword($data));
            return redirect('/login')->with('message', 'Password was reset successfully, please check your email')
            ->with('typealert', 'success');
        }
    }
}
