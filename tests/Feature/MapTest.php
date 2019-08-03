<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Map;

class MapTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_マップにデータを保存できる()
    {
        $first = factory(Map::class)->create();
        $second = factory(Map::class)->create();
        $first->save();
        $second->save();

        $response = $this->get('/map');
        $response->assertStatus(200);
    }
}
