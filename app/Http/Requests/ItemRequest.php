<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Helpers\CommonHelper;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'no' => 'required',
            'name' => 'required',
            'price' => 'nullable'
        ];
    }


     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(CommonHelper::badRequest($validator->errors()));
    }
}
