<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'image' => $this->faker->imageUrl,
            'deleted_at' => null,
        ];
    }

    /**
     * Create with Admin.
     *
     * @return ClientFactory
     */
    public function withAdmin(?Admin $admin = null): ClientFactory
    {
        if (!$admin) {
            $admin = Admin::factory()->active()->create();
        }

        return $this->state(
            function (array $attributes) use ($admin) {
                return [
                    'admin_id' => $admin->id,
                ];
            }
        );
    }
}
