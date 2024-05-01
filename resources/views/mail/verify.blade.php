<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi akun anda</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('authPage/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('authPage/css/style.css')}}">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <p>Halo <b> {{ $details['nama']}}</b> </p>
                    <p>Berikut adalah data anda</p>
                    <table>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td>{{$details['nama']}}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{$details['role']}}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>:</td>
                            <td>{{$details['website']}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Register</td>
                            <td>:</td>
                            <td>{{$details['datetime']}}</td>
                        </tr>
                        <br><br><br>
                        <center>
                            <h3>Klik dibawah ini untuk verifikasi akun : </h3>
                            <a href="{{$details['url']}}" style="text-decoration: none; color:white; padding: 9px; background-color: blue; font: bold; border-radius:20%"> Verifikasi
                        <br><br><br>
                        <p>
                            Copy right @2024 | Suci
                        </p>
                        </center>
                    </table>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('authPage/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('authPage/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>