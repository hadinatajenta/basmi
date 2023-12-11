<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $kategori = Category::all();
        return view('admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $kategori = new Category();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->jumlah_postingan = '0';

        $kategori->save();

        return redirect()->route('kategori')->with('success','Berhasil menambahkan kategori');
    }

    public function destroy($kategori_id)
    {
        $kategori = Category::find($kategori_id);
        $kategori->delete();

        return redirect()->route('kategori')->with('success','Berhasil menghapus kategori');
    }

    public function update(Request $request, $kategori_id)
    {
        $kategori = Category::find($kategori_id);
        if($kategori){
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
            return redirect()->route('kategori')->with('success','Berhasil memperbarui kategori');
        }else{
            return redirect()->route('kategori')->with('success','Kategori tidak ditemukan:(');
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        Category::whereIn('kategori_id',$ids)->delete();
        return response()->json(["success"=>'dihapus']);
    }

    public function showCategory($nama_kategori)
    {
        $catName = Category::where('nama_kategori',$nama_kategori)->firstOrFail();
        $berita= $catName->berita;;
        return view('category',compact('catName','berita'));
    }
    
}
