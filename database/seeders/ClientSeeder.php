<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::factory()->create();
        Client::factory()->withAdmin($admin)->count(25)->create();
    }
}
