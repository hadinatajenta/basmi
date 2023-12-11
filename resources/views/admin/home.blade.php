@extends('layouts.sidebar')

@section('content')
<div class="p-2 row">
    <div class="col-12">
        <!--informasi postingan-->
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-2">
                <div class="d-flex card bg-blue">
                    <div class="d-flex align-items-center card-header p-2">
                        <i class='bx bx-chat  text-white me-1 p-1 rounded-2' style="background-color:#afbff4;"></i>&nbsp; <p class="m-0 fs-6 text-white">Total postingan</p>
                    </div>
                    <div class="card-body">
                        <p class="h4 m-0 text-white">{{$berita->count()}}</p>
                        <p class="m-0 fs-6 text-white"">Semua postingan</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-2">
                <div class="d-flex card bg-ungu">
                    <div class="d-flex align-items-center card-header p-2">
                        <i class='bx bx-check me-1 p-1 rounded-2' style="background-color:#f5d5f9;"></i>&nbsp; <p class="m-0 fs-6  text-white ">Diterbitkan </p>
                    </div>
                    <div class="card-body">
                        <p class="h4 m-0 text-white">{{$terbit}}</p>
                        <p class="m-0 fs-6 text-white">Postingan diterbitkan</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-2">
                <div class="d-flex card bg-pink">
                    <div class="d-flex align-items-center card-header p-2">
                        <i class='bx bx-line-chart me-1 p-1 rounded-2' style="background-color: #ffbfdd;"></i>&nbsp; <p class="m-0 fs-6 text-white">Menunggu</p>
                    </div>
                    <div class="card-body">
                        <p class="h4 m-0 text-white">{{$tunggu}}</p>
                        <p class="m-0 fs-6 text-white">Postingan menunggu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mt-2  rounded-2 shadow-sm">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="h5 m-0 fw-semibold">Postingan</p>
                    <a href="{{route('add-post')}}" class="btn btn-primary btn-sm">+ Postingan</a>
                </div>
            </div>
            @if (session('success'))
                <div class="col-12 mb-2">
                    <div id="alert" class="alert alert-success" role="alert">
                        {!!session('success')!!}
                    </div>
                </div>
            @endif
            <div class="card-body">
                <div style="overflow-x: auto">
                    <table id="example" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th class="text-center" style="white-space:nowrap">Jenis Berita</th>
                                <th style="white-space: nowrap">Tanggal upload</th>
                                <th style="white-space: nowrap">Tanggal pembaruan</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $news)
                                <tr>
                                    <td>{{$loop->index+=1}}</td>
                                    
                                    <td><img src="{{url('storage/'.$news->gambar_utama)}}" alt="gambar" width="80px" height="auto"></td>
                                    <td>{{$news->judul ?? 'Tidak ada judul'}}</td>
                                    <td class="text-center text-capitalize 
                                    @if ($news->jenis_berita_id == '')
                                        text-secondary
                                    @endif" >{{$news->beritaBerbayar->jenis_berita ?? 'null'}}</td>
                                    <td class="text-center">{{$news->created_at->format('M d, Y')}}</td>
                                    <td class="text-center">{{$news->updated_at->format('M d, Y')}}</td>
                                    <td>
                                        <span class="@if ($news->status === 'terbit') published @endif text-capitalize">{{$news->status}}</span>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input featured-toggle" type="checkbox" role="switch" data-id="{{ $news->id }}"
                                                id="featured{{ $news->id }}" {{ $news->featured ? 'checked' : '' }}>
                                            <label class="form-check-label" for="featured{{ $news->id }}"></label>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="d-flex">
                                            <a href="{{route('edit-post',$news->id)}}"  class="btn btn-primary btn-sm me-1">
                                                <i class="bx bx-pencil"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-button" data-id="{{ $news->id }}">
                                                <i class="bx bx-trash"></i>
                                            </button>    
                                        </div>                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('components.custom-pagination')
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!--Featured-->
<script>
    document.querySelectorAll('.featured-toggle').forEach(item => {
        item.addEventListener('change', function(e) {
            const beritaId = this.dataset.id; // Mengambil ID berita
            const isFeatured = this.checked ? 1 : 0; // Cek status checkbox

            // Mengirim request AJAX ke server
            fetch(`/admin/home/berita/featured/${beritaId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ featured: isFeatured })
            })
            .then(response => {
                if (!response.ok) {
                    throw response;
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
            })
            .catch(errorResponse => {
                // Menangani error response dari server
                errorResponse.json().then(errorData => {
                    alert(errorData.error); // Menampilkan pesan error
                    item.checked = !isFeatured; // Mengembalikan status toggle
                });
            });
        });
    });
</script>

<!--Hapus-->
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                return;
            }
            const beritaId = this.dataset.id; // Mengambil ID berita

            // Mengirim request AJAX ke server untuk menghapus berita
            fetch(`/admin/home/${beritaId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // Pastikan server mengembalikan response JSON
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Mengambil token CSRF
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                button.closest('tr').remove();
                return response.json(); 
            })
            .then(data => {
                console.log(data.message); 
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        });
    });
</script>
<script rel="stylesheet" src="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"></script>
@endsection
