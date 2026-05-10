<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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

            'reviewRating' => ['required', 'integer', 'min:1', 'max:5'],
            'reviewBody' => ['required', 'string', 'min:10'],

        ];
    }

    public function messages() {
    
        return [
            'reviewRating.required' => 'Поставьте оценку',
            'reviewBody.required' => 'Напишите текст рецензии',
        ];

    }

    public function attributes() {
    
        return [
            'reviewRating' => 'Оценка',
            'reviewBody' => 'Текст рецензии',
        ];
        
    }

    
}
