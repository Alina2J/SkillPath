<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'student_id',
        'is_be',
        'task_id', // Если есть другие поля, добавьте их тоже
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

        public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }


}
