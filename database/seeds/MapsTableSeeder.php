<?php

use Illuminate\Database\Seeder;
use App\Map;
Use Carbon\Carbon;

class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $today = date('Y-m-d');
        $today = strtotime($today);
        $y_later = date('Y-m-d', strtotime('+1 year'));
        $y_later = strtotime($y_later);
        $date = rand($today, $y_later);
        $date = date('Y-m-d', $date);
        $min = 1;
        $max = 5;
        DB::table('maps')->insert([
            [
                'user_id' => rand($min, $max),
                'place' => '東京ディスニーランド',
                'title' => 'ディズニー行きたい人募集',
                'content' => '友達２人と都内から車で行きます。
                ディスニー好きな20~30代の方、一緒に行きましょう！',
                'date' => $date,
                'lat' => '35.632818',
                'lng' => '139.880416',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => '猪苗代湖',
                'title' => '猪苗代湖で遊びたい！',
                'content' => '毎日暑いですね。
                猪苗代湖に言って涼みませんか？',
                'date' => $date,
                'lat' => '37.503821',
                'lng' => '140.093186',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => '江古田駅前　赤茄子',
                'title' => '江古田にある猫居酒屋に行きたい！',
                'content' => '西武池袋線 江古田駅前に猫居酒屋があります。
                近所に住んでいるので、一緒に行ける方居たら行ってみたいです！
                1時間1,000円で飲み放題もやってますので、出来れば酒飲める方だと嬉しいです。
                宜しくお願いします。',
                'date' => $date,
                'lat' => '35.737178',
                'lng' => '139.672343',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => '(日本の)ホワイトハウス',
                'title' => 'ジャンボ焼き鳥〜！！',
                'content' => '練馬区にホワイトハウスというお店があり、焼き鳥がとにかく
                ・うまい！
                ・安い！
                ・でかい！
                です！
                おすすめなので、仕事終わりにでも軽く一杯いかがですか？
                20:00開始ぐらいで考えてます。',
                'date' => $date,
                'lat' => '35.734176',
                'lng' => '139.666421',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => 'イナバ化粧品店',
                'title' => "B'z好き募集！！！",
                'content' => "B'z稲葉さんのご実家が化粧品店を営んでいます。
                B'zグッズもたくさんあって、B'zファンにはたまらない場所だと思います。
                今回、私は稲葉さんと同じ香水を買うために行くのですが、一人で行くのも寂しいので、同行してくれる方募集します。",
                'date' => $date,
                'lat' => '35.059883',
                'lng' => '134.033665',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => 'ハワイ ワイキキビーチ',
                'title' => 'ワイキキビーチでのんびり',
                'content' => 'なかなか難しいかと思いますが、ハワイで合流して一緒にワイキキビーチ行けるかた数名募集します！',
                'date' => $date,
                'lat' => '21.276058',
                'lng' => '-157.826979',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => '富士山',
                'title' => '富士山に登りたいです。',
                'content' => 'タイトルの通りです。
                朝日を拝みに行く予定です。',
                'date' => $date,
                'lat' => '35.360687',
                'lng' => '138.727498',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => rand($min, $max),
                'place' => '東京スカイツリー',
                'title' => 'スカイツリーの展望台に行きませんか？',
                'content' => '展望台に１度行ってみたいと思っており、どなたか一緒に行ける方いませんか？
                ちなみにチケット料金は3,000円です。
                時間は応相談でお願いします。',
                'date' => $date,
                'lat' => '35.710000',
                'lng' => '139.810700',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
