<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title','Dashboard')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!--CSS-->
        <link href="/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/datatables.css">

        <!--Tinymce config-->
        <x-head.tinymce-config/>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

</head>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="d-flex sidebar-heading border-bottom p-3 ">
                    <div class="d-flex align-items-center justify-content-centeruser-profile">
                        <div class="profile" style="width: 50px">
                            <img class="img-fluid" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/5847f24a-889d-4f1d-971c-da2bafcfc71c/dfwrftm-18a738cf-4099-43e3-8914-7a49de0d2e3c.png/v1/fill/w_880,h_900/anya_forger_render_by_ben10andtheppgdude_dfwrftm-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9OTAwIiwicGF0aCI6IlwvZlwvNTg0N2YyNGEtODg5ZC00ZjFkLTk3MWMtZGEyYmFmY2ZjNzFjXC9kZndyZnRtLTE4YTczOGNmLTQwOTktNDNlMy04OTE0LTdhNDlkZTBkMmUzYy5wbmciLCJ3aWR0aCI6Ijw9ODgwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.ZWjovZ-_L9QuWjHlttg3a1DNw4LGZgWgAQL6x9004Ts" width="100%" style="border-radius:50%;">
                        </div>
                        <div class="mx-2">
                            <p class="m-0 h6 fw-bold">{{Auth::user()->name ?? 'Null'}}</p>
                            <p class="m-0 fs-6">{{Auth::user()->role ?? 'Null'}}</p>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    <!--home dashboard-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center  
                        @if(request()->routeIs('home')) 
                            active 
                        @endif" href="{{route('home')}}"
                    >
                        <i class='bx bxs-dashboard bx-sm '></i>&nbsp; Dashboard
                    </a>
                    <!--Kategori-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center
                        @if(request()->routeIs('kategori')) 
                            active 
                        @endif"  href="{{route('kategori')}}">
                        <i class='bx bx-category bx-sm' ></i>&nbsp; Kategori
                    </a>
                    <!--Halaman-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center
                    
                        @if (request()->routeIs('halaman'))
                            active
                        @endif" href="{{route('halaman')}}"><i class='bx bx-spreadsheet bx-sm' ></i>&nbsp; Halaman
                    </a>
                    <!--Sponsorship-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center
                        @if(request()->routeIs('sponsorship')) 
                            active 
                        @endif"  href="{{route('sponsorship')}}">
                        <i class='bx bx-dollar bx-sm' ></i>&nbsp; Sponsorship
                    </a>
                    <!--Jadwal kegiatan-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center" href="#">
                        <i class='bx bx-calendar bx-sm' ></i>&nbsp; Jadwal kegiatan
                    </a>
                    <!--Manajemen pengguna-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center
                    @if (request()->routeIs('users.home'))
                        active
                    @endif" href="{{route('users.home')}}">
                        <i class='bx bxs-user-account bx-sm' ></i>&nbsp; Menejemen user
                    </a>

                    <hr>

                    <!--profile users-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center" href="#!"><i class='bx bx-user bx-sm'></i>&nbsp; Profile</a>
                    <!--keluar-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 d-flex align-items-center" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        <i class='bx bx-log-out bx-sm'></i>&nbsp; Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
            
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg  border-bottom">
                    <div class="container-fluid">
                        <button class="btn " id="sidebarToggle"><i class='bx bx-menu bx-sm' ></i></button>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid mt-2">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @yield('script')

        <script>
            setTimeout(function(){
                const alert = document.getElementById('alert');
                if(alert){
                    alert.style.display="none";
                }
            },2000)
        </script>

        <script>
            $(function (e){

                $('#select_all_ids').click(function(){
                    $('.checkbox_ids').prop('checked',$(this).prop('checked'));
                });
                
                $('#deleteAllSelectedRecord').click(function(e){
                    e.preventDefault();
                    var all_ids = [];
                    $('input:checkbox[name=ids]:checked').each(function(){
                        all_ids.push($(this).val());
                    });

                    $.ajax({
                        url :"{{route('kategori.all')}}",
                        type:'DELETE',
                        data:{
                            ids:all_ids,
                            _token:'{{csrf_token() }}',
                        },
                        success:function(response){
                            $.each(all_ids,function(key,val){
                                $('#kategori_ids'+val).remove();
                            })
                        }
                    });
                });
            });
        </script>
        
    </body>
</html>
