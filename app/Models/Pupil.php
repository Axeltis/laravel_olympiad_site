<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Pupil extends Model
{
    use HasFactory;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'organization','class'
        ];
    public static function rules($user_id=null, $merge=[]): array
    {
        return array_merge([
            'pupil_organization' => ['required', 'string', 'max:70'],
            'pupil_class' => ['required', 'int', 'max:11', 'min:1'],
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
