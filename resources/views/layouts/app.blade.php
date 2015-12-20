<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Curema</title>

    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900'>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<nav>
    <h1>Curema</h1>
    @include('app.nav')
</nav>
<div>
    <header>
        @include('app.header')
    </header>
    <main>
        @yield('content')
    </main>
</div>

</body>
</html>