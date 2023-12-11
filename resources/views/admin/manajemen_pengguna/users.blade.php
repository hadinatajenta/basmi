@extends('layouts.sidebar')

@section('title','Manajemen pengguna')
    
@section('content')
    <div class="row row-cols-2 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 g-4 p-2">
        <div class=" col  rounded-2">
            <div class="card p-2 shadow-sm h-100">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <img src="/img/3people.png" alt="author" class="rounded-5 img-fluid">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <p class="h5 text-center my-2">Jumlah karyawan</p>
                        <p class="fw-semibold h4 text-center">{{$pengguna->count()}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col rounded-2">
            <div class="card p-2 shadow-sm h-100">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <img src="/img/admin.png" alt="author" class="rounded-5 img-fluid">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <p class="h5 text-center my-2">Jumlah Admin</p>
                        <p class="fw-semibold h4 text-center">{{$admin}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col rounded-2 flex-wrap">
            <div class="card p-2 shadow-sm h-100">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <img src="/img/author.png" alt="author" class="rounded-5 img-fluid">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <p class="h5 text-center my-2">Jumlah Author</p>
                        <p class="fw-semibold h4 text-center">{{$author}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--daftar karyawan-->
    <div class="row p-2 ">
        <div class="col-12 p-2">
            <div class="container table-responsive bg-white rounded-2 shadow-sm" >
                <div class="d-flex align-items-center justify-content-between p-2">
                    <p class="m-0 h4" style="color:#636464">Daftar karyawan</p>
                    <button class="btn btn-primary btn-sm" type="button" id="karyawan" data-bs-toggle="modal" data-bs-target="#tambah-karyawan">+ Karyawan</button>
                </div>
                
                <!--Tambah karyawan-->
                <div class="modal fade" id="tambah-karyawan" tabindex="-1" aria-labelledby="tambah-karyawan" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{route('users.store')}}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Karyawan baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" id="name" class="form-label" >Nama karyawan <span style="color: red">*</span></label>
                                    <input type="text" name="name" id="name" aria-describedby="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" id="email" class="form-label" >Email <span style="color: red">*</span></label>
                                    <input type="email" name="email" id="email" aria-describedby="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" id="password" class="form-label" >Password <span style="color: red">*</span></label>
                                    <input type="password" name="password" id="password" aria-describedby="password" class="form-control" autocomplete="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
    
                <!--Errors notification-->
                @if ($errors->any() || session('error'))
                    <div class="alert alert-danger" id="alert" role="alert">
                        <ul>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            @endif

                            @if (session('error'))
                                <li>{{session('error')}}</li>
                            @endif
                        </ul>
                    </div>
                @else
                    @if (session('success'))
                        <div class="alert alert-success" id="alert" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                @endif

                <!--Data karyawan-->
                <div class="table" style="overflow-x:auto">
                    <table class="table  table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" style="white-space: nowrap">Nama karyawan</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col" style="white-space: nowrap">Postingan diterbitkan</th>
                                <th scope="col" style="white-space: norwrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                   
                                    <img src="{{url('storage/'.$user->UserDetail->foto_profil)}}" alt="Employee Image" class="rounded-circle" width="40" height="40"> 
                            
                                    {{$user->name}}
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="text-center">{{$user->berita->count()}}</td>
                                <td class="">
                                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary btn-sm me-2 mb-1"><i class="bx bx-pencil"></i></a>
        
                                    
                                    @if (Auth::user()->id != $user->id)
                                    <a href="{{route('users.delete',$user->id)}}" 
                                        onclick="event.preventDefault();
                                        if(confirm('Apakah yakin ingin menghapus karyawan ini? ')) {
                                            document.getElementById('hapus-{{$user->id}}').submit();
                                        }" class="btn btn-danger btn-sm mb-1">
                                        <i class="bx bx-trash"></i>
                                        
                                    </a>
                                    <form class="d-none" action="{{route('users.delete',$user->id)}}" id="hapus-{{$user->id}}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus karyawan ini?')" >
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection