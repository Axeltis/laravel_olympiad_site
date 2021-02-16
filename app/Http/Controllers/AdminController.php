<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserStatus;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{


    public function index()
    {
        $users = User::all();
        return view('admin.home', ['users' => $users]);
    }

    public function createUser(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                $roles = Role::all();
                $statuses = UserStatus::all();
                return view('admin.create_user', ['statuses' => $statuses, 'roles' => $roles]);
                break;
            case 'POST':
                $this->create_validator($request->all())->validate();
                $data = [
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                    'password'=> $request['password'],
                ];
                $user = new User($data);
                $role = Role::where('slug', $request['role'])->first();
                $status = UserStatus::where('slug', $request['status'])->first();

                $user->role()->associate($role);
                $user->status()->associate($status);

                $user->save();
                return redirect(route('admin.home'));
                break;
        }
    }

    public function editUser(Request $request, $id)
    {
        switch ($request->method()) {
            case 'GET':
                $user = User::find($id);
                $roles = Role::all();
                $statuses = UserStatus::all();
                return view('admin.edit_user', ['statuses' => $statuses, 'user' => $user, 'roles' => $roles]);
                break;
            case 'POST':
                $this->edit_validator($request->all())->validate();
                $user = User::find($request['id']);
                $data = [
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                ];
                $user->update($data);
                $role = Role::where('slug', $request['role'])->first();
                $status = UserStatus::where('slug', $request['status'])->first();

                $user->role()->associate($role);
                $user->status()->associate($status);

                $user->save();
                return redirect(route('admin.home'));
                break;

        }
    }


    protected function create_validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['required', 'string', 'max:60'],
            'middlename' => ['string', 'max:60'],
            'phone' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', 'date', 'date_format:Y-m-d']
        ]);
    }

    protected function edit_validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['required', 'string', 'max:60'],
            'middlename' => ['string', 'max:60'],
            'phone' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'birth_date' => ['required', 'date', 'date_format:Y-m-d']
        ]);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect(route('admin.home'));
    }

}
