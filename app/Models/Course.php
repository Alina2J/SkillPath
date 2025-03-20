<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->hasMany(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
