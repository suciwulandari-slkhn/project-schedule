@extends('dashPage.index')
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

        <!-- Menu Admin-->
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
                    <a class="collapse-item" href="{{ route('kategori') }}">Kategori Ekstrakulikuler</a>
            </div>
        </li>

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
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="font-weight-bold mb-0 ml-5">Data User</h4>
                </div>
                <div>
                    <a href="/tambahUser" class="text-decoration-none text-white mr-5">
                        <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                         <i class="ti-plus btn-icon-prepend"></i>Tambah User</button></a>
                </div>
            </div>
        </div>
    </div>
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
    <div class="col-lg-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TABEL AKUN</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Gambar
                                </th>
                                <th>
                                    Nama lengkap
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        @foreach ($uc as $item)
                            <tbody>
                                <td class="py-1">
                                    <img src="{{ asset('picture/accounts') }}/{{ $item->gambar }}" alt="image" height="50" width="50"/>
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                @if ($item->role === 'admin')
                                    <td style="color:rgb(0, 255, 0); font-weight: bold;">
                                        {{ $item->role }}</td>
                                @else
                                    <td>{{ $item->role }}</td>
                                @endif
                                <td>{{ $item->email }}</td>
                                @if ($item->role === 'admin')
                                    <td style="color:rgb(0, 255, 0); font-weight: bold;">Admin User</td>
                                @else
                                    <td>
                                        <form onsubmit="return confirm('Yakin ingin Mengangkat USER Menjadi ADMIN ?')"
                                            class="d-inline" action="/uprole/{{ $item->id }}" method="POST">
                                            @csrf
                                            <input type="submit"
                                                class="btn-sm text-decoration-none border border-warning text-warning"
                                                value="UP">
                                        </form>
                                        &nbsp;<a href="/editUser/{{ $item->id }}"
                                            class="btn-sm btn-warning text-decoration-none">Edit</a>
                                        <form onsubmit="return confirmDelete(event)" class="d-inline"
                                            action="/hapusUser/{{ $item->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-danger btn-sm">Hapus</button>
                                        </form>
                                @endif
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Menghentikan form dari pengiriman langsung

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
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
