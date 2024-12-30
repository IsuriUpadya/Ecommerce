<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    // Specify the fillable fields
    protected $fillable = ['user_id', 'name', 'email'];
}
