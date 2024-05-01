<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class JadwalController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
        if (Auth::user()->role === 'admin') {
            $data = Jadwal::select('jadwal.*', 'users.fullname as nama_pengguna')
                            ->leftJoin('users', 'jadwal.user_id', '=', 'users.id')
                            ->where('waktu_mulai', '>=', $today)
                            ->get();
        } else {
            $data = Jadwal::where('user_id', Auth::id())
                            ->where('waktu_mulai', '>=', $today)
                            ->get();
        }

        $kategori = Kategori::all();
        View::share('kategori', $kategori);
        return view('penjadwalan.index', compact('data', 'kategori'));
    }


    public function tambah()
    {
        $kategori = Kategori::all();
        return view('penjadwalan.tambahJad', compact('kategori'));
    }
    
    public function edit($id)
    {
        $data = Jadwal::find($id);
        $kategori = Kategori::all();
        return view('penjadwalan.editJad', compact('data', 'kategori'));
    }

    public function hapus(Request $request)
    {
        Jadwal::where('id', $request->id)->delete();
        Session::flash('success', 'Jadwal berhasil dihapus');
        return redirect('/jadwal');
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
        ]);

        $jadwal = new Jadwal();
        $jadwal->judul = $request->judul;
        $jadwal->kategori_id = $request->kategori_id;
        $jadwal->deskripsi = $request->deskripsi;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->lokasi = $request->lokasi;
        $jadwal->user_id = auth()->id();
        $jadwal->save();

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/jadwal')->with('success', 'Berhasil menambahkan data');
    }

    public function change(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
        ]);

        $jadwal = Jadwal::find($request->id);
        $jadwal->judul = $request->judul;
        $jadwal->kategori_id = $request->kategori_id;
        $jadwal->deskripsi = $request->deskripsi;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->lokasi = $request->lokasi;
        $jadwal->user_id = auth()->id();
        $jadwal->save();

        Session::flash('success', 'Berhasil mengubah data');

        return redirect('/jadwal');
    }

    public function JadwalHariIni()
    {
        $today = Carbon::today();
        $isAdmin = Auth::user()->role === 'admin';

        if ($isAdmin) {
            $jadwals = Jadwal::whereDate('waktu_mulai',$today)
                             ->with('user')
                             ->get();
        } else {
            $userId = Auth::id();
            $jadwals = Jadwal::whereDate('waktu_mulai',  $today)
                             ->where('user_id', $userId)
                             ->get();
        }

        return view('penjadwalan.jadwal_hari_ini', compact('jadwals', 'isAdmin'));
    }

}

