<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateQuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'client_name' => 'required|max:255',
            'employee_name' => 'required|max:255',
            'quote_date' => 'required|date',
            'quote_time' => 'required|date_format:H:i',
            'quote_description' => 'required|max:10000',
            'quoted_value' => 'required|numeric'
        ];
    }

    /**
     * Customize validation error messages.
     *
     * @return array
     */
    public function messages() {
        return [
            'client_name.required' => 'O nome do cliente é obrigatório.',
            'client_name.max' => 'O nome do cliente não pode ser maior que 255 caracteres.',
            'employee_name.required' => 'O nome do vendedor é obrigatório.',
            'employee_name.max' => 'O nome do vendedor não pode ser maior que 255 caracteres.',
            'quote_date.required' => 'A data do orçamento é obrigatória.',
            'quote_date.date' => 'A data deve estar em um formato válido.',
            'quote_time.required' => 'O horário do orçamento é obrigatório.',
            'quote_time.date_format' => 'O horário deve estar em um formato válido',
            'quote_description.required' => 'A descrição do orçamento é obrigatória.',
            'quote_description.max' => 'A descrição do orçamento não pode ser maior que 10000 caracteres.',
            'quoted_value.required' => 'O valor orçado é obrigatório.',
            'quoted_value.numeric' => 'O valor orçado deve estar em um formato válido.'
        ];
    }
}