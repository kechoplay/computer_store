<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    //
    protected $table = 'khuyenmai';
    protected $primaryKey = "id";
    public $timestamps = false;

    public function sanpham(){
        return $this->belongsTo('App\SanPham','product_id','id');
    }
}
