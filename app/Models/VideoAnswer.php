<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'q1', 'q2', 'q3', 'q4', 'q5'
    ];
}
