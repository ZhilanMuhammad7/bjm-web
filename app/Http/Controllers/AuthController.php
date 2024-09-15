<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['login', 'register', 'postRegister', 'postlogin']);
    // }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $data = new User;

        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->input('password'));
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->role = 'user';

        $post = $data->save();

        return redirect()->route('auth.login')->with('success', 'Berhasil Melakukan Pendaftaran');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            switch (Auth::user()->role) {
                case 'user':
                    return redirect('/');
                case 'marketing':
                    return redirect()->route('dashboard.index');
                case 'supervisor':
                    return redirect()->route('dashboard.index');
                case 'owner':
                    return redirect()->route('dashboard.index');
                default:
                    return redirect()->route('auth.login')->with('error', 'username atau password salah!');
            }
        }
        return redirect()->route('auth.login')->with('error', 'username atau password salah!');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
