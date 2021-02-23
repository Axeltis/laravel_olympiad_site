<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
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
            'end_date' => ['required', 'date', 'date_format:Y-m-d']
        ],
            $merge);
    }

    public function competition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_competitions');
    }

}
