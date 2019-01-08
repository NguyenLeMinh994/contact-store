<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>ContactStore</title>
</head>
<body>
    <div class="container">
        <div id="app">
            <contacts>

            </contacts>
        </div>
    </div>
    <script src=" {{ asset('/js/app.js') }}"></script>
</body>
</html>