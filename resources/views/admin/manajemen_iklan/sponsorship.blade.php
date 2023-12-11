@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif (session('success'))
                    <div class="alert alert-success" id="alert" role="alert">
                        {{session('success')}}
                    </div>
                @endif

                <div class="row row-cols-3 row-cols-sm-1 row-cols-lg-3 g-2">                   
                    @foreach ($jenisIklan as $ads)
                        <div class="col">
                            <div class="d-flex card shadow-sm
                                bg-pink">
                                <div class="d-flex align-items-center card-header p-2">
                                    <i class='bx bx-check me-1 p-1 rounded-2' style="background-color:#f5d5f9;"></i>&nbsp; <p class="m-0 fs-6  text-white ">Jenis Iklan </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-10">
                                            <p class="h5 m-0 text-white">{{$ads->jenis_iklan ?? 'tai'}}</p>
                                            <p class="m-0 fs-6 text-white">Rp{{number_format($ads->price,2,',','.')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-{{$ads->id}}"><i class="bx bx-pencil"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="edit-{{$ads->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{route('sponsorship.update',$ads->id)}}" method="POST" class="modal-content">
                                                @csrf
                                                @method('PUT')  
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{$ads->jenis_iklan}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-2">
                                                        <x-forms.input label="Ubah nama jenis iklan" value="{{$ads->jenis_iklan}}" name="jenis_iklan" type="text" id="jenis_iklan" :isRequired='true' placeholder="Masukkan nama jenis iklan" />
                                                    </div>
                                                    <div class="mb-2">
                                                        <x-forms.input label="Ubah harga iklan" value="{{$ads->price}}" name="price" type="text" id="price" :isRequired='true' placeholder="Masukkan harga iklan" />
                                                    </div>
                                                    <div class="mb-2">
                                                        <x-forms.input label="Ubah deskripsi iklan" value="{{$ads->deskripsi}}" name="deskripsi" type="text" id="deskripsi" :isRequired='false' placeholder="Masukkan deskripsi iklan" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection