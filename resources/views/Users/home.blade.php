<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/home.jsx'])
    <title>Home</title>
</head>

<body>
    <div id="home-root" data-props='@json([
        'user' => auth()->user()
            ?->only(['name', 'email']),
    ])'></div>
</body>

</html>
