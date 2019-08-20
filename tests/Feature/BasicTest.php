<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicTest extends TestCase
{
    use RefreshDatabase;

    public function test_トップページが正常に見える()
    {
        $response = $this->get('/');
        $response
            ->assertSee('Gmap App')
            ->assertSee('login')
            ->assertOk();
    }

    public function test_httpステータスが正常に返ってくる()
    {
        $this->get('/sample')->assertStatus(404);
        $this->get('/login')->assertOk();
        $this->get('/register')->assertOk();
        $this->post('/register')->assertStatus(302);
    }
}
