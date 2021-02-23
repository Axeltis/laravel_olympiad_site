<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use HasFactory, UuidTrait;
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'max_points',
        'teaching_materials',
        'user_type'
    ];
    public static $videos_folder_path = 'competitions/videos/';

    public static function rules($merge = []): array
    {
        return array_merge([
            'id' => ['uuid', 'unique'],
            'name' => ['required', 'string', 'max:100'],
            'user_type' => ['required', 'string', 'max:40'],
            'description' => ['required', 'string', 'max:3000'],
            'teaching_materials' => ['required', 'string', 'max:3000'],
            'max_points' => ['required', 'int', 'min:0'],
            'video' => ['file', 'mimes:avi,mp4,mov,ogg,qt,ogx,oga,ogv,webm']
        ],
            $merge);
    }

    public function holdings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(HoldingCompetition::class);
    }

    public function status(): bool
    {
        $holding = $this->holdings()->latest()->first();
        $current_date = Carbon::now()->toDateString();
        return ($holding->start_date <= $current_date and $holding->end_date >= $current_date);
    }
}
