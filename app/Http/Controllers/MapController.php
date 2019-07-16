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
        return view('map', ['maps' => $maps]);
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
        return redirect()->route('map.index');
    }

}
