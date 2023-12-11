<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Halaman;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index():View
    {
        $halaman = Halaman::orderBy('created_at','desc')->paginate(10);
        return view ('admin.manajemen_halaman.halaman',compact('halaman'));
    }

    //tambah halaman 
    public function create():View
    {
        return view('admin.manajemen_halaman.add');
    }

    //Simpan data halaman baru
    public function store(Request $request):RedirectResponse
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan login terlebih dahulu');
        }
        //Validasi disini
        $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi'=>'string|max:150',
            'keyword' => 'string|max:150',
        ]);

        $pages = new Halaman();
        $pages->judul = $request->judul;
        $pages->deskripsi = $request->deskripsi;
        $pages->keyword = $request->keyword;
        $pages->konten = $request->konten;
        $pages->slug = Str::slug($request->judul);
        $pages->urutan_menu = 0;
        $pages->user_id = Auth::id();

        $pages->save();

        return redirect()->route('halaman')->with('success','berhasil menambahkan halaman baru');

    }

    //halaman edit pages
    public function edit($id):View
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan login terlebih dahulu');
        }
        $pages = Halaman::find($id);
        return view('admin.manajemen_halaman.edit-halaman',compact('pages'));
    }

    //fungsi hapus pages
    public function update(Request $request, $id):RedirectResponse
    {
        $pages = Halaman::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi'=>'string|max:150',
            'keyword' => 'string|max:150',
        ]);
        $pages->judul = $request->judul;
        $pages->deskripsi = $request->deskripsi;
        $pages->keyword = $request->keyword;
        $pages->konten = $request->konten;

        $pages->save();

        return redirect()->route('halaman')->with('success','Berhasil memperbarui halaman!');
    }

    //hapus halaman
    public function destroy( $id)
    {
        if(!Auth::check())
        {
            return redirect()->route('login')->with('error','Silahkan Login terlebih dahulu');
        }
        $halaman = Halaman::find($id);
        
        if($halaman){
            $halaman->delete();
            return redirect()->route('halaman')->with('success','Halaman berhasil dihapus!!');
        }else{
            return redirect()->route('halaman')->with('error','Halaman tidak ditemukan!!');
        }
    }

    public function showHalaman($slug)
    {
        $halaman = Halaman::where('slug',$slug)->firstOrFail();
        return view('pages',compact('halaman'));
    }


}
