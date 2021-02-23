<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Pupil extends Model
{
    use HasFactory,UuidTrait;
    protected  $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'organization','class'
        ];

    public $type_name = 'pupil';
    public $type_label= 'Школьник';
    public static function rules($merge=[]): array
    {
        return array_merge([
            'pupil_organization' => ['required', 'string', 'max:70'],
            'pupil_class' => ['required', 'int', 'max:11', 'min:1'],
        ],
            $merge);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(User::class,'type');
    }

}
