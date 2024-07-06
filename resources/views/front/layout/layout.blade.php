<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="">
        <title>@if(!empty($meta_title)) {{ $meta_title }} @else ArtNest: Malaysia's Premier E-Commerce Platform for Art Enthusiasts @endif</title>
       @if(!empty($meta_description))<meta name="description" content="{{ $meta_description }}">
       @endif
@if(!empty($meta_keywords))<meta name="keywords" content="{{ $meta_keywords }}"> 
       @endif
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('front/img/mdi/css/materialdesignicons.min.css')}}">

        <!-- Libraries Stylesheet -->
        <link href="{{url('front/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{url('front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="{{url('front/css/bootstrap.min.css')}}" >
        <!--<link rel="stylesheet" href="?{{url('front/css/bootstrap.min.v5.3.2.css')}}*/" > -->

        <!-- Template Stylesheet -->
        <link rel="stylesheet" href="{{url('front/css/style.css')}}" >
         <!-- Zoom Stylesheet -->
        <link rel="stylesheet" href="{{url('front/css/easyzoom.css')}}" >


    </head>

    <body>

      @include('front.layout.header')

    @include('front.layout.modals')
    @yield('content')
     @include('front.layout.footer')




        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('front/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('front/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{url('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="http://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Template Javascript -->
    
    <script src="{{url('front/js/main.js')}}"></script>
    <script src="{{url('front/js/easyzoom.js')}}"></script>
    <script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
	</script>

    @include('front.layout.scripts')

    </body>

</html>