<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Addons;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAddonsRequest;
use App\Http\Requests\UpdateAddonsRequest;

class AddonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $title = "Addon";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtAddon" => Addons::all(),
            "edit" => false
        ];

        return view('addons.data_addon', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtAddon" => Addons::all(),
            "edit" => false
        ];

        return view('addons.form_addon', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddonsRequest $request)
    {
        // Upload Foto
        if ($request->file("file_icon")) {
            $fileName = Str::random(6) . time() . '.' . $request->file("file_icon")->extension();
            //Proses Upload
            $request->file("file_icon")->move(public_path('uploads/icon'), $fileName);
        } else {
            $fileName = null;
        }


        // Simpan Data
        try {
            Addons::create([
                "name" => $request->input('name'),
                "category" => $request->input('category'),
                "price" => $request->input('price'),
                "status" => $request->input('status'),
                "icon" => $fileName,
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

        return redirect(route('addon.index'))->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Addons $addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Addons $addon)
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtAddon" => Addons::all(),
            "rsAddon" => Addons::where("id", $addon->id)->first(),
            "edit" => true
        ];

        return view('addons.form_addon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddonsRequest $request, Addons $addon)
    {


        // Upload Foto
        if ($request->file("file_icon")) {
            $fileName = Str::random(6) . time() . '.' . $request->file("file_icon")->extension();
            //Proses Upload
            $request->file("file_icon")->move(public_path('uploads/icon'), $fileName);
        } else {
            $fileName = null;
        }


        // Simpan Data
        try {
            Addons::find($addon->id)->update([
                "name" => $request->input('name'),
                "category" => $request->input('category'),
                "price" => $request->input('price'),
                "status" => $request->input('status'),
                "icon" => $fileName,
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

        return redirect(route('addon.index'))->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addons $addon)
    {
        try {
            Addons::find($addon->id)->delete();

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
