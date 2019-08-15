<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
// S3を使うための記述
use Storage;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        return redirect()->route('map.index');
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $this->authorize('view', $user);
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if($request->has('avatar_image')) {
            $image = $request->file('avatar_image');
            // バケットのuploadsフォルダにアップロード
            $path = Storage::disk('s3')->putFile('uploads', $image, 'public');
            // アップした画像のフルパスを取得
            $user->avatar_image = Storage::disk('s3')->url($path);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->profile = $request->profile;
        $user->save();
        return redirect()->route('users.show', ['id' => $user])->with('success', '編集が完了しました。');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/')->with('danger', 'アカウントを削除しました。');
    }
}
