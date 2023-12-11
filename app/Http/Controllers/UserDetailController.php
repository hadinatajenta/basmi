<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserDetailController extends Controller
{
    
    public function __construct()
    {
        return $this->middleware('auth');
    }

    //menampilkan detail user berdasarkan user id
    public function edit($id):View
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen_pengguna.user-detail',compact('user'));
    }

    public function update(Request $request ,$id):RedirectResponse
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan Login terlebih dahulu');
        }

        $pengguna = User::findOrFail($id);

        $request->validate([
            'foto_profil' => 'image',
            'name' => 'string|required|max:15',
            'last_name' => 'nullable|max:20',
            'email'=> [
                'required',
                'email',
                'max:40',
                Rule::unique('users','email')->ignore($pengguna)
            ],
            'nomor_telepon' => 'nullable|max:14',
            'nomor_karyawan' => 'nullable|max:20',
            'role' => 'in:admin,author'
        ]);

        if($pengguna->id ===  Auth::user()->id)
        {
            return redirect()->back()->with('error','Tidak dapat mengubah role diri sendiri menjadi author');
        }

        $pengguna->name = $request->name;
        $pengguna->last_name = $request->last_name;
        $pengguna->email = $request->email;

        $pengguna->role = $request->role;

        $pengguna->save();
        
        $userDetail = UserDetail::where('user_id', $id)->first();
        if ($userDetail) {
            if ($request->hasFile('foto_profil')) {
                if ($userDetail->foto_profil && Storage::disk('public')->exists($userDetail->foto_profil)) {
                    Storage::disk('public')->delete($userDetail->foto_profil);
                }
                $file = $request->file('foto_profil');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('images', $filename, 'public');
                $userDetail->foto_profil = $path;
            }
            $userDetail->nomor_telepon = $request->nomor_telepon;
            $userDetail->nomor_karyawan = $request->nomor_karyawan;
            $userDetail->jenis_kelamin = $request->jenis_kelamin;
            $userDetail->save();
        } else {
            return redirect()->route('users.home')->with('error','pengguna tidak ditemukan');
        }
        return redirect()->back()->with('success','informasi pengguna berhasil di perbaharui');
    }

}
