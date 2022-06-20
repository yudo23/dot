<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;

class AuthController extends Controller
{
    public function __construct(){
        $this->user = new User();
    }

    public function login(Request $request){
        $data_json = [];
        try {
            $email = trim(htmlentities($request->input("email")));
            $password = trim(htmlentities($request->input("password")));

            if(empty($email)){
                $data_json["IsError"] = TRUE;
                $data_json["Message"] = "Email tidak boleh kosong";
                goto ResultData;
            }

            if(empty($password)){
                $data_json["IsError"] = TRUE;
                $data_json["Message"] = "Password tidak boleh kosong";
                goto ResultData;
            }

            $data = [
                'email' => $email,
                'password' => $password
            ];

            $token = JWTAuth::attempt($data);

            if($token){
                $generate = [
                    'Token' => $token,
                    'Token_type' => 'Bearer',
                    'Expires_in' => JWTAuth::factory()->getTTL() * 60,
                    'User' => JWTAuth::user()
                ];

                $data_json["IsError"] = FALSE;
                $data_json["Message"] = "Login berhasil";
                $data_json["Data"] = $generate;
                goto ResultData;
            }
            else{
                $data_json["IsError"] = TRUE;
                $data_json["Message"] = "Email / password salah";
                goto ResultData;
            }

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function logout() {
        $data_json;
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
    
            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Logout berhasil";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function refresh() {
        $data_json;
        try {
            $generate = [
                'Token' => JWTAuth::refresh(),
                'Token_type' => 'Bearer',
                'Expires_in' => JWTAuth::factory()->getTTL() * 60,
                'User' => JWTAuth::user()
            ];
    
            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Refresh token berhasil";
            $data_json["Data"] = $generate;
            goto ResultData;
        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }
}
