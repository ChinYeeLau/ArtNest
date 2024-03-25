<?Php
use App\Models\Section;
$sections=Section::sections();
/*echo"<pre>";print_r($sections);die;*/
?>
  
 <!-- Spinner Start -->
 <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->


 <!-- Navbar start -->

 <div class="container-fluid fixed-top" style="padding-left:50px;padding-right:50px;">  
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light navbar-expand-xl" style="background-color: #fdc3b5;">
            <a href="{{url('/')}}" class="navbar-brand d-xl-none"><img src="{{asset('front/img/ART.NEST.png')}}" class="logo" alt="logo"></a>
            <button class="navbar-toggler shadow-none border-0 py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <i class="fa-solid fa-bars" style="color: #f26b4e;"></i>
            </button>  
            <div class="collapse navbar-collapse" style="width: 100%;" id="navbarCollapse" >
                <div class="d-flex flex-column flex-xl-row">
                    <div class="dropdown" style="float:right;">
                        <button class="dropbtn nav-link dropdown-toggle" data-bs-toggle="dropdown">Category</button>
                        <div class="dropdown-menu dropdown-content">
                            @foreach($sections as $section)
                                <strong style="padding-left:15px; color: #f26b4e">{{$section['name']}}</strong>
                                @if(count($section['categories']) > 0)
                                    @foreach($section['categories'] as $category)
                                        @if(isset($category['category_name']))
                                            <a  href="{{url($category['url'])}}">{{$category['category_name']}} </a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <a href="about.html" class="nav-item nav-link">About</a> 
                    <a href="{{url('/')}}" class="navbar-brand d-none d-xl-block"><img src="{{asset('front/img/ART.NEST.png')}}" class="logo" alt="logo" style="padding: 8px 16px;"></a> 
                </div>
                <div class="navbar-nav mx-auto">    
                </div>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border: none; border-radius: 30px; height: 45px;">
                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-2x" style="color: #f26b4e;"></i></button>
                    </form>
                    <div class="d-flex">
                    <a href="vendor.html" class="nav-item nav-link"><i class="fa-solid fa-store fa-2x" style="color: #f26b4e;"></i></a>   
                    <a href="favourite.html" class="nav-item nav-link"><i class="fa-solid fa-heart fa-2x" style="color: #f26b4e;"></i></a> 
                    <a href="cart.html" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping fa-2x" style="color: #f26b4e;"></i></a> 
                    <div class="dropdown" style="float:right;">
                    <button class="dropbtn nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-user fa-2x" style="color: #f26b4e; "></i></button>
                    <div class="dropdown-menu m-0   dropdown-content" style=" position: absolute;right: 0;">
                    <a href="profile.html">Profile</a>
                    <a href="trackorder.html">Track Order</a>
                    <a href="message.html">Message</a>
                    <a href="index - Copy (2).html">Log Out</a>    
                  </div>
                </div>    
                </div>
                </div>
            
        </nav>
    </div>
</div>

<!-- Navbar End -->
