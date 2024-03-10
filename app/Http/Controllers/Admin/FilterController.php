<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use DB;
use App\Http\Controllers\Controller;
use App\Models\ProductsFiltersValue;
use Illuminate\Support\Facades\View;



class FilterController extends Controller
{
    public function filters(){
        Session::put('page','filters');
        $filters=ProductsFilter::get()->toArray();
       // dd ($filters);
       return view('admin.filters.filters')->with(compact('filters'));
    }
    public function filtersValues(){
        Session::put('page','filters');
        $filters_values=ProductsFiltersValue::get()->toArray();
       // dd ($filters);
       return view('admin.filters.filters_values')->with(compact('filters_values'));
    }
    public function updateFilterStatus(Request $request){
        Session::put('page','filters');

        if($request->ajax()){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            if($data ['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            ProductsFilter::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }
    public function updateFilterValueStatus(Request $request){
        Session::put('page','filters-values');

        if($request->ajax()){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            if($data ['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            ProductsFiltersValue::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }
    public function addEditFilter(Request $request,$id=null){
        Session::put('page','filters');
        if($id==""){
            $title="Add Filter Columns";
            $filter=new ProductsFilter;
            //$getFilters=array();
            $message="Filter added successfully!";

        }else{
            $title="Edit Filter Columns";
            $filter= ProductsFilter::find($id);
            /*echo"<pre>";print_r($category['category_name']);die;*/
           // $getFilters=ProductsFilter::where(['filter_id'=>$filter['filter_id']])->get();
            $message="Filter updated successfully!";
        }
        if($request->isMethod('post')){
             $data=$request->all();
             /*echo "<pre>";print_r($data);die;*/
             $cat_ids=implode(',',$data['cat_ids']);
             //save filter column details table
             $filter->cat_ids=$cat_ids;
             $filter->filter_name=$data['filter_name'];
             $filter->filter_column=$data['filter_column'];
             $filter->status=1;
             $filter->save();
             //add filter column in products table
             DB::statement('ALTER TABLE products ADD ' . $data['filter_column'] . ' VARCHAR(255) AFTER description');
             return redirect('admin/filters')->with('success_message',$message);
        }
        //get section with categories 
$categories=Section::with('categories')->get()->toArray();
       
    return view('admin.filters.add_edit_filter')->with(compact('title','categories','filter'));
}
public function addEditFilterValue(Request $request,$id=null){
    Session::put('page','filters');
    if($id==""){
        $title="Add Filter Values";
        $filter=new ProductsFilterSValue;
        //$getFilters=array();
        $message="Filter Values added successfully!";

    }else{
        $title="Edit Filter Values";
        $filter=ProductsFilterSValue::find($id);
        /*echo"<pre>";print_r($category['category_name']);die;*/
       // $getFilters=ProductsFilter::where(['filter_id'=>$filter['filter_id']])->get();
        $message="Filter Values updated successfully!";
    }
    if($request->isMethod('post')){
         $data=$request->all();
         /*echo "<pre>";print_r($data);die;*/
        
         //save filter values details table
        
         $filter->filter_id=$data['filter_id'];
         $filter->filter_value=$data['filter_value'];
         $filter->status=1;
         $filter->save();
         //add filter values in products table
         return redirect('admin/filters-values')->with('success_message',$message);
    }
//get filters 
$filters=ProductsFilter::where('status',1)->get()->toArray();

   
return view('admin.filters.add_edit_filter_value')->with(compact('title','filter','filters'));
}
public function categoryFilters(Request $request)
{
    if ($request->ajax()) {
        $data = $request->all();
        $category_id = $data['category_id'];
        return response()->json([
            'view' => (string) View::make('admin.filters.category_filters')->with(compact('category_id'))
        ]);
    }
}
        }
    
    

