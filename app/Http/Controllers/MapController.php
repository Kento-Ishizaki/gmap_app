<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MapPostRequest;

class MapController extends Controller
{
    public function index()
    {
        $maps = Map::all();
        $count = count($maps);
        return view('map.index', ['maps' => $maps, 'count' => $count]);
    }

    public function store(MapPostRequest $request)
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

    public function update(MapPostRequest $request, Map $map)
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

    public function search(Request $request)
    {
        // DBからリクエストされた日付のデータ抽出
        $maps = Map::with(['user'])->where('date', $request->search)->get();
        $count = count($maps);
        $maps = json_encode($maps);
        return view('map.search',['maps' => $maps, 'count' => $count]);
    }
}
