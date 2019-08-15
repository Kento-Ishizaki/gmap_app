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
            ->assertStatus(200);
    }
}
