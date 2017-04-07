<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_set extends Model
{
    //
    protected $table = 'attribute_set';
    protected $primaryKey = 'id';
    protected $fillable= ['name','value'];
}
