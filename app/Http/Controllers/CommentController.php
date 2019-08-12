<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Map;
use Illuminate\Support\Facades\Auth;
use Validator;

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
        $rules = [
            'body' => 'required| max:100'
        ];

        $messages = [
            'body.required' => 'コメントを入力して下さい。',
            'body.max' => '100文字以内で入力して下さい。'
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $comment = new Comment(['body' => $request->body]);
        $comment->user_id = Auth::id();
        $avatar = $comment->user->avatar_image;
        $name = $comment->user->name;
        $map->comments()->save($comment);
        return response()->json([
            'success' => 'コメントしました。',
            'comment' => $comment,
            'avatar' => $avatar,
            'name' => $name
            ]);
    }
}
