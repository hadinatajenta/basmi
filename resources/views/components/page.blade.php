@section('title', $show->judul)

@section('content')
<main class="container-fluid py-3">
    <article class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="img/news-700x435-2.jpg" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
                        <div class="mb-3">
                            <a href="">{{$show->category->nama_kategori}}</a>
                            <span class="px-1">/</span>
                            <span>{{$show->updated_at->format('F d, Y')}}</span>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$show->judul}}</h3>
                            {!!$show->isi!!}
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->
            </div>

            @include('components.aside')
        </div>
    </article>
</main>
@endsection