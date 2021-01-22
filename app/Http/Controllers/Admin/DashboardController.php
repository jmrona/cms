<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware('userPermissions');
        $this->middleware('userStatus');
    }

    public function getDashboard(){
        return view('admin.dashboard');
    }
}
