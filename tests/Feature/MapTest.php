<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Map;
use App\User;

class MapTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_マップページが正常に見える()
    {
        $response = $this->get('/map');
        $response
            ->assertSee('日付で検索')
            ->assertSee('検索')
            ->assertOk();
    }

    public function test_データを保存できる()
    {
        $first = factory(Map::class)->create();
        $second = factory(Map::class)->create();

        $response = $this->get('/map');
        $response->assertOk();
    }

    // public function test_POSTリクエストを送信できる()
    // {
    //     $response = $this->post('/map', [
    //         'user_id' => 1,
    //         'place' => '東京駅',
    //         'title' => '東京タワー行きたい',
    //         'content' => 'アメリカ人です。東京タワーに一緒に行ける方募集します。',
    //         'date' => '2019-08-14',
    //         'lat' => '70.267150',
    //         'lng' => '123.971009'
    //     ]);
    //     $response->assertOk();
    // }

    public function test_DELETEリクエストでデータを削除できる()
    {
        $first = factory(Map::class)->create();
        $response = $this->assertCount(1, Map::all());
        $response = $this->delete(route('map.destroy', ['map' => 1]));
        $response = $this->get('/map/1');
        $response->assertNotFound();
    }

    public function test_非ログイン時にいいねボタン押したリダイレクト()
    {
        $first = factory(Map::class)->create();
        $response = $this->post(route('likes.like', ['map' => 1]))
                        ->assertRedirect('/login');
    }

    public function test_ログイン時にいいねボタンで正常レスポンス()
    {
        $user = factory(User::class)->create();
        $first = factory(Map::class)->create();
        $response = $this->actingAs($user)->post(route('likes.like', ['map' => 1]))
                        ->assertRedirect('/map/1');
    }

}
