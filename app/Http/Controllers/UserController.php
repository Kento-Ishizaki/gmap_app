<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        $user->avatar_image = $request->avatar_image;
        $user->name = $request->name;
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
