<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;

class AuthController extends BaseController
{

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function register(UserRegisterRequest $request)
    {
      
        $data = $request->except('_token','password','password_confirmation');
    
      $data['password'] =bcrypt($request->password);

 

      if($user = $this->user->create($data)){
       
            $token = $user->createToken('API Token')->plainTextToken;

       
        return $this->success([
            'message' => 'User Register Successfully ',
            'accessToken' => $token,
            'data' => new UserResource($user)
        ]);
      }
      return $this->error('Opps Something went wrong pls check the form ');
    }
    public function login(LoginRequest $request)
    {
       $data = $request->except('_token');

       if (!Auth::attempt($data)) {
        return $this->error('Credentials not match', 401);
    }
       

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'user'=>auth()->user(),
            'message'=>'Login Successfull'
        ]);
    }
}
