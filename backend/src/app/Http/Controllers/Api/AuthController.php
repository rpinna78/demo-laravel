<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;


/** 
* ** DEMO-LARAVEL **
* Controller che si occupa du autenticazione
*/
class AuthController extends Controller
{
    /**
     * Create User
     * @param CreateUserRequest $request
     * @return JsonResponse 
     */
    public function createUser(CreateUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->jsonOK(['token' => $user->createToken("API TOKEN")->plainTextToken], ['User Created Successfully'], 401);
        } catch (\Throwable $th) {
            return response()->jsonKO($th->getMessage(), 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return JsonResponse
     */
    public function loginUser(LoginUserRequest $request)
    {
        try {
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->jsonKO(['Email & Password does not match with our record.'],401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->jsonOK(['token' => $user->createToken("API TOKEN")->plainTextToken], ['User Logged In Successfully']);

        } catch (\Throwable $th) {
            return response()->jsonKO([$th->getMessage()]);
        }
    }

    /**
     * Unauthorized
     * @param void
     * @return JsonResponse Json Unauthorized with 401
    */

    public function unauthorized()
    {
        return response()->jsonKO(['Non sei autorizzato ad accedere alla risorsa richiesta'],401);
    }
    
}