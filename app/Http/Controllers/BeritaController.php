<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Category;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //menampilkan berita pada halaman dashboard home
    public function index()
    {
        $berita = Berita::orderBy('created_at','desc')->paginate(10);
        $terbit = Berita::where('status', 'terbit')->count();
        $tunggu = Berita::where('status', 'menunggu')->count();
        return view('admin.home',compact('berita','terbit','tunggu'));
    }

    //halaman add-postingan
    public function add()
    {
        $kategoriOptions = Category::pluck('nama_kategori','kategori_id')->toArray() ;
        return view('admin.manajemen_berita.add-post',compact('kategoriOptions'));
    }

    //fungsi simpan data ke database
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'max:255',
            'meta_description' => 'max:150',
            'meta_keywords' => 'max:150',
            'kategori_id'=>'required|not_in:0',
        ];
    
        if ($request->input('slugOption') === 'custom') {
            $rules['slug'] = 'required|max:100|unique:berita,slug'; 
        }
    
        $validatedData = $request->validate($rules);
    
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu!');
        }
    
        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->meta_description = $request->meta_description;
        $berita->meta_keywords = $request->meta_keywords;
        $berita->kategori_id = $request->kategori_id;
    
        // Menetapkan slug berdasarkan pilihan pengguna
        if ($request->input('slugOption') === 'custom' && $request->filled('slug')) {
            $baseSlug = Str::slug($request->slug, '-');
        } else {
            $baseSlug = Str::slug($request->judul, '-');
        }
        
        //Logika jika terdapat slug yang sama maka akan menambahkan nilai dari counter
        $slug = $baseSlug;
        $counter  = 1;
        
        while(Berita::where('slug',$slug)->exists()){
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        $berita->slug = $slug;

        //Mengambil users_id berdasarkan id login 
        $berita->users_id = Auth::id();

        //Jika ada gambar
        if ($request->hasFile('gambar_utama')) {
            $file = $request->file('gambar_utama');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            $berita->gambar_utama = $path;
        }
        //Tombol terbit
        if ($request->input('action') === 'terbit') {
            $berita->status = 'terbit';
        //Tombol simpan
        } elseif ($request->input('action') === 'draf') {
            $berita->status = 'draf';
        } else {
            $berita->status = 'draf'; 
        }

        $berita->save(); 

        $kategori = Category::find($request->kategori_id);
        if($kategori){
            $kategori->jumlah_postingan = $kategori->jumlah_postingan + 1;
            $kategori->save();
        }
       
        return redirect()->route('home')->withInput()->with('success', 'Berhasil menambahkan berita baru.');
    }

    //halaman edit berita
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoriOptions = Category::pluck('nama_kategori','kategori_id')->toArray() ;
        return view('admin.manajemen_berita.edit-post',compact('kategoriOptions','berita'));
    }

    //Simpan hasil dari edit berita
    public function update(Request $request, $id)
    {
        $rules=[
            'judul' => 'max:255',
            'meta_description' => 'max:150',
            'meta_keywords' => 'max:150',
            'kategori_id' => 'required|not_in:0'
        ];

        if($request->input('slugOption')=== 'custom'){
            $rules['slug'] = 'required|max:100|unique:berita,slug,'.$id;
        }

        $validatedData = $request->validate($rules);

        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan Login terlebih dahulu!');
        }

        //mencari berita berdasarkan id
        $berita = Berita::findOrFail($id);

        //mengambil data berita baru
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->meta_description = $request->meta_description;
        $berita->meta_keywords= $request->meta_keywords;

        //memperbarui kategori_id
        $oldKategoriId = $berita->kategori_id;
        $berita->kategori_id= $request->kategori_id;

        // Memperbarui gambar utama
        if ($request->hasFile('gambar_utama')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar_utama && Storage::disk('public')->exists($berita->gambar_utama)) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }

            $file = $request->file('gambar_utama');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            $berita->gambar_utama = $path;
        }
        if ($request->input('action') === 'terbit') {
            $berita->status = 'terbit';
        } elseif ($request->input('action') === 'draf') {
            $berita->status = 'draf';
        } else {
            $berita->status = 'draf'; 
        }

        $berita->save();

        if ($oldKategoriId != $request->kategori_id) {
            $oldKategori = Category::find($oldKategoriId);
            if ($oldKategori) {
                $oldKategori->jumlah_postingan -= 1;
                $oldKategori->save();
            }
    
            $newKategori = Category::find($request->kategori_id);
            if ($newKategori) {
                $newKategori->jumlah_postingan += 1;
                $newKategori->save();
            }
        }

        return redirect()->route('home')->withInput()->with('success','Berita berhasil diperbaharui!');
        
    }
    //fungsi hapus berita dari database
    public function delete($id)
    {   
        if(!Auth::check()){
            return redirect()->route('login')->with('error','Silahkan masuk terlebih dahulu');
        }
        $hapus = Berita::find($id);

        if(!$hapus){
            return redirect()->route('home')->with('error','Berita tidak ditemukan!');
        }

        $kategori = Category::find($hapus->kategori_id);
        if($kategori && $kategori->jumlah_postingan > 0){
            $kategori->decrement('jumlah_postingan');
        }

        if($hapus->gambar_utama && Storage::disk('public')->exists($hapus->gambar_utama)){
            Storage::disk('public')->delete($hapus->gambar_utama);
        }

        $hapus->delete();

        return response()->json(['message' => 'Berita berhasil dihapus']);    
    }

    //Mengatur Featured News 
    public function toggleFeatured(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $jumlahFeaturedSaatIni = Berita::where('featured', 1)->count();

        if ($request->featured && $jumlahFeaturedSaatIni >= 5) {
            return response()->json(['error' => 'Batas featured news adalah 5'], 400);
        }

        $berita->featured = $request->featured;
        $berita->save();

        return response()->json(['message' => 'Status Featured berhasil diubah.']);
    }


}
