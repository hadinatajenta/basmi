@extends('layouts.sidebar')

@section('title','Edit Halaman')

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('halaman.edit',$pages->id)}}" method="POST" class="p-2 row" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul berita <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul berita disini" value="{{$pages->judul}}" maxlength="100" required>
                        <span class=" fs-6" id="counter"></span>
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten </label>
                        @component('components.forms.tinymce-editor', ['name' => 'konten'])
                        
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span style="color: red">*</span></label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi berita" value="{{$pages->deskripsi}}" maxlength="150" required>
                        <span class="fs-6 " id="counter1"></span>
                    </div>
                    <div class="mb-3">
                        <label for="meta_keyword" class="form-label">Keyword <span style="color: red">*</span></label>
                        <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Pisahkan keyword dengan tanda koma (,)" value="{{$pages->keyword ?? 'tidak ada keyword'}}" maxlength="160" required>
                        <span class="fs-6 " id="sisaKeyword"></span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="action" class="btn btn-primary btn-sm" value="terbit">Terbit</button>
                        <button type="submit" name="action" class="btn btn-primary btn-sm" value="draf">Draft</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection