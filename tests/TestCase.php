<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function authHeader(Authenticatable $user = null): array
    {
        if (true === is_null($user)) {
        }

        return [
            'Authorization' => 'Bearer'
        ];
    }
}
