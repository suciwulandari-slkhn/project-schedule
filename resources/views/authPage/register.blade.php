<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('authPage/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('authPage/css/style.css')}}">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" action="{{route('registrasi')}}" class="register-form" enctype="multipart/form-data">
                           @csrf
                           @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $item)
                                            <li> {{$item}} </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <ul>
                                        <li> {{Session::get('success')}}</li>
                                    </ul>
                                </div>
                                @endif
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fullname" id="fullname" placeholder="Nama Lengkap"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div style="margin : 20px 20px 40px 20px;">
                                <label for="gambar" style="margin-bottom: 10px; font size: 16 pt; color: #66666;"></label>
                                <input class="input100" type="file" name="gambar" id="gambar" style="margin-left: -40px">
                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        
                        <a href="{{route('auth')}}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>


    </div>

    <!-- JS -->
    <script src="{{asset('authPage/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('authPage/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>