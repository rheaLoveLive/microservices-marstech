<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public $title = "User";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtUser" => User::all(),
            "edit" => false
        ];

        return view('user.data_user', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtUser" => User::all(),
            "edit" => false
        ];

        return view('user.form_user', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Simpan Data
        try {
            User::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => Hash::make($request->input('password')),
                "role" => $request->input('role'),
                "status" => $request->input('status'),
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

        return redirect(route('user.index'))->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            "title" => $this->title,
            "page_title" => "Data " . $this->title,
            "dtUser" => User::all(),
            "rsUser" => User::where("id", $user->id)->first(),
            "edit" => true
        ];

        return view('user.form_user', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {



        // Simpan Data
        try {
            User::find($user->id)->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $request->input('password') ? Hash::make($request->input('password')) : $request->input('old_password'),
                "role" => $request->input('role'),
                "status" => $request->input('status'),
            ]);

            // Notif Jika berhasil di Update
            $notif = [
                'type' => 'success',
                'text' => 'Data Berhasil Di Update'
            ];
        } catch (Exception $err) {
            // Notif Jika Gagal di Hapus
            $notif = [
                'type' => 'danger',
                'text' => 'Data Gagal Di Hapus'
            ];
        }

        return redirect(route('user.index'))->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            User::find($user->id)->delete();

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
