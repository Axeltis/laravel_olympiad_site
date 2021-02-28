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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function uploadAnswer(Request $request, $holding_id): \Illuminate\Http\RedirectResponse
    {

        Validator::make($request->all(), ['answer_file' => ['required', 'file', 'max:4000000']])->validate();
        $holding = HoldingCompetition::find($holding_id);
        $holding->users()->updateExistingPivot($request->user(), ['file_attached' => true]);
        $path = Competition::answers_folder_path . '\\' . $holding->id.'\\'.$request->user()->id;
        if (!Storage::disk('public')->missing($path)) {
            $file = Storage::disk('public')
                ->get($path);
        }
        Storage::disk('public')->delete($file);
        $file = $request->file('answer_file');
        $file->storeAs($path, 'public');
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $holdings = $user->holdings;

        return view('user.home', ['user' => $user, 'holdings' => $holdings]);
    }

    public function profile($user_id)
    {
        $user = User::where('id', $user_id)->first();
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

    public function editUser(Request $request, $user_id)
    {
        switch ($request->method()) {
            case 'GET':
                $user = User::find($user_id);
                return view('user.edit_user', ['user' => $user]);
                break;
            case 'POST':
                $this->edit_validator($request->all())->validate();

                $user = User::find($user_id);;

                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'middlename' => $request['middlename'],
                    'phone' => $request['phone'],
                   // 'email' => $request['email'],
                    'birth_date' => $request['birth_date'],
                ]);
                $user->save();

                switch (User::types_slug[$user->type_name]) {
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
                }
                return redirect(route($user->role->slug.'.home'));
                break;
        }
    }

    public function deleteUser($user_id)
    {
        User::find($user_id)->delete();

        return redirect(route('admin.home'));
    }

    public function joinCompetition(Request $request, $competition_id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $competition = Competition::find($competition_id);

        if ($user->type_name == $competition->user_type) {
            //$user->competitions()->attach($competition->current_holding);
            if($competition->current_holding->first())
            $user->holdings()->syncWithoutDetaching([$competition->current_holding->first()->id]);
        }

        return redirect(route($user->role->slug . '.home'));
    }

    public function leaveCompetition(Request $request, $competition_id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $competition = Competition::find($competition_id);
        if ($user->type_name == $competition->user_type) {
            $user->holdings()->where('holding_competition_id', $competition->current_holding->first()->id)->detach();
        }
        return redirect(route($user->role->slug . '.home'));
    }
}
