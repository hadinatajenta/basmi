<header>
    <!-- Topbar Start -->
    <nav class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            
            <div id="tanggal" class="col-md-4 d-none d-md-block">
                
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="{{route('welcome')}}" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">LSM</span>BASMI</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="/img/ads-700x70.jpg" >
            </div>
        </div>
    </nav>
    <!-- Topbar End -->
    
    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="{{route('welcome')}}" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">LSM</span>BASMI</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{route('welcome')}}" class="nav-item nav-link 
                    @if (request()->routeIs('welcome'))
                        active
                    @endif">Home
                    </a>

                    @foreach ($header as $hd)
                    <a href="{{route('showHalaman',$hd->slug)}}" class="nav-item nav-link 
                        
                        @if (request()->routeIs('showHalaman') && request()->route('slug') === $hd->slug)
                            active
                        @endif">
                        {{$hd->judul}}
                    </a>
                    @endforeach
                </div>
                <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Keyword">
                    <div class="input-group-append">
                        <button class="input-group-text text-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
</header>