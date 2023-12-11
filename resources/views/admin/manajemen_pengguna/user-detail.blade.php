@extends('layouts.sidebar')

@section('title','Detail pengguna')
    
@section('content')
    <div class="row p-2">
        <div class="col-md-12">
            
            <form action="{{route('user.update',$user->id)}}" method="POST" class="card"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header p-4">
                    <h4 class="h4 fw-semibold">Detail User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <!--Error message-->
                        @if ($errors->any() ||  session('error'))
                            <div class="alert alert-danger" >
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
                        @elseif (session('success'))
                            <x-alert level='success' message="{{session('success')}}" />
                        @endif
                        <!--Foto profil-->
                        <div class="col-4 col-sm-6 col-md-4 col-lg-4">
                            <img src="{{url('storage/'.$user->UserDetail->foto_profil)}}" alt="admingambar" class="img-fluid rounded-circle" >
                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Upload foto</label>
                                <input class="form-control @error('file')
                                    is-invalid
                                @enderror" name="foto_profil" type="file" id="foto_profil">
                                <div class="invalid-feedback">
                                    Pilih file jenis Foto
                                </div>
                              </div>
                        </div>

                        <!--Informasi detail pengguna-->
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="row">
                                <!--First name input-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input label="Nama" type="text" id="text" name="name" :isRequired='true' placeholder="masukkan nama" value="{{$user->name}}" ></x-forms.input>
                                </div>

                                <!--Last name input-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input label="Nama akhir" name="last_name" id="last_name" placeholder="last name" :isRequired='false' type="text" placeholder="last_name" value="{{$user->last_name }}"></x-forms.input>
                                </div>
                                <!--Email input-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input id="email" type="email" value="{{$user->email}}" name="email" label="Email" placeholder="Email pengguna" :isRequired="true"></x-forms.input>
                                </div>
                                <!--Role input-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.select label="Role" id="role" name="role" :options="$roleOptions" selectedvalue="{{$user->role}}"  />
                                </div>
                                <!--No telp-->    
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input label="Nomor telepon" id="No telepon" name="nomor_telepon" type="number" placeholder="masukkan nomor telepon" :isRequired="false" value="{{$user->UserDetail->nomor_telepon}}" />
                                </div>
                                <!--Nomor karyawan-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input label="Nomor karyawan" id="No karyawan" name="nomor_karyawan" type="number" placeholder="masukkan nomor karyawan" :isRequired="false" value="{{$user->UserDetail->nomor_karyawan}}" />

                                </div>
                                <!--Tanggal lahir input-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.input label='Tanggal lahir' type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="tanggal lahir" :isRequired='false' value="{{$user->UserDetail->tanggal_lahir}}" />
                                </div>
                                <!--Jenis Kelamin-->
                                <div class="col-lg-6 mb-3">
                                    <x-forms.select :options="$genderOptions" selectedvalue="{{$user->UserDetail->jenis_kelamin}}" name="jenis_kelamin" id="jenis_kelamin" label="Jenis Kelamin" />
                                </div>
                            </div>
                        </div>
                        <!--End detail user information-->
                    </div>

                    <div class="">
                        <a href="{{route('users.home')}}" class="btn btn-primary">Kembali</a>
                        <button class="btn btn-primary" type="submit"><i class="bx bx-save "></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
