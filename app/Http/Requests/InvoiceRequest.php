<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Helpers\CommonHelper;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            "referenceNo" => "required",
            "senderId" => "required",
            "recipientName" => "required",
            "recipientAddress" => "required",
            "subTotal" => "nullable",
            "taxRate" => "nullable",
            "taxAmount" => "nullable",
            "total" => "nullable",
            "amountPaid" => "nullable",
            "amountDue" => "nullable",
            "notes" => "nullable"
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
