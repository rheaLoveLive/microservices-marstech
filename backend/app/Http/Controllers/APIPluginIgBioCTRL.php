<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePluginIgBioRequest;
use App\Models\PluginIgBio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class APIPluginIgBioCTRL extends Controller
{
    public function index()
    {
        try {

            $dtBio = PluginIgBio::all();

            $result = [
                "error" => false,
                "data" => $dtBio,
            ];
        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => null,
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $rules = [
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:plugin_ig_bios',
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:13',
            'agama' => 'required'
        ];

        $messages = [
            'nama.required' => 'Nama Wajib Di Isi !',
            'nama.max' => 'Nama Maksimal 50 Karakter !',
            'alamat.required' => 'Kategori Wajib Di Isi !',
            'alamat.max' => 'Kategori Maksimal 100 Karakter !',
            'email.required' => 'Email Wajib Di Isi !',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email sudah digunakan',
            'agama.required' => 'Email Wajib Di Isi !',
            'no_hp.required' => 'Email Wajib Di Isi !',
            'no_hp.max' => "Kategori Maksimal 13 Karakter !",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validator->errors(),
            ])->header('Content-Type', 'application/json');
        }

        $validatedData = $validator->validated();

        try {
            $dtBio = PluginIgBio::create($validatedData);

            $result = [
                "error" => false,
                "data" => $dtBio,
            ];
        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => null,
                "message" => $err->getMessage(),
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');
    }

    public function edit(Request $request)
    {
        $req = $request->json()->all();

        try {
            $dtBio = PluginIgBio::where('id', $req['id'])->first();

            $result = [
                "error" => false,
                "data" => $dtBio,
            ];

        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => null,
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');

    }


    public function update(Request $request)
    {

        $rules = [
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:plugin_ig_bios,email,' . $request->id,
            'alamat' => 'required|max:100',
            'no_hp' => 'required|max:13',
            'agama' => 'required'
        ];

        $messages = [
            'nama.required' => 'Nama Wajib Di Isi !',
            'nama.max' => 'Nama Maksimal 50 Karakter !',
            'alamat.required' => 'Kategori Wajib Di Isi !',
            'alamat.max' => 'Kategori Maksimal 100 Karakter !',
            'email.required' => 'Email Wajib Di Isi !',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email sudah digunakan',
            'agama.required' => 'Email Wajib Di Isi !',
            'no_hp.required' => 'Email Wajib Di Isi !',
            'no_hp.max' => "Kategori Maksimal 13 Karakter !",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validator->errors(),
            ])->header('Content-Type', 'application/json');
        }

        $validatedData = $validator->validated();

        try {
            $dtBio = PluginIgBio::find($request->id)->update($validatedData);

            $result = [
                "error" => false,
                "data" => $dtBio,
            ];
        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => null,
                "message" => $err->getMessage(),
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {

        try {
            PluginIgBio::find($request->id)->delete();

            // Notif Jika berhasil Di Hapus
            $result = [
                'error' => false,
                'message' => 'Data Berhasil Di Hapus'
            ];
        } catch (Exception $err) {
            // Result Jika Gagal Di Di Hapus
            $result = [
                'error' => true,
                'message' => 'Data Gagal Di Hapus'
            ];
        }

        return response()->json($result)->header('Content-Type', 'application/json');

    }
}

