<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //
    protected $primaryKey = 'MaSP';
    protected $table = 'sanpham';
    protected $guarded = [];
    public $timestamps = true;

    public function danhmuc()
    {
        return $this->belongsTo('App\DanhMuc', 'DM');
    }
}
