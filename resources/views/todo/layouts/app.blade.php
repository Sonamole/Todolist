<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todolist-Laravel</title>
    @include('todo.layouts.styles')
</head>

<body class="header-fixed @yield('page') home2">

    <div id="wrapper">


        @yield('content')

    </div>

    @include('todo.layouts.scripts')
</body>

</html>
