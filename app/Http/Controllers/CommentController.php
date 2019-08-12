<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Map;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Map $map)
    {
        $this->validate($request, [
            'body' => 'required| max:100'
        ]);
        $comment = new Comment(['body' => $request->body]);
        $comment->user_id = Auth::id();
        $map->comments()->save($comment);
        return redirect()->action('MapController@show', $map);
    }

}
