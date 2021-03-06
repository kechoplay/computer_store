<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'hoadon';
    protected $guarded = [];
    public $timestamps = true;

    public function chitiethoadon()
    {
        return $this->hasMany('App\ChiTietHoaDon','order_id', 'id');
    }

    public function tongtien() {
        $tongtien = 0;
        foreach($this->chitiethoadon as $chitiethoadon) {
            $tongtien += $chitiethoadon->tongtien();
        }
        return $tongtien;
    }

    public function hinhthucthanhtoan()
    {
        return $this->belongsTo('App\HinhThucThanhToan', 'payment_method', 'id');
    }

    public function nhanvien()
    {
        return $this->belongsTo('App\Admin', 'user_id', 'id');
    }
}
