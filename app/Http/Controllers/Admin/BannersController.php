<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    public function banners(){
        Session::put('page','banners');

        $banners=Banner::get()->toArray();
       /* dd($banners);die;*/
       return view('admin.banners.banners')->with(compact('banners'));
    }
    public function updateBannerStatus(Request $request){
        Session::put('page','banners');

        if($request->ajax()){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            if($data ['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }

        }
        public function deleteBanner($id){
            Session::put('page','banners');

            //get banner image
            $bannerImage=Banner::where('id',$id)->first();
            //get banner image path
            $banner_image_path='front/images/banner_images/';
            $banner_image_file = $banner_image_path . $bannerImage->image;
            //delete banner image if exist in folder
            if(is_file($banner_image_file)){
                unlink($banner_image_file);
            }
            //Delete banner image from table
            Banner::where('id',$id)->delete();
            $message="Banner deleted Successfully!";
            return redirect('admin/banners')->with('success_message',$message);
    }
    public function addEditBanner( Request $request,$id=null){
        Session::put('page','banners');

        if ($id==""){
            //add banner
            $banner=new Banner;
            $title="Add Banner Image";
            $message="Banner added successfully!";
        }else{
            //update banner
            $banner=Banner::find($id);
            $title="Edit Banner Image";
            $message="Banner updated successfully!";
        }
        if ($request->isMethod('post')){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            $banner->type=$data['type'];
            $banner->link=$data['link'];
            $banner->title=$data['title'];
            $banner->alt=$data['alt'];
            $banner->status=1;

            if($data['type']=="Slider"){
               $width="1920";
               $height="720";
            }else if ($data['type']=="Fix"){
                $width="1920";
                $height="450";
            }
                   //Upload Banner image
        if($request->hasFile('image')){
            $image_tmp=$request->file('image');
            if ($image_tmp->isValid()){
                //get image extension
                $extension=$image_tmp->getClientOriginalExtension();
                //Generate new image name
                 $imageName=rand(111,99999).'.'.$extension;
                $imagePath='front/images/banner_images/'.$imageName;
               //upload the image
               Image::make($image_tmp)->resize($width,$height)->save($imagePath);
               $banner->image=$imageName;
            }
        }
            
            $banner->save();
            return redirect('admin/banners')->with ('success_message',$message);
        }
        return view ('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }
}
