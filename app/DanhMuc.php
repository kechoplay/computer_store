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

    public function parent()
    {
        return $this->belongsTo('App\DanhMuc', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\DanhMuc', 'parent_id')->where('cat_status', 1)->orderBy('sort_order', 'asc');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function sanpham()
    {
        return $this->hasMany('App\SanPham', 'cat_id', 'id');
    }
}
