<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Uuids;
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany(__CLASS__, 'parent_id')->where('status' , 1);
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id')->select('id','name');
    }

    public function parentCategory(){
        return $this->belongsTo(__CLASS__, 'parent_id')->select('id','category_name');
    }

    public static function categoryDetails($url){
        $catDetails = self::select(['id','category_name','url','description','parent_id'])->with(['subcategories'=>
        function($query){
            $query->select(['id','category_name','url','description','parent_id'])->where(['status'=>1]);
        }
        ])->where(['url'=>$url])->first()->toArray();
        if($catDetails['parent_id'] == 0){
            /*Show main in breadcrumb*/
            $breadcrumbs = "<a href='".url($catDetails['url'])."'>".$catDetails['category_name']."</a>";
        }else{
            /*Show main and sub category in breadcrumb*/
            $ParentCategory = self::select(['category_name','url'])->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = "<a href='".route('front.listings.index',$ParentCategory['url'])."'>".$ParentCategory['category_name']."</a>
                            <span class=\"divider\">/</span>&nbsp;<a href='".route('front.listings.index',$catDetails['url'])."'>".$catDetails['category_name']."</a>";
        }
        $catIds = [];
        $catIds[] =  $catDetails['id'];
        foreach ( $catDetails['subcategories'] as $key => $subCat){
            $catIds[] = $subCat['id'];
        }
        return ['catIds'=>$catIds, 'catDetails'=> $catDetails, 'breadcrumbs'=>$breadcrumbs];
    }
}
