<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dev-Forum</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
    <style>
        #app{
            background-color: rgba(170, 172, 183, 0.28);
        }
    </style>

</head>
<body>
<div id="app">
    <v-app>
        <index></index>
    </v-app>
</div>
</body>
</html>

<script>

</script>
