<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendancesModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];
    protected $table = 'attendances'; // <- tambahkan ini
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
