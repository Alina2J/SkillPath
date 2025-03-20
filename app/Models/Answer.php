<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description',
        'task_id',
        'student_id',
        'mark',
        'file_url',
        'date',
    ];
}
