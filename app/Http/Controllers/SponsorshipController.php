<?php

namespace App\Http\Controllers;

use App\Models\SponsorTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //halaman sponsorshi
    public function index():View
    {
        $jenisIklan = SponsorTypes::all();
        return view('admin.manajemen_iklan.sponsorship',compact('jenisIklan'));
    }

    //ubah data
    public function update(Request $request, $id):RedirectResponse
    {
        if(!Auth::user())
        {
            return redirect()->route('login')->with('success','Silahkan login terlebih dahulu');
        }

        $jenisIklan = SponsorTypes::find($id);

        $request->validate([
            'jenis_iklan' => 'required',
            'price' => 'required',
            'deskripsi' =>'nullable'
        ]);

        if($jenisIklan)
        {
            $jenisIklan->jenis_iklan = $request->input('jenis_iklan');
            $jenisIklan->price = $request->input('price');
            $jenisIklan->deskripsi = $request->input('deskripsi');
            $jenisIklan->save();

            return redirect()->route('sponsorship')->with('success','Berhasil memperbarui informasi jenis iklan');
        }else{
            return redirect()->route('sponsorship')->with('error','Gagal memperbarui informasi jenis iklan');
        }


    }
}
