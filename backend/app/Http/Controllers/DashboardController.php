<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Addons;
use App\Models\PluginRoutes;
use App\Models\Transactions;

class DashboardController extends Controller
{
    public $title = "Dashboard";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            $jumlah_user = User::where("role", "user")->count(),
            $jumlah_addonc = Addons::all()->count(),
            $jumlah_trans = Transactions::all()->count(),
            $jumlah_route = PluginRoutes::all()->count(),

        ];

        return view('dashboard', $data, compact('jumlah_user', 'jumlah_addonc', 'jumlah_trans', 'jumlah_route'));
    }


}
