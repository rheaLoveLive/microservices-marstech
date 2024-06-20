<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Addons;
use Illuminate\Support\Str;
use App\Models\Transactions;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;

class TransactionsController extends Controller
{

    public $title = "Transaksi";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtTrans" => DB::table('transactions AS t')
                ->leftJoin('users AS u', 'u.id', 't.id_user')
                ->leftJoin('addons AS ad', 'ad.id', 't.id_addon')
                ->select('t.*', 'u.name AS user_name', 'ad.name AS addon_name')
                ->get(),
            "edit" => false

        ];

        return view("trans.data_trans", $data);
    }

    public function edit(Transactions $tran)
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtUser" => User::all(),
            "dtAddon" => Addons::all(),
            "rsTrans" => Transactions::where("id", $tran->id)->first(),
            "edit" => true
        ];

        return view('trans.form_trans', $data);
    }

    public function show()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionsRequest $request, Transactions $tran)
    {
        try {
            Transactions::find($tran->id)->update([
                "tgl_trans" => date("Y-m-d"),
                "id_user" => $request->input("id_user"),
                "name_user" => $request->input("name_user"),
                "id_addon" => $request->input("id_addon"),
                "gtotal_trans" => $request->input('gtotal_trans'),
                "diskon_trans" => $request->input('diskon_trans'),
                "pay_trans" => $request->input('pay_trans'),
                "type_payment_trans" => $request->input('type_payment_trans'),
                "number_card_trans" => $request->input('number_card_trans'),
                "status_trans" => $request->input('status_trans'),
            ]);

            $notif = [
                "type" => "success",
                "text" => "Data berasil diedit !",
            ];
        } catch (Exception $err) {
            $notif = [
                "type" => "danger",
                "text" => "Data gagal diedit !",
            ];
        }

        return redirect()->route('trans.index')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $tran)
    {

        try {
            Transactions::find($tran->id)->delete();

            // Notif Jika berhasil Di Hapus
            $notif = [
                'type' => 'danger',
                'text' => 'Data Berhasil Di Hapus'
            ];
        } catch (Exception $err) {
            // Notif Jika Gagal Di Di Hapus
            $notif = [
                'type' => 'success',
                'text' => 'Data Gagal Di Hapus'
            ];
        }

        return redirect()->back()->with('notif', $notif);
    }
}
