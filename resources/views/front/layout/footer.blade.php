  <!-- Footer Start -->
  <div class="container-fluid text-white-50 footer pt-5" style="background-color: #ffffff;">
    <div class="container py-5 ">
        <div class="pb-4 mb-4" >
            <div class="row g-4">
                <!--<div class="col-lg-3">
                    <a href="#">
                        <img src="{{asset('front/img/logo2.png')}}" style="margin-bottom: 5px;">
                        <p class="mb-0" style="color: #f26b4e;">Entrepreneurial Spirit For A <br> Brighter Future </p>
                    </a>
                </div>-->
                <div class="col-lg-6">
                    <form class="position-relative mx-auto" >@csrf
                        <input class="form-control border-1 w-100 py-3 px-4 rounded-pill " type="email" placeholder="Your Email" name="subscriber_email" id="subscriber_email" required>
                        <button type="button" class="btn py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0; background-color: #000000; display: flex; align-items: center; justify-content: center; box-shadow: none;" onclick="addSubscriber()">Subscribe Now</button>
                    </form>
                </div>
              
            </div>
        </div>
        <div class="row g-5 " >
            <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-item">
                    <h4 class="text-black mb-3">Why People Like us!</h4>
                    <p class="mb-4" style="color: #474747;">We provide a free platform and opportunity for everyone who interested can start their business here without any charges. </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-black mb-3">Shop Info</h4>
                    <a class="btn-link  " href="{{url('aboutus')}}">About Us</a>
                    <a class="btn-link  " href="{{url('sell-on-us')}}">Sell On Us</a>
                    <a class="btn-link" href="{{url('faq')}}">FAQs & Help</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="text-start footer-item" >
                    <h4 class="text-black mb-3">For You</h4>
                    <div class="d-flex">
                    <div class="col-6">
                    <a class="btn-link" href="{{url('Prints')}}">Art Prints</a>
                    <br>    
                    <a class="btn-link" href="{{url('Photography')}}">Photography</a>
                    <br>     
                    <a class="btn-link" href="{{url('T-shirt')}}">T-Shirt</a>
                    <br>     
                    <a class="btn-link" href="{{url('Hoodies')}}">Hoodies</a>    
                    </div>
                    <div class="col-6">
                    <a class="btn-link" href="{{url('Totes')}}">Totes</a>
                    <br>     
                    <a class="btn-link" href="{{url('Pouches')}}">Pouches</a>
                    <br>     
                    <a class="btn-link" href="{{url('Necklaces')}}">Necklaces</a>
                    <br>     
                    <a class="btn-link" href="{{url('Bracelets')}}">Bracelets</a>    
                    </div>
                    </div>    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item" >
                   <!-- <h4 class="text-black mb-3">Contact</h4>-->
                    <a href="{{url('contact')}}" class="btn border-secondary py-2 px-4 rounded-pill">Contact Us </a>
                        <div class="d-flex " >
                            <a class="btn me-2 btn-md-square rounded-circle social-btn"  href="#" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a class="btn me-2 btn-md-square rounded-circle social-btn"  href="#" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

  
  
 <!-- Copyright Start -->
 <div class="container-fluid copyright py-4" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span style="color: #000000;"><i class="fa-solid fa-copyright" style="color: #000000; margin-right: 5px;"></i>2024 ART.NEST, All right reserved.</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
