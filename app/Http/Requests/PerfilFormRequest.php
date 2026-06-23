<?php

namespace sisClientes\Http\Requests;

use sisClientes\Http\Requests\Request;

class PerfilFormRequest extends Request
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
        switch($this->method()){
        case 'POST':
        {
        return [
            'descripcion' => 'required|max:255',

        ];        
        break;
        }
        case 'PATCH':
         {
            return [
            'descripcion' => 'required|max:255',

        ];

        break;
        }
        default:break;

        }    

        return [
            'descripcion' => 'required|max:255',

        ];
    }
}
