<?php

include_once 'BaseApiTestCase.php';

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends BaseApiTestCase
{

    public function testGetAllPosts()
    {
        $this->withOAuthTokenTypeUser();
        $this->get('posts');
        $this->printResponseData();
        $this->seeJsonStructure([
            'data' => [
                '*' => [
                    'post_id',
                    'title',
                    'body',
                    'is_recommended',
                ],
            ]
        ]);
    }

    public function testGetSinglePost()
    {
        $this->withOAuthTokenTypeUser();
        $this->get('posts/1');
        $this->printResponseData();
        $this->seeJsonStructure([
            'data' => [
                'post_id',
                'title',
                'body',
                'is_recommended',
            ]
        ]);
    }

    public function testCreatePostIncorrect()
    {
        $this->withOAuthTokenTypeUser();
        $this->post('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ]);
        $this->printResponseData();
        $this->assertResponseStatus(self::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testCreatePostCorrect()
    {
        $this->withOAuthTokenTypeUser();
        $this->post('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body with a long body',
        ]);
        $this->printResponseData();
        $this->assertResponseOk();
    }

    public function testUpdatePost()
    {
        $this->withOAuthTokenTypeUser();
        $this->put('posts/2', [
            'title' => 'Test Title Changed',
        ]);
        $this->printResponseData();
        $this->assertResponseNoContent();
    }

    public function testDeletePost()
    {
        $post = \Someline\Models\Foundation\Post::find(3);
        if (!$post) {
            $post = factory(\Someline\Models\Foundation\Post::class, 1)->make();
            $post->post_id = 3;
            $post->save();
        }

        $this->withOAuthTokenTypeUser();
        $this->delete('posts/3');
        $this->printResponseData();
        $this->assertResponseNoContent();
    }

}
