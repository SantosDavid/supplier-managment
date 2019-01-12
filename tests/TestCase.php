<?php

namespace Tests;

use JWTAuth;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAs(Authenticatable $user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', 'Bearer ' . $token);

        return $this;
    }
}
