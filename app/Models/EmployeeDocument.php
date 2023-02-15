<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EmployeeDocument extends Model
{
    use HasFactory;
     protected $fillable = [
       'user_id','passport','passport','relieving_letter','salary_slip','aadhar_card','pencard_card','form_16',
    ];
}
