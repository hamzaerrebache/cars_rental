<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agencies extends Model
{
    use HasFactory;
    protected $fillable =[
        'agency_name','description','user_id'
    ];
}
