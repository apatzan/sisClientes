<?php

namespace sisClientes\Http\Requests;

use sisClientes\Http\Requests\Request;

class ClienteFormRequest extends Request
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
            'idCliente' =>required,
            'idTipif' =>required,
            'observacion' =>'max:200',
            'fechaPromes' =>date


        ];
    }
}
