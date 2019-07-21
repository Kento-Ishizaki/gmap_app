<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
// S3を使うための記述
use Storage;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $image = $request->file('avatar_image');
        // バケットのuploadsフォルダにアップロード
        $path = Storage::disk('s3')->putFile('uploads', $image, 'public');
        // アップした画像のフルパスを取得
        $user->avatar_image = Storage::disk('s3')->url($path);
        $user->name = $request->name;
        // $user->avatar_image = $request->file('avatar_image')->storeAs('user_images', $user->name. '.png');
        $user->email = $request->email;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->profile = $request->profile;
        $user->save();
        return redirect()->route('users.show', ['id' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
    }
}
