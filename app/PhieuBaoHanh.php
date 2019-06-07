<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuBaoHanh extends Model
{
    //
    protected $table = 'phieubaohanh';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function hoadon()
    {
        return $this->belongsTo('App\HoaDon', 'order_id', 'id');
    }

    public function sanpham()
    {
        return $this->belongsTo('App\SanPham', 'product_id', 'id');
    }
}
