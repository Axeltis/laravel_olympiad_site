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
        $type_validator=[
            'student'=>Student::rules(),
            'teacher'=>Teacher::rules(),
            'pupil'=>Pupil::rules(),
            'none'=>[]
        ];
        if(array_key_exists($data['type_select'], $type_validator) )
            $validator = User::rules(null,$type_validator[$data['type_select']]);
        else{
            abort(500);
        }

        $validator['password'] = ['required', 'string', 'min:8', 'confirmed'];

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
        $user->role()->associate($role);
        $user->status()->associate($status);
        $user->save();


        switch($data['type_select']) {
            case 'student':
                $student = new Student([
                    'speciality' => $data['student_speciality'],
                    'college' => $data['student_college'],
                    'course' =>$data['student_course']
                ]);
                $student->user()->associate($user);
                $student->save();
                break;
            case 'teacher':
                $teacher = new Teacher([
                    'organization' => $data['teacher_organization'],
                    'position' => $data['teacher_position'],
                ]);
                $teacher->user()->associate($user);
                $teacher->save();
                break;
            case 'pupil':
                $pupil = new Pupil([
                    'organization' => $data['pupil_organization'],
                    'class' =>$data['pupil_class']
                ]);
                $pupil->user()->associate($user);
                $pupil->save();
                break;
        }


        return $user;
    }

}
