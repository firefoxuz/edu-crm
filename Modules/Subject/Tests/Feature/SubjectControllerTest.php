<?php

namespace Modules\Subject\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Modules\Subject\Entities\Subject;
use Modules\User\Entities\User;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
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
        Subject::factory(30)->create();

        $response = $this->getJson(route('subjects.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'name',
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
            'name' => 'Test',
        ];
        $response = $this->postJson(route('subjects.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);

        $this->assertDatabaseHas('subjects', $data);

    }

    public function testShow()
    {
        $subject = Subject::factory()->create();

        $response = $this->getJson(route('subjects.show', ['subject' => $subject->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'name',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);
    }

    public function testUpdate()
    {
        $subject = Subject::factory()->create();

        $data = [
            'name' => 'New Name'
        ];

        $response = $this->putJson(route('subjects.update', ['subject' => $subject->id]), $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'name',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);

        $this->assertNotEquals($subject->name, $data['name']);
    }

    public function testDestroy()
    {
        $subject = Subject::factory()->create();

        $response = $this->deleteJson(route('subjects.destroy', ['subject' => $subject->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'name',
                'deleted_at',
                'created_at',
                'updated_at',
            ]);

        $this->assertDatabaseMissing('subjects', $subject->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }
}
