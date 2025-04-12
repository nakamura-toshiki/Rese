<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'image' => 'required|mimes:png,jpeg',
            'name' => 'required',
            'area_id' => 'required',
            'category_id' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '店舗画像を登録してください',
            'image.mimes:png,jpeg' => '「.png」または「.jpeg」形式でアップロードしてください',
            'name.required' => '店舗名を入力してください',
            'area_id.required' => 'エリアを選択してください',
            'category_id.required' => 'ジャンルを選択してください',
            'description.required' => '店舗概要を入力してください'
        ];
    }
}
