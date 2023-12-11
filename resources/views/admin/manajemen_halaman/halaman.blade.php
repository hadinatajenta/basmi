@extends('layouts.sidebar')

@section('content')
    <div class="p-2 row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row row-cols-2">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 mb-2">
                    <div class="d-flex card bg-blue">
                        <div class="d-flex align-items-center card-header p-2">
                            <i class='bx bx-chat  text-white me-1 p-1 rounded-2' style="background-color:#afbff4;"></i>&nbsp; <p class="m-0 fs-6 text-white">Total postingan</p>
                        </div>
                        <div class="card-body">
                            <p class="h4 m-0 text-white">{{$halaman->count()}}</p>
                            <p class="m-0 fs-6 text-white"">Semua Halaman</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 mb-2">
                    <div class="d-flex card bg-pink">
                        <div class="d-flex align-items-center card-header p-2">
                            <i class='bx bx-chat  text-white me-1 p-1 rounded-2' style="background-color: pink"></i>&nbsp; <p class="m-0 fs-6 text-white">Total postingan</p>
                        </div>
                        <div class="card-body">
                            <p class="h4 m-0 text-white">{{$halaman->count()}}</p>
                            <p class="m-0 fs-6 text-white"">Semua Halaman</p>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
        <div class="col-12 col-sm-12 col-md-8 col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="h5 m-0 fw-semibold"> Semua Halaman</p>
                        <a href="{{route('halaman.add')}}" class="btn btn-primary btn-sm">Tambah halaman</a>
                    </div>
                </div>
                @if (session('success'))
                <div id="alert" class="alert alert-success" role="alert">
                    {!!session('success')!!}
                </div>
                @endif
                <div class="card-body" style="overflow-x: auto">
                    <table class="table table-responsive">
                        <thead>
                            
                            <tr>
                                <th>No</th>
                                <th style="white-space: nowrap">Judul halaman</th>
                                <th style="white-space:nowrap">Tanggal update</th>
                                <th>Author</th>
                                <th >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($halaman as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->updated_at->format('M d, Y')}}</td>
                                <td>{{$item->user->name}}</td>
                                <td style="white-space: nowrap">
                                    <!--EDIT-->
                                    <a href="{{route('halaman.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="bx bx-pencil"></i></a>
                                    
                                    <!--Hapus-->
                                    <a href="{{route('halaman.hapus',$item->id)}}" 
                                       onclick="event.preventDefault();
                                       document.getElementById('hapus-halaman-{{$item->id}}').submit();" id="hapus-{{$item->id}}" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                        
                                    </a>

                                    <form action="{{route('halaman.hapus',$item->id)}}" method="POST" id="hapus-halaman-{{$item->id}}">
                                    @csrf
                                    @method('DELETE')
                                    </form>
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

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
        function initDraggableElements() {
        const users = document.querySelectorAll(".user");

        users.forEach(user => {
            user.addEventListener("dragstart", (e) => {
                // Mengatur data yang akan di-drag (dalam hal ini, ID elemen)
                e.dataTransfer.setData("text/plain", user.id);
            });
        });
    }

    // Memanggil fungsi untuk menginisialisasi elemen yang dapat di-drag
    initDraggableElements();

    // Menambahkan event listener untuk elemen yang dapat di-drop
    const dropZone = document.querySelector(".card-body");

    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault(); // Mencegah aksi default (biasanya melarang drop)
    });

    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        const userId = e.dataTransfer.getData("text/plain"); // Mendapatkan ID elemen yang di-drop
        const droppedElement = document.getElementById(userId); // Mengambil elemen yang di-drop
        dropZone.appendChild(droppedElement); // Menambahkan elemen yang di-drop ke dalam card-body
    });
</script>

  
@endsection