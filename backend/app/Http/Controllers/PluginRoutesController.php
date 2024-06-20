<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Addons;
use App\Models\PluginRoutes;
use App\Models\Transactions;
use App\Http\Requests\StorePluginRoutesRequest;
use App\Http\Requests\UpdatePluginRoutesRequest;

class PluginRoutesController extends Controller
{

    public $title = "Plugin Route";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtPlugin" => PluginRoutes::all(),
            "dtAddon" => Addons::all(),
            "edit" => false
        ];

        return view('route.data_route', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtPlugin" => PluginRoutes::all(),
            "dtAddon" => Addons::all(),
            "edit" => false
        ];

        return view('route.form_route', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePluginRoutesRequest $request)
    {
        try {
            PluginRoutes::create([
                "name" => $request->input('name'),
                "id_addon" => $request->input('id_addon'),
                "path" => $request->input('path'),
                "icon" => $request->input('icon'),
            ]);

            // Notif Jika berhasil disimpan
            $notif = [
                'type' => 'success',
                'text' => 'Data Berhasil Di Simpan'
            ];
        } catch (Exception $err) {
            // Notif Jika Gagal disimpan

            $notif = [
                'type' => 'danger',
                'text' => 'Data Gagal Di Simpan'
            ];
        }

        return redirect()->route('route.index')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(PluginRoutes $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PluginRoutes $route)
    {

        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtAddon" => Addons::all(),
            "dtPlugin" => PluginRoutes::all(),
            "rsPlugin" => PluginRoutes::where("id", $route->id)->first(),
            "edit" => true
        ];

        return view('route.form_route', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePluginRoutesRequest $request, PluginRoutes $route)
    {
        try {
            PluginRoutes::find($route->id)->update([
                "name" => $request->input('name'),
                "id_addon" => $request->input('id_addon'),
                "path" => $request->input('path'),
                "icon" => $request->input('icon'),
            ]);

            // Notif Jika berhasil disimpan
            $notif = [
                'type' => 'success',
                'text' => 'Data Berhasil Di Update'
            ];
        } catch (Exception $err) {
            // Notif Jika Gagal disimpan

            $notif = [
                'type' => 'danger',
                'text' => 'Data Gagal Di Update'
            ];
        }

        return redirect()->route('route.index')->with('notif', $notif);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PluginRoutes $route)
    {
        try {
            PluginRoutes::find($route->id)->delete();

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
