<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'nombre'=>'required|max:50',
            'apellidos'=>'required|max:100',
            'email' => 'required|email|max:250',
            'telefono' => 'required',
            'direccion' => 'required|max:250',
            'fecha_entrega' => 'required|date_format:"d/m/Y"',
            'hora_desde' => 'required|integer',
            'hora_hasta' => 'required|integer|max:24|gt:hora_desde',
        ];
    }
}
