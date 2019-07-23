<?php

use Illuminate\Database\Seeder;
// 現在時刻をcreate_atとupdated_atに登録
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'テストユーザー',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'sex' => '男性',
                'age' => '28',
                'profile' => 'サンプルユーザーです。',
                'remember_token' => str_random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => '2',
                'name' => '石崎',
                'email' => 'ishizaki@example.com',
                'password' => Hash::make('password'),
                'sex' => '男性',
                'age' => '28',
                'profile' => 'サッカーが趣味です。仕事はエンジニアです。',
                'remember_token' => str_random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => '3',
                'name' => '江古田',
                'email' => 'ekoda@example.com',
                'password' => Hash::make('password'),
                'sex' => '女性',
                'age' => '26',
                'profile' => "B'zファンで、岡山県津山市出身です。",
                'remember_token' => str_random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => '4',
                'name' => 'ヒジン',
                'email' => 'hijin@example.com',
                'password' => Hash::make('password'),
                'sex' => '男性',
                'age' => '29',
                'profile' => "韓流スター。超絶イケメン",
                'remember_token' => str_random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => '5',
                'name' => 'ララ子',
                'email' => 'lalako@example.com',
                'password' => Hash::make('password'),
                'sex' => '女性',
                'age' => '24',
                'profile' => "日々プログラミングに夢中になってます。",
                'remember_token' => str_random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
