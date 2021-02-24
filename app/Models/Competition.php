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
            'name' => ['required', 'string', 'max:100'],
            'user_type' => ['required', 'string', 'max:40'],
            'description' => ['required', 'string', 'max:8000'],
            'teaching_materials' => ['required', 'string', 'max:8000'],
            'max_points' => ['required', 'int', 'min:0'],
            'video' => ['file', 'mimes:avi,mp4,mov,ogg,qt,ogx,oga,ogv,webm']
        ],
            $merge);
    }

    public function holdings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(HoldingCompetition::class);
    }

    public function status(): array
    {
        $holding = $this->holdings()->latest()->first();
        $current_date = Carbon::now()->toDateString();
        $status_array = [
            'will_hold' => [
                'slug' => 'will_hold',
                'label' => 'Будет проведен',
                ],
            'holding' => [
                'slug' => 'holding',
                'label' => 'Проводится',
                ],
            'was_held' => [
                'slug' => 'was_held',
                'label' => 'Было проведено',
                ],
            'not_hold'=> [
                'slug' => 'not_hold',
                'label' => 'Не проводилось',
            ],
        ];
        if($holding) {
            if ($holding->start_date > $current_date) {
                return $status_array['will_hold'];
            } else if ($holding->end_date < $current_date) {
                return $status_array['was_held'];
            } else {
                return $status_array['holding'];
            }
        }else{
            return $status_array['not_hold'];
        }
    }
}
