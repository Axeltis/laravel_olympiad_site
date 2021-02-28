<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoldingCompetition extends Model
{
    use HasFactory;
    use HasFactory, UuidTrait;


    protected $primaryKey = 'id';
    protected $fillable = [
        'start_date',
        'end_date'
    ];

    public static function rules($merge=[]): array
    {
        return array_merge([
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],

        ],
            $merge);
    }

    public function competition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_competitions')->withPivot(['file_attached','points']);
    }
    public function status(): array
    {
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

            if ($this->start_date > $current_date) {
                return $status_array['will_hold'];
            } else if ($this->end_date < $current_date) {
                return $status_array['was_held'];
            } else {
                return $status_array['holding'];
            }

    }
}
