<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CCC App Name')</title>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.css">

    <link href="/css/app.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{url('assets/flew/css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{url('assets/flew/css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <!-- Theme style  -->
    <link rel="stylesheet" href="{{url('assets/flew/css/style.css')}}">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{url('assets/flew/css/flexslider.css')}}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{url('assets/flew/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/flew/css/owl.theme.default.min.css')}}">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

    <!-- Scripts -->
    @yield('scripts', '')
    <style media="screen">
      h2,h3,h4,h5,h1,.navbar-brand,a.btn{
        font-family: 'Amatic SC', cursive;
      }
      p strong{
        font-size:24px;

      }
      
      div.v-align h2.title{
        font-size:32px
      }

      div.v-align h5.title{
        font-size:24px
      }
      .navbar li a strong{
        font-size:24px;
        font-family: 'Amatic SC', cursive;

      }
      .grid-container{
        width:70%
      }
    </style>

</head>
<body class="with-navbar" v-cloak>
  @include('layouts.nav.guest')
</div>
<br>
  @yield('content')
</body>
<!-- JavaScript -->
<script src="/js/app.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>

<script src="{{url('assets/flew/js/owl.carousel.min.js')}}"></script>
<!-- Flexslider -->
<script src="{{url('assets/flew/js/jquery.flexslider-min.js')}}"></script>

<!-- MAIN JS -->
<script src="{{url('assets/flew/js/main.js')}}"></script>

</html>
