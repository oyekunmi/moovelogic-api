<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class LoginController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';        
        $this->validate($request, [
            $fieldType => 'required',
            'password' => 'required',
        ]);

        $fields = array($fieldType => $input[$fieldType], 'password' => $input['password']);
        if($token = auth()->attempt($fields)){
            $data  = [
                'user' => auth()->user(),
                'token' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL()
                ]
            ];
            return $this->sendResponse($data, 'Login successful.');
        } else {
            return $this->sendError('The provided login details is not valid. Please verify , then try again', 'Invalid Login Credentials.');
        }


    }
}