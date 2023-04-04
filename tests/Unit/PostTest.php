<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * jsonStructure Response for Posts collection
     *
     * @return array
     */
    private function jsonStructureResponse(): array
    {
        return [
            'id',
            'title',
            'publisher_id'
        ];
    }

    /**
     * Post payload
     *
     * @return array
     */
    private function samplePostPayload(): array
    {
        return [
            'id' => 1,
            'title' => 'Test post title'
        ];
    }

    public function itShouldReturnErrorIfUnauthenticated()
    {
        $response = $this->json(
            'GET',
            route('posts.index'),
            [
                'size' => 15
            ],
            [
                'Authorization' => 'Invalid-token-123'
            ]
        );

        $response->assertStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function itShouldReturnPostsList()
    {
        $response = $this->json(
            'GET',
            route('posts.index'),
            [
                'size' => 15
            ],
            $this->authHeader()
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => $this->jsonStructureResponse()
            ],
            'links',
            'meta'
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testPostListRequiresSize(): void
    {
         $response = $this->json(
             'GET',
             route('posts.index'),
             [

             ],
             $this->authHeader()
         );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['size']);
    }

    /**
     * @test
     *
     * @return void
     */
    public function itShouldSavePostAndAppendCurrentUserAsCreator(): void
    {
        $user = User::factory()->create();

        $payload = $this->samplePostPayload();

        $response = $this->actingAs($user)
            ->json(
                'POST',
                route('posts.store'),
                $payload,
                $this->authHeader($user)
            );

        $response->assertStatus(200);
        $this->assertDatabaseCount('posts', 1);
        $response->assertJson([
            'data' => [
                'id' => $payload['id'],
                'title' => $payload['title'],
                'publisher_id' => $user->id
            ]
        ]);
    }

    public function itShouldSavePostWithSelectedPublisherId(): void
    {
    }
}
