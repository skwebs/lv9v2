<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmitCard extends Model
{
    use HasFactory, SoftDeletes;
    
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