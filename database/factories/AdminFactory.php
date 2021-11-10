<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => Hash::make(123456),
            'status' => $this->faker->randomElement([Admin::STATUS_INACTIVE, Admin::STATUS_ACTIVE]),
            'deleted_at' => null,
        ];
    }

    /**
     * Create an active Admin.
     *
     * @return AdminFactory
     */
    public function active(): AdminFactory
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'status' => Admin::STATUS_ACTIVE,
                ];
            }
        );
    }

    /**
     * Create an Admin with random password.
     *
     * @return AdminFactory
     */
    public function randomPassword(): AdminFactory
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'password' => Hash::make($this->faker->password),
                ];
            }
        );
    }
}
