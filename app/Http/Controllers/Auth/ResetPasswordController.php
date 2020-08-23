<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;

class ResetPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    // protected function sendResetResponse(Request $request, $response)
    // {
    //     return $this->sendResponse("Password has been reset", "Password has been reset");
    // }

    // protected function sendResetFailedResponse(Request $request, $response)
    // {
    //      return $this->sendError("Password reset failed", "Password reset failed");
    // }

    public function validateToken(Request $request){
        $data = $request->validate(['token' => ['required', 'string', 'min:4', 'max:4']]);

        $validToken = User::where('token',$data['token'])->first();
        // echo($validToken);
        // die();
        
        if($validToken == null){
            return $this->sendError("Invalid token.", "Invalid token.");
        }
        return $this->sendResponse("Token is valid.", "Token is valid");
    }
    
    public function reset(Request $request){
   
        $data = $request->validate([
            'token' => ['required', "string", "min:4", "max:4"],
            'new_password' => ['required', 'string', 'min:8','confirmed'],
                
            ]);
            
        $user = User::where('token', $data['token'])->first();
        // echo ($user->password);
        // die();
            
        if ($user == null){
            return $this->sendError("The token is invalid", "The token is invalid");
        }
        
        User::where('token', $data['token'])->update(['password' => bcrypt($data['new_password'])]);

        return $this->sendResponse("Password reset successful.", "Password reset successful.");
        

    }

}
