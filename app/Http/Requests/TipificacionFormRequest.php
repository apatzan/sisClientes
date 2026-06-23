<?php

namespace sisClientes\Http\Requests;

use sisClientes\Http\Requests\Request;

class TipificacionFormRequest extends Request
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
            // Validacion del campo descripcion
                    'descripcion' =>'required|max:50',
                    'estado' =>'required',
                    'esPromesa'=>'required',


        ];
    }
}