<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhThucThanhToan extends Model
{
    //
    protected $table = 'hinhthucthanhtoan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
}
