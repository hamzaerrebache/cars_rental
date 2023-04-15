<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;
    protected $fillable =[
        'First_name_client',
        'Last_name_client',
        'email_verified_at',
        'email_client',
        'password_client',
        'adress_client',
        'Code_postal_client',
        'city_client',
        'country_client',
        'pays_client'
    ];
}
