<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\HoldingCompetition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.hold_competition_form',['competition'=>$competition]);

    }

    public function holdCompetition(Request $request,$competition_id): \Illuminate\Http\RedirectResponse
    {
        $holding = HoldingCompetition::find($request['id']);
        $competition = Competition::find($competition_id);
        $data = [
            'start_date'=>$request['start_date'],
            'end_date'=>$request['end_date']
        ];
        if($holding){
            $holding->update($data);
        }
        else{
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

        return view('admin.competition_form', ['competition' => $competition]);
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

    public function save(Request $request, $id = null)
    {
        $this->validator($request->all())->validate();
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'max_points' => $request['max_points'],
            'teaching_materials' => $request['teaching_materials'],
            'user_type'=>  'App/Models/'.ucfirst($request['user_type']),
        ];

        $competition = Competition::find($id);
        if ($competition) {
            $competition->update($data);
            $competition->save();
        } else {
            $competition = new Competition($data);
            $competition->save();
        }
        if(array_key_exists('video',$request->all())) {
            $video = $request->file('video');
            $files = Storage::disk('public')->files(Competition::$videos_folder_path . $competition->id);
            Storage::disk('public')->delete($files);
            $video->storeAs(Competition::$videos_folder_path, $competition->id, 'public');
        }
        return redirect(route('competition', ['id' => $competition->id]));
    }

}
