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

    public function test_ユーザー１と２を登録してその情報が見れる()
    {
        $first = factory(User::class)->create();
        $second = factory(User::class)->create();
        $first->save();
        $second->save();

        // ユーザー１のテスト
        $response = $this->get('/users/1');
        $response
            ->assertSee($first->name)
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

    public function test_usersにアクセスが来たらマップにリダイレクト()
    {
        $response = $this->get('/users')
            ->assertRedirect('/map');
    }

    public function test_DELETEリクエストでデータを削除できる()
    {
        $first = factory(User::class)->create();
        $response = $this->assertCount(1, User::all());
        $response = $this->delete(route('users.destroy', ['user' => 1]));
        $response = $this->get('/user/1');
        $response->assertStatus(404);
    }

    public function test_POSTリクエストを送信できる()
    {
        $response = $this->post('/register', [
            'name' => 'サンプルユーザー',
            'email' => 'sample@sample.com',
            'password' => 'password',
        ]);
        $response->assertStatus(302);
    }

}
