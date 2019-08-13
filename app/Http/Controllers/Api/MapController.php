<?php

namespace App\Http\Controllers\Api;

use App\Map;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $maps = Map::with(['user'])->where('date', '>=', $today)->get();
        return json_encode($maps, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $map = map::find($id);
        return json_encode($map, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
