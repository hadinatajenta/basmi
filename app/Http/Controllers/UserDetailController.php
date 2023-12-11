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
        $genderOptions = ['laki-laki' => 'Laki-laki', 'perempuan'=> 'Perempuan'];
        $roleOptions =['admin'=>'admin', 'author'=> 'author'];
        return view('admin.manajemen_pengguna.user-detail',compact('user','genderOptions','roleOptions'));
    }

    public function update(Request $request ,$id):RedirectResponse
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan Login terlebih dahulu');
        }

        $pengguna = User::findOrFail($id);

        $request->validate([
            'foto_profil' => 'image',
            'name' => 'string|required',
            'last_name' => 'nullable',
            'email'=> [
                'required',
                'email',
                'max:40',
                Rule::unique('users','email')->ignore($pengguna->id)
            ],
            'nomor_telepon' => 'nullable|min:11',
            'nomor_karyawan' => 'nullable|min:16|max:20',
            'role' => 'in:admin,author'
        ]);

        
        $pengguna->name = $request->name;
        $pengguna->last_name = $request->last_name;

        $pengguna->email = $request->email;

        //Validasi role user admin yang saat ini login tidak dapat mengubah diri sendiri menjadi author
        $pengguna->role = $request->role;
        if($pengguna->id ===  Auth::user()->id && $request->role == 'author')
        {
            return redirect()->back()->with('error','Tidak dapat mengubah role diri sendiri menjadi author');
        }

        //Simpan perubahan pada model User
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
            $userDetail->tanggal_lahir = $request->tanggal_lahir;
            $userDetail->nomor_karyawan = $request->nomor_karyawan;
            $userDetail->jenis_kelamin = $request->jenis_kelamin;
            $userDetail->save();
            return redirect()->back()->with('success','informasi pengguna berhasil di perbaharui');
        } else {
            return redirect()->route('users.home')->with('error','pengguna tidak ditemukan');
        }
    }

}
