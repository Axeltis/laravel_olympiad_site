<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\RedirectToHome;
use App\Models\Pupil;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserStatus;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, RedirectToHome;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $user_validator=[
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['required', 'string', 'max:60'],
            'middlename' => ['required', 'string', 'max:60'],
            'phone' => ['required', 'string', 'max:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', 'date', 'date_format:Y-m-d']
        ];
        $student_validator= [
            'college' => ['required', 'string', 'max:70'],
            'speciality' => ['required', 'string', 'max:70'],
            'course' => ['required', 'int', 'max:6', 'min:1'],
        ];
        $teacher_validator=[
            'college' => ['required', 'string', 'max:70'],
            'position' => ['required', 'string', 'max:70'],
        ];
        $pupil_validator =[
            'organization' => ['required', 'string', 'max:70'],
            'class' => ['required', 'int', 'max:11', 'min:1'],
        ];
        $type_validator=[
            'student'=>$student_validator,
            'teacher'=>$teacher_validator,
            'pupil'=>$pupil_validator
        ];

        if( array_key_exists($data['type_select'], $type_validator) )
        $validator = array_merge($user_validator,$type_validator[$data['type_select']]);
        else{
            abort(500);
        }
        return Validator::make($data, $validator);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data): User
    {
        $user = new User([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'middlename' => $data['middlename'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'password' => bcrypt($data['password']),
        ]);
        $role = Role::where('slug', 'user')->first();
        $status = UserStatus::where('slug', 'waiting')->first();

        switch ($data['type_select']) {
            case 'student':
                $student = new Student([
                    'speciality' => $data['speciality'],
                    'college' => $data['college'],
                    'course' => $data['course']
                ]);
                $student->user()->associate($user);
                $student->save();
                break;
            case 'teacher':

                $teacher = new Teacher([
                    'organization' => $data['organization'],
                    'position' => $data['position'],
                ]);
                $teacher->user()->associate($user);
                $teacher->save();
                break;
            case 'pupil':

                $pupil = new Pupil([
                    'organization' => $data['organization'],
                    'class' => $data['class']
                ]);
                $pupil->user()->associate($user);
                $pupil->save();
                break;


        }


        return $user;
    }

}
