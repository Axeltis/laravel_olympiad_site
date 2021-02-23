<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,UuidTrait;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $primaryKey = 'id';

    protected $fillable = [
        'name',
        'surname' ,
        'middlename',
        'phone',
        'birth_date',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserStatus::class,'status_id');
    }
        public static function types()
        {
            return [
            'slug'=>   [
                'student'=>'Студент',
                'teacher'=>'Преподаватель',
                'pupil'=>'Школьник'
            ],
             'path' =>  [
                 'App/Models/Student'=>'Студент',
                 'App/Models/Teacher'=>'Преподаватель',
                 'App/Models/Pupil'=>'Школьник'
                ]
            ];
        }
    public function type(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
            return $this->morphTo(__FUNCTION__, 'type_name', 'type_id');
    }

    public static function rules($id=null, $merge=[]): array
    {
        return array_merge([
                'name' => ['required', 'string', 'max:60'],
                'surname' => ['required', 'string', 'max:60'],
                'middlename' => ['required', 'string', 'max:60'],
                'phone'  => ['required', 'string', 'max:16',Rule::unique('users','phone')->ignore($id),'regex:/(8)[0-9]{10}/'],
                'email'     => ['required', 'string', 'email', 'max:60',Rule::unique('users','email')->ignore($id)],
                'birth_date' => ['required', 'date', 'date_format:Y-m-d']

            ],
            $merge);
    }

    public function competitions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(HoldingCompetition::class, 'users_competitions');
    }

}
