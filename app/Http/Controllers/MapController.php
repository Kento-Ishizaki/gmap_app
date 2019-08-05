<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function index()
    {
        $maps = Map::all();
        return view('map.index', ['maps' => $maps]);
    }

    public function store(Request $request)
    {
        $map = new Map();
        $map->user_id = Auth::id();
        $map->place = $request->place;
        $map->title = $request->title;
        $map->content = $request->content;
        $map->date = $request->date;
        $map->lat = $request->lat;
        $map->lng = $request->lng;
        $map->save();
        return redirect()->route('map.index')->with('success', '投稿が完了しました。');
    }

    public function show(Map $map)
    {
        $user_id = Auth::id();
        $map->load('likes');
        $likesCount = count($map->likes);
        $defaultLiked = $map->likes->where('user_id', $user_id)->first();
        if($defaultLiked === null) {
            $defaultLiked = false;
        } else {
            $defaultLiked = true;
        };
        return view('map.show', [
            'map' => $map,
            'user_id' => $user_id,
            'likesCount' => $likesCount,
            'defaultLiked' => $defaultLiked
            ]);
    }

    public function edit(Map $map)
    {
        $this->authorize('view', $map);
        return view('map.edit', ['map' => $map]);
    }

    public function update(Request $request, Map $map)
    {
      $map->user_id = Auth::id();
      $map->place = $request->place;
      $map->title = $request->title;
      $map->content = $request->content;
      $map->date = $request->date;
      $map->lat = $request->lat;
      $map->lng = $request->lng;
      $map->save();
      return redirect()->route('map.index')->with('success', '編集が完了しました。');
    }

    public function destroy(Map $map)
    {
      $map->delete();
      return redirect()->route('map.index')->with('danger', '削除しました。');
    }
}
