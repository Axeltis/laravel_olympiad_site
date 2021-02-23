<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory,UuidTrait;
    protected  $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'organization','position'
    ];
    public $type_name = 'teacher';
    public $type_label = 'Преподаватель';
    public static function rules( $merge=[]): array
    {
        return array_merge([
                'teacher_organization' => ['required', 'string', 'max:70'],
                'teacher_position' => ['required', 'string', 'max:70'],
        ],
            $merge);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(User::class,'type');
    }
}
