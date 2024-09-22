<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $sliderBanners=Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $fixBanners=Banner::where('type','Fix')->where('status',1)->get()->toArray();
        $newProducts=Product::orderby('id','Desc')->where('status',1)->with('section')->limit(8)->inRandomOrder()->get();
        $bestSellers=Product::where('is_bestseller','Yes')->where('status',1)->limit(8)->inRandomOrder()->with('section')->get();
        $discountedProducts=Product::where('product_discount','>',0)->where('status',1)->limit(8)->inRandomOrder()->with('section')->get();
        $featuredProducts=Product::where('is_featured','Yes')->where('status',1)->limit(8)->inRandomOrder()->with('section')->get();
        $meta_title="ArtNest-E-Commerce Platform for Art Enthusiasts";
        $meta_description="Online Shopping Website for Arts";
        $meta_keywords="eshop website,online shopping,art,prints,tshirt,hoodies,jewelry,bracelets";
        return view ('front.index')->with(compact('sliderBanners','fixBanners','newProducts','bestSellers','discountedProducts','featuredProducts','meta_title','meta_description','meta_keywords'));
    }
}
