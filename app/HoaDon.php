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
}
