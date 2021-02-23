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
                        $user->type->update([
                            'speciality' => $request['student_speciality'],
                            'college' => $request['student_college'],
                            'course' => $request['student_course']
                        ]);
                        $user->type->save();
                        break;
                    case 'teacher':
                        $user->type->update([
                            'organization' => $request['teacher_organization'],
                            'position' => $request['teacher_position'],
                        ]);
                        $user->type->save();
                        break;
                    case 'pupil':
                        $user->type->update([
                            'organization' => $request['pupil_organization'],
                            'class' => $request['pupil_class']
                        ]);
                        $user->type->save();
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
