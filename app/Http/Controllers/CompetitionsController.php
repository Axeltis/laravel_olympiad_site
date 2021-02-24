<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\HoldingCompetition;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompetitionsController extends Controller
{

    public function index(Request $request)
    {
        $competitions = Competition::all();

        return view('competitions', ['competitions' => $competitions]);
    }

    public function holdCompetitionForm(Request $request, $id)
    {
        $competition = Competition::find($id);
        return view('admin.hold_competition_form', ['competition' => $competition]);

    }

    public function holdCompetition(Request $request, $competition_id): \Illuminate\Http\RedirectResponse
    {
        $holding = HoldingCompetition::find($request['id']);
        $competition = Competition::find($competition_id);
        $data = [
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date']
        ];
        if ($holding) {
            $holding->update($data);
        } else {
            $holding = new HoldingCompetition($data);
        }
        $holding->competition()->associate($competition);
        $holding->save();
        return redirect()->back();
    }

    public function deleteHolding(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        HoldingCompetition::find($id)->delete();

        return redirect()->back();
    }

    public function competition(Request $request, $id)
    {
        $competition = Competition::find($id);
        return view('competition', ['competition' => $competition]);
    }

    public function competitionForm($id = null)
    {
        $competition = Competition::find($id);

        return view('admin.competition.competition_form', ['competition' => $competition, 'id' => $id]);
    }

    public function competitionDescriptionForm(Request $request, $id)
    {
        return view('admin.competition.description_form', ['data' => $request['data'], 'id' => $id]);
    }

    public function competitionMaterialsForm(Request $request, $id)
    {
        return view('admin.competition.teaching_materials_form', ['data' => $request['data'], 'id' => $id]);
    }



    public function save(Request $request, $page, $id=null)
    {
        switch ($page) {
            case 'teaching_materials':

                $data = [
                    'description' => $request['description'],
                    'teaching_materials' => $request['teaching_materials'],
                ];
                $validator = [
                    'description' => Competition::rules()['description'],
                    'teaching_materials' => Competition::rules()['teaching_materials']
                ];
                Validator::make($data, $validator)->validate();
                $competition = Competition::find($id);
                $competition->update($data);
                $competition->save();
                return redirect(route('admin.home'));
                break;
            case 'description':

                $data = [
                    'description' => $request['description'],
                    'teaching_materials' => $request['teaching_materials'],
                ];
                $validator = [
                    'description' => Competition::rules()['description'],
                    'teaching_materials' => Competition::rules()['teaching_materials']
                ];
                Validator::make($data, $validator)->validate();
                $competition = Competition::find($id);
                $competition->update($data);
                $competition->save();
                return redirect(route('admin.competition_materials_form', ['id' => $id,'data' => $data]));
                break;
            case 'all':

                $this->validator($request->all())->validate();
                $competition = Competition::find($id);
                if ($competition) {
                    $competition->update(['name' => $request['name'],
                        'max_points' => $request['max_points'],
                        'user_type' => 'App/Models/' . ucfirst($request['user_type']),]);

                } else {
                    $competition = new Competition([
                        'name' => $request['name'],
                        'max_points' => $request['max_points'],
                        'user_type' => 'App/Models/' . ucfirst($request['user_type']),
                        'description' => $request['description'],
                        'teaching_materials' => $request['teaching_materials'],
                    ]);
                }

                $competition->save();
                if (array_key_exists('video', $request->all())) {
                    $video = $request->file('video');
                    $files = Storage::disk('public')->files(Competition::$videos_folder_path . $competition->id);
                    Storage::disk('public')->delete($files);
                    $video->storeAs(Competition::$videos_folder_path, $competition->id, 'public');
                }

                $data = [
                    'description' => $request['description'],
                    'teaching_materials' => $request['teaching_materials'],
                ];
                return redirect(route('admin.competition_description_form', ['data' => $data, 'id' => $competition->id]));
                break;
            default:
                abort(500, 'Invalid request');
                break;
        }
    }

    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Competition::rules();
        return Validator::make($data, $validator);
    }

    public function delete(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        Competition::find($id)->delete();
        return redirect()->back();
    }
}
