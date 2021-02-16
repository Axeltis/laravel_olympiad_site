<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.home');
    }
    public function userProfile($id)
    {
        $user = User::where('id',$id)->first();
        return view('user.profile',['user'=>$user]);
    }
}
