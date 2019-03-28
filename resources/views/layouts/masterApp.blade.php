<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png')}}">
	<meta name="author" content="Golam Sorwar">
	<meta name="description" content="Online Garments ERP System">
	<meta name="keywords" content="Garments ERP,Inventory">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Garments ERP')</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <div id="app">
      <header id="header" id="home">
        <div class="header-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-4 header-top-left no-padding">
                <ul>
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                  <li><a href="#"><i class="fab fa-behance"></i></a></li>
                </ul>
              </div>
              <div class="col-lg-6 col-sm-6 col-8 header-top-right no-padding">
                <a href="tel:+880 1687922145">+880 1687922145</a>
                <a href="mailto:info@golamsorwar.xyz">info@golamsorwar.xyz</a>
              </div>
            </div>
          </div>
        </div>

        <div class="container main-menu">
          <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
              <a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" style="height:25px;width:130px;"></a>
            </div>
            {{-- <Myheader></Myheader> --}}
            <nav id="nav-menu-container">
              <ul class="nav-menu">
                <li><a href="#">Library</a></li>
                <li><a href="#">Merchandising</a></li>
                <li><a href="#">Planning</a></li>
                <li class="menu-active"><a href="{{ route('home') }}">Inventory</a></li>
                <li><a href="#">Production</a></li>
                <li><a href="#">Accounting</a></li>
              </ul>
            </nav>
          </div>
        </div>

      </header>

      @yield('content')

      <footer class="footer-area section-gap">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-6">
              <div class="single-footer-widget">
                <h6>About Us</h6>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <p class="footer-text">
                  Copyright &copy; @php echo date('Y') @endphp All rights reserved | Garments ERP
                </p>
              </div>
            </div>
            <div class="col-lg-5  col-md-6 col-sm-6">

            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
              <div class="single-footer-widget">
                <h6>Follow Us</h6>
                <p>Let us be social</p>
                <div class="footer-social d-flex align-items-center">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-dribbble"></i></a>
                  <a href="#"><i class="fab fa-behance"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <script src="{{asset('js/app.js')}}"></script>


</body>
</html>
