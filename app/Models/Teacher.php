<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'organization','position'
    ];
    public static function rules($user_id=null, $merge=[]): array
    {
        return array_merge([
                'teacher_organization' => ['required', 'string', 'max:70'],
                'teacher_position' => ['required', 'string', 'max:70'],
        ],
            $merge);
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            Student::where('user_id',$model->user_id)->delete();
            Teacher::where('user_id',$model->user_id)->delete();
            Pupil::where('user_id',$model->user_id)->delete();
        });
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
