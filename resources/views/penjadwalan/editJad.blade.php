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
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kontrol lainnya:</h6>
                    <a class="collapse-item" href="{{ route('userControl') }}">Pengguna</a>
                    <a class="collapse-item" href="{{route('kategori')}}">Kategori Ekstrakulikuler</a>
            </div>
        </li>

        <!--Menu user-->
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


@elseif(Auth::user()->role === 'user')
    @section('navitem')
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
    @endsection
@endif

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Jadwal </h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/editJadwal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $data->judul }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ $data->deskripsi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <!-- Ganti input text dengan select -->
                        <select class="form-control" id="kategori" name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            <!-- Loop untuk menampilkan opsi kategori -->
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" @if($kat->id == $data->kategori_id) selected @endif>{{ $kat->nama }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai"
                            value="{{ $data->waktu_mulai }}" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai"
                            value="{{ $data->waktu_selesai }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                            value="{{ $data->lokasi }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                    <a href="/jadwal" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
