<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'title' => 'required|string|min:2',
                'body' => 'required|string|min:5',
                'category_id' => 'required|numeric|exists:categories,id',
                'user_id' => 'required|numeric|exists:users,id',
            ];
        }

        return [
            'title' => 'string|min:2',
            'body' => 'string|min:5',
            'category_id' => 'numeric|exists:categories,id',
            'user_id' => 'numeric|exists:users,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
