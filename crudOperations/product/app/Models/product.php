<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name', // Add other fields here as well
        'category',
        'active',
        'description',
       
        // Add other fields here
    ];
    use HasFactory;
}
