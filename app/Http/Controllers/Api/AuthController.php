<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Class AuthController extends Controller{
    use ApiResponses;

    public function login(LoginUserRequest   $request)
    {
        $request->validated($request->all());
        if (!Auth::attempt($request->only(["email","password"]))) {
            return $this->error(
                "",
                "Password or/and Email error",
                422
            );
        }
        $user = User::whereEmail($request->email)->first();

         


        return $this->success(
            [
                "user"=>$user,
                "token"=>$user->createToken(
                    "API TOKEN of".$user->surname,
                    [$user->roles]
                )->plainTextToken,

            ],
            "User is auth"
        );
        
    }

    public function register(StoreUserRequest $request)
    {
        
            $request->validated($request->all());
            $user = User::create([
                'surname' => $request->surname,
                'firstname' => $request->firstname,
                'password' => $request->password,
                'birthdate' => $request->birthdate,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'tel' => $request->tel,
                'sexe' => $request->sexe,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);


            return $this->success(
                [
                    "token"=>$user->createToken(
                        "API TOKEN of ".$user->surname,
                        [$user->roles] // ability pass to token
                    )->plainTextToken,
                    "user"=>$user
                ],
                "User Created Successfully",
                201
            );

      
    }


    public function registerAdmin(StoreUserRequest $request)
    {
        //Only Super Admin can store user with ability is admin
        //If you want store admin
        //Store manually in DB, one user with role=>"super_admin"
        //And login with credential(After ,you can store admin)

            $request->validated($request->all());
            $user = User::create([
                'surname' => $request->surname,
                'firstname' => $request->firstname,
                'password' => $request->password,
                'birthdate' => $request->birthdate,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'tel' => $request->tel,
                'sexe' => $request->sexe,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);


            return $this->success(
                [
                    "token"=>$user->createToken(
                        "API TOKEN of ".$user->surname,
                        ["admin"] // ability "admin" pass to token
                    )->plainTextToken,
                    "user"=>$user
                ],
                "Admin is  Created Successfully",
                201
            );

      
    }

    




   

    public function logout(Request $request)
    {
         Auth::currentAccessToken()->delete();

         return $this->success("","You have logout",400);
    }
}