<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Area</title>
</head>
<body>
    <header>
        <h1>User Layout</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
