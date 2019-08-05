<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Map;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function like(Map $map)
    {
        $like = new Like();
        $like->map_id = $map->id;
        $like->user_id = Auth::id();
        $map->likes()->save($like);
        return redirect()->route('map.show', ['map' => $map])->with('success', 'お気に入り登録しました。');
    }

    public function unlike(Map $map)
    {
        $user_id = Auth::id();
        $like = Like::where('user_id', $user_id)->where('map_id', $map->id)->first();
        $like->delete();
        return redirect()->route('map.show', ['map' => $map])->with('danger', 'お気に入り解除しました。');
    }
}
