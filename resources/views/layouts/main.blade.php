<html>
<head>
    <title>ShortUrl - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<nav class="nav justify-content-center">
    <a class="nav-link" href="/">HOME / ADD URL</a>
    <a class="nav-link" href="/stat">STATISTICS</a>
</nav>
<div class="container">
    @yield('content')
</div>
</body>
</html>