<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapPostRequest extends FormRequest
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
        return [
            'place' => 'required| string| max:50',
            'title' => 'required| string| max:50',
            'content' => 'required| string',
            'date' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'ユーザー情報',
            'place' => '場所',
            'title' => 'タイトル',
            'content' => '内容',
            'date' => '日付',
        ];
    }
}
