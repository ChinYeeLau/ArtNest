<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function cmspages(){
        Session::put('page','cmspages');
        $cms_pages=CmsPage::get()->toArray();
        return view('admin.pages.cms_pages')->with(compact('cms_pages'));
    }
    public function updatePageStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            if($data ['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }
    public function deletePage ($id){
        //Delete
      CmsPage::where('id',$id)->delete();
        $message="CMS Page has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
