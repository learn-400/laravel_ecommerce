<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable= ['name','sort_description','long_description','attribute_set','attribute','price','image','qty','category_id','brand_id','publication_status'];
}
