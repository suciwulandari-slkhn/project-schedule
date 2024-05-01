@extends('dashPage.index')

@if (Auth::user()->role === 'admin')
    @section('navitem')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kontrol lainnya:</h6>
                    <a class="collapse-item" href="{{route('userControl')}}">Daftar Pengguna</a>
                    <a class="collapse-item" href="{{route('kategori')}}">Kategori</a>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{route ('jadwal')}}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Jadwal</span>
            </a>
        </li>
        <div class="nav-item">
            <a class="nav-link" href="{{route ('jadwal_hari_ini')}}">
                <i class="fas fa-fw fa-bell"></i>
                <span>Notification</span>
            </a>
        </div>   
    </ul>
    @endsection 
    
    
@elseif(Auth::user()->role === 'user')
    @section('navitem')
        <!-- Sidebar -->
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/user">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!--Menu penjadwalan-->
            <li class="nav-item">
                <a class="nav-link" href="{{route ('jadwal')}}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Jadwal</span>
                </a>
            </li>
            <div class="nav-item">
                <a class="nav-link" href="{{route ('jadwal_hari_ini')}}">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>Notification</span>
                </a>
            </div> 
        <!-- End of Sidebar --> 
    @endsection
@endif


@section('main')
<div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Jadwal Hari ini</h1>
        </div>
            <div class="row">
                @if ($jadwals->count() > 0)
                @foreach ($jadwals as $jadwal)
                <div class="col-lg-4 mb-4"> <!-- Kolom untuk setiap kartu -->
                    <div class="card h-100"> <!-- Kartu dengan ketinggian yang sama -->
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary" style="width: 80%;">Jadwal: {{ $jadwal->judul }}</h6>
                                @if ($isAdmin) <!-- Menampilkan informasi owner hanya jika pengguna adalah admin -->
                                    <h6 style="width: 20%;">{{ $jadwal->user->fullname }}</h6>
                                @endif 
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Waktu: {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</p>       
                            <p>{{ $jadwal->deskripsi }}</p> <!-- Deskripsi atau informasi tambahan lainnya -->
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="col-lg-12 mb-4"> <!-- Kolom untuk kartu jika tidak ada jadwal -->
                        <div class="card h-100"> <!-- Kartu dengan ketinggian yang sama -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Hari Ini</h6>
                            </div>
                            <div class="card-body">
                                <p>Tidak ada jadwal hari ini.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>   


@endsection