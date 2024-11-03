<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
    public function rules(){
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required' , 'in:男性,女性,その他'],
            'email' => ['required' , 'email'],
            'tell1' => ['required' , 'numeric', 'digits_between:2,20'],
            'tell2' => ['required' , 'numeric' , 'digits_between:2,20'],
            'tell3' => ['required' , 'numeric' , 'digits_between:2,20'],
            'address' => ['required', 'string', 'max:50'],
            'building' => [] ,
            'category_id' => ['required', 'exists:categories,id' , 'not_in:'],
            'detail' => ['required' , 'string' , 'max:120'],
        ];
    }

    public function messages(){
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tell1.required' => '電話番号を入力してください',
            'tell1.numeric' => '電話番号は5桁までの数字で入力してください',
            'tell1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tell2.required' => '電話番号を入力してください',
            'tell2.numeric' => '電話番号は5桁までの数字で入力してください',
            'tell2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tell3.required' => '電話番号を入力してください',
            'tell3.numeric' => '電話番号は5桁までの数字で入力してください',
            'tell3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.not_in' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください'
        ];
    }
}