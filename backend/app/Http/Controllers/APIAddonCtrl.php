<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Addons;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIAddonCtrl extends Controller
{

    // ambil semua data addon tanpa syarat
    function getAll()
    {
        try {
            $dtAddon = Addons::all();
            
            $result = [
                "error" => false,
                "data" => $dtAddon
            ];

        } catch (Exception $err) {

            $result = [
                "error" => true,
                "data" => $err->getMessage(),
            ];
        }
        return response()->json($result)->header('Content-Type', 'application/json');
    }

    // ambil data addon beserta transaksinya (dibeli) jika ada
    function getAddonWithTrans(Request $req)
    {

        $request = $req->json()->all();

        try {
            $dtAddon = DB::table('addons AS ad')
                ->leftJoin('transactions AS t', function (JoinClause $join) use ($request) {
                    $join->on('t.id_addon', '=', 'ad.id')
                        ->where('t.id_user', '=', $request['id_user']);
                })
                ->select('ad.*', 't.status_trans', 't.id_user')
                ->get();
            $result = [
                "error" => false,
                "data" => $dtAddon
            ];

        } catch (Exception $err) {

            $result = [
                "error" => true,
                "data" => $err->getMessage(),
            ];
        }
        return response()->json($result)->header('Content-Type', 'application/json');
    }

    // update status addon
    function updateStat(Request $req)
    {
        $request = $req->json()->all();

        try {

            Addons::where('id', '=', $request['id_addon'])
                ->update([
                    "status" => $request['status']
                ]);

            $dtAddon = Addons::where('id', '=', $request['id_addon'])->first();

            $result = [
                "error" => false,
                "data" => $dtAddon
            ];

        } catch (Exception $err) {

            $result = [
                "error" => true,
                "data" => $err->getMessage(),
            ];
        }
        return response()->json($result)->header('Content-Type', 'application/json');
    }

}
