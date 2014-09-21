<!DOCTYPE html>
<html class="no-js" lang="">    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @section('title')
        INTERNSHAL APP
        @show
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="mainContainer">
        <header>
            <div class="center">
                <h3>
                    @section('header')
                    <a href="/">Home</a>
                    @show
                </h3>
            </div>
        </header>
        <div class="container">
            @yield('content')
        </div>
        <footer>
        </footer>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>