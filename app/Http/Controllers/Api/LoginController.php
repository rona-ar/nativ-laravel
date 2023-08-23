<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function __invoke()
    {
        $validator = Validator::make(request()->all(), [
            'username'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = request()->only('username', 'password');

        if (!$token = auth()->guard('mobile')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'NIM atau Password Anda salah'
            ], 401);
        }

        //if auth success
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('mobile')->user(),
            'token'   => $token
        ], 200);
    }
}
