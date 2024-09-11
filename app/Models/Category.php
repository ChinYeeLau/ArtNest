<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }
    public function parentcategory(){
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }

    public static function categoryDetails($url){
        $categoryDetails = Category::select('id','parent_id','category_name','url','description','section_id','meta_title','meta_description','meta_keywords')
                                    ->with('section:id,name')
                                    ->where('url', $url)
                                    ->first();
    
        if (!$categoryDetails) {
            // Handle the case where no category is found for the given URL
            return null; // Or you can return an empty array or handle it differently based on your requirements
        }
    
        $categoryDetailsArray = $categoryDetails->toArray();
    
        // Construct breadcrumbs based on category hierarchy
        $breadcrumbs = '<li class="breadcrumb-item"><a href="' . url($categoryDetailsArray['url']) . '">'.$categoryDetailsArray['category_name'].'</a></li>';
    
        if ($categoryDetailsArray['parent_id'] != 0) {
            $parentCategory = Category::select('category_name','url')->where('id', $categoryDetailsArray['parent_id'])->first();
            if ($parentCategory) {
                $breadcrumbs = '<li class="breadcrumb-item"><a href="' . url($parentCategory['url']) . '">'.$parentCategory['category_name'].'</a></li>' . $breadcrumbs;
            }
        }
    
        $catIds = array($categoryDetailsArray['id']);
    
        $resp = array(
            'catIds' => $catIds,
            'categoryDetails' => $categoryDetailsArray,
            'breadcrumbs' => $breadcrumbs
        );
    
        return $resp;
    }
    
     public static function getCategoryName($category_id){
        $getCategoryName=Category::select('category_name')->where('id',$category_id)->first();
        return $getCategoryName->category_name;
     }
     public static function getCategoryStatus($category_id){
        $getCategoryStatus=Category::select('status')->where('id',$category_id)->first();
        return $getCategoryStatus->status;
     }
}
