<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdStatus;
use App\Models\Moderation;
use App\Models\Role;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ModeratorController extends Controller
{
    public function index()
    {
       
        return view('moderator.home');
    }

   
}
