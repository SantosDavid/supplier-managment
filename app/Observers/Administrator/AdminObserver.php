<?php

namespace App\Observers\Administrator;

use Hash;
use App\Models\Administrator\Admin;

class AdminObserver
{
    public function saving(Admin $admin)
    {
        if ($admin->getOriginal('password') !== $admin->password) {
            $admin->password = Hash::make($admin->password);
        }
    }
}
