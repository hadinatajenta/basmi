@extends('layouts.sidebar')

@section('content')
<div class="p-2 row">
    <div class="card">
        <div class="tengah justify-content-between card-header">
            <p class="m-0 h4" >Kategori</p>
            <a href="#" class="btn btn-danger btn-sm ms-2 me-auto" id="deleteAllSelectedRecord"><i class="bx bx-trash"></i> Hapus terpilih</a>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Kategori
            </button>
        </div>

        <!--Modals-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('kategori.store')}}" method="POST" class="modal-content">
                    @csrf

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <x-forms.input name="nama_kategori" label="Kategori" placeholder="Masukkan Kategori" id="kategori" :isRequired='true' type="text" ></x-forms.input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card-body" >
            @if (session('success'))
                <x-alert level="success" message="{{session('success')}}"></x-alert>
            @elseif ($errors->any())
                <x-alert level="danger" message="{{$errors}}"></x-alert>
            @endif
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select_all_ids"></th>
                        <th >No</th>
                        <th style="white-space: nowrap">Nama Kategori</th>
                        <th class="text-center" style="white-space: nowrap">Jumlah Postingan</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($kategori)>0)
                        @foreach ($kategori as $cat)
                        <tr id="kategori_ids{{$cat->kategori_id}}" class="align-items-center">
                            <td><input type="checkbox" name="ids" class="checkbox_ids"  value="{{$cat->kategori_id}}"></td>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cat->nama_kategori ?? 'Tidak ada'}}</td>
                            <td class="text-center">{{$cat->jumlah_postingan}}</td>
                            <td style="text-align:center">
                                <!--update-->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update-{{$cat->kategori_id}}">
                                    <i class="bx bx-pencil"></i> 
                                </button>
                                <div class="modal fade" id="update-{{$cat->kategori_id}}" tabindex="-1" aria-labelledby="update-{{$cat->kategori_id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('kategori.update', $cat->kategori_id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nama Kategori</span>
                                                        <input type="text" name="nama_kategori" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$cat->nama_kategori}}">
                                                    </div>                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--hapus-->
                                <a href="{{route('kategori.destroy',$cat->kategori_id)}}" 
                                    class="btn btn-danger btn-sm"
                                    onclick="event.preventDefault();
                                    document.getElementById('form-hapus-{{$cat->kategori_id}}').submit();"
                                >
                                    <i class="bx bx-trash"></i> 
                                </a>
                                <form class="d-none" id="form-hapus-{{$cat->kategori_id}}" action="{{route('kategori.destroy',$cat->kategori_id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection