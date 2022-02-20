<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>'Bad Request']);

        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status'=>200,
            'message'=>'User created successfully'
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>'Bad Request'
            ]);
        }
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token= $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'status'=>200,
            'token'=>$token
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Token deleted successfully'
        ]);
    }
}
