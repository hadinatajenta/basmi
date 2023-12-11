@extends('layouts.sidebar')
@section('title','Edit Post')
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

    <form action="{{route('update-post',$berita->id)}}" method="POST" class="p-2 row" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <x-forms.input label='Judul' value='{{$berita->judul}}' id="judul" name='judul' placeholder='judul' :isRequired='true' type='text' />
                        <span class=" fs-6" id="counter"></span>
                    </div>
                    @include('components.forms.tinymce-editor', ['content' => $berita->isi])
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <x-forms.input label="Deskripsi" id="deskripsi" maxlength='150' value="{{$berita->meta_description}}" placeholder="masukkan deskripsi berita" :isRequired='true' type='text' name='meta_description' />
                        <span class="fs-6 " id="counter1"></span>
                    </div>
                    <div class="mb-3">
                        <x-forms.input label="Keyword" id="keyword" maxlength='150' value="{{$berita->meta_keywords}}" placeholder="masukkan keywword berita" :isRequired='true' type='text' name='meta_keywords' />
                        <span class="fs-6 " id="sisaKeyword"></span>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Gambar utama (Thumbnail)</label>
                        <input class="form-control" type="file" id="formFile" name="gambar_utama">
                    </div>
                    <div class="mb-3">
                        <x-forms.select :options="$kategoriOptions" id="kategori" label='Kategori' name="kategori_id" />
                    </div>
                    <div class="mb-3">
                        <x-forms.select :options="$jenisBeritaOptions" id="jenisBerita" label='Jenis Berita' name="jenis_berita_id" />
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

@section('script')
<script src="/js/counter.js"></script>
@endsection