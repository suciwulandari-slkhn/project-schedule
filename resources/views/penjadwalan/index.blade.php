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

        <!-- menu All -->
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
        <!-- End of Sidebar --> 
    @endsection
@endif
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Jadwal</h1>
        <p class="mb-4">Selamat datang <b>{{Auth::user()->fullname}}</b>! Anda dapat mengecek jadwal dan membuat jadwal baru untuk kegiatan yang Anda inginkan</p>
            {{-- Sweet Allert --}}
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire(
                            'Sukses',
                            '{{ Session::get('success') }}',
                            'success'
                        );
                    });
                </script>
            @endif 
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap">
                <!-- Tombol Tambah Jadwal -->
                <a href="/jadwalTambah" class="btn-sm btn-primary text-decoration-none mr-2 mb-2 mb-md-0">Tambah Jadwal</a> 
                <!-- Form Pencarian dan Filter -->
                <div class="d-flex mb-2 mb-md-0"> 
                    <!-- Form Pencarian -->
                    <form class="form-inline" method="post" action="/search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control border-0 small" name="search_term" 
                            placeholder="Cari dengan judul / lokasi" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-inline mr-2" action="{{ route('filterByCategory') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <select class="form-control" name="kategori">
                                <option value="">Filter berdasarkan Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    
                    
                    
                    
                    <!-- Tambahkan mb-2 mb-md-0 untuk margin bottom hanya pada layar kecil -->
                    {{-- <form class="form-inline mr-2" action="/search-by-category" method="post">
                        <div class="input-group">
                            <select class="form-control" name="kategori">
                                <option value="">Filter berdasarkan Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form> --}}
                    {{-- Form Pencarian --}}
                    {{-- <form class="form-inline" method="post" action="{{ route('search') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control border-0 small" name="search_term" 
                            placeholder="Cari dengan judul / lokasi" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
            
            <!-- Data Table Content -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Waktu mulai</th>
                                <th>Waktu selesai</th>
                                <th>Lokasi</th>
                                @if(Auth::user()->role === 'admin') <!-- Tambahkan kondisi untuk mengecek apakah pengguna adalah admin -->
                                    <th>Nama Pengguna</th> <!-- Tampilkan kolom Nama Pengguna hanya jika pengguna adalah admin -->
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @foreach ($kategori as $kat)
                                        @if ($kat->id == $item->kategori_id)
                                            {{ $kat->nama }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->waktu_mulai }}</td>
                                <td>{{ $item->waktu_selesai }}</td>
                                <td>{{ $item->lokasi }}</td>
                                @if(Auth::user()->role === 'admin') <!-- Tambahkan kondisi untuk mengecek apakah pengguna adalah admin -->
                                    <td>{{ $item->nama_pengguna }}</td> <!-- Tampilkan nama pengguna hanya jika pengguna adalah admin -->
                                @endif
                                <td>
                                    <a href="/jadwalEdit/{{$item->id}}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form onsubmit="return konfirHapus(event)" action="/jadwalHapus/{{$item->id}}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger  btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function konfirHapus(event) {
        event.preventDefault(); // Menghentikan form dari pengiriman langsung

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confisrmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                swal('Your imaginary file is safe!');
            }
        });
    }
</script>

{{-- <script>
    $(document).ready(function() {
        // Event listener untuk perubahan dropdown kategori
        $('select[name="kategori"]').change(function() {
            // Ambil nilai kategori yang dipilih
            var selectedCategoryId = $(this).val();
            
            // Kirim permintaan Ajax untuk mendapatkan data jadwal berdasarkan kategori yang dipilih
            axios.get('/jadwal-by-kategori/' + selectedCategoryId)
                .then(function(response) {
                    // Menghapus semua elemen jadwal sebelumnya
                    $('#jadwal-list').empty();
                    
                    // Menambahkan data jadwal baru ke dalam daftar
                    response.data.forEach(function(jadwal) {
                        $('#jadwal-list').append('<li>' + jadwal.judul + '</li>');
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching jadwal data:', error);
                });
        });
    });
</script> --}}


