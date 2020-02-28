<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        return [
            'email' => $emailValidation,
            'name' => 'required',
            'city' => 'required',
            'adress' => 'required',
            'phone' => 'required',
            'dostavka' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'У вас уже есть учетная запись с этим адресом электронной почты. Пожалуйста <a href="/login">Войдите</a> чтобы продолжать.',
        ];
    }
}
