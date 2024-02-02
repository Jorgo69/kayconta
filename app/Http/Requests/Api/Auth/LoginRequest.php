<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'success'=> false,
            'error' => true,
            'message' => 'Certaines informations ne correspondent pas',
            'errorsList'=> $validator->errors(),
        ]));
    }

    public function messages(){
        return[
            'email.required' => 'Adresse email est necessaire',
            'email.email' => 'Email non valide',
            'email.exists'=> 'Adresse Introuvable',
            'password.required' => 'Un mot de passe est requis',
        ];
    }
}
