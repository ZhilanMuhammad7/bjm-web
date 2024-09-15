<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Pengguna::orderBy('pengguna_id', 'desc')->get();
        // return view('Supervisor.formPengguna',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => $request->password,
            'role' => $request->role
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Memasukkan Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pengguna tidak ditemukan',
            ]);
        }

        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pengguna tidak ditemukan',
            ]);
        }
        $data->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => $request->password,
            'role' => $request->role
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah data',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan delete Data',
        ]);
    }

    public function tablePengguna()
    {
        $data = User::whereIn('role', ['marketing', 'supervisor'])->get();
        return view('Admin.Supervisor.tablePenguna', compact('data'));
    }
    public function postPengguna(Request $request)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->input('password')),
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role,
        ];

        User::create($data);

        return redirect()->route('pengguna.tablePengguna')->with('success', 'Berhasil Menambahkan Data User');
    }
}

