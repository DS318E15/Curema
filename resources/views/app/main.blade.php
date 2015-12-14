<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <!-- header -->
    </header>
    <main>
        @yield('content')
    </main>
</div>

</body>
</html>