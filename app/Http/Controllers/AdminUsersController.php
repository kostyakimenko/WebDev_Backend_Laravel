<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => "required|unique:users,name,{$request['user_id']}|max:255",
            'email' => "required|email|unique:users,email,{$request['user_id']}"
        ]);

        if ($validator->fails()) {
            return redirect('admin/users')
                ->withErrors($validator)
                ->with('error_id', $request['user_id']);
        }

        $user = User::where('id', '=', $request['user_id'])->first();
        $user->name = $request['username'];
        $user->role = $request['role'];
        $user->email = $request['email'];
        $user->access = $request['access'];
        $user->save();

        return redirect('admin/users');
    }
}
