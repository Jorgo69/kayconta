<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
        $register = new User();
        $register->pseudo = $request->pseudo;
        $register->email = $request->email;
        $register->password = Hash::make($request->password);
        
        $register->save();

            return response()->json([
                'status' => 'success',
                'status_code' => 'Compte cree avec success',
                'data' => $register,

            ], 200);
        } catch (Exception $exception) {
            return response()->json($exception);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if(auth()->attempt($request->only('email', 'password')))
            {
                $auth = auth()->user();
                $token = $auth->createToken(env('USER_AUTH_TOKEN'))->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'status_message' => 'Connectez avec success',
                    'auth_user' => $auth,
                    'token' => $token
                ]);
            }else{
                return response()->json([
                'staus' => 403,
                'status_code' => 'Information non valide',
                ]);
            }
        }catch (Exception $error) {
             return response()->json($error);
        }
    }
}
