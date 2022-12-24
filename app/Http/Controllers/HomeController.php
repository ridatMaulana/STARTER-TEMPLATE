<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home',compact('user'));
    }

    public function profile()
    {
        $data['user'] = Auth::user();
        $role = Role::where('id', $data['user']->roles_id)->get();
        foreach ($role as $roles)
        {
            $data['role'] = $roles;
        }
        return view('admin/profil')->with($data);
    }

    public function change_password()
    {
        return view('admin/password');
    }

    public function store(Request $req)
    {
        $user = Auth::user();
        $validated = $req->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($req->old_password, $user->password)) {
            if (Hash::check($req->password, $user->password)) {
                return redirect()->back()->withErrors("Password baru yang anda masukan sama dengan password lama anda");
            }else{
                $user->password = Hash::make($req->password);
                $user->save();
                $notification = array(
                    'message' => 'password berhasil diubah',
                    'alert-type' => 'success'
                );

                 return redirect()->route('change_password')->with($notification);
            }
        }else{
            return redirect()->back()->withErrors("Password lama yang anda masukan salah");
        }
    }
}
