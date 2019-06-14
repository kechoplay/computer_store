<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    //
    protected $table = 'nhacungcap';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function sanpham()
    {
        return $this->hasMany('App\SanPham', 'sup_id', 'id');
    }
}
