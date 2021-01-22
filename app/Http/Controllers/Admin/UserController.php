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
        $this->middleware('userPermissions');
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

    public function getPermissions($id){
        $user = User::findOrFail($id);
        $data = ['user' => $user];

        return view('admin.users.permissions', $data);
    }

    public function savePermissions(Request $request, $id){
        $user = User::findOrFail($id);

        $permissions = [
            'dashboard' => $request->input('dashboard'),
            'products_list' => $request->input('products_list'),
            'products_add' => $request->input('products_add'),
            'products_edit' => $request->input('products_edit'),
            'products_delete' => $request->input('products_delete'),
            'product_gallery_add' => $request->input('product_gallery_add'),
            'product_gallery_delete' => $request->input('product_gallery_delete'),
            'category_list' => $request->input('category_list'),
            'category_add' => $request->input('category_add'),
            'category_edit' => $request->input('category_edit'),
            'category_delete' => $request->input('category_delete'),
            'users_list' => $request->input('users_list'),
            'users_edit' => $request->input('users_edit'),
            'users_ban' => $request->input('users_ban'),
            'users_active' => $request->input('users_active'),
            'users_permissions' => $request->input('users_permissions'),
        ];
        $permissions = json_encode($permissions);

        $user->permissions = $permissions;

        if($user->save()){
            return back()->with('message', 'Permissons granted successfully')
                    ->with('typealert', 'success');
        }

        return back()->with('message', 'An error has occurred')
                    ->with('typealert', 'danger');
    }
}
