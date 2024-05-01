<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MeTime</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('landingpage/assets/favicon.ico')}}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('landingpage/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#!">Selamat Datang</a>
                <a class="btn btn-primary" href="{{ route('auth')}}">Masuk</a>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5">Tata kelola waktu Anda dengan bijak bersama MeTime!</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-calendar m-auto text-primary"></i></div>
                            <h3>Penjadwalan Fleksibel</h3>
                            <p class="lead mb-0">MeTime membantu Anda menyusun jadwal harian atau mingguan dengan cepat dan mudah!</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-bell m-auto text-primary"></i></div>
                            <h3>Pengingat Personalisasi:</h3>
                            <p class="lead mb-0">MeTime membantu Anda menyusun jadwal harian atau mingguan dengan cepat dan mudah!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer" style="padding: 20px;">
            <div class="container">
                <div class="row text">
                    <div class="col-lg-12 h-100 text-center text-lg-start my-auto" style="display: flex; justify-content: center;">
                        <p class="text-muted small mb-4 mb-lg-0" style="margin: 0 auto;">&copy; MeTime2024. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('landingpage/ js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
