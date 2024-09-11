@extends('front.layout.layout')
@section('content')



<!-- Contact Start -->
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="fw-bold">Contact Us</h1><br>
                        <p class="mb-4"></a><strong>ArtNest: Malaysia's Premier E-Commerce Platform for Art Enthusiasts</strong><br></p>

                           <p> ArtNest is an innovative e-commerce platform based in Malaysia, dedicated to bringing together art lovers and creators. Launched to support and nurture the local art community, ArtNest serves as a vibrant marketplace where artists can showcase and sell their unique creations, and art enthusiasts can discover and purchase original works.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100" 
                        style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.537812206004!2d101.72168617945543!3d3.2152551884055702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20of%20Management%20and%20Technology%20(TAR%20UMT)!5e0!3m2!1sen!2smy!4v1726061593258!5m2!1sen!2smy" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success</strong>  <?php echo Session::get('success_message'); ?>
                  <button type="button" class="close close-button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if($errors->any())              
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error</strong>  <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                  <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <div class="col-lg-7">
                    <form action="{{url('contact')}}" method="post" >@csrf
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" id="contact-name" name="name" value="{{old('name')}}" required>
                        <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email" id="contact-email" name="email" value="{{old('email')}}" required >
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Subject" id="contact-subject" name="subject" value="{{old('subject')}}" required>
                        <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message" id="contact-message" name="message" value="{{old('message')}}" required></textarea>
                        <button class="w-60 btn-primary  py-3  text-white "    type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x  me-4 gradient-icon2 " ></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">Ground Floor, Bangunan Tan Sri Khaw Kai Boh (Block A), Jalan Genting Kelang, Setapak, 53300 Kuala Lumpur, Federal Territory of Kuala Lumpur
                            </p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x me-4 gradient-icon2 " ></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">info@artnest.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x  me-4 gradient-icon2 " ></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+012) 3456789</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Contact End -->
@endsection