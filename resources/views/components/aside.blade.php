<aside class="col-lg-4 pt-3 pt-lg-0">
    <!-- Ads Start -->
    <div class="mb-3 pb-3">
        <a href=""><img class="img-fluid" src="/img/news-500x280-4.jpg" alt=""></a>
    </div>
    <!-- Ads End -->

    <!-- Popular News Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Terbaru</h3>
        </div>
        
        @foreach ($newest as $news)
        <div class="d-flex mb-3">
            <img src="{{url('storage/'.$news->gambar_utama)}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">{{$news->category->nama_kategori}}</a>
                    <span class="px-1">/</span>
                    <span>{{$news->created_at->format('M d, Y')}}</span>
                </div>
                <a class="h6 m-0" href="{{route('show',[$news->category->nama_kategori,'slug'=>$news->slug])}}">{{$news->judul ?? 'null'}}</a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Popular News End -->

    <!-- Tags Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Tags</h3>
        </div>
        <div class="d-flex flex-wrap m-n1">
            @foreach ($kategori as $item)
                <a href="{{route('showCategory',$item->nama_kategori)}}" class="btn btn-sm btn-outline-secondary m-1">{{$item->nama_kategori}}</a>
            @endforeach
        </div>
    </div>
    <!-- Tags End -->
</aside>