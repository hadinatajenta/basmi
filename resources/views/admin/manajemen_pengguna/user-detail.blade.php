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
                        @if ($errors->any() &&  session('error'))
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
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                        <!--Foto profil-->
                        <div class="col-4 col-sm-6 col-md-4 col-lg-4">
                            <img src="{{asset('storage/'.$user->UserDetail->foto_profil)}}" alt="admingambar" class="img-fluid rounded-circle">
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
                                <div class="col-lg-6">
                                    <x-forms.input label="Nama" type="text" id="text" name="name" :isRequired='true' placeholder="masukkan nama" value="{{$user->name}}" ></x-forms.input>
                                </div>

                                <!--Last name input-->
                                <div class="col-lg-6 ">
                                    <x-forms.input label="Nama akhir" name="last_name" id="last_name" placeholder="last name" :isRequired='false' type="text" placeholder="last_name" value="{{$user->last_name }}"></x-forms.input>
                                </div>
                                <!--Email input-->
                                <div class="col-lg-6">
                                    <x-forms.input id="email" type="email" value="{{$user->email}}" name="email" label="Email" placeholder="Email pengguna" :isRequired="true"></x-forms.input>
                                </div>
                                <!--Role input-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label">Role <span style="color: red">*</span></label>
                                        <select class="form-select" id="role" name="role" aria-label="Role">
                                            <option value="admin" @if ($user->role === 'admin') selected  @endif >Admin</option>
                                            <option  value="author" @if (Auth::user()->id === $user->id)
                                                disabled
                                            @endif @if ($user->role === 'author') selected  @endif>Author</option>
                                        </select>
                                    </div>
                                </div>
                                <!--No telp-->    
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telp </label>
                                        <input type="number" name="nomor_telepon" class="form-control 
                                        @error('nomor_telepon')
                                            is-invalid
                                        @enderror" value="{{$user->UserDetail->nomor_telepon}}" placeholder="masukkan nomor telepon disini">
                                        <div class="invalid-feedback">
                                            Nomor telepon minimal 11 nomor
                                        </div>
                                    </div>
                                </div>
                                <!--Nomor karyawan-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="nomor_karyawan" class="form-label">Nomor karyawan</label>
                                        <input type="number" name="nomor_karyawan" class="form-control
                                        @error('nomor_karyawan')
                                            is-invalid
                                        @enderror" value="{{$user->UserDetail->nomor_karyawan}}" placeholder="masukkan nomor telepon disini" maxlength="20">
                                        <div class="invalid-feedback">
                                            Nomor telepon minimal 16 
                                        </div>
                                    </div>
                                </div>
                                <!--Tanggal lahir input-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{$user->UserDetail->tanggal_lahir}}" placeholder="masukkan nomor telepon disini">
                                    </div>
                                </div>
                                <!--Jenis Kelamin-->
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="jenis_kelamin">
                                            <option value="laki-laki" @if ($user->UserDetail->jenis_kelamin == 'laki-laki')
                                                selected
                                            @endif >Laki-laki</option>
                                            <option value="perempuan" @if ($user->UserDetail->jenis_kelamin == 'perempuan')
                                                selected
                                            @endif>Perempuan</option>
                                        </select>
                                    </div>
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

@section('script')
    <script>
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()
    </script>
@endsection