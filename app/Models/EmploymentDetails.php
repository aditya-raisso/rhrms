<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','job_title','company_name','location','describer_work_here','currently_work_here','start_date','end_date',
    ];
}
