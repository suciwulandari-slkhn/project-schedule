<?php
namespace App\Http\Controllers;
use App\Models\kategori as ModelsKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    function index(){
        //kirim data dr model
        $data = ModelsKategori::all();
        return view('kategori.index', ['data'=> $data]);
    }

    //fungsi menampilkan formulir tambah
    function tambah(){
        return view('kategori.tambahKat');
    }
    
    function edit($id){
        $data = ModelsKategori::find($id);
        return view('kategori.editKat', ['data'=> $data]);
    }

    function hapus(Request $request){
       ModelsKategori::where('id', $request->id)->delete();
       Session::flash('success', 'kategori berhasil dihapus');
       return redirect('/kategori');

    }

    //fungsi menangani proses
    function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',

        ], [
            'nama.required' => 'nama Wajib Di isi',
            'deskripsi.required' => 'deskripsi Wajib Di isi',
        ]);

        ModelsKategori::insert([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'pengajar' => $request->pengajar,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect('/kategori')->with('success', 'Berhasil Menambahkan Data');

    }

    function change(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'nama Wajib Di isi',
            'deskripsi.required' => 'deskripsi Wajib Di isi',
        ]);

        $dataKategori = ModelsKategori::find($request->id);

        $dataKategori->nama = $request->nama;
        $dataKategori->deskripsi = $request->deskripsi;
        $dataKategori->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/kategori');
    }

    }
