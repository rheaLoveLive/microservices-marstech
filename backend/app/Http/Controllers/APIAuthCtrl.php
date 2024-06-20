<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIAuthCtrl extends Controller
{
    function Login(Request $request)
    {
        $dtLogin = $request->json()->all();
        $rsLogin = User::where('email', $dtLogin['email'])->where('status', 1)->first();

        if ($rsLogin) {
            if (Hash::check($dtLogin['password'], $rsLogin->password)) {
                $result = [
                    "error" => false,
                    "message" => "Login Berhasil !",
                    "data" => [
                        "user" => $rsLogin
                    ]
                ];
            } else {
                $result = [
                    "error" => true,
                    "message" => "Password Salah",
                    "data" => null,
                ];
            }
        } else {
            $result = [
                "error" => true,
                "message" => "User Tidak ditemukan",
                "data" => null,
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');
    }

    function resgistration(Request $request)
    {

        $dtReg = $request->json()->all();

        $validation = Validator::make(
            $dtReg,
            [
                "password" => "min:6",
                "email" => "unique:users",
            ],
            [
                "password.min" => "Maaf Password Harus 6 Digit",
                "email.unique" => "Maaf Email Sudah Digunakan !"
            ]
        );

        if ($validation->fails()) {
            $result = [
                "error" => true,
                "data" => $validation->errors()
            ];
            return response()->json($result)->header('Content-Type', 'application/json');

        }


        try {

            $dtUser = User::create([
                "name" => $dtReg["name"],
                "email" => $dtReg["email"],
                "password" => Hash::make($dtReg["password"]),
                "role" => "user",
                "status" => 1,
            ]);

            $result = [
                "error" => false,
                "data" => null
            ];

        } catch (Exception $err) {

            $result = [
                "error" => true,
                "data" => null
            ];

        }

        return response()->json($result)->header('Content-Type', 'application/json');

    }
}
