@extends('layouts.sidebar')

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

    <form action="{{route('add-post')}}" method="POST" class="p-2 row" enctype="multipart/form-data">
        @csrf
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <!--Title input-->
                    <div class="mb-3">
                        <x-forms.input label="Judul" name="judul_ber" id="judul" :isRequired='true' type="text" placeholder="Masukkan judul disini"></x-forms.input>
                        <span id="counter" class="fs-6"></span>
                    </div>
                    
                    <!--Rich editor input-->
                    <x-forms.tinymce-editor/>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <!--Description-->
                    <div class="mb-3">
                        <x-forms.input label='Deksripsi' id="deskripsi" name="meta_description " type="text" :isRequired='true' placeholder="masukkan deskripsi"  />
                        <span class="fs-6 " id="counter1"></span>
                    </div>
                    <!--Keyword-->
                    <div class="mb-3">
                        <x-forms.input label="Keyword" id="keyword" name="meta_keyword" type="text" placeholder="Masukkan meta keyword" :isRequired='true'></x-forms.input>
                        <span class="fs-6" id="sisaKeyword"></span>
                    </div>
                    <!--image upload-->
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Gambar utama (Thumbnail)</label>
                        <input class="form-control" type="file" id="formFile" name="gambar_utama">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; width: 100%; margin-top: 20px;">
                    </div>
                    <!--Kategori-->
                    <div class="mb-3">
                        <x-forms.select :options="$kategoriOptions" id="kategori_id" name="kategori_id" label="Pilih Kategori" />

                    </div>
                    <!--Jenis berita-->
                    <div class="mb-3">
                        <x-forms.select :options="$jenisBeritaOptions" id="jenis_berita_id" name="jenis_berita_id" label="Jenis berita"/>
                    </div>
                    <!--Slug select-->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="slugOption" id="defaultSlug" value="default" checked>
                            <label class="form-check-label" for="defaultSlug">
                              Slug bawaan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="slugOption" id="customSlugRadio" value="custom">
                            <label class="form-check-label" for="customSlugRadio">
                              Custom Slug
                            </label>
                        </div>
                    </div>
                    <!--Custom slug input-->
                    <div class="mb-3" id="customSlugInput" style="display: none;">
                        <label for="slug" class="form-label">Custom Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter custom slug">
                    </div>
                    <!--Save / draft button-->
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