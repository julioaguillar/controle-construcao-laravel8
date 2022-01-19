<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateServicoTomadoRequest extends FormRequest
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
            'data' => 'required|date',
            'servico_id' => 'required|integer',
            'prestador_servico_id' => 'nullable|integer',
            'forma_pagamento_id' => 'nullable|integer',
            'valor' => ['required', Helper::REGEX_MONEY_2_DIGITS],
            'pdf' => 'nullable|mimetypes:application/pdf|max:10000',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data' => 'Data',
            'servico_id' => 'Serviço',
            'prestador_servico_id' => 'Prestador de serviço',
            'forma_pagamento_id' => 'Forma de pagamento',
            'valor' => 'Valor do serviço',
            'pdf' => 'Arquivo (pdf)',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }

}
