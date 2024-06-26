<?Php
use App\Models\Section;
$sections=Section::sections();
/*echo"<pre>";print_r($sections);die;*/
 $totalCartItems=totalCartItems();
?>
  
 <!-- Spinner Start -->
 <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow " style="color: #f26b4e;" role=""></div>
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
                        <div class=" m-0 dropdown-content" style=" position: absolute;">
                            @foreach($sections as $section)
                                <strong style="padding-left:15px; color: #f26b4e;font-size:24px;">{{$section['name']}}</strong>
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
                    <a href="{{url('contact')}}" class="nav-item nav-link">Contact Us</a> 
                    <a href="{{url('/')}}" class="navbar-brand d-none d-xl-block"><img src="{{asset('front/img/ART.NEST.png')}}" class="logo" alt="logo" style="padding: 8px 16px;"></a> 
                </div>
                <div class="navbar-nav mx-auto">    
                </div>
                <form class="d-flex" action="{{url('/search-products')}}" method="get">
                    <input name="search" class="form-control me-2" type="search" placeholder="Search"  @if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])) value="{{$_REQUEST['search']}}" @endif
                        aria-label="Search" style="border: none; border-radius: 30px; height: 45px;">
                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-2x" style="color: #f26b4e;"></i></button>
                    </form>
                    <div class="d-flex">
                    <!-- Vendor Dropdown -->
                <div class="dropdown" style="float:right;">
                    <button class="dropbtn nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-store fa-2x" style="color: #f26b4e; "></i></button>
                    <div class="dropdown-content" style="position: absolute; right: 0;">
                       
                            <a href="{{url('vendor/login')}}">Log in</a>
                            <a href="{{url('vendor/register')}}">Register</a>
                        
                    </div>
                </div>  
            
                   <!-- Favorites and Cart Links -->
                   <div class="navbar-nav ml-auto ">
                    <a href="{{url('wishlist')}}" class="nav-item nav-link"><i class="fa-solid fa-heart fa-2x" style="color: #f26b4e;"></i></a>  </div>
                    <div class="navbar-nav ml-auto ">
                        <a href="{{url('cart')}}" class="nav-item nav-link cart-link">
                            <i class="fa-solid fa-cart-shopping fa-2x cart-icon"></i>
                            <span class="cart-items totalCartItems">{{$totalCartItems}}</span>
                        </a>                </div>
            
                    <div class="dropdown" style="float:right;">
                        
                        <button class="dropbtn nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        @if(!empty(Auth::user()->image))
                       <img src=" {{ url('front/images/photos/' . Auth::user()->image) }}"  alt="User Photo" class="user-photo">
                       @else
                 <i class="fa-solid fa-user fa-2x" style="color: #f26b4e; "></i>
                     @endif
                    </button>
                    <div class="m-0 dropdown-content" style="position: absolute; right: 0;">
                        @if (Auth::check())
                            <a href="{{url('user/account')}}">Profile</a>
                            <a href="{{url('user/orders')}}">My Orders</a>
                            <a href="{{url('user/chat')}}">Message</a>
                            <a href="{{url('user/logout')}}">Log Out</a>
                        @else  
                            <a href="{{url('user/login')}}">User Login</a>  
                            <a href="{{url('user/register')}}">User Register</a>     
                        @endif
                    </div>
                </div>    
                </div>
                </div>
            
        </nav>
    </div>
</div>

<!-- Navbar End -->
