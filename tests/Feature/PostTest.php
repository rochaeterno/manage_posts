<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * Test creating a new order.
     *
     * @return void
     */

    /**
     * @test
     */
    public function post_list_should_be_possible()
    {
        $this->json('get', 'api/posts')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'author',
                            'content',
                            'tags' => ['*']
                        ]
                    ]
                ]
            );
    }

    /**
     * @test
     */
    public function post_should_be_created()
    {
        $payload = [
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),
            "tags" => $this->faker->words(5)
        ];

        $this->json('post', 'api/posts', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'title',
                        'author',
                        'content',
                        'tags' => []
                    ]
                ]
            );
        $this->assertDatabaseHas('posts', [
            "title" => $payload['title'],
            "author" => $payload['author'],
            "content" => $payload['content']
        ]);
    }

    /**
     * @test
     */
    public function post_should_showed_correctly()
    {
        $random_tags = $this->faker->words(3);
        $post = Post::create([
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),

        ]);

        foreach ($random_tags as $tag) {
            $tags = Tag::create(['name' => $tag]);

            $post->tags()->attach($tags);
        }

        $this->json('get', "api/posts/$post->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id' => $post->id,
                        'title' => $post->title,
                        'author' => $post->author,
                        'content' => $post->content,
                        'tags' => $random_tags
                    ]
                ]
            );
    }

    /**
     * @test
     */
    public function post_should_be_deleted()
    {

        $postData = [
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),
        ];
        $post = Post::create(
            $postData
        );

        $this->json('delete', "api/posts/$post->id")
            ->assertNoContent();
        $this->assertDatabaseMissing('posts', $postData);
    }

    /**
     * @test
     */
    public function post_should_be_update()
    {
        $random_tags = $this->faker->words(3);
        $post = Post::create([
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),

        ]);

        foreach ($random_tags as $tag) {
            $tags = Tag::create(['name' => $tag]);

            $post->tags()->attach($tags);
        }

        $payload = [
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),
            "tags" => $this->faker->words(5)
        ];

        $this->json('put', "api/posts/$post->id", $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id' => $post->id,
                        'title' => $payload['title'],
                        'author' => $payload['author'],
                        'content' => $payload['content'],
                        'tags' => $payload['tags']
                    ]
                ]
            );
    }
}
