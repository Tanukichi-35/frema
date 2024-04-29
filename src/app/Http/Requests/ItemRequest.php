<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'max:3',
            'condition_id' => 'required',
            'price' => 'required|integer|min:1',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.string' => '商品名は文字列で入力してください。',
            'name.max' => '商品名の最大文字数は255文字です。',
            'description.required' => '商品説明を入力してください',
            'description.string' => '商品説明は文字列で入力してください。',
            'description.max' => '商品説明の最大文字数は255文字です。',
            'category_id.max' => 'カテゴリーの選択は3つまでです。',
            'condition_id.required' => '状態を選択してください',
            'price.required' => '金額を入力してください',
            'price.integer' => '金額は1以上の整数を入力してください',
            'price.min' => '金額は1以上の整数を入力してください',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        //dd(count($this->category_id));
        // $data['category_number'] = 0;
        // if(!is_null($this->category_id)){
        //     $data['category_number'] = count($this->category_id);
        // }
        $target = array('¥', ',');
        $data['price'] = str_replace($target, '', $this->price);

        $this->merge($data);
        // dd($this);
    }
}
