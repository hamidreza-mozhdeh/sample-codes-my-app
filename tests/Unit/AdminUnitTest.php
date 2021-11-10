<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminUnitTest extends TestCase
{
    use DatabaseMigrations;

    const createSeveral = 3;

    /**
     * @test
     */
    public function createAdmin()
    {
        $admin = Admin::factory()->make();

        $newAdmin = new Admin;

        $newAdmin->first_name  = $admin->first_name;
        $newAdmin->surname     = $admin->surname;
        $newAdmin->email       = $admin->email;
        $newAdmin->password    = $admin->password;
        $newAdmin->status      = $admin->status;

        $newAdmin->save();

        $this->assertTrue($newAdmin instanceof Admin);
        $this->assertEquals($newAdmin->first_name, $admin->first_name);
        $this->assertEquals($newAdmin->surname, $admin->surname);
        $this->assertEquals($newAdmin->email, $admin->email);
        $this->assertEquals($newAdmin->password, $admin->password);
        $this->assertEquals($newAdmin->status, $admin->status);
    }

    /**
     * @test
     */
    public function updateAdmin()
    {
        $admin = Admin::factory()->create();
        $newAdmin = Admin::factory()->make();

        $admin->first_name  = $newAdmin->first_name;
        $admin->surname     = $newAdmin->surname;
        $admin->email       = $newAdmin->email;
        $admin->password    = $newAdmin->password;
        $admin->status      = $newAdmin->status;

        $admin->save();

        $this->assertTrue($admin instanceof Admin);

        $this->assertEquals($admin->first_name, $newAdmin->first_name);
        $this->assertEquals($admin->surname, $newAdmin->surname);
        $this->assertEquals($admin->email, $newAdmin->email);
        $this->assertEquals($admin->password, $newAdmin->password);
        $this->assertEquals($admin->status, $newAdmin->status);

        $this->assertDatabaseHas(
            'admins',
            [
                'id' => $admin->id,
                'first_name' => $admin->first_name,
                'surname' => $admin->surname,
                'email' => $admin->email,
                'password' => $admin->password,
                'status' => $admin->status,
            ]
        );
    }

    /**
     * @test
     */
    public function showAdmin()
    {
        $admin = Admin::factory()->active()->create();

        $fetchedAdmin = Admin::find($admin->id);

        $this->assertTrue($fetchedAdmin instanceof Admin);

        $this->assertEquals($fetchedAdmin->first_name, $admin->first_name);
        $this->assertEquals($fetchedAdmin->surname, $admin->surname);
        $this->assertEquals($fetchedAdmin->email, $admin->email);
        $this->assertEquals($fetchedAdmin->password, $admin->password);
        $this->assertEquals($fetchedAdmin->status, $admin->status);
    }

    /**
     * @test
     */
    public function listOfAdmin()
    {
        $count = self::createSeveral;
        $countBefore = Admin::all()->count();
        Admin::factory()->active()->count(self::createSeveral)->create();
        $countAfter = Admin::all()->count();
        $this->assertEquals($countAfter, $count + $countBefore);
    }

    /**
     * @test
     */
    public function destroyAdmin()
    {
        Admin::factory()->active()->count(self::createSeveral)->create();

        $countBefore = Admin::all()->count();
        $admin = Admin::first();
        $admin->delete();

        $countAfter = Admin::all()->count();
        $this->assertEquals($countAfter, --$countBefore);
    }
}
