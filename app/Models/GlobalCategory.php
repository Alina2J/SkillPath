<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalCategory extends Model
{
    public $timestamps = false;

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
}
