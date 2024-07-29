
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if(Session::get('page')=="dashboard")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" href="{{url('admin/dashboard')}}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(Auth::guard('admin')->user()->type=="vendor")
        <li class="nav-item">
            <a @if(Session::get('page')=="update_admin_password"||Session::get('page')=="update_admin_details")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Settings</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a  @if(Session::get('page')=="update_admin_password")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/update-admin-password')}}" > Update Password</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="update_admin_details")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/update-admin-details')}}"> Update Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="update_personal_details"||Session::get('page')=="update_business_details"||Session::get('page')=="update_bank_details")@endif class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Vendor Details</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-vendors">
                <ul class="nav flex-column sub-menu"style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="update_personal_details")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/update-vendor-details/personal')}}" > Personal Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="update_business_details")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/update-vendor-details/business')}}"> Business Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="update_bank_details")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/update-vendor-details/bank')}}"> Bank Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="products")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Catalogue Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
              
                    <li class="nav-item"> <a @if(Session::get('page')=="products")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/products')}}" >Products</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="coupons")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/coupons')}}" >Coupons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="orders")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Orders Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item">
                        <a @if(Session::get('page')=="orders")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/orders')}}" > Orders</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="chats")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-chats" aria-expanded="false" aria-controls="ui-chats">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Chat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-chats">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item">
                        <a @if(Session::get('page')=="chats")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/admin/chat')}}">Chats</a>
                    </li>
                </ul>
            </div>
        </li>
        @else
        
        <li class="nav-item">
            <a @if(Session::get('page')=="view_admins"||Session::get('page')=="view_vendors"||Session::get('page')=="view_all")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Admin Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admins">
                <ul class="nav flex-column sub-menu"style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="view_admins")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/admins/admin')}}" > Admins</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="view_vendors")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/admins/vendor')}}" > Vendors</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="view_all")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/admins')}}" > All</a></li>

              
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="sections"||Session::get('page')=="categories"||Session::get('page')=="products"||Session::get('page')=="coupons"||Session::get('page')=="filters")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Catalogue Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="sections")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/sections')}}" > Sections</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="categories")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/categories')}}" > Categories</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="products")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/products')}}" >Products</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="coupons")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/coupons')}}" >Coupons</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="filters")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/filters')}}" > Filters</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="orders")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Orders Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item">
                        <a @if(Session::get('page')=="orders")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/orders')}}" > Orders</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="ratings")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-ratings" aria-expanded="false" aria-controls="ui-ratings">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Ratings Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-ratings">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item">
                        <a @if(Session::get('page')=="ratings")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif class="nav-link" href="{{url('admin/ratings')}}" > Ratings & Reviews</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a  @if(Session::get('page')=="users"||Session::get('page')=="subscribers")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-users">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Users Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-users">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="users")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/users')}}" > Users</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="subscribers")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/subscribers')}}" > Subscribers</a></li>
                </ul>
            </div>
        </li>
       
        <li class="nav-item">
            <a  @if(Session::get('page')=="banners")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-banners" aria-expanded="false" aria-controls="ui-banners">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Banners Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-banners">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="banners")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/banners')}}" > Home Page Banners</a></li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a  @if(Session::get('page')=="cmspages")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-pages" aria-expanded="false" aria-controls="ui-pages">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Pages Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-pages">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="cmspages")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/cms-pages')}}" > CMS Pages</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a  @if(Session::get('page')=="shipping")style="background:#f26b4e !important; color:#fff!important;"@endif class="nav-link" data-toggle="collapse" href="#ui-shipping" aria-expanded="false" aria-controls="ui-shipping">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Shipping Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-shipping">
                <ul class="nav flex-column sub-menu" style="background:#fff!important;color:#f26b4e !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="shipping")style="background:#f26b4e !important; color:#fff!important;"@else style="background:#fff !important;color:#f26b4e!important" @endif  class="nav-link" href="{{url('admin/shipping-charges')}}" > Shipping Charges</a></li>
                </ul>
            </div>
        </li>
        @endif
       
       
    </ul>
</nav>