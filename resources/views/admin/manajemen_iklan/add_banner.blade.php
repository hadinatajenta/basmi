@extends('layouts.sidebar')

@section('title','Tambah banner')
@section('content')
    <div class="container">
        <form action="{{route('sponsor.store-banner')}}" method="POST">
            @csrf
            <p class="h5 fw-semibold">Informasi pengiklan</p>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <x-forms.input name="pengiklan" 
                    label="Nama Pengiklan" 
                    type="text" 
                    placeholder="Masukkan nama pengiklan" 
                    :isRequired='true'
                    id="pengiklan"></x-forms.input>    
                </div>
                <div class="col-sm-12 col-md-6">
                    <x-forms.input name="email" 
                    label="Email Pengiklan" 
                    type="email" 
                    placeholder="Masukkan email pengiklan" 
                    :isRequired='true'
                    id="email"></x-forms.input>        
                </div>
                <div class="col-sm-12 col-md-6">
                    <x-forms.input name="nomor_telepon" 
                    label="Nomor telepon Pengiklan" 
                    type="number" 
                    placeholder="Masukkan Telepon pengiklan" 
                    :isRequired='true'
                    id="telepon"></x-forms.input>        
                </div>
                <div class="col-sm-12 col-md-6">
                    <x-forms.input name="perusahaan" 
                    label="Perusahaan" 
                    type="text" 
                    placeholder="Masukkan perusahaan" 
                    :isRequired='false'
                    id="perusahaan"></x-forms.input>        
                    
                </div>
            </div>

            <p class="h5 fw-semibold">Informasi banner</p>
            <div class="row row-cols-sm-1 row-cols-lg-2">
                <div class="col">
                    <x-forms.input name="jenis_banner" 
                    label="Jenis Banner" 
                    type="text" 
                    placeholder="Masukkan jenis iklan" 
                    :isRequired='false'
                    id="perusahaan"></x-forms.input>
                </div>
            </div>
        </form>
    </div>
@endsection