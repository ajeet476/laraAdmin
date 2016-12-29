<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/styles/default.min.css">
    <style type="text/css">
        .nav-header nav {
            height: auto !important
        }
        .page-title {
            padding: 2rem 0;
            margin: 0;
            text-align: center;
        }
        .page-title a {
            display: inline-block
        }
    </style>
    <style type="text/css">.row[data-v-742ee0e8] {
            margin-bottom: 0 !important
        }</style>
    <style type="text/css">.v-btn[data-v-178395d0] {
            margin-bottom: 1rem
        }</style>
    <style type="text/css">footer[data-v-b0b8a98e] {
            padding-left: 0
        }</style>
    <style type="text/css">pre[data-v-f744084a] {
            border: 1px solid rgba(51, 51, 51, .12);
            margin: 2rem 0
        }

        pre[data-v-f744084a]:before {
            content: "language-markup";
            background: #cecece;
            padding: .2rem;
            border: 1px solid rgba(51, 51, 51, .12);
            position: relative;
            left: -9px;
            top: -7px
        }</style>
    <style type="text/css">.btn {
            margin-bottom: 1rem
        }</style>
    <style type="text/css">body {
            overflow-x: hidden
        }

        main {
            min-height: 83.1vh;
            padding-bottom: 3rem
        }

        footer, header, main {
            padding-left: 240px
        }

        @media only screen and (max-width: 992px) {
            footer, header, main {
                padding-left: 0
            }
        }

        h4 {
            margin-top: 6rem
        }</style>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <header>
        <div class="nav-header">
            <nav class="">
                <admin-side-bar></admin-side-bar>
            </nav>
        </div>
    </header>
    <main>
        <div class=" container">
            @yield('content')
        </div>
    </main>

    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">©Copyright 2016 John Leider</div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.js"></script>

</body>
</html>
