<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://seeklogo.com/images/I/instagram-logo-1494D6FE63-seeklogo.com.png" type="image/x-icon">
    <title>@yield('title') </title>
    <link rel="stylesheet" href="{{ asset("css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    @yield('style')
    <style>
        #loader-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .loader img {
            width: 70px; /* Adjust the width as needed */
            height: 70px; /* Adjust the height as needed */
        }

        .content-container {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .content-visible {
            opacity: 1;
        }
    </style>

</head>
<body >
    <div id="loader-container">
       <div class="loader"><img loading="eager" src="https://seeklogo.com/images/I/instagram-logo-1494D6FE63-seeklogo.com.png" alt="Instagram Logo">
       </div>
   </div>

    <div class="container-fluid ">
        {{------------------------- Sidebar -------------------------}}
        <div class="row">
            <div class="col-md-3 col-2 p-0 col-lg-2" >
                <div class="sidebar  position-fixed top-0 start-0 bottom-0" style="width:inherit;">
                    @include('includes.sidebar')
                </div>
            </div>
        {{------------------------- Main layout -------------------------}}
            <div class="col-md-9 col-10"  >
                <div class="container">
                    <div class="row text-center" >
                    @yield('content')
                </div>
                </div>
            </div>


        </div>



    </div>

    <script>
        window.addEventListener('load', function () {
            var loaderContainer = document.getElementById('loader-container');
            var contentContainer = document.querySelector('.content-container');

            // Smoothly hide the loader after 2 seconds
            setTimeout(function () {
                loaderContainer.style.opacity = 0;
                contentContainer.classList.add('content-visible');
            }, 1000);

            // Add a delay before completely hiding the loader
            setTimeout(function () {
                loaderContainer.style.display = 'none';
            }, 1500);
        });
    </script>
    <script src="{{ asset("js/bootstrap.bundle.min.js") }}"></script>

</body>
</html>
