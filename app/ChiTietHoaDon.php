<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'chitiethoadon';
    protected $guarded = [];
    public $timestamps = true;

    public function hoadon()
    {
        return $this->belongsTo('App\HoaDon', 'order_id', 'id');
    }

    public function sanpham()
    {
        return $this->belongsTo('App\SanPham','product_id', 'id');
    }

    public function giathanhtoan() {
        return $this->price * (1 - $this->sale / 100);
    }
    public function tongtien(){
        return $this->giathanhtoan() * $this->quantity;
    }
}
