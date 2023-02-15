<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
* ** DEMO-LARAVEL **
* FormRequest che lavora sulle regole che entrano in gioco in fase di creazione Utente
*/
class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];
    }
}
