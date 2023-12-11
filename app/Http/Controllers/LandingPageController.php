<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
class LandingPageController extends Controller
{
    
    public function index()
    {   

        $featured = Berita::where('featured','1')->take(5)->get();
        $latest = Berita::orderBy('created_at','desc')->where('status','terbit')->take(8)->get();
        $categories = Category::with(['berita' => function($query) {
                    $query->take(5); // Ambil 5 berita dari setiap kategori
                    }])
                    ->withCount('berita')
                    ->orderByDesc('berita_count')
                    ->take(4)
                    ->get();
        return view('welcome',compact('latest','categories','featured'));
    }

    public function show($nama_kategori, $slug)
    {
        $show = Berita::whereHas('category',function($query) use ($nama_kategori){
            $query->where('nama_kategori',$nama_kategori);
        })->where('slug',$slug)->firstOrFail();

        return view('single',compact('show'));
    }
}
