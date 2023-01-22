<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Title --}}
    <title>📌 T O D O</title>
</head>
<body>

    {{-- Vue Container --}}
    <div id="root"></div>

    @auth

        {{-- Recognizes if the user is logged --}}
        <script>
            window.user = true;
        </script>
    @endauth

    {{-- Js --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>