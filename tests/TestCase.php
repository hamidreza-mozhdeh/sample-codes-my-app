<?php

namespace Tests;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    use RefreshDatabase;

    public function actingAsAdmin(Admin $admin = null): array
    {
        if(!$admin) {
            $admin = Admin::factory()->active()->create();
        }

        $response = $this->postJson(
            route('api.login'),
            [
                'email' => $admin->email,
                'password' => '123456',
            ]
        );

        return $response->json();
    }
}
