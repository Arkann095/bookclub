<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name' => ['required', 'string', 'max:18'],
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'password' => ['bail', 'required', 'min:8', 'confirmed','uppercase','regex:/[0-9]/'],
            'avatar' => ['nullable', 'image', 'max:2048'],

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'Имя обязательно для заполнения',
            'name.max' => 'Имя должно быть не длиннее 18 символов',

            'email.unique' => 'Пользователь с таким email уже зарегистрирован',
            'email.email' => 'Введите настоящий email, а не ерунду',

            'password.required'  => 'Пароль обязателен',
            'password.min'       => 'Пароль должен быть не менее :min символов',
            'password.uppercase' => 'Пароль должен содержать хотя бы одну заглавную букву',
            'password.number'    => 'Пароль должен содержать хотя бы одну цифру',
            'password.confirmed' => 'Пароли не совпадают',

            'avatar.image'    => 'Файл должен быть картинкой (jpg, png, gif, webp)',
            'avatar.max'      => 'Аватар не должен быть больше 2 МБ',
        ];
    }

    public function attributes() {

        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'password' => 'Пароль',
        ];

    }
}
