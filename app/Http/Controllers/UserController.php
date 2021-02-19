<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.home');
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.profile', ['user' => $user]);
    }

    protected function edit_validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $type_validator = [
            'student' => Student::rules(),
            'teacher' => Teacher::rules(),
            'pupil' => Pupil::rules(),
            'none' => []
        ];


        $validator = User::rules($data['id'], $type_validator[$data['type']]);


        return Validator::make($data, $validator);
    }

    public function editUser(Request $request, $id)
    {
        switch ($request->method()) {
            case 'GET':
                $user = User::find($id);
                return view('user.edit_user', ['user' => $user]);
                break;
            case 'POST':
                $this->edit_validator($request->all())->validate();

                $user =  User::find($id);;

                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                ]);
                $user->save();

                switch ($user->type()) {
                    case 'student':
                        $user->asStudent->update([
                            'speciality' => $request['speciality'],
                            'college' => $request['college'],
                            'course' => $request['course']
                        ]);
                        break;
                    case 'teacher':
                        $user->asTeacher->update([
                            'organization' => $request['organization'],
                            'position' => $request['position'],
                        ]);
                        break;
                    case 'pupil':
                        $user->asPupil->update([
                            'organization' => $request['organization'],
                            'class' => $request['class']
                        ]);
                        break;
                    default:
                        break;
                }
                return redirect(route('user.profile',['id'=>$id]));
                break;
        }
    }
        public function deleteUser($id)
        {
            User::find($id)->delete();

            return redirect(route('admin.home'));
        }


}
