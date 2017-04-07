<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    //
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable= ['name','publication_status'];
}
