@extends('layouts.index')

@section('title','Halaman')

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
                            <span>{{$halaman->updated_at->format('F d, Y')}}</span>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$halaman->judul}}</h3>
                            {!!$halaman->konten!!}
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