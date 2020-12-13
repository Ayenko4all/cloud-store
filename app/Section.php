<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use Uuids;
    protected  $guarded = [];
    public function categories(){
        return $this->hasMany(Category::class, 'section_id')->where([
            'parent_id'=>0, 'status'=>1
        ])->with(['subcategories']);
    }
}
