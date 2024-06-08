<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state',
        'mobile',
        'current_status',
        'portfolio',
        'status'
        // Add more attributes as needed
    ];
}