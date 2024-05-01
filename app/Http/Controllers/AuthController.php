<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function index(){
        return view('authPage/login');
    }
    
    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'password wajib diisi',
        ]);
    
        //simpan ke db
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        //cek apakah ada di db
        if(Auth::attempt($infoLogin)){
            //jika email sudah dikonfir
            if(Auth::user()->email_verified_at != null){
                if(Auth::user()->role === 'admin'){
                    // Simpan informasi pengguna dalam sesi
                    $request->session()->put('user', Auth::user());
                    return redirect()->route('admin')->with('success', 'Halo Admin, Anda berhasil login');
                }else if(Auth::user()->role === 'user'){
                    // Simpan informasi pengguna dalam sesi
                    $request->session()->put('user', Auth::user());
                    return redirect()->route('user')->with('success', 'Berhasil login');
                }
            }else{
                Auth::logout();
                return redirect()->route('auth')->withErrors('Akun anda belum aktif. Harap Verifikasi terlebih dahulu');
            }
        }else{
            return redirect()->route('auth')->withErrors("Email atau password salah");
        }
    }
    
    function create(){
        return view('authPage/register');
    }

    function register(Request $request){

        $str = Str::random(100);
         $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'gambar' => 'required|image|file',

        ],[
            'fullname.required' => 'Nama wajib diisi',
            'fullname.min' => 'Nama minimal 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'password wajib diisi',
            'password.min' => 'password minimal 6 karakter',
            'gambar.required' => 'gambar wajib diisi',
            'gambar.image' => 'gambar yang diupload harus image',
            'gambar.file' => 'gambar harus berupa file',
        ]);

        $gambar_file = $request->file('gambar');
        $gambar_ekstensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
        $gambar_file ->move(public_path('picture/accounts'),$nama_gambar);

        $infoRegister =[
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'gambar' => $nama_gambar,
            'verify_key' => $str
        ];

        User::create($infoRegister);
        //data yang dikirim ke email pendaftaran
        $details = [
            'nama' => $infoRegister['fullname'],
            'role' => 'user',
            'datetime' =>date('Y-m-d H:i:s'),
            'website' => 'Pendaftaran Akun Ekstrakulikuler',
            'url' => 'http://' . request()->getHttpHost() . "/" ."verify/". $infoRegister['verify_key'],
        ];

        Mail::to($infoRegister['email'])->send(new AuthMail($details));
        return redirect()->route('auth')->with('success','Link verifikasi telah dikirim di email anda. Cek email untuk melakukan verifikasi');
    }

    function verify($verify_key){
        $keyCheck = User::select('verify_key')
        ->where('verify_key', $verify_key)
        ->exists();

        if($keyCheck){
            $user = User::where('verify_key', $verify_key)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
            return redirect()->route('auth')->with('succes','verifikasi email berhasil, akun anda sudah aktif');
        }else{
            return redirect()->route('auth')->withErrors('Keys tidak valid. pastikan telah melakukan register')->withInput();
        }
    }

    //Logout
    function logout(){
        Auth::logout();
        return redirect('/');
    }

}


    // function login(Request $request){
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',

    //     ],[
    //         'email.required' => 'Email wajib diisi',
    //         'password.required' => 'password wajib diisi',
    //     ]);

    //     //jika valid disimpan info loginnya
    //     $infoLogin = [
    //         'email' => $request->email,
    //         'password' => $request->password,
    //     ];

    //     //cek apakah ada di db
    //     if(Auth::attempt($infoLogin)){
    //         //jika email sudah dikonfir
    //         if(Auth::user()->email_verified_at != null){
    //             if(Auth::user()->role === 'admin'){
    //                 return redirect()-> route('admin')->with('success', 'Halo Admin, Anda berhasil login');
    //             }else if(Auth::user()->role === 'user'){
    //                 return redirect()-> route('user')->with('success', 'Berhasil login');
    //             }
    //         }else{
    //             Auth::logout();
    //             return redirect()->route('auth')->withErrors('Akun anda belum aktif. Harap Verifikasi terlebih dahulu');
    //         }
    //     }else{
    //         return redirect()->route('auth')->withErrors("Email atau password salah");
    //     }
    //  }

