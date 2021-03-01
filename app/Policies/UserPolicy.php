<?php

namespace App\Policies;

use App\Models\Competition;
use App\Models\HoldingCompetition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    private $instance = null;

    public static function getInstance(): UserPolicy
    {
        return $instance = $instance ?? new UserPolicy();
    }

    public function view(User $user, array $data): bool
    {
        return $user->role->slug == $data['role'];
    }

    public function editUser(User $user, array $data): bool
    {
        return $user->id == $data['user_id'] or $user->role->slug == 'admin';
    }

    public function joinCompetition(User $user, array $data): bool
    {
        $competition = Competition::find($data['competition_id']);
        if ($competition)
            return $competition->user_type == $user->type_name;
        else return false;
    }

    public function leaveCompetition(User $user, array $data): bool
    {
        $competition_id = $data['competition_id'];
        return $user->holdings()->whereHas('competition', function ($q) use ($competition_id) {
            $q->where('id',$competition_id);
        })->exists();
    }

    public function uploadAnswer(User $user, array $data): bool
    {
        return $user->holdings()->where('id', $data['holding_id'])->exists();
    }

    public function viewProfile(User $user, array $data): bool
    {
        $model = User::find($data['user_id']);
        if ($model)
            return $user->id == $model->id or $user->role->slug == 'admin';
        else return false;
    }

}
