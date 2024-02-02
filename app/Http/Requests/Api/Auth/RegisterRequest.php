<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pseudo' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|unique:users,email|min:2 |max:255',
            'password' => 'required|min:7',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'error' => true,
            'message' => 'Veillez fournie toutes les infos',
            'errorsList'=> $validator->errors(),
        ]));
    }

    public function messages(){
        return[
            'pseudo.required' => 'Veillez fourni un Pseudo',
            'pseudo.min' => 'Le champs Pseudo doit avoir plus de 2 caractere',
            'pseudo.max' => 'Le champs doit avoir moins de 255 caractere',
            'email.required' => 'Adresse email est necessaire',
            'email.unique' => 'Adresse Email deja utilise',
            'email.email' => 'Email non valide',
            'password.required' => 'Un mot de passe est requis',
            'password.min' => 'Votre mot de passe doit avoir au moins 7 caractere',
        ];
    }
}
