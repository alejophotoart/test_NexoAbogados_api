<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubscriptionRequest extends FormRequest
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
            'subscriptionPrice' => 'required',
            'subscriptionPrice' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'subscriptionPrice.required' => 'El valor de la suscripcion es requerido',
            'subscriptionPrice.numeric' => 'Debe seleccionar un valor numerico',
        ];
    }
}
