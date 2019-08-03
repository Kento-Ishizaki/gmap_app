<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_ユーザー登録フォームが見れる()
    {
        $response = $this->get('/register');
        $response
            ->assertSee('ユーザー登録フォーム')
            ->assertSee('登録')
            ->assertOk();
    }

    public function test_ユーザー１と２が見れる()
    {
        $first = factory(User::class)->create();
        $second = factory(User::class)->create();
        $first->save();
        $second->save();

        // ユーザー１のテスト
        $response = $this->get('/users/1');
        $response
            ->assertSee($first->name)
            ->assertSee($first->email)
            ->assertSee($first->sex)
            ->assertOk();

        // ユーザー２のテスト
        $response = $this->get('/users/2');
        $response
            ->assertSee($second->name)
            ->assertSee($second->avatar_image)
            ->assertSee($second->profile)
            ->assertOk();
    }

    
}
