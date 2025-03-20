<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;

    public function globalCategory()
    {
        return $this->belongsTo(GlobalCategory::class);
    }
}
