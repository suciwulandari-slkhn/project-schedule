@extends('dashPage.index')
@section('navitem')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <div class="nav-item active">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </div>

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
        
        
    @endsection


@section('main')
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang! {{Auth::user()->fullname}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Email dn role-->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{Auth::user()->email}} </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{Auth::user()->role}} </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-fill bi-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ date('j F Y') }} 
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ date('l') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

    </div>
</div>
  
@endsection