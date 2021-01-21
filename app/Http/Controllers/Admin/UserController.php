<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware('userStatus');
    }

    public function index($status){
        if (is_numeric($status)){
            $users = User::where('status', $status)->orderBy('id', 'Asc')->paginate(10);
            $data = ['users' => $users];

            return view('admin.users.home', $data);
        };

        $users = User::orderBy('id', 'Asc')->paginate(10);
        $data = ['users' => $users];

        return view('admin.users.home', $data);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $data = ['user' => $user];

        return view('admin.users.edit', $data);

    }

    public function banUser($id){

        $user = User::findOrFail($id);

        if($user->status == '100'){
            return back()->with('message', 'This user is already banned')
                    ->with('typealert', 'info');
        }

        $user->status = '100';

        if($user->save()){
            return back()->with('message', 'User banned successfully')
                    ->with('typealert', 'success');
        }

        return back()->with('message', 'User couldn\'t be banned')
                    ->with('typealert', 'danger');
    }

    public function activeUser($id){

        $user = User::findOrFail($id);

        if($user->status == '1' || $user->status == '0'){
            return back()->with('message', 'This user is already active')
                    ->with('typealert', 'info');
        }

        $user->status = '0';

        if($user->save()){
            return back()->with('message', 'User actived successfully')
                    ->with('typealert', 'success');
        }

        return back()->with('message', 'User couldn\'t be actived')
                    ->with('typealert', 'danger');
    }
}
