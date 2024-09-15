<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/favicon.ico')}}">

    <title>BJM - Berkah Jaya Motor Mobilindo</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('user/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user/css/skin_color.css')}}">

</head>

<body class="theme-primary">

    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div>
                        <img src="{{asset('images/auth-bg/404.png')}}" class="max-w-650 w-p100" alt="" />
                        <h1>Page Not Found !</h1>
                        <h3>looks like, page doesn't exist</h3>
                        <div class="my-30"><a href="{{url('/')}}" class="btn btn-danger">Back to Home</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendor JS -->
    <script src="{{asset('user/js/vendors.min.js')}}"></script>

    <!-- EduAdmin front end -->
    <script src="{{asset('user/js/template.js')}}"></script>

</body>

</html>