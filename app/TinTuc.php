<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = 'tintuc';
    protected $guarded = [];
    public $timestamps = true;

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
