<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    use HasFactory;

     protected $fillable = [
        'salary_type','department_id',
        
    ];

    public function getSalaryTypeAttribute($value)
    {
        return ucwords($value);
    }
}
