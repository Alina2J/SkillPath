<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalizeResult extends Model
{
    use HasFactory;

    protected $table = 'normalize_results';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
