<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
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

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .github_link > a {
            display: inline;
            bottom: 50px;
            margin-top: 100px;
            text-transform: none;

        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            LaraTrell
        </div>

        @if ($errors->any())
            <div class="danger" style="color:red;">
                <h4>{!! $errors->first() !!}</h4>
            </div>
        @endif


        <div class="links">
            <a href="{!! route('authWithTrello') !!}">Sign in with Trello</a>
        </div>

        <p style="margin-top:100px">Visualiza en una sola pantalla todas las tarjetas de todas las listas 'Doing' de todos tus proyectos y clientes.</p>

        <div class="links github_link" style="margin-top:150px">
            <a href="https://github.com/mpijierro/laratrell" target="_blank"><i class="fa fa-github-alt"></i>&nbsp;&nbsp;GitHub</a>
            <a href="http://www.mandev.es/cv" target="_blank"><i class="fa fa-user"></i>&nbsp;&nbsp;about me</a>
        </div>

    </div>
</div>
</body>
</html>
