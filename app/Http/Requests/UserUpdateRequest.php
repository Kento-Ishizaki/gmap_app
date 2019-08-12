<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = new User();
        $user = Auth::user();
        return [
            'name' => 'required| string| max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // 自分のメールアドレスは一意チェックから除外
                Rule::unique('users')->ignore($user->id)
            ],
            'age' => 'numeric| nullable',
            'sex' => 'required',
            'profile' => 'string| nullable'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'age' => '年齢',
            'sex' => '性別',
            'profile' => '自己紹介',
            ''
        ];
    }
}
