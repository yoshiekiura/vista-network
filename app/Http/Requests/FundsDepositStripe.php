<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundsDepositStripe extends FormRequest
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
            'cardNumber' => 'required|numeric',
            'cardExpiryMonth' => 'required',
            'cardExpiryYear' => 'required',
            'cardCVC' => 'required|numeric'
        ];
    }
}
