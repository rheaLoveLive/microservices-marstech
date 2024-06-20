<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | CAFE ADDon</title>

    @include('layouts.sc_header')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- REQUIRED SCRIPTS -->
    @include('layouts.sc_footer')
    @yield('custom_js')
</body>

</html>
