<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, UuidTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'college', 'speciality', 'course'
    ];
    public  const slug = 'student';
    public  const label = 'Студент';
    public const path = 'App\\Models\\Student';
    public $viewables = [
        'college' => 'Колледж',
        'speciality' => 'Специальность',
        'course' => 'Курс'
    ];

    public static function rules($merge = []): array
    {
        return array_merge([
            'student_college' => ['required', 'string', 'max:70'],
            'student_speciality' => ['required', 'string', 'max:70'],
            'student_course' => ['required', 'int', 'max:6', 'min:1'],
        ],
            $merge);
    }


    public function user(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(User::class, 'type');
    }

}
