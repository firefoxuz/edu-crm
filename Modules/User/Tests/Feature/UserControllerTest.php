<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        User::factory(30)->create();

        $response = $this->getJson(route('users.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'full_name',
                        'email',
                        'role',
                        'deleted_at',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active'
                    ]
                ],
            ]);
    }

    public function testStore()
    {
        $data = [
            'full_name' => 'Full Name',
            'email' => 'email@example.com',
            'role' => '1',
            'password' => '123456',
        ];
        $response = $this->postJson(route('users.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id',
                'full_name',
                'email',
                'role',
                'created_at',
                'updated_at',
            ]);

        unset($data['password']);

        $this->assertDatabaseHas('users', $data);

    }

    public function testShow()
    {
        $user = User::factory()->create();

        $response = $this->getJson(route('users.show', ['user' => $user->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'full_name',
                'email',
                'role',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $data = [
            'full_name' => 'Full Name',
            'email' => 'email@example.com',
            'role' => '1',
        ];

        $response = $this->putJson(route('users.update', ['user' => $user->id]), $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'full_name',
                'email',
                'role',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);

        $this->assertNotEquals($user->only(
            'full_name',
            'email',
            'role',
        ), $data);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('users.destroy', ['user' => $user->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'full_name',
                'email',
                'role',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);

        $this->assertDatabaseMissing('users', $user->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }
}
