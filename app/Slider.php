<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $table = 'slider';
    protected $primaryKey = 'id';
    protected $fillable= ['name','image','sort_order','publication_status'];
}
