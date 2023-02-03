<?php

namespace App\Http\Requests;

use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'surname' => ['required',"string","max:255","min:4"],
            'firstname' => ['required',"string","max:255","min:4"],
            'email' => ['required',"string","max:255","unique:users"],
            'password' => ['required',"min:6"],
            'birthdate' => ['required'],
            'country' =>['required'],
            'city' =>['required'],
            'address' =>['required'],
            'tel' =>['required'],
            'sexe' =>['required'],
            'niveau' =>['required'],
        ];
    }
}
