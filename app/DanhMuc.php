<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'danhmuc';
    protected $guarded = [];
    public $timestamps = true;
}
