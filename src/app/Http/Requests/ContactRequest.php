<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            // 1. お名前
            'last_name'  => ['required'],
            'first_name' => ['required'],

            // 2. 性別
            'gender' => ['required'],

            // 3. メール
            'email' => ['required', 'email'],

            // 4. 電話番号（3分割）
            'tel1' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel2' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel3' => ['required', 'regex:/^[0-9]+$/', 'max:5'],

            // 5. 住所
            'address' => ['required'],

            // 6. 建物名
            'building' => ['nullable'],

            // 7. お問い合わせの種類
            'category_id' => ['required'],

            // 8. お問い合わせ内容
            'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [

            // 1. お名前
            'last_name.required'  => '姓を入力してください',
            'first_name.required' => '名を入力してください',

            // 2. 性別
            'gender.required' => '性別を選択してください',

            // 3. メール
            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => 'メールアドレスはメール形式で入力してください',

            // 4. 電話番号
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',

            'tel1.regex' => '電話番号は 半角英数字で入力してください',
            'tel2.regex' => '電話番号は 半角英数字で入力してください',
            'tel3.regex' => '電話番号は 半角英数字で入力してください',

            'tel1.max' => '電話番号は 5桁まで数字で入力してください',
            'tel2.max' => '電話番号は 5桁まで数字で入力してください',
            'tel3.max' => '電話番号は 5桁まで数字で入力してください',

            // 5. 住所
            'address.required' => '住所を入力してください',

            // 7. 種類
            'category_id.required' => 'お問い合わせの種類を選択してください',

            // 8. 内容
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max'      => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}