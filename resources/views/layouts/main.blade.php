<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') </title>
    <link rel="stylesheet" href="{{ asset("css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">


</head>
<body>
    <div class="container-fluid ">
        {{------------------------- Sidebar -------------------------}}
        <div class="row">
            <div class="col-md-3 col-2 p-0 border col-lg-2" >
                <div class="sidebar  position-fixed top-0 start-0 bottom-0">
                    @include('includes.sidebar')
                </div>
            </div>
        {{------------------------- Main layout -------------------------}}
            <div class="col-md-8 col-4"  >
                <div class="container">
                    <div class="row text-center mx-auto">
                    @yield('content')
                </div>
                </div>
            </div>


        </div>



    </div>
    <script src="{{ asset("js/bootstrap.bundle.min.js") }}"></script>

</body>
</html>
