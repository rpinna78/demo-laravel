<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\BookPrivacyEnum;
use App\Enums\BookStatusEnum;

/** 
* ** DEMO-LARAVEL **
* FormRequest che lavora sulle regole che entrano in gioco in fase di creazione Book 
*/
class CreateBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'status' => [new Enum(BookStatusEnum::class)],
            'privacy' => [new Enum(BookPrivacyEnum::class)],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'title changed',
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
            'status' => 'Valid values are `draft`,`saved` and `hidden`.'
        ];
    }
}
