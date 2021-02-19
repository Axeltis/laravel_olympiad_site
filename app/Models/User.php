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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserStatus::class,'status_id');
    }
    public function ads(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Ad::class);
    }
    public function moderations(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Moderation::class);
    }
    public function type(){
        if($this->asStudent)
            return 'student';
        elseif($this->asTeacher)
            return 'teacher';
        elseif($this->asPupil)
            return 'pupil';
        else
            return 'none';

    }
    public static function rules($id=null, $merge=[]): array
    {
        return array_merge([
                'name' => ['required', 'string', 'max:60'],
                'surname' => ['required', 'string', 'max:60'],
                'middlename' => ['required', 'string', 'max:60'],
                'phone'  => ['required', 'string', 'max:16',Rule::unique('users','phone')->ignore($id)],
                'email'     => ['required', 'string', 'email', 'max:60',Rule::unique('users','email')->ignore($id)],
                'birth_date' => ['required', 'date', 'date_format:Y-m-d']

            ],
            $merge);
    }
    public $type_label = [
        'student'=>'Студент',
            'teacher'=>'Преподаватель',
        'pupil'=>'Школьник',
        'none'=>'None'
        ];

    public function asStudent(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Student::class, 'user_id');
    }
    public function asTeacher(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Teacher::class,'user_id');
    }
    public function asPupil(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Pupil::class,'user_id');
    }
}
