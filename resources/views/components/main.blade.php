
<main>
    <!-- Main News Slider Start -->
    <section class="container-fluid py-3">
        <section class="container">
            <div class="row">
                <article class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="img/news-700x435-1.jpg" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="">Technology</a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href="">January 01, 2045</a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="">Sanctus amet sed amet ipsum lorem. Dolores et erat et elitr sea sed</a>
                            </div>
                        </div>
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="img/news-700x435-2.jpg" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="">Technology</a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href="">January 01, 2045</a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="">Sanctus amet sed amet ipsum lorem. Dolores et erat et elitr sea sed</a>
                            </div>
                        </div>
                    </div>
                </article>
                <aside class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Categories</h3>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="img/cat-500x80-1.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Business
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="img/cat-500x80-2.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Technology
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="img/cat-500x80-3.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Entertainment
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="img/cat-500x80-4.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Sports
                        </a>
                    </div>
                </aside>
            </div>
        </section>
    </section>
    <!-- Main News Slider End -->

    <!-- Featured News Slider Start -->
    <section class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Featured</h3>
            </div>
            <article class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
                @forelse ($featured as $ft)
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        <img class="img-fluid w-100 h-100" src="{{url('storage/'.$ft->gambar_utama)}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1" style="font-size: 13px;">
                                <a class="text-white" href="{{route('showCategory',$ft->category->nama_kategori)}}">{{$ft->category->nama_kategori}}</a>
                                <span class="px-1 text-white">/</span>
                                <span class="text-white">{{$ft->updated_at->format('F d, Y')}}</span>
                            </div>
                            <a class="h4 m-0 text-white" href="{{route('show',[$ft->category->nama_kategori, 'slug'=>$ft->slug])}}">{{$ft->judul}}</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-primary">
                        tidak ada data
                    </div>
                @endforelse
            </article>
        </div>
    </section>
    <!-- Featured News Slider End -->

    <!-- Category News Slider Start -->
    <section class="container-fluid">
        <div class="container">
            <div class="row ">
                @foreach ($categories as $category)
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">{{$category->nama_kategori}}</h3>
                    </div>
                    <article class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">  
                        @forelse ( $category->berita as $berita )
                            <div class="position-relative">
                                <img src="{{url('storage/'.$berita->gambar_utama)}}" height="150" width="150" style="object-fit: cover; ">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 13px;">
                                        <a href="{{route('showCategory',$category->nama_kategori)}}">{{$category->nama_kategori}}</a>
                                        <span class="px-1">/</span>
                                        <span>{{$berita->created_at->format('m D, y')}}</span>
                                    </div>
                                    <a class="h6 m-0" href="{{route('show',[$category->nama_kategori, 'slug'=>$berita->slug])}}" >{{Str::limit($berita->judul,35,'...')}}</a>
                                </div>
                            </div>
                        @empty
                            <x-alert level="info" message="Tidak ada berita"></x-alert>
                        @endforelse
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Category News Slider End -->

    <!-- News With Sidebar Start -->
    <section class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Terbaru</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($latest as $lt)
                                    <div class="col-md-6 col-lg-6 d-flex align-items-stretch">
                                        <div class="card mb-4 shadow-sm">
                                            <img class="card-img-top" src="{{ url('storage/'.$lt->gambar_utama) }}" alt="Card image cap" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $lt->judul ?? 'Tidak ada judul' }}</h5>
                                                <p class="card-text">{{ $lt->excerpt }}</p>
                                                <a href="{{ route('show', [$lt->category->nama_kategori ?? 'null', 'slug' => $lt->slug]) }}" class="btn btn-primary mt-auto">Baca lebih lanjut</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    <!--ads-->
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                    </div>
                    
                    
                </div>
                
                @include('components.aside')
            </div>
        </div>
    </section>
    <!-- News With Sidebar End -->
</main>