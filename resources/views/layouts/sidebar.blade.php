<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('profilAdmin')}}" class="brand-link">
        <img src="{{ asset('assets/dist/img/LOGO.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PUSKESMAS PATUK II</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{route('profilAdmin')}}">
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </a>
            </div>
            <div class="info">
                <a href="{{route('profilAdmin')}}" class="d-block">{{ Auth::user()->full_name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role_id == 1)
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role') }}" class="nav-link">
                        <i class="nav-icon far fa-sun"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('poli') }}" class="nav-link">
                        <i class="nav-icon fas fa-x-ray"></i>
                        <p>
                            Kelola Poli
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dokter') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Kelola Dokter
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('jadwal') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-medical-alt"></i>
                        <p>
                            Kelola Jadwal Dokter
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('penyakit') }}" class="nav-link">
                        <i class="nav-icon fas fa-disease"></i>
                        <p>
                            Kelola Penyakit
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('obat') }}" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Kelola Obat
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('pemeriksaan') }}" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-medical"></i>
                        <p>
                            Pemeriksaan
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="/kartuPasien" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Kartu Pasien
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('pendaftaran') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Form Registrasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kartuPasien" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kartu Pasien</p>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item menu-open">
                    <a href="{{ route('noAntrian') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            No Antrian
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item menu-open">
                    <a href="{{ route('kajian_awal') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Form Kajian Awal
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                @endif
                
                {{-- <li class="nav-item menu-open">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class='nav-icon fas fa-sign-out-alt'></i>
                        <p>
                            Logout
                         
                        </p>
                    </a>
                </li> --}}
            </ul>
            <div class="user-panel mt-2 pb-3 mb-3 d-flex">
            </div>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>