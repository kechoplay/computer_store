<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'sanpham';
    protected $guarded = [];
    public $timestamps = true;

    public function danhmuc()
    {
        return $this->belongsTo('App\DanhMuc', 'cat_id');
    }

    public function khuyenmai()
    {
        return $this->hasMany('App\KhuyenMai', 'product_id', 'id')->orderBy('end_time', 'DESC');
    }

    public function chitiethoadon()
    {
        return $this->hasMany('App\ChiTietHoaDon', 'product_id', 'id');
    }
}
