<?php

namespace App\Observers\Company;

use Hash;
use App\MOdels\Company\User;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->getOriginal('password') !== $user->password) {
            $user->password = Hash::make($user->password);
        }
    }
}
