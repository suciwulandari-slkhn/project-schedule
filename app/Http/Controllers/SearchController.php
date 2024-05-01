<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kategori;

use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search_term');
        $tanggal = $request->input('tanggal');
        $user = Auth::user();
        $query = Jadwal::where('user_id', $user->id);
    
        // Tambahkan kondisi pencarian 
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul', 'like', '%'.$searchTerm.'%')
                    ->orWhere('lokasi', 'like', '%'.$searchTerm.'%');
            });
        }
        if ($tanggal) {
            $query->whereDate('waktu_mulai', $tanggal);
        }
        $result = $query->get();
    
        // Mengambil semua kategori dari database
        $kategori = Kategori::all();
    
        return view('penjadwalan.index', ['data' => $result, 'kategori' => $kategori]);
    }
    
    public function filterByCategory(Request $request)
    {
        $kategoriId = $request->input('kategori');

        $result = Jadwal::where('kategori_id', $kategoriId)->get();

        $kategori = Kategori::all();

        return view('penjadwalan.index', ['data' => $result, 'kategori' => $kategori]);
    }
     
}
