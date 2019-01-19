<?php

namespace App\Observers\User;

use Hash;
use App\Models\Tenant\User;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->getOriginal('password') !== $user->password) {
            $user->password = Hash::make($user->password);
        }
    }
}
