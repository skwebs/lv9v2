<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'mother',
        'father',
        'gender',
        'dob',
        'aadhaar',
        'mobile',
        'address',
        'class',
        'roll',
        'student_type',
        'image',
        'created_by',
        'updated_by',
    ];
}