<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomeAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $user = User::find(Auth::user()->id);
        if($this->middleware("role:$user->roles[0]->name")){
           echo ($user->roles[0]->name);
           $view_folder = strval($user->roles[0]->name);
            return view("$view_folder.home");
        }
//        $this->middleware('role:role_visitor');
//        return view('admin.home');
    }
}
