<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyLeave extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','leave_apply_from','leave_apply_to','number_of_days','leave_type_id','reason_for_leave',
];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
