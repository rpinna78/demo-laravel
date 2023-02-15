<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
* ** DEMO-LARAVEL **
* FormRequest che lavora sulle regole che entrano in gioco in fase login utente
*/
class LoginUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
