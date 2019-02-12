<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.14/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.14/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.14/js/uikit-icons.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
    background-image: url("http://atlanticfutsal.ca/grfx/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;

                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
        .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #333;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .content1 {
            color: #333;

            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
                <div class="top-left links">
                    <a href="https://laravel.com/docs">Our Profie</a>
                    <a href="https://laracasts.com">Booking</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Tournament</a>
                    <a href="https://forge.laravel.com">Our Member</a>
                    <a href="https://github.com/laravel/laravel">Contact Us</a>
                </div>
                <div class="uk-container uk-container-small">

<div class="content1 uk-text-justify  uk-margin-xlarge-top uk-column-1-2 uk-column-divider">
    <p>Futsal ini didirikan oleh Fadhel Irawan pada tahun 2006 yang bertepatan di daerah Kandang Lhokseumawe,Aceh Indonesia.</p>

    <p>Futsal ini sudah berstandar FIFA, dengan berbagai tipe lapangan dan fasilitas dari yang ekonomis sampai fasilitas royal.</p>

    <blockquote cite="#" class="uk-column-span">
        <p>Permainan yang paling indah bukan bisa merebut banyak gol namun permainan paling indah permainan yang FAIRPLAY.</p>
        <footer><cite><a href="">Lutfi Haridha</a></cite></footer>
    </blockquote>
    <p>
        Futsal ini sudah dilengkapi alat medis, musholla, dan kamar ganti baik perempuan maupun pria. Jika anda memerlukan wasit sebagai memimpin pertandingan kami akan sediakan.
    </p>
    <p>Jika terjadi pelanggaran terhadap futsal kami, kami tidak segan segan untuk memblacklist anda dari sini.</p>
</div>
</div>
        </div>

    </body>
</html>
