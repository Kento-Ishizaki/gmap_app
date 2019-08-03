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
    public function test_ユーザー１が見れる()
    {
        $user = factory(User::class)->create();
        dd($user);

        $response = $this->get('/users/1');
        $response->assertSee('@');


        // $this->visit('/users/1')
        //     ->see('@');

        // $response = $this->get('/users/1');
        // $response->assertSee('テストユーザー');
        // $first = factory(App\User::class)->create();
        // $second = factory(App\User::class)->create();
        // $first->save();
        // $second->save();

        // $this->visit('/users/1')
        //     ->see('テストユーザー')->see('@');
    }

    
}
