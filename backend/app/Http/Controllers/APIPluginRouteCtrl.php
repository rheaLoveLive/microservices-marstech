<?php

namespace App\Http\Controllers;

use App\Models\PluginRoutes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIPluginRouteCtrl extends Controller
{

    // ambil route jika addon statusnya lebih dari 0 dan dan jika user sudah membelinya atau belum 
    public function getRoutes(Request $req)
    {
        $request = $req->json()->all();

        try {
            $dtPlug = DB::table('transactions AS t')
                ->leftJoin('plugin_routes AS r', 'r.id_addon', 't.id_addon')
                ->leftJoin('addons AS ad', 'ad.id', '=', 't.id_addon')
                ->select('r.*', 'ad.status', 'ad.name AS addon_name')
                ->where('ad.status', '>', 0)
                ->where('t.id_user', '=', $request['id_user'])
                ->get();
            $result = [
                "error" => false,
                "data" => $dtPlug
            ];

        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => $err->getMessage()
            ];
        }

        return response()->json($result);
    }

    // masih belum berguna 
    public function getAllRoutes()
    {
        try {
            $dtPlug = DB::table('plugin_routes AS r')
                ->leftJoin('addons AS ad', 'ad.id', 'r.id_addon')
                ->select('r.*', 'ad.status', 'ad.name AS addon_name')
                ->get();
            $result = [
                "error" => false,
                "data" => $dtPlug
            ];

        } catch (Exception $err) {
            $result = [
                "error" => true,
                "data" => null
            ];
        }

        return response()->json($result);
    }
}
