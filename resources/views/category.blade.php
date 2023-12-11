@extends('layouts.index')

@section('title','KATEGORI')
    
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item" href="{{route('showCategory',$catName->nama_kategori)}}">Category</a>
                <span class="breadcrumb-item active">{{$catName->nama_kategori}}</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- News With Sidebar Start -->
    <main class="container-fluid py-3">
        <section class="container">
            <div class="row">
                <article class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">{{$catName->nama_kategori}}</h3>
                            </div>
                        </div>
                        @php
                            $count = 0;
                        @endphp
                        @forelse ($berita as $item)
                            @if ($count<4)
                            <div class="large col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="{{url('storage/'.$item->gambar_utama)}}"  style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 14px;">
                                            <a href="">{{$item->category->nama_kategori}}</a>
                                            <span class="px-1">/</span>
                                            <span>{{$item->created_at->format('F d, Y')}}</span>
                                        </div>
                                        <a class="h4" href="{{route('show',[$item->category->nama_kategori, 'slug'=>$item->slug])}}">{{$item->judul}}</a>
                                        <p class="m-0">{{$item->meta_description}}</p>
                                    </div>
                                </div>
                            </div>
                    
                            @elseif ($count>=4 && $count<10)
                            <div class="small col-lg-6">
                                <div class="d-flex mb-3">
                                    <img src="/img/news-100x100-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="">{{$item->category->nama_kategori}}</a>
                                                <span class="px-1">/</span>
                                                <span>{{$item->created_at->format('F d, Y')}}</span>
                                            </div>
                                            <a class="h6 m-0" href="{{route('show',[$item->category->nama_kategori,'slug'=>$item->slug])}}">{{$item->judul}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php
                                $count++;
                            @endphp
                            @if ($count>=10)
                                @break
                            @endif
                        @empty
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    Tidak ada informasi
                                </div>
                            </div>
                        @endforelse
                        
                    </div>
                    <div class="mb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                              <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                  <a class="page-link" href="#" aria-label="Previous">
                                    <span class="fa fa-angle-double-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#" aria-label="Next">
                                    <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </article>

                @include('components.aside')
            </div>
        </section>
    </main>
    <!-- News With Sidebar End -->

@endsection