<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Shop</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@3.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link href='/css/app.css' rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <script>
            localStorage.session = <?php
                use Illuminate\Support\Facades\Auth;

                echo json_encode([
                    'user' => [
                        'username' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'id' => Auth::user()->id
                    ]
                ]);
            ?>;
        </script>
    </head>

    <body>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>