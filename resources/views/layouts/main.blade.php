<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script defer src=""></script>
    <title>426_pr</title>
</head>

<body>
    <header>
        <div class="container header__content">
            <h1>Logo</h1>
            <div class="header__menu">
                @auth
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/register" class="button">
                        Register
                    </a>
                    <a href="/login" class="button">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </header>
    @yield('content')
</body>

</html>
