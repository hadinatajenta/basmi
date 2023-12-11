<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //menampilkan semua pengguna pada halaman 'users'
    public function index()
    {
        $pengguna = User::all();
        $author = User::where('role','author')->count();
        $admin = User::where('role','admin')->count();
        return view('admin.manajemen_pengguna.users',compact('pengguna','author','admin'));
    }

    //Fungsi untuk menambahkan dan menyimpan pengguna baru pada halaman 'users'
    public function store (Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:15',
            'email'=>'required|string|email|unique:users|max:40',
            'password'=>'required|string|min:8',
        ]);

        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->input('role', 'author');
        $user->save();

        $userDetail = New UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->save();

        if($user->save())
        {
            return redirect()->back()->withInput()->with('success','Berhasil menambahkan karyawan baru!');
        }else{
            return redirect()->back()->withInput()->with('error','Tidak dapat menambahkan karyawan dengan email yang telah digunakan');
        }
    }

    //Fungsi untuk mengahpus karyawan
    public function delete($id)
    {
        if(Auth::user()->id  == $id)
        {
            return redirect()->route('users.home')->with('error','Tidak dapat menghapus diri sendiri');
        }
        
        $pengguna = User::findOrFail($id);

        if($pengguna)
        {
            $pengguna->delete();
            return redirect()->route('users.home')->with('success','Karyawan berhasil di hapus');
        }
        elseif(!$pengguna)
        {
            return redirect()->route('users.home')->with('error','Karyawan tidak ditemukan!');
        }
        
    }
}
