<?php

namespace App\Http\Controllers;

use App\Models\AddonManager;
use Exception;
use Illuminate\Support\Str;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APITransCtrl extends Controller
{

    // membuat transaksi
    public function store(Request $req)
    {
        $notrans = "P" . date("Ymdhis") . Str::upper(Str::random(5));

        $request = $req->json()->all();

        try {
            Transactions::create([
                "no_trans" => $notrans,
                "tgl_trans" => date("Y-m-d"),
                "id_user" => $request["id_user"],
                "id_addon" => $request["id_addon"],
                "gtotal_trans" => $request["gtotal_trans"],
                "diskon_trans" => $request["diskon_trans"],
                "pay_trans" => $request["pay_trans"],
                "type_payment_trans" => $request["type_payment_trans"],
                "number_card_trans" => $request["number_card_trans"],
                "status_trans" => $request["status_trans"],
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

        return response()->json($result)->header("Content-Type", "application/json");
    }
}
