<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\HoldingCompetition;
use App\Models\Pupil;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use ZipArchive;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', $request->user()->id)->get();
        $competitions = Competition::all();
        return view('admin.home', ['users' => $users, 'competitions' => $competitions]);
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
                $user = new User([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                    'password' => bcrypt($request['password']),
                ]);
                $role = Role::where('slug', $request['role'])->first();
                $status = UserStatus::where('slug', $request['status'])->first();

                $user->role()->associate($role);
                $user->status()->associate($status);

                switch ($request['type_select']) {
                    case 'student':
                        $student = new Student([
                            'speciality' => $request['student_speciality'],
                            'college' => $request['student_college'],
                            'course' => $request['student_course']

                        ]);
                        $student->save();
                        $user->type()->associate($student);
                        break;
                    case 'teacher':
                        $teacher = new Teacher([
                            'organization' => $request['teacher_organization'],
                            'position' => $request['teacher_position'],
                        ]);
                        $teacher->save();
                        $user->type()->associate($teacher);
                        break;
                    case 'pupil':
                        $pupil = new Pupil([
                            'organization' => $request['pupil_organization'],
                            'class' => $request['pupil_class']
                        ]);
                        $pupil->save();
                        $user->type()->associate($pupil);
                        break;
                }
                $user->save();
                return redirect(route('admin.home'));
                break;
        }
    }

    public function editUser(Request $request, $user_id)
    {
        switch ($request->method()) {
            case 'GET':
                $user = User::find($user_id);
                $roles = Role::all();
                $statuses = UserStatus::all();
                return view('admin.edit_user', ['statuses' => $statuses, 'user' => $user, 'roles' => $roles]);
                break;
            case 'POST':
                $this->edit_validator($request->all())->validate();

                $user = User::find($request['id']);

                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                ]);
                $role = Role::where('slug', $request['role'])->first();
                $status = UserStatus::where('slug', $request['status'])->first();

                $user->role()->associate($role);
                $user->status()->associate($status);
                if ($user->type) $user->type->delete();
                switch ($request['type_select']) {
                    case 'student':
                        $student = new Student([
                            'speciality' => $request['student_speciality'],
                            'college' => $request['student_college'],
                            'course' => $request['student_course']

                        ]);
                        $student->save();
                        $user->type()->associate($student);
                        break;
                    case 'teacher':
                        $teacher = new Teacher([
                            'organization' => $request['teacher_organization'],
                            'position' => $request['teacher_position'],
                        ]);
                        $teacher->save();
                        $user->type()->associate($teacher);
                        break;
                    case 'pupil':
                        $pupil = new Pupil([
                            'organization' => $request['pupil_organization'],
                            'class' => $request['pupil_class']
                        ]);
                        $pupil->save();
                        $user->type()->associate($pupil);
                        break;
                }
                $user->save();
                return redirect(route('admin.home'));
                break;

        }
    }


    protected function create_validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $type_validator = [
            'student' => Student::rules(),
            'teacher' => Teacher::rules(),
            'pupil' => Pupil::rules(),
            'none' => []
        ];


        if (array_key_exists($data['type_select'], $type_validator))
            $validator = User::rules(null, $type_validator[$data['type_select']]);
        else {
            abort(500);
        }

        $validator['password'] = ['required', 'string', 'min:8', 'confirmed'];

        return Validator::make($data, $validator);
    }

    protected function edit_validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $type_validator = [
            'student' => Student::rules(),
            'teacher' => Teacher::rules(),
            'pupil' => Pupil::rules(),
            'none' => []
        ];

        if (array_key_exists($data['type_select'], $type_validator))
            $validator = User::rules($data['id'], $type_validator[$data['type_select']]);
        else {
            abort(500);
        }

        return Validator::make($data, $validator);
    }

    public function deleteUser($user_id)
    {
        $user = User::find($user_id);
        foreach ($user->holdings as $holding) {
            $path = Competition::answers_folder_path . $holding->id . '/' . $user_id;
            $files = Storage::disk('public')
                ->files($path);
            Storage::delete($files);
        }
        $user->delete();
        return redirect(route('admin.home'));
    }

    public function downloadAllAnswers(Request $request, $holding_id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $path = Competition::answers_folder_path . $holding_id . '/';
        $path =Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$path;
        $zip_file = $path . 'answers.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        foreach ($files as  $file)
        {
            $filePath     = $file->getRealPath();
            // We're skipping all subfolders
            if (!$file->isDir()) {
                if($file->getFilename()!='answers.zip') {
                    $zip->addFile($filePath, $file->getFilename());
                }

            }
        }

        $zip->close();
        return response()->download($zip_file);
    }

    public function downloadAnswer(Request $request, $holding_id, $user_id)
    {
        //$holding = HoldingCompetition::find($holding_id);
        //$user = User::find($user_id);
        $path = Competition::answers_folder_path . $holding_id . '/' . $user_id;
        $files = Storage::disk('public')
            ->files($path);
        foreach ($files as $file) {
            return Storage::disk('public')->download($file);
        }
        return redirect()->back();

    }

    public function estimateAnswer(Request $request, $holding_id, $user_id): \Illuminate\Http\RedirectResponse
    {
        $holding = HoldingCompetition::find($holding_id);
        $user = User::find($user_id);
        if ($user and $holding) {
            $competition = $holding->competition()->first();
            Validator::make($request->all(), ['points' => ['required', 'int', 'max:' . $competition->max_points], 'min:0'])->validate();
            $holding->users()->updateExistingPivot($user, ['points' => $request['points']]);

        }
        return redirect()->back();
    }
}
