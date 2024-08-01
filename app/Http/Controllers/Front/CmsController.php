<?php

namespace App\Http\Controllers\Front;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Validator;

class CmsController extends Controller
{
    public function cmsPage(){
        $currentRoute= url()->current(); 
       $currentRoute=Str_replace("http://127.0.0.1:8000/","",$currentRoute);
      // echo  $currentRoute;
       $cmsRoutes=CmsPage::select('url')->where('status',1)->get()->pluck('url')->toArray();
        if(in_array($currentRoute,$cmsRoutes)){
            $cmsPageDetails=CmsPage::where('url',$currentRoute)->first()->toArray();
            $meta_title=$cmsPageDetails['meta_title'];
            $meta_description=$cmsPageDetails['meta_description'];
            $meta_keywords=$cmsPageDetails['meta_keywords'];
           return view('front.pages.cms_page')->with(compact('cmsPageDetails','meta_title','meta_description','meta_keywords'));
        }else{
            abort(404);
        }
    }
    public function contact(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
           // echo "<pre>";print_r($data);die;
           $rules=[
            "name"=>"required|max:100",
            "email"=>"required|email|max:150",
            "subject"=>"required|max:200",
            "message"=>"required",
           ];
           $customMessages=[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
            'email.email'=>'Valid Email is required',
            'subject.required'=>'Subject is required',
            'message.required'=>'Message is required',

           ];
           $validator=Validator::make($data,$rules,$customMessages);
           if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
           }
            //send user query to admin
            $email="admin@admin.com";
            $messageData=[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message'],
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject("Enquiry from ArtNest");
            });
            $message="Thanks for your query.We will get back to you soon.";
            return redirect()->back()->with('success_message',$message);
        }$meta_title="Contact Us-ArtNest";
        $meta_description="ArtNest-Online Shopping Website for Arts";
        $meta_keywords="eshop website,online shopping,contact us";
        return view('front.pages.contact')->with(compact('meta_title','meta_description','meta_keywords'));
    }

    public function aboutUs(){
        return view('front.pages.aboutus');
    }
    public function sellOnUs(){
        return view('front.pages.sellonus');
    }
}
