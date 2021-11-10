<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminTest extends TestCase
{
    const createSeveral = 3;

    /**
     * @test
     */
    public function createAdmin()
    {
        $admin = Admin::factory()->make();

        $response = $this->postJson(
            route('api.admins.store'),
            [
                'first_name' => $admin->first_name,
                'surname' => $admin->surname,
                'email' => $admin->email,
                'email_confirmation' => $admin->email,
                'password' => $admin->password,
                'password_confirmation' => $admin->password,
                'status' => $admin->status,
            ]
        )->assertCreated();

        $this->assertEquals($response->getOriginalContent()->first_name, $admin->first_name);
        $this->assertEquals($response->getOriginalContent()->surname, $admin->surname);
        $this->assertEquals($response->getOriginalContent()->email, $admin->email);
        $this->assertEquals($response->getOriginalContent()->status, $admin->status);
    }

    /**
     * @test
     */
    public function createAdminWithoutParameters()
    {
        $response = $this->postJson(route('api.admins.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertArrayHasKey('first_name',  $response->json());
        $this->assertArrayHasKey('surname',     $response->json());
        $this->assertArrayHasKey('email',       $response->json());
        $this->assertArrayHasKey('password',    $response->json());
    }

    /**
     * @test
     */
    public function createAdminWithNullParameters()
    {
        $response = $this->postJson(
            route('api.admins.store'),
            [
                'first_name' => null,
                'surname' => null,
                'email' => null,
                'password' => null,
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertArrayHasKey('first_name',  $response->json());
        $this->assertArrayHasKey('surname',     $response->json());
        $this->assertArrayHasKey('email',       $response->json());
        $this->assertArrayHasKey('password',    $response->json());
    }

    /**
     * @test
     */
    public function createAdminWithInvalidParameters()
    {
        $response = $this->postJson(
            route('api.admins.store'),
            [
                'first_name' => $this->faker->realTextBetween(61),
                'surname' => $this->faker->asciify('*'),
                'email' => $this->faker->userName,
                'password' => $this->faker->password(1, 5),
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertArrayHasKey('first_name',  $response->json());
        $this->assertArrayHasKey('surname',     $response->json());
        $this->assertArrayHasKey('email',       $response->json());
        $this->assertArrayHasKey('password',    $response->json());
    }

    /**
     * @test
     */
    public function updateAdmin1()
    {
        $auth = $this->actingAsAdmin();

        $admin = Admin::factory()->create();
        $newAdmin = Admin::factory()->make();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$auth['secret_string']}",
            'Accept' => 'application/json'
        ])
            ->patchJson(
            route('api.admins.update', ['admin' => $admin->id]),
            [
                'first_name' => $newAdmin->first_name,
                'surname' => $newAdmin->surname,
                'email' => $newAdmin->email,
                'email_confirmation' => $newAdmin->email,
                'password' => $newAdmin->password,
                'password_confirmation' => $newAdmin->password,
                'status' => $newAdmin->status,
            ]
        )->assertOk();

        $this->assertEquals($response->getOriginalContent()->first_name, $newAdmin->first_name);
        $this->assertEquals($response->getOriginalContent()->surname, $newAdmin->surname);
        $this->assertEquals($response->getOriginalContent()->email, $newAdmin->email);
        $this->assertEquals($response->getOriginalContent()->status, $newAdmin->status);
    }
//
//    /**
//     * @test
//     */
//    public function updateAdminWithoutParameters()
//    {
//        $admin = Admin::factory()->create();
//
//        $response = $this->patchJson(route("api.admins.update', ['admin' => $admin->id]));
//
//        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
//
//        $this->assertArrayHasKey('first_name',  $response->json());
//        $this->assertArrayHasKey('surname',     $response->json());
//        $this->assertArrayHasKey('email',       $response->json());
//        $this->assertArrayHasKey('password',    $response->json());
//    }
//
//    /**
//     * @test
//     */
//    public function updateAdminWithNullParameters()
//    {
//        $admin = Admin::factory()->create();
//
//        $response = $this->patchJson(
//            route('api.admins.update', ['admin' => $admin->id]),
//            [
//                'first_name' => null,
//                'surname' => null,
//                'email' => null,
//                'password' => null,
//            ]
//        );
//
//        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
//
//        $this->assertArrayHasKey('first_name',  $response->json());
//        $this->assertArrayHasKey('surname',     $response->json());
//        $this->assertArrayHasKey('email',       $response->json());
//        $this->assertArrayHasKey('password',    $response->json());
//    }
//
//    /**
//     * @test
//     */
//    public function updateAdminWithInvalidParameters()
//    {
//        $admin = Admin::factory()->create();
//
//        $response = $this->patchJson(
//            route('api.admins.update', ['admin' => $admin->id]),
//            [
//                'first_name' => $this->faker->realTextBetween(61),
//                'surname' => $this->faker->asciify('*'),
//                'email' => $this->faker->userName,
//                'password' => $this->faker->password(1, 5),
//            ]
//        );
//
//        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
//
//        $this->assertArrayHasKey('first_name',  $response->json());
//        $this->assertArrayHasKey('surname',     $response->json());
//        $this->assertArrayHasKey('email',       $response->json());
//        $this->assertArrayHasKey('password',    $response->json());
//    }
//
//    /**
//     * @test
//     */
//    public function showAdmin1()
//    {
//        $admin = Admin::factory()->create();
//
//        $response = $this->getJson(route('api.admins.show', ['admin' => $admin->id]))
//            ->assertSuccessful();
//
//        $this->assertEquals($response->getOriginalContent()->first_name, $admin->first_name);
//        $this->assertEquals($response->getOriginalContent()->surname, $admin->surname);
//        $this->assertEquals($response->getOriginalContent()->email, $admin->email);
//        $this->assertEquals($response->getOriginalContent()->status, $admin->status);
//    }
//
//    /**
//     * @test
//     */
//    public function listOfAdmin()
//    {
//        $count = self::createSeveral;
//        Admin::factory()->count($count)->create();
//
//        $response = $this->getJson(route('api.admins.index'))
//            ->assertOk();
//
//        $this->assertEquals(count($response->getOriginalContent()), $count);
//    }
//
//    /**
//     * @test
//     */
//    public function destroyAdmin()
//    {
//        $count = self::createSeveral;
//        Admin::factory()->count($count)->create();
//
//        $admin = Admin::first();
//
//        $response = $this->deleteJson(route('api.admins.destroy', $admin));
//        $response->assertStatus(Response::HTTP_OK);
//        $this->assertDatabaseMissing('admins', ['id' => $admin->id, 'deleted_at' => null]);
//
//        $admins = Admin::all();
//        $this->assertEquals($admins->count(), --$count);
//    }
//
//    /**
//     * @test
//     */
//    public function destroyAdminWithInvalidId()
//    {
//        $count = self::createSeveral;
//        Admin::factory()->count($count)->create();
//
//        $admin = Admin::all()->last();
//
//        $response = $this->deleteJson(route('api.admins.destroy', $admin->id + 1));
//        $response->assertStatus(Response::HTTP_NOT_FOUND);
//
//        $admins = Admin::all();
//        $this->assertEquals($admins->count(), $count);
//    }
}
