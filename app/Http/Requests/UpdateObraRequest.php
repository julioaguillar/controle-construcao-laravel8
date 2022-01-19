<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObraRequest extends FormRequest
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
            'proprietario' => 'required|max:100',
            'endereco' => 'max:150',
            'inicio' => 'required',
            'metragem' => 'nullable',
            'cub' => 'nullable',
        ];
    }
}
