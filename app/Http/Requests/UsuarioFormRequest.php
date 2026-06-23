<?php

namespace sisClientes\Http\Requests;

use sisClientes\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email, $this->id,id',
            'password' => 'required|min:6|confirmed',
        ];        
        break;
        }
        case 'PATCH':
         {
            return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ];

        break;
        }
        default:break;

        }    

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email, $this->id,id',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
