<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Survey</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <main class="main">
        @include('layout.sidebar')

        <div class="content">
            <div class="top-navbar">
                <div class='bx bx-menu' id="menu-icon"></div>
                <div class="profile">
                    <img src="https://i.postimg.cc/65Nh1ys9/profile.jpg" alt="profile image">
                </div>
            </div>

            @yield('content')

        </div>
    </main>

    <script src="{{ asset('js/app.js')}}"></script>
    @yield('scripts')

</body>
</html>
