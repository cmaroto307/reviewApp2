<!DOCTYPE html>
<html lang="en">
    <head>
        <title>reviewApp</title>        
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="Harry Boo">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/apple-touch-icon-114x114.png') }}">
        
        <!-- Load Core CSS 
        =====================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/core/bootstrap-3.3.7.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/core/animate.min.css') }}">
        
        <!-- Load Main CSS 
        =====================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/main/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main/setting.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main/hover.css') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/css/range-slider/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/range-slider/ion.rangeSlider.skinFlat.css') }}">
        
        <!-- Load Magnific Popup CSS 
        =====================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific/magic.min.css') }}">        
        <link rel="stylesheet" href="{{ asset('assets/css/magnific/magnific-popup.css') }}">              
        <link rel="stylesheet" href="{{ asset('assets/css/magnific/magnific-popup-zoom-gallery.css') }}">
        
        <!-- Load OWL Carousel CSS 
        =====================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.transitions.css') }}">
        
        <!-- Load Color CSS - Please uncomment to apply the color.
        =====================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/color/pasific.css') }}">
        
        <!-- Load Fontbase Icons - Please Uncomment to use linea icons
        =====================================--> 
        <link rel="stylesheet" href="{{ asset('assets/css/icon/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/icon/et-line-font.css') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        
    </head>
    <body  id="topPage" data-spy="scroll" data-target=".navbar" data-offset="100">
        
        <!-- Page Loader
        ===================================== -->
		<div id="pageloader" class="bg-grad-animation-3">
			<div class="loader-item">
                <img src="{{ asset('assets/img/other/oval.svg') }}" alt="page loader">
            </div>
		</div>
        
        <!-- Navigation Area
        ===================================== -->
        <nav class="navbar navbar-pasific navbar-expand-md navbar-standart navbar-fixed-top" style="border-bottom:1px solid #fff;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo/logo-default.png') }}" alt="logo">
                        ReviewApp
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link title text-uppercase font-montserrat color-dark">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('reviews/film') }}" class="nav-link title text-uppercase font-montserrat color-dark">Films</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('reviews/book') }}" class="nav-link title text-uppercase font-montserrat color-dark">Books</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('reviews/record') }}" class="nav-link title text-uppercase font-montserrat color-dark">Records</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link title text-uppercase font-montserrat color-dark">{{ auth()->user()->name }}</a>
                            </li>
                            @if (Route::has('logout'))
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="document.getElementById('formLogout').submit();" class="nav-link title text-uppercase font-montserrat color-dark">Logout</a>
                                    <form id="formLogout" action="{{ url('logout') }}" method="post">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        @else
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link title text-uppercase font-montserrat color-dark">Log in</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link title text-uppercase font-montserrat color-dark">Register</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Modal Content
        ===================================== -->
        <div class="container" style="padding-top: 100px;">
            @yield('modalContent')
        </div>
        <main>
            <div class="container">
                <!-- para mostrar mensajes de error -->
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- para mostrar mensajes de operaciones -->
                @if(session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                @yield('content')
                <hr>
            </div>
        </main>
        
        <!-- Footer Area
        =====================================-->
        <footer id="footer" class="footer-one center-block bg-light pb30 ">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-2 col-xs-12 mb25">
                        <div class="navbar-brand-footer center-block">ReviewApp</div>
                        <div class="copyright center-block">&copy; 2023. All rights reserved.</div>
                    </div>
                    
                    <div class="col-md-8 col-xs-12 text-center">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class=" bb-solid-1">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('reviews/film') }}">Films</a></li>
                                    <li><a href="{{ url('reviews/book') }}">Books</a></li>
                                    <li><a href="{{ url('reviews/record') }}">Records</a></li>
                                    <li><a href="{{ url('/home') }}">Profile</a></li>
                                </ul>
                            </div>
                            
                            <div class="col-sm-12 mt25">
                                <ul>
                                    <li><a href="#">Help Center</a></li>
                                    <li><a href="#">Term of Service</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-xs-12">
                        <div class="social-container">
                            <ul class="footer-social text-center">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-github"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- JQuery Core
        =====================================-->
        <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap-3.3.7.min.js') }}"></script>
        
        <!-- Magnific Popup
        =====================================-->
        <script src="{{ asset('assets/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/js/magnific-popup/magnific-popup-zoom-gallery.js') }}"></script>
        
        <!-- JQuery Main
        =====================================-->
        <script src="{{ asset('assets/js/main/jquery.appear.js') }}"></script>
        <script src="{{ asset('assets/js/main/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/js/main/parallax.min.js') }}"></script>
        <script src="{{ asset('assets/js/main/jquery.countTo.js') }}"></script>
        <script src="{{ asset('assets/js/main/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/main/jquery.sticky.js') }}"></script>
        <script src="{{ asset('assets/js/main/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('assets/js/main/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/js/main/main.js') }}"></script>
    </body>
</html>