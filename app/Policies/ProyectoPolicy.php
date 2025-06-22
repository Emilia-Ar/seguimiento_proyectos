<?php

namespace App\Policies;

use App\Models\Proyecto;
use App\Models\User;

class ProyectoPolicy
{
    public function view(User $user, Proyecto $proyecto): bool
    {
        return $user->id === $proyecto->user_id;
    }

    public function update(User $user, Proyecto $proyecto): bool
    {
        return $user->id === $proyecto->user_id;
    }

    public function delete(User $user, Proyecto $proyecto): bool
    {
        return $user->id === $proyecto->user_id;
    }
}

